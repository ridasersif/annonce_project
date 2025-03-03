@extends('layouts.app')  
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3 class="mb-0 fw-bold">{{ __('Create Your Account') }}</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">{{ __('Full Name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Enter your name">
                            </div>
                            @error('name')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Enter your email">
                            </div>
                            @error('email')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Enter your password">
                                <span class="input-group-text toggle-password cursor-pointer"><i class="fas fa-eye"></i></span>
                            </div>
                            @error('password')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-bold">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm your password">
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-4">
                            <label for="role" class="form-label fw-bold">{{ __('I am a') }}</label>
                            <div class="d-flex gap-4">
                                @foreach($roles as $role)
                                    @if($role->id != 1) <!-- Exclude Admin -->
                                    <div class="form-check form-check-inline p-3 border rounded role-selector" data-role="{{ $role->id }}">
                                        <input class="form-check-input role-input" type="radio" name="role_id" id="role_{{ $role->id }}" value="{{ $role->id }}" {{ $loop->first ? 'checked' : '' }}>
                                        <label class="form-check-label ms-2" for="role_{{ $role->id }}">
                                            <i class="fas {{ $role->id == 2 ? 'fa-building' : 'fa-user' }} me-2"></i> {{ $role->name }}
                                        </label>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            @error('role_id')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Company Information (Society Only) -->
                        <div id="society-info" class="society-fields bg-light p-3 rounded mb-4" style="display:none;">
                            <h5 class="mb-3 border-bottom pb-2">Company Information</h5>
                            <div class="mb-3">
                                <label for="company_name" class="form-label fw-bold">{{ __('Company Name') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    <input id="company_name" type="text" class="form-control" name="company_name" placeholder="Enter company name">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold">{{ __('Address') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <input id="address" type="text" class="form-control" name="address" placeholder="Enter company address">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">{{ __('Description') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                    <textarea id="description" class="form-control" name="description" rows="3" placeholder="Brief description of your company"></textarea>
                                </div>
                            </div>
                       </div>

                        <!-- Submit Button -->
                        <div class="mb-0 d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i> {{ __('Create Account') }}
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Sign In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const societyInfo = document.getElementById('society-info');
        const roleInputs = document.querySelectorAll('.role-input');

        function updateRoleSelection() {
            let selectedRole = document.querySelector('.role-input:checked').value;
            if (selectedRole == 3) {
                societyInfo.style.display = 'block';
            } else {
                societyInfo.style.display = 'none';
            }
        }

        roleInputs.forEach(input => {
            input.addEventListener('change', updateRoleSelection);
        });

        updateRoleSelection(); 
    });
</script>
@endsection
