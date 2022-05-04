@extends('layouts.login')

@section('content')



<form action="{{ url('profileup') }}" enctype="multipart/form-data" method="post">
  @csrf
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
   @endif

   <div class="Form">
       <figure><img src="{{ asset('storage/images/' .auth()->user()->images) }}"></figure>
  <div class="Form-Item">
    <p class="Form-Item-Label">username</p>
  <input type="text" name="username" class="Form-Item-Input" value="{{ Auth::user()->username }}"></div>

    <div class="Form-Item">
    <p class="Form-Item-Label">mail address</p>
   <input type="text" name="mail" class="Form-Item-Input" value="{{ Auth::user()->mail }}"></div>

    <div class="Form-Item">
    <p class="Form-Item-Label">password</p>
    <input type="password" name="newpassword" class="Form-Item-Input"></div>

    <div class="Form-Item">
    <p class="Form-Item-Label">password confirm</p>
    <input type="password" name="newpassword_confirmation" class="Form-Item-Input"></div>

    <div class="Form-Item">
    <p class="Form-Item-Label">bio</p>
    <input type="text" name="bio" value="{{ Auth::user()->bio }}" class="Form-Item-Input"></div>

    <div class="Form-Item">
        <p class="Form-Item-Label isMsg">icon image</p>
    <dd><input type="file" name="iconimage" class="Form-Item-img"></div>
  <input type="submit" name="profileupdate" value="更新" class="btn-update">
</div>
</form>

@endsection
