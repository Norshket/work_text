<?php

namespace  App\Services\ListItems;

use App\Models\Hashtags\Hashtag;
use App\Models\ListItems\ListItem;
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

    public function  create(): array
    {

        $data = [
            'method' => 'create',
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
        $listItem = ListItem::create($request);
        $this->syncHashtags($listItem, $request['hashtags'] ?? []);
        return true;
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
            'method'    => 'edit',
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
        return ListItem::select('id', 'name', 'text');
    }


    public function datatable()
    {
        return DataTables::of($this->getQueryDataTable())

            ->addColumn('actions', function ($item) {
                $data = [
                    'delete' => route('list-items.destroy', $item),
                    'edit' => route('list-items.edit', $item)
                ];
                return view('list_items.components.action_button')->with($data);
            })
            ->toJson();
    }


    public function viewDataTable()
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
     * Крепим хэштеги, если в базе таковых нет - создаем
     *
     * @param ListItem $listItem
     * @param array $hashtags
     * 
     * @return bool
     */
    public function syncHashtags(ListItem $listItem, array $hashtags): bool
    {
        $hashtagIds =[];
        foreach ($hashtags as $item) {
            $hashtagIds[] = Hashtag::firstOrCreate(['name' => $item])->id;
        }
        $listItem->hashtags()->sync($hashtagIds);
        return true;
    }
}
