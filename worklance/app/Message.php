<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'from_user_id'
    ];

    public function toUser()
    {
        return $this->belongsTo('App\User');
    }

    static public function getArchivedChats()
    {
        $user_id = Auth()->user()->id;
        $archivedChats1 = self::where('user_id', $user_id)->pluck('from_user_id');
        $archivedChats2 = self::where('from_user_id', $user_id)->pluck('user_id');
        return $archivedChats1->merge($archivedChats2)->toArray();
    }
}
