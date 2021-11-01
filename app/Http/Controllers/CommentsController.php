<?php

namespace App\Http\Controllers;

use App\Models\Comment;
// use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    http://localhost:8000/post/{id}/comments
    public function index_text(Post $post) {
        select *
        from comments
        where post_id = $post->id;
        return $post->comments;
        post클래스에 comments함수 구현할 경우에는...

    }
    */
    public function index($postId)
    {
        /*
            select * from comments where post_id = ?
            order by created_at desc;
        */
        $comments = Comment::where('post_id', $postId)->latest()->get();
        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $postId)
    {
        // 이하는 첫번째 방법이요
        // Comment 객체를 생성하고
        // 이 객체의 멤버변수 (프로퍼티)를 설정하고
        // save()

        // 이하는 두 번째 방법이다
        // Comment::create([]);
        $request->validate(['comment' => 'required|min:1']);
        // $this->validate($request, ['comment'=>'required']);
        // $request->validate(['email' => 'required|email|unique:comment']); // 이게 와야 이메일 형태로 올 수 있다. 중복 이메일도 금지!

        // create에 사용할 수 있는 칼럼들은
        // Eloquent 모델 클래스에 $fillable에 명시되어 있어야한다.
        // mass assignment

        $comment = Comment::create(
            [
                'comment' => $request->input('comment'),
                'user_id' => auth()->user()->id,  // 로그인 한 사용자의 id
                'post_id' => $postId,
            ]);

        return $comment; //위 create에 의해 삽입된 레코드에 대응된 Eloquent 객체인 것이야...
        // $comment = new Comment();
        // $comment->user_id = auth()->user->id;
        // $comment->post_id = $postId;
        // $comment->comment = $request->comment;

        // $comment->save(); // id, crated_at, update_at 자동부여

    //     Comment::create([
    //         'comment'=>$request->comment,
    //         'user_id'=> auth()->user->id,
    //         'post_id'=> $postId
    //     ]);

    //     $this->validate($request, [
    //         'content'=>'required|min:1'
    //     ]);
    //     $input = array_merge($request->all(), [
    //         "user_id"=>Auth::user()->id
    //     ]);
    //     Comment::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $commentId)
    {
        $request->validate(['comment' => 'required']);
        $comment = Comment::find($commentId);
        $comment::update([
            'comment' => $request->input('comment'),
        ]);

        // update할 레코드를 먼저 찾고, 그 다음 update
        // selete * from comments where id = ?
        //update commetns set comment=?, updated_at=now() where id = ?

        // $request['comment'];
        // $request->input('comment');
        // $comment = $request->comment;

        // $comment = Comment::find($comment_id);
        /* selete * from comments where id = ? */

        // $comment->comment = $comment;
        // $comment->save();

        // $comment->update([
        //     'comment'=>$comment
        // ]);

        // $comment->update($request->all());
        // // comment, user_id, post_id, created_at, updated_at
        // return view('comment.show', ['comment'=>$comment]);
        // return view('comment.show', compact('comment'));
        // return view('comment.show')->with(['comment'=>$comment]);
        // return '$comment';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($commentId)
    {
        // comments 테이블에서 id가 $commentId인 레코드를 삭제.
        // 1. RAW query
        // 2. DB Query Builder
        // delete from comments where id = ?
        // select * from comments where id =?

        $comment = Comment::find($commentId);

        $comment->delete();

        return $comment;
    }
}
