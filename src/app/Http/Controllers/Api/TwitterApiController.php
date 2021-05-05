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
    $response = $this->connection()->get('statuses/user_timeline',
      array(
        'count' => '3',
      )
    );

    // APIにデータを追加するために扱う変数を定義。
    $current_date = CarbonController::getCurrentDate('Y-m');
    $base_link_uri = config('constants.twitter.base_uri');

    foreach ($response as $index => $value) {
      $created_date = date('Y-m', strtotime((string) $value->created_at));
      $screen_name = $value->user->screen_name;

      $value->created_date = $created_date;
      $value->link = $base_link_uri . $screen_name . '/status/' . $value->id_str;
      $value->new = ($created_date === $current_date) ? true : false;
    };

    /**
     * TODO:URL直打ちしたら情報出てきてしまうので対策する。（http://localhost:8080/api/twitter）
     */
    return response()->json($response);
  }

  /**
   * アカウント情報
   * @return Object アカウント情報
   */
  public function getAccount()
  {
    $data = config('constants.twitter');
    $response = $this->connection()->get('account/verify_credentials');

    $response->service_name = (object) $data['name'];
    $response->link = $data['base_uri'] . $response->screen_name;
    $response->icon_name = $data['icon_name'];

    return response()->json($response);
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
