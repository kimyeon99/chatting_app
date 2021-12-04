<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    protected $fillable = ['text','to', 'from', 'InRoom'];
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

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
