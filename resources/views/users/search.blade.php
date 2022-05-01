@extends('layouts.login')

@section('content')

<li class="main-block">
{!! Form::open(['url' => '/searchs']) !!}
 <input type="text" size="25" name="name" placeholder="ユーザー名">
  <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
  {!! Form::close() !!}
  @if(isset($keyword))
  <p>検索ワード：{{$keyword}}</p>
  @endif
</li>

<table>

  @foreach($user as $user)
  @if ($user->id !== Auth::user()->id)

  <tr>
      <td><img src="{{ asset('storage/images/' .$user->images) }}">
      {{$user->username}}</td>

@if(auth()->user()->isFollowing($user->id))
    <td><form method="POST" action="{{ route('unfollow') }}">
      @csrf
      <button type="submit" class="btn btn-danger" value="{{$user->id}}" name="unfollow">フォロー解除</button>
    </form></td>
@else
    <td><form method="POST" action="{{ route('follow') }}">
      @csrf
      <button type="submit" class="btn btn-info" value="{{$user->id}}" name="follow" style="color:white;">フォローする</button></form></td>
</tr>
    @endif
      @endif
  @endforeach

</table>

@endsection
