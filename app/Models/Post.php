<?php

namespace App\Models;

//Database(Eloquent)Model・モデルとデータベースを紐つける
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
// 1つの投稿は1人のユーザーに属する
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
