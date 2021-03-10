<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CarbonController extends Controller
{
  /**
   * 現在日付取得
   */
  public function getCurrentDate()
  {
    // dateインスタンス
    $date = Carbon::now('Asia/Tokyo');
    $separate_date = explode('-', $date->toDateString());

    // 扱いやすい配列に整形
    $current_date = array(
      'year'  => $separate_date[0],
      'month' => $separate_date[1],
      'date'  => $separate_date[2],
    );

    return $current_date;
  }
}
