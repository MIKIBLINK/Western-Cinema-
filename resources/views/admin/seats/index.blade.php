@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">List of Seats</h4>
                            </div>
                            <div class="col-auto">
                                <form class="row g-2">
                                    <div class="col-auto">
                                        <a href="{{ route('admin.seats.create') }}" class="btn btn-primary">
                                            <i class="fa-solid fa-plus me-1"></i>
                                            Add Seats
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><div class="pt-0 card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 checkbox-all" id="datatable_1">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-1">No</th>
                                        <th class="ps-1">Hall</th>
                                        <th class="ps-1">Row</th>
                                        <th class="ps-1">Seat Number</th>
                                        <th class="ps-1">Type</th>
                                        <th class="ps-1">Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows && $rows->count() > 0)
                                        @php($i = 1)
                                        @foreach ($rows as $row)
                                            <tr>
                                                <td>{{ $i++ }}</td>

                                                {{-- Prevents crash if the hall was deleted from the database --}}
                                                <td>{{ $row->hall?->name ?? 'Hall Not Found' }}</td>

                                                <td>{{ $row->seat_row }}</td>
                                                <td>{{ $row->seat_number }}</td>
                                                <td>{{ $row->type ?? 'Standard' }}</td>
                                                <td>
                                                    @if($row->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                <td class="text-end">
                                                    <div class="gap-2 d-flex justify-content-end">
                                                        <a href="{{ route('admin.seats.edit', $row->id) }}">
                                                            <i class="las la-pen text-secondary fs-18"></i>
                                                        </a>

                                                        <form action="{{ route('admin.seats.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this seat?')">
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
                                            <td colspan="7" class="text-center">No seats found in the database.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div></div></div> </div> </div>@endsection
