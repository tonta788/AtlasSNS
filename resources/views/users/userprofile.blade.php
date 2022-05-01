@extends('layouts.login')

@section('content')

<li class="main-block">

@if ($user->id !== Auth::user()->id)
    <figure><img src="{{ asset('storage/images/' .$user->images) }}"></figure>
    <div class="post-content">
  <div>
    <div class="post-name">name  {{$user->username}}</div>
  <div>bio   {{$user->bio}}
      @if(auth()->user()->isFollowing($user->id))


  <form method="POST" action="{{ route('unfollow') }}">
      @csrf
      <button type="submit" class="btn btn-danger" value="{{$user->id}}" name="unfollow">フォロー解除</button>
    </form>
@else
<form method="POST" action="{{ route('follow') }}">
      @csrf
      <button type="submit" class="btn btn-info" value="{{$user->id}}" name="follow" style="color:white;">フォローする</button></form>
    @endif
      @endif
      </div>
</div>
</li>

@foreach($posts as $post)

<div>

<li class="post-block">
<figure><img src="{{ asset('storage/images/' .$user->images) }}"></figure>
<div class="post-content">
<div>
<div class="post-name">{{$user->username}}</div>
<div>{{$post->created_at}}</div>
</div>

<div>{{$post->post}}</div>
@endforeach
</div>
</li>
</div>
@endsection
