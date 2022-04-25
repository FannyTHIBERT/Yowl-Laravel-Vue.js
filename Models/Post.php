<?php

namespace App\Models;

use App\Http\Controllers\Api\PostController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
    'is_admin' => 'bollean'
    ];

    protected $fillable = ['title', 'user_id', 'category_id', 'content', 'img_post'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
