@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Edit Movie</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.showtimes.update', $showtime->id) }}" method="POST" id="form-validation-2" class="form">
                    @method('PUT')
                    @csrf

                    <!-- Movie Selection -->
                    <div class="mb-2">
                        <label class="form-label">Movie</label>
                        <select name="movie_id" class="form-control" required>
                            <option value="">-- Select Movie --</option>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}" 
                                    {{ (old('movie_id') ?? $showtime->movie_id) == $movie->id ? 'selected' : '' }}>
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
                                <option value="{{ $hall->id }}" 
                                    {{ (old('hall_id') ?? $showtime->hall_id) == $hall->id ? 'selected' : '' }}>
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
                        <input type="datetime-local" class="form-control" name="start_time" required 
                            value="{{ old('start_time') ?? \Carbon\Carbon::parse($showtime->start_time)->format('Y-m-d\TH:i') }}">
                        @error('start_time')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror 
                    </div>

                    <!-- Price -->
                    <div class="mb-2">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" placeholder="Enter price" required 
                            value="{{ old('price') ?? $showtime->price }}">
                        @error('price')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror 
                    </div>

                    <button class="btn btn-primary" type="submit">Update Showtime</button>
                </form>

            </div>
        </div>

    </div>
@endsection
