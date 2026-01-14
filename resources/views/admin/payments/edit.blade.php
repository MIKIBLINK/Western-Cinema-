@extends('admin.dashboard')

@section('content')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="shadow-sm card">
                <div class="bg-white card-header border-bottom">
                    <h4 class="mb-0 card-title">Edit Payment Status</h4>
                    <p class="mb-0 text-muted small">Reference: <strong>{{ $payment->transaction_ref ?? 'N/A' }}</strong></p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Customer</label>
                                <input type="text" class="form-control bg-light" value="{{ $payment->booking?->user?->name ?? 'Guest' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Amount</label>
                                <input type="text" class="form-control bg-light" value="${{ number_format($payment->amount, 2) }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Movie Title</label>
                            <input type="text" class="form-control bg-light" value="{{ $payment->booking?->showtime?->movie?->title ?? 'Movie Deleted' }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label fw-bold">Update Status</label>
                            <select name="status" id="status" class="form-select border-primary">
                                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending (Awaiting Payment)</option>
                                <option value="paid" {{ ($payment->status == 'paid' || $payment->status == 'completed') ? 'selected' : '' }}>Paid (Confirmed)</option>
                                <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed (Cancelled)</option>
                            </select>
                            @error('status')
                                <div class="mt-1 text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.payments.index') }}" class="px-4 btn btn-secondary">Back to List</a>
                            <button type="submit" class="px-4 btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
