@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-item-center">
                                <h3 class="card-title">Category List</h3>
                                <a href="{{ route('category_create') }}" class="btn btn-primary">Create Category</a>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Post Count</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $catrgory)
                                        <tr>
                                            <td>{{ $catrgory->id }}.</td>
                                            <td>{{ $catrgory->name }}</td>
                                            <td>{{ $catrgory->slug }}</td>
                                            <td>{{ $catrgory->id }}.</td>
                                            <td>
                                                <a href="{{ route('category_edit', [$catrgory->id]) }}"
                                                    class="btn btn-sm btn-primary mr-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('category_destroy', [$catrgory->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-success mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
