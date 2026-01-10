@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Create Movie</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.halls.store') }}" method="POST" id="form-validation-2" class="form" enctype="multipart/form-data">
                    @csrf     

                    <!-- Hall Name -->
                    <div class="mb-2">
                        <label for="name" class="form-label">Hall Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter hall name" required value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Total Seats -->
                    <div class="mb-2">
                        <label for="total_seats" class="form-label">Total Seats</label>
                        <input type="number" class="form-control" name="total_seats" placeholder="Enter total seats" required min="1" value="{{ old('total_seats') }}">
                        @error('total_seats')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Save</button>

                </form>
            </div>
        </div>

    </div>
@endsection
