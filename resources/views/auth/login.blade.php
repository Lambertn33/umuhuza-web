@extends('layouts.auth')

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
                                           <h2>LOGO</h2>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Welcome Back !</h5>
                                            <p class="text-muted mt-2">Sign in to continue</p>
                                        </div>
                                        @if (Session::has('danger'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('danger') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div> 
                                        @endif
                                        <form class="mt-4 pt-2" action="{{route('authenticate')}}" method="POST">
                                            @csrf
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="text" class="form-control" id="input-username" name="username" placeholder="Enter Telephone or Email">
                                                <label for="input-username">Email/Telephone</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="people-outline"></i>
                                                </div>
                                            </div>
    
                                            <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5" name="password" id="password-input" placeholder="Enter Password">
                                                
                                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                </button>
                                                <label for="input-password">Password</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="lock-outline"></i>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </form>                        
                                        <div class="mt-4 pt-3 text-center">
                                            <p class="text-muted mb-0">Don't have an account ? <a href="{{route('getRegistrationPage')}}"
                                                class="text-primary fw-semibold"> Signup now </a> </p>
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
