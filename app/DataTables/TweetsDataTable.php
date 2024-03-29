<?php

namespace App\DataTables;

use App\Http\Resources\TweetResource;
use App\Tweet;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class TweetsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     */
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))->setTransformer(function ($item) {
            return TweetResource::make($item)->resolve();
        });
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Tweet::query()->where('user_id', Auth::id())->with('hashtags');

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
            'id',
            'text',
            'user_id',
            'hashtags',
            'retweet_count',
            'favorite_count',
            'twitter_created_at',
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