<?php

namespace App\DataTables;

use App\Models\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query): \Yajra\DataTables\DataTableAbstract
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {

                $url_edit = route('customers.edit', [$row->id]);

                $btn = '<div class="btn-toolbar mb-lg-1" role="group" aria-label="Basic example">';
                $btn .= '<a href="' . $url_edit . '" class="btn"><i class="fa fa-pen"></i> </a>';

                $btn .= '</div>';
                return $btn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
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
                    ->setTableId('customers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy('0');
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
                ->title('#'),
            Column::make('customer_name')
                ->title(trans('cruds.customer.fields.full_name')),
            Column::make('email')
                ->title(trans('cruds.customer.fields.email')),
            Column::make('address')
                ->title(trans('cruds.customer.fields.address')),
            Column::make('tel_num')
                ->title(trans('cruds.customer.fields.phone')),
            Column::computed('action')
                ->width('15%')
                ->title('')
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
        return 'Customers_' . date('YmdHis');
    }
}
