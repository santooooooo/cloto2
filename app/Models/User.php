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
    protected $appends = ['status', 'follows_count', 'followers_count', 'seat', 'room'];

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
     * Chat モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chats()
    {
        return $this->hasMany('App\Models\Chat');
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
     * Post モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
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
    public function getFollowsCountAttribute()
    {
        return $this->follows()->count();
    }

    /**
     * フォロワー数の追加
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFollowersCountAttribute()
    {
        return $this->followers()->count();
    }

    /**
     * 座席データの追加
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getSeatAttribute()
    {
        return $this->seat()->first();
    }

    /**
     * 部屋データの追加
     *
     * @return Array
     */
    public function getRoomAttribute()
    {
        $seat = $this->seat()->first();

        // 着席前
        if (empty($seat)) {
            return null;
        }

        $room = $seat->section()->first()->room;
        return ['id' => $room->id, 'name' => $room->name];
    }

    /**
     * フォローしているか
     *
     * @param  Int  $user_id  フォロー先のユーザー
     * @return Boolean
     */
    public function isFollowing(Int $user_id)
    {
        return $this->follows()->where('followed_id', $user_id)->exists();
    }

    /**
     * フォローされているか
     *
     * @param  Int  $user_id  フォロー元のユーザー
     * @return Boolean
     */
    public function isFollowed(Int $user_id)
    {
        return $this->followers()->where('following_id', $user_id)->exists();
    }

    /**
     * 通知の取得
     *
     * @param  Int  $limit  取得件数
     * @return Array  通知一覧
     */
    public function getNotifications(Int $limit = 10)
    {
        $notifications = [];
        $unread_notifications_count = 0;

        // データの作成
        foreach ($this->notifications()->take($limit)->get() as $notification) {
            $data = ['read_at' => $notification->read_at];
            $user = $this->find($notification->data['user_id']);

            $type = explode('\\', $notification->type);
            switch (end($type)) {
                case 'UserFollowed':
                    // フォロー通知
                    $data += [
                        'type' => 'UserFollowed',
                        'username' => $user->username,
                        'message' => $user->handlename . 'さんにフォローされました！'
                    ];
                    break;

                case 'KarteCommentPosted':
                    // カルテへのコメント通知
                    $data += [
                        'type' => 'KarteCommentPosted',
                        'karte_id' => $notification->data['karte_id'],
                        'message' => 'カルテに' . $user->handlename . 'さんがコメントしました！'
                    ];
                    break;

                case 'PostCommentPosted':
                    // 投稿へのコメント通知
                    $data += [
                        'type' => 'PostCommentPosted',
                        'post_id' => $notification->data['post_id'],
                        'message' => '投稿に' . $user->handlename . 'さんがコメントしました！'
                    ];
                    break;

                case 'KarteFavorited':
                    // カルテへのいいね通知
                    $data += [
                        'type' => 'KarteFavorited',
                        'karte_id' => $notification->data['karte_id'],
                        'message' => 'カルテに' . $user->handlename . 'さんがいいねしました！'
                    ];
                    break;

                case 'PostFavorited':
                    // 投稿へのいいね通知
                    $data += [
                        'type' => 'PostFavorited',
                        'post_id' => $notification->data['post_id'],
                        'message' => '投稿に' . $user->handlename . 'さんがいいねしました！'
                    ];
                    break;

                case 'CommentFavorited':
                    // コメントへのいいね通知
                    $data += ['message' => 'コメントに' . $user->handlename . 'さんがいいねしました！'];

                    if (!empty($notification->data['karte_id'])) {
                        $data += [
                            'type' => 'CommentToKarteFavorited',
                            'karte_id' => $notification->data['karte_id'],
                        ];
                    } else if (!empty($notification->data['post_id'])) {
                        $data += [
                            'type' => 'CommentToPostFavorited',
                            'post_id' => $notification->data['post_id'],
                        ];
                    }
                    break;
            }

            array_push($notifications, $data);

            // 未読通知数のカウント
            if (empty($notification->read_at)) {
                $unread_notifications_count += 1;
            }
        }

        return compact('notifications', 'unread_notifications_count');
    }
}
