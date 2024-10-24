<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('posts.index') }}">投稿アプリ</a>

            <ul>
                <li>
            <!-- 要素にonclick属性を設定し、値にJavaScriptのイベント処理を指定しています。 -->
            <!-- onclick属性内ではセミコロン;で区切ることで、複数の処理を記述 (onclick属性＝クリック時のイベント処理を設定するための属性)-->
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>投稿一覧</h1>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <!-- 投稿一覧ページにフラッシュメッセージの表示エリア追加 -->
        @if (session('flash_message'))
            <p>{{ session('flash_message') }}</p>
        @endif

    <!-- 投稿一覧ページにエラーメッセージの表示エリア追加 -->
        @if (session('error_message'))
            <p>{{ session('error_message') }}</p>
        @endif


        <!-- 補足：アクション内でモデルのインスタンスを受け取る方法 -->
        <!-- 「/products/1」「/products/10」のようにURLの一部を変化させてその値を取得したい場合、ルーティングでURLを設定するときにその一部を中括弧{}で囲む -->
        @if($posts->isNotEmpty())
            @foreach($posts as $post)
                <article>
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->content }}</p>
    <!-- route()ヘルパ関数の第2引数にモデルのインスタンスを渡す必要があるので注意。-->
                    <a href="{{ route('posts.show', $post) }}">詳細</a>
                    <a href="{{ route('posts.edit', $post) }}">編集</a>

                    <!-- form要素にonsubmit属性を設定し、JavaScriptのconfirm()メソッドを使って確認ダイアログを表示。【onsubmit属性＝フォーム送信時のイベント処理を設定するための属性】 -->
                    <!--確認ダイアログを表示させることで、誤って「削除」ボタンを押してしまうといった意図せぬ操作を防げるため、ユーザビリティの向上につながります。特にデータの削除のような後戻りできない操作の場合は必須級です。  -->
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">

                    <!-- 削除」ボタンでは、フォームを送信する前に「本当に削除してもよろしいですか？」という確認ダイアログを表示 -->
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>


                </article>
            @endforeach
        @else
            <p>投稿はありません。</p>
        @endif
    </main>

    <footer>
        <p>&copy; 投稿アプリ All rights reserved.</p>
    </footer>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>
