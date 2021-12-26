@extends('main')

@section('content')

    <!-- form start -->
    @if($users->count() > 0)
        <form action="{{ route('companies.store') }}" method="post">
            @csrf
            <div class="card-body">
                @foreach($users as $user)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="user-{{ $user->id }}">
                        <label class="form-check-label" for="user-{{ $user->id }}">{{ $user->name }}</label>
                    </div>
                @endforeach
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add users</button>
            </div>
        </form>
    @else
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">This company has no users</h3>
            </div>
        </div>
    @endif

@endsection
