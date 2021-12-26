@extends('main')

@section('content')

    <!-- form start -->
    <form action="{{ route('companies.add.users', ['company' => $company->id]) }}" method="post">
        @csrf
        <div class="card-body">
            @foreach($users as $user)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="user-{{ $user->id }}" name="{{ $user->id }}">
                    <label class="form-check-label" for="user-{{ $user->id }}">{{ $user->name }}</label>
                </div>
            @endforeach
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add users</button>
        </div>
    </form>

@endsection
