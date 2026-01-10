@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Edit Movie</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.seats.update', $seat->id) }}" method="POST" id="form-validation-2" class="form">
                    @method('PUT')
                    @csrf


                    <div class="mb-2">
                        <label class="form-label">Hall</label>
                        <select name="hall_id" class="form-control" required>
                            <option value="">-- Select Hall --</option>
                            @foreach($halls as $hall)
                                <option value="{{ $hall->id }}" {{ $seat->hall_id == $hall->id ? 'selected' : '' }}>
                                    {{ $hall->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('hall_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Seat Row</label>
                        <input type="text" class="form-control" name="seat_row" required value="{{ $seat->seat_row }}">
                        @error('seat_row')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Seat Number</label>
                        <input type="number" class="form-control" name="seat_number" required value="{{ $seat->seat_number }}">
                        @error('seat_number')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>

                </form>
            </div>
        </div>

    </div>
@endsection
