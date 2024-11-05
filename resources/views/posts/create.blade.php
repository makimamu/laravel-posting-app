<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create New Post</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        {{-- ナビゲーションバー --}}
        @include('layouts.navbar')

        {{-- コンテンツ --}}
        <main class="py-4">
            <div class="container">
                <h1>Create New Post</h1>

                {{-- エラーメッセージの表示 --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 投稿フォーム --}}
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    {{-- タイトル入力 --}}
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}">
                    </div>

                    {{-- 内容入力 --}}
                    <div class="form-group">
                        <label for="body">本文</label>
                        <textarea id="content" name="content">{{ old('content') }}</textarea>

                    </div>

                    {{-- 送信ボタン --}}
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
            </div>
        </main>
    </div>

    {{-- JavaScriptファイル --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>