@extends('main')

@section('content')

    <!-- form start -->
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="user-name">Name</label>
                <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="user-name" placeholder="Enter user name">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update user</button>
        </div>
    </form>

@endsection
