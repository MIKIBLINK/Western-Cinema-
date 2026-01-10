@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Create Movie</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.showtimes.store') }}" method="POST" id="form-validation-2" class="form" enctype="multipart/form-data">
                    @csrf     

                    <!-- Movie Selection -->
                        <div class="mb-2">
                            <label class="form-label">Movie</label>
                            <select name="movie_id" class="form-control" required>
                                <option value="">-- Select Movie --</option>
                                @foreach($movies as $movie)
                                    <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                                        {{ $movie->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('movie_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror 
                        </div>

                        <!-- Hall Selection -->
                        <div class="mb-2">
                            <label class="form-label">Hall</label>
                            <select name="hall_id" class="form-control" required>
                                <option value="">-- Select Hall --</option>
                                @foreach($halls as $hall)
                                    <option value="{{ $hall->id }}" {{ old('hall_id') == $hall->id ? 'selected' : '' }}>
                                        {{ $hall->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hall_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror 
                        </div>

                        <!-- Start Time -->
                        <div class="mb-2">
                            <label class="form-label">Start Time</label>
                            <input type="datetime-local" class="form-control" name="start_time" required value="{{ old('start_time') }}">
                            @error('start_time')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror 
                        </div>

                        <!-- Price -->
                        <div class="mb-2">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" name="price" placeholder="Enter price" required value="{{ old('price') }}">
                            @error('price')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror 
                        </div>


                    <button class="btn btn-primary" type="submit">Save</button>

                </form>
            </div>
        </div>

    </div>
@endsection
