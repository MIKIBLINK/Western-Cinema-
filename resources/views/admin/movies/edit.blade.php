@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Edit Movie</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.movies.update', $row->id) }}" method="POST" id="form-validation-2" class="form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf


                    <div class="mb-2">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title" required value="{{$row->title ?? old('title')}}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                    </div>

                    <div class="mb-2">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="" cols="150" rows="2" class="form-control"></textarea>
                    </div>

                    <div class="mb-2">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control" name="duration" placeholder="Enter duration" required value="{{$row->duration ?? old('duration')}}">
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                    </div>

                    <div class="mb-2">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="text" class="form-control" name="rating" placeholder="Enter rating" required value="{{$row->rating ?? old('rating')}}">
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                    </div>

                    <div class="mb-2">
                        <label for="poster" class="form-label">Poster</label>
                        <input type="file" name="poster" class="form-control" onchange="loadFile(event)">
                        <img id="output" class="mt-2" width="100" src="{{asset($row->poster)}}">
                        @error('poster')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>

                </form>
            </div>
        </div>

    </div>
@endsection
