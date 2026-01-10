@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Create bookings</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bookings.store') }}" method="POST" id="form-validation-2" class="form">
                    @csrf     

                    {{-- Select User --}}
                    <div class="mb-2">
                        <label class="form-label">User</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">-- Select User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Select Showtime --}}
                    <div class="mb-2">
                        <label class="form-label">Showtime</label>
                        <select name="showtime_id" class="form-control" required>
                            <option value="">-- Select Showtime --</option>
                            @foreach($showtimes as $showtime)
                                <option value="{{ $showtime->id }}" {{ (old('showtime_id', $booking->showtime_id ?? '') == $showtime->id) ? 'selected' : '' }}>
                                    {{ $showtime->movie->title }} 
                                    @if($showtime->hall) | Hall: {{ $showtime->hall->name }} @endif
                                    | {{ \Carbon\Carbon::parse($showtime->start_time)->format('M d, Y H:i') }}
                                </option>
                            @endforeach
                        </select>
                        @error('showtime_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Select Seats --}}
                    <div class="mb-2">
                        <label class="form-label">Seats</label>
                        <select name="seat_ids[]" class="form-control" multiple required>
                            @foreach($seats as $seat)
                                <option value="{{ $seat->id }}" {{ (collect(old('seat_ids'))->contains($seat->id)) ? 'selected':'' }}>
                                    {{ $seat->hall->name }} - {{ $seat->seat_row }}{{ $seat->seat_number }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hold Ctrl (or Cmd) to select multiple seats</small>
                        @error('seat_ids')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>



                    <button class="btn btn-primary" type="submit">Save</button>

                </form>
            </div>
        </div>

    </div>
@endsection
