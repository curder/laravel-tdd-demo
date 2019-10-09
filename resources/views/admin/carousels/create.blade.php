@extends('admin.layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('admin.partials.errors-and-messages')
        <div class="box">
            <div class="box-body">
                <form action="{{ route('admin.carousel.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <div class="input-group">
                            <span class="input-group-addon">http://</span>
                            <input type="text" name="link" id="link" class="form-control" placeholder="www.example.com" value="{{ old('link') }}">
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('admin.carousel.index') }}" class="btn btn-default btn-sm">Back</a>
                        <button type="submit" class="btn btn-primary btn-sm">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
