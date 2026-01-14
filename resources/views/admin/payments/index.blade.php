@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">List of Payments</h4>
                            </div>
                        </div>
                    </div>
                    <div class="pt-0 card-body">
                        <div class="table-responsive">
                            <table class="table mb-0" id="datatable_1">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Movie</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Transaction Ref</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rows as $index => $payment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>

                                            {{-- Safe User Access --}}
                                            <td>{{ $payment->booking?->user?->name ?? 'Deleted User' }}</td>

                                            {{-- Safe Movie Access --}}
                                            <td>
                                                <span class="fw-medium text-primary">
                                                    {{ $payment->booking?->showtime?->movie?->title ?? 'N/A (Movie Deleted)' }}
                                                </span>
                                            </td>

                                            <td>${{ number_format($payment->amount, 2) }}</td>
                                            <td>
                                                <span class="badge
                                                    {{ ($payment->status === 'paid' || $payment->status === 'completed') ? 'bg-success' :
                                                    ($payment->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                                    {{ ucfirst($payment->status ?? 'Unknown') }}
                                                </span>
                                            </td>
                                            <td>{{ $payment->transaction_ref ?? 'N/A' }}</td>

                                            <td class="text-end">
                                                <div class="gap-2 d-flex justify-content-end">
                                                    <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-outline-secondary">
                                                        <i class="las la-pen fs-16"></i> Edit
                                                    </a>

                                                    <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="las la-trash-alt fs-16"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="py-4 text-center">No payment records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
