<?php

namespace  App\Services\ListItems;

use App\Models\ListItems\ListItem;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class ListItemService
{

    protected $translation = 'list_items.';

    public function  index()
    {
        return [
            'dataTable' => $this->viewDataTable(),
        ];
    }

    public function  create()
    {
    }

    public function  store(array $request)
    {
    }

    public function  edit(ListItem $listItem)
    {
    }

    public function  update(ListItem $listItem, array $request)
    {
    }

    public function delete(ListItem $listItem)
    {
    }

    public function getQueryDataTable()
    {
        return ListItem::select('id', 'name');
    }


    public function datatable()
    {
        return DataTables::of($this->getQueryDataTable())->toJson();
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



    public function getTableColumns()
    {
        return [
            [
                'title' => __($this->translation . 'datatable.id'),
                'data' => 'id',
                'width' => '5%'
            ],
            [
                'title' => __($this->translation . 'datatable.name'),
                'data' => 'name',
            ]
        ];
    }
}
