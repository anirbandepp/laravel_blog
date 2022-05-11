@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank">Home</a></li>
                        <li class="breadcrumb-item active"> <a href="{{ route('site_settings') }}">Settings List</a> </li>
                        <li class="breadcrumb-item active">Create Settings</li>
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
                                <h3 class="card-title">Create Settings</h3>
                                <a href="{{ route('site_settings') }}" class="btn btn-primary">
                                    Go Back to Settings List
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @include('includes.errors')
                                </div>
                            </div>

                            <form action="{{ route('site_settings_store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter name">
                                    </div>

                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook"
                                            placeholder="Enter facebook">
                                    </div>

                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter"
                                            placeholder="Enter twitter">
                                    </div>

                                    <div class="form-group">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram"
                                            placeholder="Enter instagram">
                                    </div>

                                    <div class="form-group">
                                        <label for="reddit">Reddit</label>
                                        <input type="text" class="form-control" name="reddit" id="reddit"
                                            placeholder="Enter reddit">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter email">
                                    </div>

                                    <div class="form-group">
                                        <label for="copyright">Copyright</label>
                                        <input type="text" class="form-control" name="copyright" id="copyright"
                                            placeholder="Enter copyright">
                                    </div>

                                    <div class="form-group">
                                        <label>About site</label>
                                        <textarea class="form-control" name="about_site" rows="3" placeholder="about_site..."></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Site Logo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="site_logo" class="custom-file-input">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content -->
@endsection
