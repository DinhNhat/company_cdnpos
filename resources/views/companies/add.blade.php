@extends('main')

@section('content')

    <!-- form start -->
    <form action="{{ route('companies.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="company-name">Name</label>
                <input type="text" class="form-control" name="name" id="company-name" placeholder="Enter company name">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create company</button>
        </div>
    </form>

@endsection
