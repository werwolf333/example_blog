@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/users/{{$user->id}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="patch" />
            <div class="form-group">
                <label for="name">Имя</label>
                <input id="name" name="name" class="form-control" type="text" value="{{$user->name}}"> 
            </div>
            
            <div class="form-group">
                <label for="role">Роль</label>
                <select name="role_id" class="custom-select">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif>
                            {{$role->role}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="email">Почта</label>
                <input id="email" name="email" class="form-control" type="text" value="{{$user->email}}"> 
            </div>
            <div class="form-group">
                <label for="created_at">Дата создания</label>
                <input id="created_at" name="created_at" class="form-control" type="datetime" value="{{$user->created_at}}" readonly>
            </div>
            <div class="form-group">
                <label for="updated_at">Дата изменения</label>
                <input id="updated_at" name="updated_at" class="form-control" type="datetime" value="{{$user->updated_at}}" readonly>
            </div>
            <input type="submit" class="btn btn-primary" value="Принять">
        </form>

    </div>
@endsection
