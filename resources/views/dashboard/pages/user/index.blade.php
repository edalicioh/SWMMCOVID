@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-md-6">

            <h1>Informações de Usuários</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Novo Usuário</a>

        </div>
    </div>


@stop

@section('content')

    <div class="row ">
        <div class="col">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)

                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->user_name }} </td>
                            <td>{{ $user->email }}</td>
                            <td style="width: 10%">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-danger exclude" data-id="{{$user->id }}"
                                        data-token="{{ csrf_token() }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        (function() {
            document.querySelectorAll('.exclude').forEach(e => {
                e.addEventListener('click', event => {
                    const id  = e.dataset.id
                    const token  = e.dataset.token

                    $.ajax({
                        type: "DELETE",
                        url: 'users/' + id,
                        data: {
                            "id": id,
                            "_method": 'DELETE',
                            "_token": token,
                        },
                        success: function(response) {
                            window.location = '{{ url ('/admin/users') }}'
                        }
                    });
                })
            })
        })()

    </script>
@stop
