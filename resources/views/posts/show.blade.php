<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿詳細</title>
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('posts.index') }}">投稿アプリ</a>

            <ul>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>投稿詳細</h1>

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- フラッシュメッセージの表示 -->
        @if (session('flash_message'))
            <p>{{ session('flash_message') }}</p>
        @endif

        <a href="{{ route('posts.index') }}">&lt; 戻る</a>

        <article>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
    <!-- その投稿が属するユーザーのID（idカラムの値）と現在ログイン中のユーザーのIDを比較し、一致する場合にのみ「編集」ボタンを表示させています。 -->
            @if ($post->user_id === Auth::id())
                <a href="{{ route('posts.edit', $post) }}">編集</a>

            <!-- 「編集」ボタンと同様に、現在ログイン中のユーザー自身の投稿にのみ「削除」ボタンを表示させます。よって、「削除」ボタンも@ifと@endifの中に入れています。 -->
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            @endif
        </article>
    </main>

    <footer>
        <p>&copy; 投稿アプリ All rights reserved.</p>
    </footer>
</body>

</html>
