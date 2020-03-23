@extends('layouts.app')

@section('content')
<div id="container">
    <div class="document">
        <form method="POST" action="/messages/{{$messageId}}/comments">
            {{ csrf_field() }}
            <H4>Текст</H4>
            <textarea name="text" class="form-control"></textarea>
            <p><input type="submit" value="Добавить комментарий "></p>
        </form>
    </div>
</div>

@endsection