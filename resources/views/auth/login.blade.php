@extends('layouts.logout')

@section('content')

<div id="clear">
{!! Form::open() !!}

<p class="welcome">AtlasSNSへようこそ</p>
 <div>
{{ Form::label('mail adress') }}
{{ Form::text('mail',null,['class' => 'input']) }}
</div>
<div>
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}
</div>
{{ Form::submit('LOGIN',['class' => 'submit'])}}

<a class="btn" href="/register">新規ユーザーの方はこちら</a>

{!! Form::close() !!}
</div>
@endsection
