<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
    protected $appends = ['path', 'user', 'tags', 'comments_count', 'favorites_count', 'favorite_id_by_auth_user'];

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
     * Comment モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Favorite モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
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

    /**
     * コメント数の追加
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    /**
     * いいね数の追加
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    /**
     * ログインユーザーによるいいねIDの追加
     *
     * @return Int|Null
     */
    public function getFavoriteIdByAuthUserAttribute()
    {
        $favorite = $this->favorites()->select('id')->where('user_id', Auth::id())->first();
        return $favorite ? $favorite->id : null;
    }
}
