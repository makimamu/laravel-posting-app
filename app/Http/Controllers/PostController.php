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
    // 投稿を取得し、更新日時が古い順に並べ替える
        $posts = Post::orderBy('updated_at', 'asc')->get();
        return view('posts.index', compact('posts'));
    }
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
    public function store(Request $request)
    {
    // バリデーションの追加
    $request->validate([
        'title' => 'required|string|max:40',  // タイトルは必須で最大40文字
        'content' => 'required|string|max:200', // 本文は必須で最大200文字
    ]);
    
    // バリデーション後に投稿を保存
    Post::create($request->all());
    return redirect()->route('posts.index');
}
/*【フラッシュメッセージの表示】投稿の作成後は投稿一覧ページにリダイレクトさせますが、そのとき「投稿が完了しました。」というフラッシュメッセージを表示。
リダイレクト時にwith()メソッドを使っています。*/
        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
//-----------------------------------------------
 // 編集ページ

    /*投稿が属するユーザーのID（idカラムの値）と現在ログイン中のユーザーのIDを比較し異なる場合は投稿一覧ページにリダイレクトさせていることです。
    他人の投稿を編集できないようにするため、このような処理を記述しています。*/
    public function edit(Post $post)
    {
    //【Authファサード（認証）】のid()メソッドを使うことで、現在ログイン中のユーザーのIDを直接取得できます。
        if ($post->user_id !== Auth::id()) {
        /*【フラッシュメッセージの表示】「不正なアクセスです。」というフラッシュメッセージを表示。*/
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        return view('posts.edit', compact('post'));
    }
//------------------------------------------
     //更新機能
    public function update(Request $request, Post $post)
    {
    // バリデーションの追加
    $request->validate([
        'title' => 'required|string|max:40',  // タイトルは必須で最大40文字
        'content' => 'required|string|max:200', // 本文は必須で最大200文字
        ]);
    
    // バリデーション後に投稿を更新
    $post->update($request->all());
    return redirect()->route('posts.show', $post);
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
