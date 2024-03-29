@extends('layouts.master')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Display Current Photo -->
                        <div class="form-group">
                            <label for="current_photo">{{ __('Current Photo') }}</label>
                            {{-- @if($user->image) --}}
                                    <img src="{{ url($user->image->user_image) }}" alt="Current Photo" style="max-width: 100px; margin-bottom: 5px;">
                            {{-- @else --}}
                            {{-- @endif --}}
                        </div>

                        <!-- Upload New Photo -->
                        <div class="form-group">
                            <label for="photo">{{ __('Photo') }}</label>
                            <input id="user_image" type="file" class="form-control @error('user_image') is-invalid @enderror" name="user_image">
                            @error('user_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                        </div>

                        @if($customer)
                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username', $customer->username) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address', $customer->address) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="contact_number">{{ __('Contact Number') }}</label>
                                <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{ old('contact_number', $customer->contact_number) }}" required>
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
