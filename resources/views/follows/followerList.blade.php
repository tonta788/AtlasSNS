@extends('layouts.login')

@section('content')
<div class="main-block">
<p>Follower List</p>
<div class=follow-block>
@foreach($users as $users)
<a href="/userprofile/{{$users->id}}"><img src="{{ asset('storage/images/' .$users->images) }}"></a>
@endforeach
</div>
</div>

@foreach ($timelines as $timelines)
<div class="post-block">
  <figure><img src="{{ asset('storage/images/' .$timelines->user->images) }}"></figure>

<div class="post-content">

<div>
<div class="post-name">{{ $timelines->user->username }}</div>
<div>{{ $timelines->created_at }}</div>
</div>
<div>{{ $timelines->post }}</div>
</div>
</div>
@endforeach



@endsection
