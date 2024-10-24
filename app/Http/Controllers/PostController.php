<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{
    //--------------------------------------------------
    // 【一覧ページ　(indexアクション)】
    public function index()
    {
//Auth::user()->posts()で現在ログイン中のユーザーに属するすべての投稿を取得
//orderBy()メソッドをつなげることで作成日時が新しい順に並べ替えています
    $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->get(); 

        return view('posts.index', compact('posts'));
    }
//---------------------------------------------------
// 【詳細ページ】
    //【show()メソッド】特定の投稿（Post）を表示する為のページを返す。
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
//-------------------------------------------
    // 作成ページ
        public function create()
    {
        return view('posts.create');
    }
//-------------------------------------------
    // 作成機能
        public function store(PostRequest $request)
{
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->save();
        
/*【フラッシュメッセージの表示】投稿の作成後は投稿一覧ページにリダイレクトさせますが、そのとき「投稿が完了しました。」というフラッシュメッセージを表示。
リダイレクト時にwith()メソッドを使っています。*/
        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
    }
//-----------------------------------------------
 // 編集ページ

    /*投稿が属するユーザーのID（idカラムの値）と現在ログイン中のユーザーのIDを比較し異なる場合は投稿一覧ページにリダイレクトさせていることです。
    他人の投稿を編集できないようにするため、このような処理を記述しています。*/
    public function edit(Post $post)
    {
    //【Authファサード（認証）】のid()メソッドを使うことで、現在ログイン中のユーザーのIDを直接取得できます。
        if ($post->user_id !== Auth::id()) {
        /*【フラッシュメッセージの表示】投稿の作成後は投稿一覧ページにリダイレクトさせますが、そのとき「不正なアクセスです。」というフラッシュメッセージを表示。
リダイレクト時にwith()メソッドを使っています。*/
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        return view('posts.edit', compact('post'));
    }
//------------------------------------------
     // 更新機能
    
    /*updateアクションの場合は「どのデータを更新するか」という情報も必要。
    【showアクション】やeditアクションと同様にPostモデルの型宣言も行い、インスタンスを受け取っています。*/
    public function update(PostRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', $post)->with('flash_message', '投稿を編集しました。');
    }
//--------------------------------------------
         // 削除機能

         //他人の投稿を削除できないようにするため,その投稿が属するユーザーのID（idカラムの値）と現在ログイン中のユーザーのIDを比較し、異なる場合は投稿一覧ページにリダイレクトさせる
        public function destroy(Post $post) {
            if ($post->user_id !== Auth::id()) {
                return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
            }
    //受け取ったモデルのインスタンスに対してdelete()メソッドを実行するだけ
            $post->delete();
    
            return redirect()->route('posts.index')->with('flash_message', '投稿を削除しました。');
        }
    

}

