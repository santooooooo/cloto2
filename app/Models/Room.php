<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['sections'];

    public $timestamps = false;

    /**
     * Section モデルのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }

    /**
     * 座席データの追加
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getSectionsAttribute()
    {
        return $this->sections()->with('seats.user')->get();
    }
}
