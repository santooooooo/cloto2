<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use App\Notifications\Auth\VerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'handlename', 'icon', 'sns', 'web', 'introduction',
        'type', 'role', 'seat_id', 'in_progress'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'sns' => 'json'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status', 'follows', 'followers'];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    /**
     * Seat モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seat()
    {
        return $this->belongsTo('App\Models\Seat');
    }

    /**
     * Karte モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kartes()
    {
        return $this->hasMany('App\Models\Karte');
    }

    /**
     * Inquiry モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inquiries()
    {
        return $this->hasMany('App\Models\Inquiry');
    }

    /**
     * ログイン状態の確認
     *
     * @return \Illuminate\Support\Facades\Cache
     */
    public function isOnline()
    {
        return Cache::has('user-' . $this->id);
    }

    /**
     * 状態の取得
     *
     * @return \Illuminate\Support\Facades\Cache
     */
    public function status()
    {
        return Cache::get('user-' . $this->id);
    }

    /**
     * Followers のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    /**
     * Followers のリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    /**
     * フォローしているか
     *
     * @param  Int $user_id フォロー先のユーザー
     * @return Boolean
     */
    public function isFollowing(Int $user_id)
    {
        return $this->follows()->where('followed_id', $user_id)->exists();
    }

    /**
     * フォローされているか
     *
     * @param  Int $user_id フォロー元のユーザー
     * @return Boolean
     */
    public function isFollowed(Int $user_id)
    {
        return $this->followers()->where('following_id', $user_id)->exists();
    }

    /**
     * 状態データの追加
     *
     * @return \Illuminate\Support\Facades\Cache
     */
    public function getStatusAttribute()
    {
        return $this->status();
    }

    /**
     * フォロー数の追加
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFollowsAttribute()
    {
        return $this->follows()->count();
    }

    /**
     * フォロワー数の追加
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFollowersAttribute()
    {
        return $this->followers()->count();
    }
}
