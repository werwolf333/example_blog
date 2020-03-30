@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
                <tr>
                    <td>имя</td>
                    <td>роль</td>
                    <td>почта</td>
                    <td>создан</td>
                    <td>изменён</td>
                    <td></td>
                    <td></td>
                </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td class="text-right">
                        <form class="form-inline" method="POST" action="/users/{{$user->id}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete" />
                            <input class="btn btn-danger btn-sm" name="delete" type="submit" value="удалить">
                        </form>
                    </td>
                    <td class="text-right">
                        <a class="btn btn-info btn-sm" href="/users/{{$user->id}}/edit"> изменить</a>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
