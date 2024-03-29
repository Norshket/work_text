<?php

namespace  App\Services\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class UserService
{
    protected $translation = 'users.';

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
            'title'  =>  __($this->translation . "titles.create"),
        ];

        return [
            'action'    => 'success',
            'html'      => view('users.components.form')->with($data)->render()
        ];
    }

    /**
     * @param array $request
     * 
     * @return bool
     */
    public function store(array $request): bool
    {
        $user = User::create($request);
        $user->assignRole('user');
        $user->givePermissionTo(['list_items_open', 'users_close']);

        return true;
    }

    /**
     * @param User $user
     * 
     * @return array
     */
    public function edit(User $user): array
    {
        $data = [
            'model'     => $user,
            'title'     =>  __($this->translation . "titles.edit"),
            'method'    => 'edit',
        ];

        return [
            'action'    => 'success',
            'html'      => view('users.components.form')->with($data)->render()
        ];
    }

    /**
     * @param User $user
     * @param array $request
     * 
     * @return bool
     */
    public function update(User $user, array $request): bool
    {
        return $user->update($request);
    }

    /**
     * @param User $user
     * 
     * @return array
     */
    public function delete(User $user): array
    {
        $delete = false;
        if ($user->checkRelationship()) {
            $delete = $user->delete();
        }

        return [
            'is_delete' => $delete,
            'message' => $delete ? __('toastr.success') : __('toastr.error')
        ];
    }

    public function getQueryDataTable()
    {
        return User::select('id', 'name', 'email');
    }


    public function datatable()
    {
        return DataTables::of($this->getQueryDataTable())

            ->addColumn('actions', function ($item) {
                $data = [
                    'delete' => route('users.destroy', $item),
                    'edit' => route('users.edit', $item),
                    'permissions' => route('user_permissions.edit', $item),

                    'canDelete' => Auth::user()->can('delete', $item),
                    'canUpdate' => Auth::user()->can('update', $item),
                    'isAdmin' => $item->id === User::ADMIN
                ];
                return view('users.components.action_button')->with($data);
            })
            ->toJson();
    }


    public function viewDataTable()
    {
        return app(Builder::class)
            ->orders([0, 'asc'])
            ->setTableId('users-table')
            ->ajax(route('users.datatable'))
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
                'title' => __($this->translation . 'datatable.email'),
                'data'  => 'email',
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
}
