@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">List of Showtimes</h4>
                            </div><div class="col-auto">
                                <form class="row g-2">
                                    <div class="col-auto">
                                        <a class="btn bg-primary-subtle text-primary dropdown-toggle d-flex align-items-center arrow-none"
                                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                            aria-expanded="false" data-bs-auto-close="outside">
                                            <i class="iconoir-filter-alt me-1"></i> Filter
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-start">
                                            <div class="p-2">
                                                <div class="mb-2 form-check">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-all">
                                                    <label class="form-check-label" for="filter-all">All</label>
                                                </div>
                                                <div class="mb-2 form-check">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-one">
                                                    <label class="form-check-label" for="filter-one">New</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="col-auto">
                                        <a href="{{ route('admin.showtimes.create') }}" class="btn btn-primary">
                                            <i class="fa-solid fa-plus me-1"></i>
                                            Add Showtimes
                                        </a>
                                    </div></form>
                            </div></div></div><div class="pt-0 card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 checkbox-all" id="datatable_1">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-1">No</th>
                                        <th class="ps-1">Movie</th>
                                        <th class="ps-1">Hall</th>
                                        <th class="ps-1">Start time</th>
                                        <th class="ps-1">Price</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows && $rows->count() > 0)
                                        @php($i = 1)
                                        @foreach ($rows as $row)
                                            <tr>
                                                <td>{{ $i++ }}</td>

                                                {{-- Added null-safe operator to prevent crash if movie is deleted --}}
                                                <td>{{ $row->movie?->title ?? 'Movie Deleted' }}</td>

                                                {{-- Added null-safe operator to prevent crash if hall is deleted --}}
                                                <td>{{ $row->hall?->name ?? 'Hall Deleted' }}</td>

                                                <td>{{ $row->start_time }}</td>
                                                <td>{{ number_format($row->price, 2) }}</td>

                                                <td class="text-end">
                                                    <div class="gap-2 d-flex justify-content-end">
                                                        <a href="{{ route('admin.showtimes.edit', $row->id) }}">
                                                            <i class="las la-pen text-secondary fs-18"></i>
                                                        </a>

                                                        <form action="{{ route('admin.showtimes.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this showtime?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="background: none; border: none; padding: 0;">
                                                                <i class="las la-trash-alt text-secondary fs-18"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No showtimes found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div></div></div> </div> </div>@endsection
