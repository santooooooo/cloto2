<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'karte_id', 'post_id', 'body', 'media'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['media' => 'json'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['user', 'favorites_count', 'favorite_id_by_auth_user'];

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
     * Karte モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function karte()
    {
        return $this->belongsTo('App\Models\Karte');
    }

    /**
     * Post モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
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
     * ユーザーデータの追加
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getUserAttribute()
    {
        return $this->user()->first();
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
