@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Edit Movie</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.halls.update', $hall->id) }}" method="POST" id="form-validation-2" class="form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf


                    <!-- Hall Name -->
                    <div class="mb-2">
                        <label for="name" class="form-label">Hall Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter hall name" required 
                            value="{{ $hall->name ?? old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Total Seats -->
                    <div class="mb-2">
                        <label for="total_seats" class="form-label">Total Seats</label>
                        <input type="number" class="form-control" name="total_seats" placeholder="Enter total seats" required min="1" 
                            value="{{ $hall->total_seats ?? old('total_seats') }}">
                        @error('total_seats')
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
