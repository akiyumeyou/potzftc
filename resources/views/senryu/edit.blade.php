<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>川柳編集</title>
    @vite(['resources/css/senryu.css', 'resources/js/senryu.js'])
</head>
<body>
    <header>
        <nav>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('最初のページ') }}
            </x-nav-link>
            <x-nav-link :href="route('senryus.index')" :active="request()->routeIs('senryus.index')">
                {{ __('シルバー川柳') }}
            </x-nav-link>
        </nav>
    </header>

    <div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('senryus.update', $senryu->id) }}" method="POST" enctype="multipart/form-data" data-type="edit">
            @csrf
            @method('PUT')
            <div class="senryu-container">
                <label for="theme">テーマ:</label>
                <input type="text" name="theme" id="theme" class="senryu-input" value="{{ $senryu->theme }}" required><br>
                <label for="s_text1">上五:</label>
                <input type="text" name="s_text1" id="s_text1" class="senryu-input" value="{{ $senryu->s_text1 }}" required maxlength="5"><br>
                <label for="s_text2">中七:</label>
                <input type="text" name="s_text2" id="s_text2" class="senryu-input" value="{{ $senryu->s_text2 }}" required maxlength="7"><br>
                <label for="s_text3">下五:</label>
                <input type="text" name="s_text3" id="s_text3" class="senryu-input" value="{{ $senryu->s_text3 }}" required maxlength="5"><br>
            </div>

            <div id="drop-area">
                <p>ここにファイルをドラッグ＆ドロップ</p>
                <input type="file" name="img_path" id="fileElem" class="file-input" accept="image/*,video/*" style="display:none">
                <label class="file-input-label" for="fileElem">またはファイルを選択</label>
                <p id="file-name"></p>
            </div>

            <div id="preview-container">
                @if ($senryu->img_path)
                    @if (Str::endsWith($senryu->img_path, ['.mp4', '.mov', '.avi']))
                        <video src="{{ $senryu->img_path }}" controls class="preview"></video>
                    @else
                        <img src="{{ $senryu->img_path }}" class="preview">
                    @endif
                @endif
            </div>

            <div class="button-container">
                <button type="submit" class="toukou_btn" id="toukou-btn">更新</button>
                <button type="button" class="reselect_btn" id="reselect-btn" style="display: none;">画像再選択</button>
            </div>
        </form>

        <form action="{{ route('senryus.destroy', $senryu->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete_btn">削除</button>
        </form>
    </div>

    <footer>
        <p>© 2024 川柳アプリ</p>
    </footer>
</body>
</html>
