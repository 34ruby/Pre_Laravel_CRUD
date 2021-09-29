<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            1. 게시글 리스트를 DB에서 읽어와야지
            2. 게시글 목록을 만들어주는 BLADE 에 읽어온 데이터를 전달하고 실행.
            3.


        */

        // select * from posts order by created_at desc
        // $posts = Post::all();

        // 게시글 화면 출력하는거 순서를 바꾸기.
        // $posts = Post::orderBy('created_at','desc')->get();
        // $posts = Post::latest()->get();


        $posts = Post::latest()->paginate(10);

        // dd($posts); // 실험
        return view('bbs.index',['posts' =>$posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd("heiiii");

        return view ('bbs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title'=>'required','content'=>'required|min:1']);
        //
        // dd($request->all());

        $fileName = null;

        if($request->hasFile('image')) {
            $fileName =  time().'_'.$request->file('image')->getClientOriginalName();

            $path = $request->file('image')->storeAs('public/images', $fileName);
        }

        $input = array_merge($request->all(), ["user_id" => Auth::user()->id]);
        // 이미지가 있으면 .. $input
        if($fileName) {

            $input = array_merge($input, ["image" => $fileName ]);
        }
        // $input ["title"=> "suifwe", "content"=> "sfuiowejf", "user_id"=> 1]
        // redirect 안하면 F5 시 계속 같은 값이 넘어감
        // mass assignment
        // Eloquent model의 white list 인  $fillable 에 기술해야 한다.
        Post::create($input);

        // Post::crate($input);
        // $post = new Post;
        // $post -> title = $input['title'];
        // $post -> content = $input['content'];
        // ...
        // $post -> save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //id에 해당하는 Post를 데이터베이스에서 인출
        $post = Post::find($id);
        // 그놈을 상세보기 뷰로 전달한다.
        return view ('bbs.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $id에 해당하는 포스트를 수정할 수 있는
        // 페이지를 반환해주면 된다.

        return view('bbs.edit', ['post'=>Post::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['title'=>'required','content'=>'required|min:1']);

        $post = Post::find($id);
        // $post->title = $request->input['title'];
        $post->title = $request->title;
        $post->content = $request->content;
        // $request 객체 안에 이미지가 있다면 ...
        // 이 이미지를 이 게시글의 이미지로 변경하겠다는 의미인 것이다.
        if($request->image) {
            // 이 이미지를 이 게시글의 이미지로 파일 시스템에
            // 저장하고, DB에 반영하기 전에
            // 기존 이미지가 있다면 ...
            // 그 이미지를 파일 시스템에서 삭제해줘야 겠지요 ...
            if($post->image) {
                Storage::delete('public/images/'.$post->image);
                //.은 문자열 합치는 것이야.
            }
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $post->image = $fileName;
            $request->image->storeAs('public/images/'.$fileName);
        }
        $post->save();
        // update posts set title = $request->title, content -> $reuest->content, image = $fileName, // <= optional
        $post->update(['title' => $request->title, 'content' => $request->content]);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // $id, REquest~ 로 하면 에러난다.
        //DI, Dependency Injection, 의존성 주입
        // dd($request);
        $post = Post::find($id);

        //게시글에 딸린 이미지가 있으면 파일시스템에도 삭제를 해야겠지요?\
        if($post->image) {
            Storage::delete('public/images/'.$post->image);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function deleteImage($id) {
        $post = Post::find($id);
        Storage::delete('public/images', $post->image);
        $post -> image = null;
        $post->save();

        return redirect()->route('posts.edit', ['post'=>$post->id]);
    }
}
