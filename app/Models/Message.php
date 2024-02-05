<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = "messages";
    protected $guarded = [];
    protected $primaryKey = 'Id';

    public function user()
    {
        return $this->belongsTo(User::class,'UserId','Id');
    }
}
