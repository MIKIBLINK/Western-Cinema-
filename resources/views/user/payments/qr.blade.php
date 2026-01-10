@extends('layouts.app')

@section('content')
<h3>Scan or Click QR to Pay</h3>

<form action="{{ route('user.payments.paid', $booking) }}" method="POST">
    @csrf
    <button type="submit" style="border:none;background:none">
        <img src="{{ asset('images/qr.jpg') }}" width="250">
    </button>
</form>
@endsection
