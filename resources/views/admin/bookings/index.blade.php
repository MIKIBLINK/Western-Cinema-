@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">List of booking</h4>
                            </div><!--end col-->
                            <div class="col-auto">
                                <form class="row g-2">
                                    <div class="col-auto">
                                        <a class="btn bg-primary-subtle text-primary dropdown-toggle d-flex align-items-center arrow-none"
                                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                            aria-expanded="false" data-bs-auto-close="outside">
                                            <i class="iconoir-filter-alt me-1"></i> Filter
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-start">
                                            <div class="p-2">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-all">
                                                    <label class="form-check-label" for="filter-all">
                                                        All
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-one">
                                                    <label class="form-check-label" for="filter-one">
                                                        New
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-two">
                                                    <label class="form-check-label" for="filter-two">
                                                        VIP
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked
                                                        id="filter-three">
                                                    <label class="form-check-label" for="filter-three">
                                                        Repeat
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked
                                                        id="filter-four">
                                                    <label class="form-check-label" for="filter-four">
                                                        Referral
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked
                                                        id="filter-five">
                                                    <label class="form-check-label" for="filter-five">
                                                        Inactive
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-six">
                                                    <label class="form-check-label" for="filter-six">
                                                        Loyal
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-auto">
                                        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
                                            <i class="fa-solid fa-plus me-1"></i>
                                            Add Booking
                                        </a>
                                    </div><!--end col-->
                                </form>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">

                        <div class="table-responsive">
                            <table class="table mb-0 checkbox-all" id="datatable_1">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-1">No</th>
                                        <th class="ps-1">User</th>
                                        <th class="ps-1">Movie</th>
                                        <th class="ps-1">Hall</th>
                                        <th class="ps-1">Showtime</th>
                                        <th class="ps-1">Seats</th>
                                        <th class="ps-1">Total Price</th>
                                        <th class="ps-1">Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rows as $index => $booking)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->showtime->movie->title }}</td>
                        <td>{{ $booking->showtime->hall_id}}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('Y-m-d H:i') }}</td>
                        <td>
                            @foreach($booking->seats as $seat)
                                                {{ $seat->seat_row }}{{ $seat->seat_number }}
                                                @if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td>${{ number_format($booking->total_price, 2) }}</td>
                                        <td>{{ ucfirst($booking->status) }}</td>
                                        <td class="text-end d-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="las la-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="las la-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No bookings found.</td>
                                    </tr>
                                @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->
@endsection
