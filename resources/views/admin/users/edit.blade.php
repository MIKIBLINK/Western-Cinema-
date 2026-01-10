@extends('admin.dashboard')
@section('content')
    <div class="container-xxl">
        <div class="card">
            <div class="header">
                <h4 class="card-tittle">Edit Movie</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $row->id) }}" method="POST" id="form-validation-2" class="form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name" required value="{{$row->name ?? old('name')}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        {{-- Email --}}
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$row->email ?? old('email')}}" required>
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
                    <button class="btn btn-primary" type="submit">Update</button>

                </form>
            </div>
        </div>

    </div>
@endsection
