<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = "tickets";
    protected $guarded = [];
    protected $primaryKey = 'Id';

    public function messages()
    {
        return $this->hasMany(Message::class,'TicketId','Id')->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'UserId','Id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class,'CategoryId','Id');
    }
    public function getStatusAttribute($status)
    {
        switch ($status){
            case 0:
                $status='<span class="label text-warning d-flex"><div class="dot-label bg-warning ml-1"></div>در حال بررسی</span>';
                break;
            case 1:
                $status='<span class="label text-success d-flex"><div class="dot-label  bg-success ml-1"></div>پاسخ داده </span>';
                break;
            case 2:
                $status='<span class="label text-muted d-flex"><div class="dot-label  bg-gray-300 ml-1"></div>پاسخ مشتری</span>';
                break;
            case 3:
                $status='<span class="label text-primary d-flex"><div class="dot-label  bg-primary ml-1"></div>تکمیل شده</span>';
                break;
            case 4:
                $status='<span class="label text-danger d-flex"><div class="dot-label  text-danger ml-1"></div>بسته شده </span>';
                break;
        }
        echo $status;
    }


}
