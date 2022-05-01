@extends('layouts.login')

@section('content')
<ul>
<li class="main-block">
{!! Form::open(['url' => 'post/create']) !!}
<img src="{{ asset('storage/images/' .auth()->user()->images) }}">
{!! Form::input('text', 'newPost', null, ['required|min:1|max:150', 'class' => 'form-control form-control-lg', 'placeholder' => '投稿内容を入力してください。']) !!}

<input type="image" src="images/post.png" width="120" height="120">

{!! Form::close() !!}
</li>
@foreach ($list as $list)
<div>

    <li class="post-block">
  <figure><img src="{{ asset('storage/images/' .$list->user->images) }}"></figure>

<div class="post-content">
  <div>
    <div class="post-name">{{ $list->user->username }}</div>
    <div>{{ $list->created_at }}</div>
    </div>
    <div>{{ $list->post }}

@if (Auth::user()->id == $list->user_id)
     <div><button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$list->id}}"><img src="images/edit.png" width="60" height="60"></button>

    <a href="/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="images/trash-h.png" width="80" height="80"></a>
    </div>
@endif
    </li>

<!-- Modal -->
 {{ Form::open(['url' => 'post/update'.$list->id,'method' => 'post']) }}
@csrf
<div class="modal fade" id="exampleModal{{$list->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
 {!! Form::input('text', 'upPost', $list->post, ['required', 'class' => 'form-control']) !!}
  </div>
      <div class="modal-footer">
        <button type="submit" data-bs-dismiss="modal"><img src="{{ asset('images/edit.png') }}" alt="編集" width="25px" style="border-style:none;"></button>
         </div>
      </div>
    </div>
  </div>
</div>
  {{ Form::close() }}

@endforeach

@endsection
