<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// 使用するリソース
use App\Http\Resources\PrefectureResource;
use App\Http\Resources\PositionResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->user_id,
            'name_ja' => $this->last_name_ja.' '.$this->first_name_ja,
            'name_kana' => $this->last_name_kana.' '.$this->first_name_kana,
            'name_en' => $this->last_name_en.' '.$this->first_name_en,
            'img' => [
                'src' => 'test.jpg',
                'alt' => 'テストaltタグ',
            ],
            // [TODO:] 確認中。不必要であれば削除
            'post' => [
                'club' => null,
                'alumni' => null
            ],
            'graduate_date' => $this->graduation_year,
            'alma_mater' => $this->alma_mater,
            'prefecture' => PrefectureResource::make($this->prefecture),
            'position' => PositionResource::make($this->position),
            'grade' => $this->grade,
        ];
    }
}
