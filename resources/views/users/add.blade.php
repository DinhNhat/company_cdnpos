@extends('main')

@section('content')

    <!-- form start -->
    <form action="" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="user-name">Name</label>
                <input type="text" class="form-control" name="name" id="user-name" placeholder="Enter user name">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create user</button>
        </div>
    </form>

@endsection
