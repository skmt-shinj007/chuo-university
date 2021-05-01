<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// rilations
use App\Models\Prefecture;
use App\Http\Resources\PrefectureResource;

class MemberResource extends JsonResource
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
                'name' => [
                    'ja' => $this->last_name_ja.' '.$this->first_name_ja,
                    'kana' => $this->last_name_kana.' '.$this->first_name_kana,
                    'en' => $this->last_name_en.' '.$this->first_name_en,
                ],
                'img' => [
                    'src' => 'hogehoge.jpg',
                    'alt' => null,
                ],
                'from' => [
                    'place' => Prefecture::find($this->prefecture_id),
                    'alma_mater' => $this->alma_mater,
                ],
                'post' => [
                    'club' => null,
                    'alumni' => null
                ],
                'graduate' => [
                    'age' => null,
                    'year' => null,
                ]
        ];
    }
}
