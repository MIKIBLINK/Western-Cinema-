@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">List of Bookings</h4>
                            </div>
                            <div class="col-auto">
                                {{-- Add Booking button if needed --}}
                            </div>
                        </div>
                    </div><div class="pt-0 card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 checkbox-all" id="datatable_1">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-1">No</th>
                                        <th class="ps-1">Customer</th>
                                        <th class="ps-1">Movie</th>
                                        <th class="ps-1">Hall</th>
                                        <th class="ps-1">Showtime</th>
                                        <th class="ps-1">Seats</th>
                                        <th class="ps-1">Total Price</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows && $rows->count() > 0)
                                        @php($i = 1)
                                        @foreach ($rows as $row)
                                            <tr>
                                                <td>{{ $i++ }}</td>

                                                {{-- Customer Name --}}
                                                <td>{{ $row->user?->name ?? 'Guest/Deleted User' }}</td>

                                                {{-- Movie Title (Nested Relationship) --}}
                                                <td>{{ $row->showtime?->movie?->title ?? 'Movie N/A' }}</td>

                                                {{-- Hall Name (Nested Relationship) --}}
                                                <td>{{ $row->showtime?->hall?->name ?? 'Hall N/A' }}</td>

                                                {{-- Showtime Start Time --}}
                                                <td>{{ $row->showtime?->start_time ?? 'Showtime Deleted' }}</td>

                                                {{-- Displaying Seats (assuming a many-to-many relationship) --}}
                                                <td>
                                                    @foreach($row->seats as $seat)
                                                        <span class="badge bg-secondary-subtle text-secondary">{{ $seat->seat_row }}{{ $seat->seat_number }}</span>
                                                    @endforeach
                                                </td>

                                                <td>${{ number_format($row->total_price, 2) }}</td>

                                                <td class="text-end">
                                                    <div class="gap-2 d-flex justify-content-end">
                                                        <a href="{{ route('admin.bookings.show', $row->id) }}">
                                                            <i class="las la-eye text-secondary fs-18"></i>
                                                        </a>

                                                        <form action="{{ route('admin.bookings.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Cancel this booking?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                                                <i class="las la-trash-alt text-secondary fs-18"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No bookings found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div></div></div> </div> </div>@endsection
