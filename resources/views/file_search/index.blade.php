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
                                            <h5 class="mb-0">File Search !</h5>
                                            <p class="text-muted mt-2">Provide the File Number and additional information</p>
                                        </div>
                                        @if (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div> 
                                        @endif
                                        <form class="mt-4 pt-2" action="{{route('searchFile')}}" method="POST">
                                            @csrf
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="text" class="form-control" id="input-names" value="{{old('names')}}" name="names" placeholder="Enter Names" required>
                                                <label for="input-names">Names</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="people-outline"></i>
                                                </div>
                                            </div>
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="tel" class="form-control" id="input-tel" maxlength="12" minlength="12" value="{{old('telephone')}}" name="telephone" placeholder="Enter Telephone" required>
                                                <label for="input-tel">Telephone(format 250...)</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="phone-outline"></i>
                                                </div>
                                            </div>
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="text" class="form-control" id="input-username" required name="file_number" value="{{old('file_number')}}" placeholder="Enter File Number">
                                                <label for="input-username">File number</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="file-outline"></i>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="input-username">Reason for file access</label>
                                                <textarea name="reason" cols="30" rows="5" class="form-control" required>
                                                    {{old('reason')}}
                                                </textarea>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Search File</button>
                                            </div>
                                        </form>                        
                                        <div class="mt-4 pt-3 text-center">
                                            <p class="text-muted mb-0">Want to sign in ? <a href="{{route('getLoginPage')}}"
                                                class="text-primary fw-semibold"> Sign in  </a> </p>
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
