@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success mb-4" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header d-flex d-flex-wrap justify-content-between align-items-center">
                    <h3>Companies</h3>
                    <a class="btn btn-primary pull-right" href="{{ route('companies.create') }}"> Create Company</a>
                </div>
                <div class="card-body">
                    <div>
                        <div class="row mb-4">
                            <div class="col-md-8 form-inline">
                                Per Page: &nbsp;
                                <select wire:model="perPage" class="form-control">
                                    <option>10</option>
                                    <option>15</option>
                                    <option>25</option>
                                </select>
                            </div>

                           
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th >Name</th>
                                    <th >Email</th>
                                    <th >Website</th>
                                    <th ># of Employees</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                <tr>
                                    <td><a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a></td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->website }}</td>
                                    <td>{{ $company->employees_count }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-primary mr-1 " href="{{ route('companies.edit', $company->id) }}">Edit</a>
                                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection