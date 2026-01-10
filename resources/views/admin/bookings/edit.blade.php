@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Edit Movie</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" id="form-validation-2" class="form">
                    @method('PUT')
                    @csrf


                    {{-- Select User --}}
                    <div class="mb-2">
                        <label class="form-label">User</label>
                        <select name="user_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Select Showtime --}}
                    <div class="mb-2">
                        <label class="form-label">Showtime</label>
                        <select name="showtime_id" class="form-control" required>
                            @foreach($showtimes as $showtime)
                                <option value="{{ $showtime->id }}" {{ $booking->showtime_id == $showtime->id ? 'selected' : '' }}>
                                    {{ $showtime->movie->title }} | {{ $showtime->hall }} | {{ \Carbon\Carbon::parse($showtime->start_time)->format('Y-m-d H:i') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Select Seats --}}
                    <div class="mb-2">
                        <label class="form-label">Seats</label>
                        <select name="seat_ids[]" class="form-control" multiple required>
                            @foreach($seats as $seat)
                                <option value="{{ $seat->id }}" {{ $booking->seats->contains($seat->id) ? 'selected' : '' }}>
                                    {{ $seat->hall->name }} - {{ $seat->seat_row }}{{ $seat->seat_number }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hold Ctrl (or Cmd) to select multiple seats</small>
                    </div>

                    {{-- Status --}}
                    <div class="mb-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="reserved" {{ $booking->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>

                </form>
            </div>
        </div>

    </div>
@endsection
