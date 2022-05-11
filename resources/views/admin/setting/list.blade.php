@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Site Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank">Home</a></li>
                        <li class="breadcrumb-item active">View Settings</li>
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
                                <h3 class="card-title">Settings List</h3>
                                <a href="{{ route('site_settings_create') }}" class="btn btn-primary">Create Settings</a>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>About site</th>
                                        <th>Copy right</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($settings as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($item->site_logo) }}" alt="" width="100px;">
                                            </td>
                                            <td>{{ $item->about_site }}.</td>
                                            <td>{{ $item->copyright }}.</td>

                                            <td>
                                                <a href="{{ route('post_edit', [$item->id]) }}"
                                                    class="btn btn-sm btn-primary mr-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>

                                            <td>
                                                <form action="{{ route('post_delete', [$item->id]) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
