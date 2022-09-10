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
                                        <a href="" class="d-block auth-logo">
                                            <h2>Logo</h2>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <div class="avatar-md mx-auto">
                                                <div class="avatar-title rounded-circle bg-light">
                                                    <i class="bx bx-like h2 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <h4 class="text-success">Success !</h4>
                                                <h5>Dear {{$data['names']}}</h5>
                                                @if ($data['role'] === \App\Models\Role::NOTARY)
                                                <p class="text-muted">Thanks for registration... you will be notified soon after reviewing your application</p>
                                                @else
                                                <p class="text-muted">Thanks for registration... You will get a confirmation SMS containing your password</p>
                                                @endif
                                                <div class="mt-4">
                                                   @if ($data['role'] === \App\Models\Role::NOTARY)
                                                   <a href="" class="btn btn-primary w-100">Back to Home</a>
                                                   @else
                                                   <a href="{{route('getLoginPage')}}" class="btn btn-primary w-100">Login</a>
                                                   @endif
                                                </div>
                                            </div>
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
