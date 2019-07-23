<?php

namespace App\DataTables;

use App\Http\Resources\HashtagTweetsResource;
use App\Tweet;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class HashtagTweetsDataTable extends DataTable
{

    protected $hashtag;


    /**
     * HashtagTweetsDataTable constructor.
     * @param $hashtag
     */
    public function __construct($hashtag)
    {
        $this->hashtag = $hashtag;
    }

    /**
     * Build DataTable class.
     * @param $query
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))->setTransformer(function ($item) {
            return HashtagTweetsResource::make($item)->resolve();
        });
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Tweet::query()->select('tweets.*')
            ->leftJoin('hashtag_tweet', 'tweets.id', 'hashtag_tweet.tweet_id')
            ->where('user_id', Auth::id())
            ->where('hashtag_tweet.hashtag_id', $this->hashtag->id)
            ->distinct();

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