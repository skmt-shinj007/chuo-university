@php
    $keywords = __('messages.metaData.keywords');
    $keyword = implode(',',  $keywords);
@endphp
<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="{{ __('messages.metaData.description') }}">
  <meta name="keywords" content="{{ $keyword }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>中央大学ソフトテニス部 白門会</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <div id="app">
    {{-- ヘッダーコンポーネント読み込み --}}
    <header-component></header-component>
    <div class="container">
      {{-- メインコンテンツ読み込み --}}
      <main>
          <router-view></router-view>
      </main>
      {{-- フッターコンポーネント読み込み --}}
      <footer-component></footer-component>
    </div>
  </div>
<script src="{{ asset('js/app.js') }}" ></script>
</body>
</html>
