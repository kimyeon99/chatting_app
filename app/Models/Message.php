<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    protected $fillable = ['text','to', 'from', 'InRoom'];

    public function from(){
        return $this->belongsTo(User::class, 'from');
    }

    public function to(){
        return $this->belongsTo(User::class, 'to');
    }

    public function InRoom(){
        return $this->belongTo(Room::class, 'InRoom');
    }
}
