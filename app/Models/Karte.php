<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Karte extends Model
{
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'body', 'achieve', 'challenge', 'reference', 'image', 'activity_time'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['image' => 'json'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['path', 'user', 'tags'];

    /**
     * User モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Tag モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    /**
     * 保存パスの追加
     *
     * @return String
     */
    public function getPathAttribute()
    {
        $karte_dir = '/storage/user/karte';

        return $karte_dir . '/' . $this->user()->first()->username . '/'
            . (new Carbon($this->created_at))->format('Y_md_Hi') . '/';
    }

    /**
     * ユーザーデータの追加
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    /**
     * タグデータの追加
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getTagsAttribute()
    {
        return $this->tags()->get();
    }
}
