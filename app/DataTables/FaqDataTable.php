<?php

namespace App\DataTables;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Storage;

class FaqDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($faq) {
                $editBtn = '<a href="' . route('faqs.edit', $faq->id) . '" class="btn details btn-success mt-1">Edit</a>';
                if ($faq->deleted_at === null) {
                    // faq is not soft-deleted, show delete button
                    $deleteBtn = '<form action="' . route('faqs.destroy', $faq->id) . '" method="POST" class="delete-form">';
                    $deleteBtn .= csrf_field();
                    $deleteBtn .= method_field('DELETE');
                    $deleteBtn .= '<button type="submit" class="btn details btn-danger mt-1"><i class="fas fa-trash"></i> Delete</button>';
                    $deleteBtn .= '</form>';
                } else {
                    // faq is soft-deleted, show restore button
                    $deleteBtn = '<form action="' . route('faqs.restore', $faq->id) . '" method="GET" class="delete-form">';
                    $deleteBtn .= csrf_field();
                    // $deleteBtn .= method_field('GET'); // Assuming you're using PATCH method for restore
                    $deleteBtn .= '<button type="submit" class="btn details btn-success mt-1"><i class="fas fa-undo"></i> Restore</button>';
                    $deleteBtn .= '</form>';
                }
                return $editBtn . $deleteBtn;
            })
            ->addColumn('images', function ($faq) {
                $images = '<div id="carouselExampleControls_' . $faq->id . '" class="carousel slide" data-ride="carousel">';
                            $images .= '<div class="carousel-inner">';
                            $imagePaths = explode(',', $faq->img_path);
                            foreach ($imagePaths as $key => $imagePath) {
                                $images .= '<div class="carousel-item' . ($key == 0 ? ' active' : '') . '">';
                                $images .= '<img class="d-block w-100 " src="' . asset($imagePath) . '" alt="Slide ' . ($key + 1) . '" style="width: 40px; height: 150px;">';
                                $images .= '</div>';
                            }
                            $images .= '</div>';
                            $images .= '<a class="carousel-control-prev" href="#carouselExampleControls_' . $faq->id . '" role="button" data-slide="prev">';
                            $images .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            $images .= '<span class="sr-only">Previous</span>';
                            $images .= '</a>';
                            $images .= '<a class="carousel-control-next" href="#carouselExampleControls_' . $faq->id . '" role="button" data-slide="next">';
                            $images .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            $images .= '<span class="sr-only">Next</span>';
                            $images .= '</a>';
                            $images .= '</div>';
                            return $images;
                        })
                        ->rawColumns(['action', 'images'])
                        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        return Faq::query()->withTrashed()->orderBy('id', 'asc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('product-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->parameters([
            'dom'          => 'Bfrtip',
            'buttons'      => ['export', 'print', 'reset', 'reload'],
        ])
        ->orderBy(1)
        ->selectStyleSingle();
                    // ->buttons([
                    //     Button::make('excel'),
                    //     Button::make('csv'),
                    //     Button::make('pdf'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('category'),
            Column::make('question'),
            Column::make('answer'),
            Column::computed('images')
            ->title('Images')
            ->orderable(false)
            ->searchable(false)
            ->width(200),
            Column::make('deleted_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Faq_' . date('YmdHis');
    }
}
