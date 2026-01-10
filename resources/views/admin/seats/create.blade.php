@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Create Seats</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.seats.store') }}" method="POST" id="form-validation-2" class="form">
                    @csrf     

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

                    <div class="mb-2">
                        <label class="form-label">Seat Rows (range)</label>
                        <input type="text" class="form-control" name="seat_row" placeholder="A-D" value="{{ old('seat_row') }}" required>
                        <small class="text-muted">Example: A-D or C-F</small>
                        @error('seat_row')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Seats per row</label>
                        <input type="number" class="form-control" name="seat_number" placeholder="5" value="{{ old('seat_number') }}" min="1" required>
                        @error('seat_number')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>


                    <button class="btn btn-primary" type="submit">Save</button>

                </form>
            </div>
        </div>

    </div>
@endsection
