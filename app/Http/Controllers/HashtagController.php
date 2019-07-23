<?php

namespace App\Http\Controllers;

use App\DataTables\HashtagsDataTable;
use App\DataTables\HashtagTweetsDataTable;
use App\DataTables\TweetsDataTable;
use App\Hashtag;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HashtagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param HashtagsDataTable $dataTable
     * @return Response
     */
    public function index(Request $request, HashtagsDataTable $dataTable)
    {

        return $dataTable->render('hashtags.index');
    }

    /**
     * @param Request $request
     * @param Hashtag $hashtag
     * @return mixed
     */
    public function getHashtagTweets(Request $request, Hashtag $hashtag)
    {
        $dataTable = new HashtagTweetsDataTable($hashtag);
        return $dataTable->render('tweets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Tweet $tweet
     * @return Response
     */
    public function show(Tweet $tweet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Tweet $tweet
     * @return Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Tweet $tweet
     * @return Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Tweet $tweet
     * @return Response
     */
    public function destroy(Tweet $tweet)
    {
        //
    }
}
