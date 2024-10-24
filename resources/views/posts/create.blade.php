<!DOCTYPE html>+<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規投稿</title>
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
        <h1>新規投稿</h1>

        {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('posts.index') }}">&lt; 戻る</a>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div>
                <label for="title">タイトル</label>
                <!-- <input type="text" id="title" name="title"> -->
                <input type="text" id="title" name="title" value="{{ old('title') }}">

            </div>
            <div>
                <label for="content">本文</label>
                <!-- <textarea id="content" name="content"></textarea> -->
                <textarea id="content" name="content"></textarea>
            </div>
            <button type="submit">投稿</button>
        </form>
    </main>

    <footer>
        <p>&copy; 投稿アプリ All rights reserved.</p>
    </footer>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>
