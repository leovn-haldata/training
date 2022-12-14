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
            ->addColumn('description', function ($row) {
                return substr($row->description, 0, 50);
            })
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $url_view = route('products.show',[$row->id]);
                $url_edit = route('products.edit',[$row->id]);
                $url_del = route('products.destroy',[$row->id]);

                $btn  = '<div class="btn-toolbar mb-lg-1" role="group" aria-label="Basic example">';
                $btn .= '<a target="blank" href="' . $url_view . '" class="btn  btn-sm"><i class="fa fa-eye"></i></a>';
                $btn .= '<a href="' . $url_edit . '" class="btn"><i class="fa fa-pen"></i> </a>';

                $btn .= '<form action="' . $url_del .'" method="POST">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button type="submit" onclick="return confirm(\'Bạn có muốn xoá sản phẩm ' .
                    $row->product_name .' không?\')"
                        class="edit btn btn-danger btn-sm" style="display: inline-list"><i class="fa fa-trash-alt"></i></a>
                    </form>';
                $btn .= '</div>';

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
            ->ajax('');


    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id')
                ->title('Id')
                ->searchable(true)
                ->orderable(true),
            Column::make('product_name')->title('Product Name'),
            Column::make('description')->title('Description')
            ->content(100),
            Column::make('product_price')->title('Price'),
            Column::make('is_sales')->title('Status'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(true)
                ->printable(true)
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
