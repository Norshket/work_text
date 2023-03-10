<?php

namespace  App\Services\ListItems;

use App\Models\Hashtags\Hashtag;
use App\Models\ListItems\ListItem;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class ListItemService
{
    protected $translation = 'list_items.';

    /**
     * @return array
     */
    public function  index(): array
    {
        return [
            'dataTable' => $this->viewDataTable(),
        ];
    }

    /**
     * @return array
     */
    public function  create(): array
    {
        $data = [
            'method'    => 'create',
            'title'     =>  __('list_items.titles.create'),
            'users'     => User::whereHas('roles', function ($query) {
                $query->where('id', User::ROLE_USER);
            })->pluck('name', 'id'),
        ];

        return [
            'action'    => 'success',
            'method'    => 'create',
            'html'      => view('list_items.components.form')->with($data)->render()
        ];
    }

    /**
     * @param array $request
     * 
     * @return bool
     */
    public function store(array $request): bool
    {
        $request['author_id'] = auth()->id();
        $listItem = ListItem::create($request);

        if (isset($request['image'])) {
            $modelFile = $listItem->addMedia($request['image'])->toMediaCollection('images');
            $path = $modelFile->getPath();
            $listItem->crop($path, $request['image-width'], $request['image-height'], $request['image-x'], $request['image-y']);
        }
        $listItem->users()->sync($request['users']);
        $this->syncHashtags($listItem, $request['hashtags'] ?? []);
        return true;
    }



    /**
     * @param ListItem $listItem
     * 
     * @return array
     */
    public function show(ListItem $listItem): array
    {
        $data = [
            'model'     => $listItem->load(['hashtags', 'users', 'media']),
            'title'     =>  __('list_items.titles.show'),
        ];

        return [
            'action'    => 'success',
            'html'      => view('list_items.components.show')->with($data)->render()
        ];
    }



    /**
     * @param ListItem $listItem
     * 
     * @return array
     */
    public function edit(ListItem $listItem): array
    {
        $data = [
            'model'     => $listItem->load('hashtags'),
            'title'     =>  __('list_items.titles.edit'),
            'method'    => 'edit',
            'users'     => User::whereHas('roles', function ($query) {
                $query->where('id', User::ROLE_USER);
            })->pluck('name', 'id'),
        ];

        return [
            'action'    => 'success',
            'html'      => view('list_items.components.form')->with($data)->render()
        ];
    }

    /**
     * @param ListItem $listItem
     * @param array $request
     * 
     * @return bool
     */
    public function update(ListItem $listItem, array $request): bool
    {
        $listItem = tap($listItem)->update($request);

        if ($request['delete_image']) {
            $listItem->media()->delete();
        }


        if (isset($request['image'])) {
            $listItem->media()->delete();
            $modelFile = $listItem->addMedia($request['image'])->toMediaCollection('images');
            $path = $modelFile->getPath();
            $listItem->crop($path, $request['image-width'], $request['image-height'], $request['image-x'], $request['image-y']);
        }
        $listItem->users()->sync($request['users']);
        $this->syncHashtags($listItem, $request['hashtags'] ?? []);
        return true;
    }

    /**
     * @param ListItem $listItem
     * 
     * @return bool
     */
    public function delete(ListItem $listItem): bool
    {
        return $listItem->delete();
    }

    public function getQueryDataTable()
    {
        return ListItem::select('id', 'name', 'text', 'author_id')
            ->when(!auth()->user()->hasRole(User::ROLE_ADMIN), function ($query) {
                $query->where('author_id', '=', auth()->id())
                    ->orWhereHas('users', function ($query) {
                        $query->where('id', '=', auth()->id());
                    });
            });
    }

    /**
     * @return JsonResponse
     */
    public function datatable(): JsonResponse
    {
        return DataTables::of($this->getQueryDataTable())

            ->addColumn('actions', function ($item) {
                return view('list_items.components.action_button')->with(['model' =>  $item]);
            })
            ->toJson();
    }


    /**
     * @return Builder
     */
    public function viewDataTable(): Builder
    {
        return app(Builder::class)
            ->orders([0, 'asc'])
            ->setTableId('list_items-table')
            ->ajax(route('list_items.datatable'))
            ->pageLength(10)
            ->columns($this->getTableColumns())
            ->parameters([
                'paging' => true,
                'searching' => true,
                'sDom' => '<"top">rt<"bottom"><div>p<"clear">',
                'searchHighlight' => true,
                'language' => [
                    'url' => url('plugins/dt/Russian.json'),
                ]
            ]);
    }

    /**
     * @return array
     */
    public function getTableColumns(): array
    {
        return [
            [
                'title' => __($this->translation . 'datatable.id'),
                'data'  => 'id',
                'width' => '5%'
            ],
            [
                'title' => __($this->translation . 'datatable.name'),
                'data'  => 'name',
            ],
            [
                'title'     => __($this->translation . 'datatable.actions'),
                'data'      => 'actions',
                'searchable' => false,
                'sortable'  => false,
                'width'     => '10%',
            ]
        ];
    }

    /**
     * ???????????? ??????????????, ???????? ?? ???????? ?????????????? ?????? - ??????????????
     *
     * @param ListItem $listItem
     * @param array $hashtags
     * 
     * @return bool
     */
    public function syncHashtags(ListItem $listItem, array $hashtags): bool
    {
        $hashtagIds = [];
        foreach ($hashtags as $item) {
            $hashtagIds[] = Hashtag::firstOrCreate(['name' => $item])->id;
        }
        $listItem->hashtags()->sync($hashtagIds);
        return true;
    }
}
