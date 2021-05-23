<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $fillable = [
        'name',
        'description',
        'contact',
        'about',
        'reference',
        'user_id',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function skills()
    {
        return $this->hasMany('App\PostSkill');
    }

    static public function getPosts()
    {
        return DB::table('posts')->orderBy('created_at', 'desc')->paginate(10);
    }

}
