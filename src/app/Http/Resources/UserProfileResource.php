<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// 使用するリソース
use App\Http\Resources\PrefectureResource;
use App\Http\Resources\PositionResource;
use App\Http\Resources\TagResource;

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
            // [TODO:] テスト
            'img' => [
                'src' => 'test.jpg',
                'alt' => 'テストaltタグ',
            ],
            'tags' => TagResource::collection($this->tags),
            'graduate_date' => $this->graduation_year,
            'alma_mater' => $this->alma_mater,
            'prefecture' => PrefectureResource::make($this->prefecture),
            'position' => PositionResource::make($this->position),
            'grade' => $this->grade,
            'affiliation' => $this->affiliation,
            'achievement' => $this->achievement
        ];
    }
}
