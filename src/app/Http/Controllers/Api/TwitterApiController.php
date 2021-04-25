<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CarbonController;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterApiController extends Controller
{
  /**
   * Twitter Apiに接続
   * バージョン：1.1
   */
  private function connection()
  {
    $consumer_key = env('TWITTER_API_KEY', '');
    $consumer_secret = env('TWITTER_API_KEY_SECRET', '');
    $access_token = env('TWITTER_API_ACCESS_TOKEN', '');
    $access_token_secret = env('TWITTER_API_ACCESS_TOKEN_SECRET', '');

    // APIに接続
    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

    return $connection;
  }

  /**
   * タイムラインを3件取得する
   * @return \Illuminate\Http\Response
   */
  public function getTimeline()
  {
    // 直近3投稿の取得をリクエスト
    $request = $this->connection()->get('statuses/user_timeline',
      array(
        'count' => '3',
      )
    );

    // フロントに返すレスポンスを定義
    $response = $request;

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
    $response[0]->current_date = (new CarbonController)->getCurrentDate();

    // データをjson形式に変換
    $response = json_encode($response);

    /**
     * TODO:URL直打ちしたら情報出てきてしまうので対策する。（http://localhost:8080/api/twitter）
     */
    return $response;
  }

  /**
   * アカウント情報
   * @return Object アカウント情報
   */
  public function getAccount()
  {
    $response = $this->connection()->get('account/verify_credentials');
    $baseUrl = config('constants.twitter.baseUrl');
    $response->link = $baseUrl . $response->screen_name;

    $user = json_encode($response);
    return $user;
  }

  /**
   * プロバイダーのユーザー情報取得
   * @return Array ユーザー情報
   */
  public function getProvider()
  {
    $providers = config('constants.twitter.providers');
    $provider_ids = array_values($providers);

    $params = [
      'user_id' => $provider_ids
    ];
    $response = $this->connection()->get('users/lookup', $params);
    json_encode($response);

    return $response;
  }
}
