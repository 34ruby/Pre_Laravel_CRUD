<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; //trait

    protected $fillable = [
        "title", 
        "content", 
        "user_id",
        "image", 
    ];

    public function writer() {
        /* User <-> Post 의 relationship */
        // 1 : N
        // User는 hasMany posts
        // Post는 belongs to a User
        return $this->belongsTo(User::class, "user_id");
        /*
            select p.*, u.*
            from users u, posts p
            inner join on u.id = p.writer_id
        */
    }

}
