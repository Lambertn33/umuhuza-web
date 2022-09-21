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
                                            <h5 class="mb-0">Request File Access !</h5>
                                            <p class="text-muted mt-2">Enter Your Code</p>
                                        </div>
                                        @if (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div> 
                                        @else
                                        <div class="alert alert-success fade show mb-0" role="alert">
                                            <b>Dear {{$data['names']}} Please provide the code once received..</b>
                                        </div>
                                        @endif
                                        <form class="mt-4 pt-2" action="" method="POST">
                                            @csrf
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="text" class="form-control" id="input-tel" value="{{old('code')}}"  name="code" placeholder="Enter Received Code" required>
                                                <label for="input-tel">Code</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="phone-outline"></i>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Continue</button>
                                            </div>
                                        </form>                        
                                        <div class="mt-2 pt-2 text-center">
                                            <p class="text-muted mb-0">Discard ? <a href="{{route('getLoginPage')}}" class="text-primary fw-semibold"> Login </a> </p>
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
