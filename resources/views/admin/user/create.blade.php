@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank">Home</a></li>
                        <li class="breadcrumb-item active"> <a href="{{ route('user_index') }}">User List</a> </li>
                        <li class="breadcrumb-item active">Create User</li>
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
                                <h3 class="card-title">Create User</h3>
                                <a href="{{ route('user_index') }}" class="btn btn-primary">
                                    Go Back to User List
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row offset-2">
                                <div class="col-md-8">
                                    @include('includes.errors')

                                    <form action="{{ route('user_store') }}" method="POST">
                                        @csrf
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Enter name">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Enter email">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password" id="password"
                                                    placeholder="Enter password">
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                                            </div>

                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content -->
@endsection
