@extends('main')

@section('content')

    <div class="card-body table-responsive p-0">
        <table class="table table-striped text-nowrap">
            <thead>
            <tr>
                <th style="">ID</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('users.edit', ['user' => $user->id]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm"
                               onclick="removeRow({{ $user->id }}, '{{ url('/users/destroy') }}')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
    </div>
@endsection


