@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Create User</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.store') }}" class="form" id="form-validation-user">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name" required value="{{old('name')}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        {{-- Email --}}
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{old('email')}}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{old('password')}}" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-2">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Enter password" required>
                        </div>

                        <button class="btn btn-primary mt-2" type="submit">Save</button>
                    </form>
            </div>
        </div>

    </div>
@endsection
