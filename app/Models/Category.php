<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $guarded = [];
    protected $primaryKey = 'Id';

    public function getStatusAttribute($status)
    {
        return $status ? 'فعال' : 'غیر فعال';
    }

}
