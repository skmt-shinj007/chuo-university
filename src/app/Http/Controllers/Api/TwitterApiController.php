<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterApiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // APIキー
    $consumer_key = config('keys.twitter.api_key');

    // シークレットAPIキー
    $consumer_secret = config('keys.twitter.api_key_secret');

    // アクセストークン
    $access_token = config('keys.twitter.access_token');

    // シークレットアクセストークン
    $access_token_secret = config('keys.twitter.access_token_secret');

    // APIに接続
    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

    // 直近3投稿の取得をリクエスト
    $request = $connection->get('statuses/home_timeline',
      array(
        'count' => '3',
      )
    );

    // リクエストの内容を変数に格納。（データをいじれるように）
    $twitterResponse = json_encode($request);

    return $twitterResponse;
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
