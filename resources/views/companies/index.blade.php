@extends('main')

@section('content')

    <div class="card-body table-responsive p-0">
        <table class="table table-striped text-nowrap">
            <thead>
            <tr>
                <th style="">ID</th>
                <th>Name</th>
                <th>Add users</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $key => $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('companies.users.add', ['company' => $company->id]) }}">
                            Add users
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('companies.edit', ['company' => $company->id]) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger btn-sm"
                           onclick="removeRow({{ $company->id }}, '{{ url('/companies/destroy') }}')">
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


