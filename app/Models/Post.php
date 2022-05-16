<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 입력 허용할 데이터 필드
    protected $fillable = [
        'title',
        'body',
    ];
}
