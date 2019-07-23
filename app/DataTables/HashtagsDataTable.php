<?php

namespace App\DataTables;

use App\Hashtag;
use App\Http\Resources\HashtagResource;
use App\Http\Resources\TweetResource;
use App\Tweet;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class HashtagsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     */
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))->setTransformer(function ($item) {
            return HashtagResource::make($item)->resolve();
        });
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Hashtag::query()->whereHas('tweets', function ($q) {
            return $q->where('user_id', Auth::id());
        });

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'text',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'tweets_' . time();
    }
}