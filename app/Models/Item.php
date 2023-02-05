<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'detail',
    ];

    const TYPE = [
        1 => "野菜",
        2 => "肉類",
        3 => "魚類",
        4 => "調味料",
        5 => "インスタント",
        6 => "菓子類",
        7 => "冷凍食品",
        8 => "飲料水"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
