@extends('layouts.app')

@section('content')
    <div id="container">
        <div class="document">
            <form method="POST" action="/messages">
                {{ csrf_field() }}
                <H3>ЗАГОЛОВОК</H3>
                <input name="title" class="heading">
                <H4>Текст</H4>
                <textarea name="text" class="form-control"></textarea>
                <p><input type="submit" value="Добавить сообщение "></p>
            </form>
        </div>
    </div>

@endsection