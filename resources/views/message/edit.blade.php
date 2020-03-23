@extends('layouts.app')

@section('content')
    <div id="container">
        <div class="document">
            <form method="POST" action="/messages/{{$message->id}}">
                <input type="hidden" name="_method" value="patch" />
                {{ csrf_field() }}
                <H3>ЗАГОЛОВОК</H3>
                <input name="title" class="heading" value="{{$message->title}}">
                <H4>Текст</H4>
            <textarea name="text" class="form-control">{{$message->text}}</textarea>
                <p><input type="submit" value="Сохранить изменения "></p>
            </form>
        </div>
    </div>

@endsection