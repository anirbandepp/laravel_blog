@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Post</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank">Home</a></li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('post_index') }}" target="_blank"> Post List</a>
                        </li>
                        <li class="breadcrumb-item active">View Post</li>
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
                                <h3 class="card-title">View Post</h3>
                                <a href="{{ route('post_index') }}" class="btn btn-primary">
                                    Go Back to Post List
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 200px">Image</th>
                                        <td><img src="{{ asset($post->image) }}" alt="" width="300px;"> </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px">Title</th>
                                        <td> {{ $post->title }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px">Category Name</th>
                                        <td> {{ $post->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px">Post Tags</th>
                                        <td>
                                            @foreach ($post->tags as $tag)
                                                <span class="badge badge-primary"> {{ $tag->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px">Auther Name</th>
                                        <td> {{ $post->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 200px">Post Description</th>
                                        <td> {!! $post->description !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content -->
@endsection
