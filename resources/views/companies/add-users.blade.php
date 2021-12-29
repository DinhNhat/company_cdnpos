@extends('main')

@section('content')

    <!-- form start -->
    <form action="{{ route('companies.users.add', ['company' => $company->id]) }}" method="post">
        @csrf
        <div class="card-body">
            {!! App\Helpers\Helper::usersDisplay($users, $company) !!}
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add users</button>
        </div>
    </form>

@endsection
