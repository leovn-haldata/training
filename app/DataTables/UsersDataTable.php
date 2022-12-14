<?php

namespace App\DataTables;

use App\Http\Controllers\UsersController;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn('group_role',
                function ($row) {
                    return $this->getGroup($row->group_role);
                })
            ->addColumn('is_active',
                function ($row) {
                    return (new \App\Http\Controllers\UsersController)->status($row->is_active);
                })
            ->addColumn('action',
                function ($row) {
                    $url_active = route('users.active', [$row->id]);
                    $url_edit = route('users.edit', [$row->id]);
                    $url_del = route('users.destroy', [$row->id]);

                    $btn = '<div class="btn-toolbar mb-lg-1" role="group" aria-label="Basic example">';
                    $btn .= '<a href="' . $url_edit . '" class="btn"><i class="fa fa-pen"></i> </a>';

                    $btn .= '<div><form action="' . $url_del . '" method="POST">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" onclick="return confirm(\'Bạn có muốn xoá không?\')"
                        class="edit btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                    </form></div>';
                    $btn .= '<a onclick="return confirm(\'Bạn có muốn khóa/mở khóa không?\')" href="' . $url_active . '" class="btn"><i class="fa fa-user-lock"></i></a>';

                    $btn .= '</div>';
                    return $btn;
                });
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return Builder
     */
    public function query()
    {
        $model = User::where(['is_delete' => 0]);

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
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id')->title('#'),
            Column::make('name')->title(trans('global.name')),
            Column::make('email')->title(trans('global.email')),
            Column::make('group_role')->title(trans('global.group')),
            Column::make('is_active')->title(trans('global.status')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
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
        return 'Users_' . date('YmdHis');
    }

    public function getGroup($id)
    {
        $group = Roles::where('id', $id)->first();
        return (!$group ? trans('global.group_error') : $group->title ) ;
    }

}
