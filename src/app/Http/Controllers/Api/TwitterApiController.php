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

    // フロントに返すレスポンスを定義
    $response = $request;

    // 開発用: データが見やすいようにjson_encode関数にオプション付与
    function json_dev($data) {
      return json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    /**
     * ツイート時間を datetime に変換。
     * この時点で日本時間に修正済（APIレスポンス -> UTCタイムスタンプ）
     * 時間まで知りたいとき -> @param1 に 'Y-m-d H:i:s' を入れる。
     */
    $created_at = date('Y-m-d', strtotime((string) $request[0]->created_at));
    $separate_created = explode("-", $created_at);

    $created_date = array(
      'year'  => $separate_created[0],
      'month' => $separate_created[1],
      'date'  => $separate_created[2],
    );

    // レスポンスにデータを格納
    $response[0]->created_date = $created_date;

    // 現在日時取得のため、CarbonControllerからメソッドを呼ぶ
    $carbon_controller = app()->make('App\Http\Controllers\CarbonController');
    $response[0]->current_date = $carbon_controller->getCurrentDate();

    // データをjson形式に変換
    $response = json_encode($response);

    /**
     * URL直打ちしたら情報出てきてしまうので対策する。（http://localhost:8080/api/twitter）
     */
    return $response;
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
