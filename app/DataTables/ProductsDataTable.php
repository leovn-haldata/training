<?php

namespace App\DataTables;

use App\Http\Controllers\ProductsController;
use App\Models\Products;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {


        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($row) {
                $url = url('/products/') . $row->product_id;
                $btn = '<a target="blank" href="' . $url . '" class="edit btn btn-info btn-sm">View</a>';
                $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';

                return $btn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Products $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Products $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters([
                'dom'          => 'Bfrtip',
                'buttons'      => ['export', 'print', 'reset', 'reload'],
            ]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('product_id')
                ->title('Id')
                ->searchable(true)
                ->orderable(true),
            Column::make('product_name')->title('Product Name'),
            Column::make('description')->title('description'),
            Column::make('product_price')->title('Price'),
            Column::make('is_sales')->title('Status'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(true)
                ->printable(true)
                ->width(60)
                ->addClass('text-center'),
            ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Products_' . date('YmdHis');
    }
}
