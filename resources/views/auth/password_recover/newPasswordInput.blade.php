@extends('auth.layouts')

@section('content')
<div class="col-xxl-4 col-lg-4 col-md-6">
    <div class="row justify-content-center g-0">
        <div class="col-xl-9">
            <div class="p-4">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="auth-full-page-content rounded d-flex p-3 my-2">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <a href="#" class="d-block auth-logo">
                                           <img src="/assets/images/umurinzi_logo.jpg" width="100%" alt="">
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Password Recover !</h5>
                                            <p class="text-muted mt-2">Enter New Password</p>
                                        </div>
                                        @if (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div> 
                                        @elseif(Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <b>{{ Session::get('success') }}</b>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div> 
                                        @endif
                                        <form class="mt-4 pt-2" action="{{route('provideNewPasswordForPasswordReset')}}" method="POST">
                                            @csrf    
                                            <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5" name="password" value="{{old('password')}}" id="password-input" placeholder="Enter Password">
                                                
                                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                </button>
                                                <label for="input-password">Password</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="lock-outline"></i>
                                                </div>
                                            </div>
                                            <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5" name="password_confirm" value="{{old('password_confirm')}}" id="password-confirm-input" placeholder="Enter Password">
                                                
                                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-confirm-addon">
                                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                </button>
                                                <label for="input-password">Confirm Password</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="lock-outline"></i>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset Password</button>
                                            </div>
                                        </form>                        
                                        <div class="mt-2 pt-2 text-center">
                                            <p class="text-muted mb-0">Already have an account ? <a href="{{route('getLoginPage')}}" class="text-primary fw-semibold"> Login </a> </p>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end auth full page content -->
</div>
@endsection
