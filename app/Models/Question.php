<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'body', 'tried'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['user', 'answers_count', 'stars_count', 'star_id_by_auth_user'];

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
     * Answer モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    /**
     * Star モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stars()
    {
        return $this->hasMany('App\Models\Star');
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
     * 回答数の追加
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAnswersCountAttribute()
    {
        return $this->answers()->count();
    }

    /**
     * スター数の追加
     *
     * @return \Illuminate\Support\Collection
     */
    public function getStarsCountAttribute()
    {
        return $this->stars()->count();
    }

    /**
     * ログインユーザーによるスターIDの追加
     *
     * @return Int|Null
     */
    public function getStarIdByAuthUserAttribute()
    {
        $star = $this->stars()->select('id')->where('user_id', Auth::id())->first();
        return $star ? $star->id : null;
    }
}
