@extends('layouts.logout')

@section('content')

<div id="clear">
  <p class="welcome">{{ SESSION('username') }}さん<br>
  ようこそ！AtlasSNSへ</p>
  <p class="newuser">ユーザー登録が完了しました。<br>
  早速ログインをしてみましょう!</p>

 <a class="btn btn-danger" href="/login">ログイン画面へ</a>
</div>

@endsection
