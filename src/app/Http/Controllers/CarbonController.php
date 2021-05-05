<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CarbonController extends Controller
{
  /**
   * 現在日付取得
   * @param string format
   */
  public static function getCurrentDate($format)
  {
    // dateインスタンス
    $date = Carbon::now('Asia/Tokyo');
    return $date->format($format);
  }
}
