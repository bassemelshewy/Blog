@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="col-12">
        <div class="row justify-content-center g-0">
            <div class="col-lg-5 col-md-5 col-12">
                <div class="bg-white rounded10 shadow-lg">
                    <div class="content-top-agile p-20 pb-0">
                        <h2 class="text-primary">Get started with Us</h2>
                        <p class="mb-0">Register a new membership</p>
                    </div>
                    <div class="p-40">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                    <input type="text" class="form-control ps-15 bg-transparent @error('name') is-invalid @enderror"
                                        placeholder="Full Name" name="name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <span class="input-group-text text-danger border-danger mt-5">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                                    <input type="email" class="form-control ps-15 bg-transparent @error('email') is-invalid @enderror" placeholder="Email"
                                        name="email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <span class="input-group-text text-danger border-danger mt-5">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                    <input type="password" class="form-control ps-15 bg-transparent @error('password') is-invalid @enderror" placeholder="Password"
                                        name="password">
                                </div>
                                @error('password')
                                    <span class="input-group-text text-danger border-danger mt-5">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                    <input type="password" class="form-control ps-15 bg-transparent @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Retype Password" name="password_confirmation">
                                </div>
                                @error('password_confirmation')
                                    <span class="input-group-text text-danger border-danger mt-5">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-info margin-top-10">Register</button>
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="mt-15 mb-0">Already have an account?<a href="{{ route('login') }}"
                                    class="text-danger ms-5"> Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
