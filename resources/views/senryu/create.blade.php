<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>川柳投稿</title>
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
            <div>{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div>{{ session('error') }}</div>
        @endif

        <form action="{{ route('senryus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="senryu-container">
                <label for="theme">テーマ:</label>
                <input type="text" name="theme" id="theme" class="senryu-input" required><br>
                <label for="s_text1">上五:</label>
                <input type="text" name="s_text1" id="s_text1" class="senryu-input" required maxlength="5"><br>
                <label for="s_text2">中七:</label>
                <input type="text" name="s_text2" id="s_text2" class="senryu-input" required maxlength="7"><br>
                <label for="s_text3">下五:</label>
                <input type="text" name="s_text3" id="s_text3" class="senryu-input" required maxlength="5"><br>
            </div>

            <div id="drop-area">
                <p>ここにファイルをドラッグ＆ドロップ</p>
                <input type="file" name="img_path" id="fileElem" class="file-input" accept="image/*,video/*" style="display:none">
                <label class="file-input-label" for="fileElem">またはファイルを選択</label>
                <p id="file-name"></p>
            </div>

            <div id="preview-container"></div>

            <button type="submit" class="toukou_btn" id="toukou-btn" style="display: none;">投稿する</button>
            <button type="button" class="reselect_btn" id="reselect-btn" style="display: none;">画像再選択</button>
        </form>
    </div>

    <footer>
        <p>© 2024 川柳アプリ</p>
    </footer>
</body>
</html>
