<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿編集</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
        <h1>投稿編集</h1>
        <!-- バリデーションエラーの【フラッシュメッセージ】の表示（エラーがあるかどうか） -->
        <!-- any() メソッドは、エラーが1つでも存在する場合に true を返し、エラーがなければ false を返します。 -->
        <!--<ul>...</ul>は、エラーメッセージをリストとして表示するためのHTML要素です。エラーがある場合に、エラーの内容をリスト項目 (<li>) として表示  -->
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('posts.index') }}">&lt; 戻る</a>

        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <label for="title">タイトル</label>
                <!-- old()ヘルパ関数を使い、エラー時に入力内容が保持されるようにする。
            ただし、投稿編集ページの場合は以下のように、どの投稿を編集しているのか」がわかるように初期値も設定しなければなりません。 -->
            <!-- この場合はどうすればよいのかというと、old()ヘルパ関数の第2引数に「直前の入力値が存在しない場合の初期値」つまり「エラー時以外の通常の初期値」を指定 -->

                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}">
            </div>
            <div>
                <label for="content">本文</label>
                <textarea id="content" name="content">{{ old('content', $post->content) }}</textarea>
            </div>
            <button type="submit">更新</button>
        </form>
    </main>

    <footer>
        <p>&copy; 投稿アプリ All rights reserved.</p>
    </footer>
    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>
