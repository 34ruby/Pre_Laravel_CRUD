<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;

class LikesController extends Controller
{
    /*
        1. 좋아요 / 좋아요 취소 요청을 보낸 로그인 된 사용자의 요청 처리
        2. 좋아요 한 사람 숫자 출력
    */

    public function store(Post $post) {
        $post->likes()->toggle(auth()->user());
    }
}
