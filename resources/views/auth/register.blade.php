@extends('layouts.logout')

@section('content')
<div id="clear">
{!! Form::open() !!}

<h2>新規ユーザー登録</h2>
@if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
   @endif
   <div>
{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::password('password',null,['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}
</div>
{{ Form::submit('登録',['class' => 'submit']) }}

<a class="btn" href="/login" role="button">ログイン画面へ戻る</a>

{!! Form::close() !!}
</div>

@endsection
