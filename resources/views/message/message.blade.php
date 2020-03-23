@extends('layouts.app')

@section('content')
    <div class="document">
        <div>&nbsp;</div>
        <div class="dochead">
            <span class="dhead">{{$message->title}}</span>
        </div>
        <div>
            <span class="post">posted by {{$message->name}} | {{$message->createdAt}}</span>
        </div>
        <div class="dcontent">
            {{$message->text}}
        </div>
    </div>
    <div class="center">
        <a href="/messages/{{$message->id}}/comments/create">добавить комментарий</a>
    </div>
        @foreach ($comments as $comment)
            <div class="dcontent Comment">
                <h4>{{$comment->userName}}:</h4>
                <p>{{$comment->text}}</p>

                @if (
                    Auth::user() ? 
                    Auth::user()->role_id == 1 or 
                    Auth::user()->role_id == 2 and 
                    $comment->userName == Auth::user()->name : null
                )

                    <form method="POST" action="/messages/{{$message->id}}/comments/{{$comment->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete" />
                        <input class="btn btn-danger btn-sm" name="delete" type="submit" value="удалить">
                    </form>
                    <a class="btn btn-primary btn-sm" href="/messages/{{$message->id}}/comments/{{$comment->id}}/edit">изменить</a>
                @endif

            </div>
        @endforeach
@endsection