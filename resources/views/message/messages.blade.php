@extends('layouts.app')

@section('content')

    @foreach($messages as $message)
        <div id="container">
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
                <div class="doccontrols">

                @if (
                    Auth::user()?
                    Auth::user()->role_id == 1 or 
                    Auth::user()->role_id == 2 and 
                    $message->name == Auth::user()->name : null
                )
                    <a class="btn btn-info btn-sm" href="/messages/{{$message->id}}/edit"> изменить</a>

                    <form class="form-inline" method="POST" action="/messages/{{$message->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete" />
                        <input class="btn btn-danger btn-sm" name="delete" type="submit" value="удалить">
                    </form>
                @endif

                    <div class="bubble">
                        <a class="Href" href="/messages/{{$message->id}}">
                            {{$message->commentsCount}} comments    
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
