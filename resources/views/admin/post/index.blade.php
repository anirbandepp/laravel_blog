@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Post List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank">Home</a></li>
                        <li class="breadcrumb-item active">Post</li>
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
                                <h3 class="card-title">Post List</h3>
                                <a href="{{ route('post_create') }}" class="btn btn-primary">Create Post</a>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Author</th>

                                        <th>View Post</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($posts->count() > 0)
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}.</td>
                                                <td>
                                                    <img src="{{ asset($post->image) }}" alt="" width="100px;">
                                                </td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->category->name }}</td>

                                                <td>
                                                    @foreach ($post->tags as $tag)
                                                        <span class="badge badge-primary">{{ $tag->name }}</span>
                                                    @endforeach
                                                </td>

                                                <td>{{ $post->user->name }}</td>

                                                <td>
                                                    <a href="{{ route('post_show', $post->id) }}"
                                                        class="btn btn-sm btn-success mr-1">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href="{{ route('post_edit', [$post->id]) }}"
                                                        class="btn btn-sm btn-primary mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('post_delete', [$post->id]) }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger"> <i
                                                                class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">
                                                <h5 class="text-center">No post Found</h5>
                                            </td>
                                        </tr>
                                    @endif
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
