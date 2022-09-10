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
                                        <a href="index.html" class="d-block auth-logo">
                                            <h2>LOGO</h2>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Register Account</h5>
                                            <p class="text-muted mt-2">Get your free account now.</p>
                                        </div>
                                        @if (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <b>{{ Session::get('error') }}</b>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div> 
                                        @endif
                                        <form class="mt-4 pt-2" action="{{route('registerOnFirstPage')}}" method="POST">
                                            @csrf
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="text" class="form-control" id="input-names" value="{{($data && $data['names']) ? $data['names'] : old('names')}}" name="names" placeholder="Enter Names" required>
                                                <label for="input-names">Names</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="people-outline"></i>
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="email" class="form-control" id="input-email" value="{{($data && $data['email']) ? $data['email'] : old('email')}}" name="email" placeholder="Enter Email" required>
                                                <label for="input-email">Email</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="email-outline"></i>
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="tel" class="form-control" id="input-tel" maxlength="12" minlength="12" value="{{($data && $data['telephone']) ? $data['telephone'] : old('telephone')}}" name="telephone" placeholder="Enter Telephone" required>
                                                <label for="input-tel">Telephone(format 250...)</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="phone-outline"></i>
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-custom mb-4">
                                                <select class="form-select pb-0 pt-0" name="role" required>
                                                    <option selected disabled value="">Select User Type</option>
                                                    @foreach (\App\Models\Role::REGISTER_TYPE as $item)
                                                        <option {{(($data && $data['role'] === $item) ||(old('role') === $item)) ? "selected" : ""}} value="{{$item}}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-floating-icon">
                                                    <i data-eva="person-outline"></i>
                                                </div>
                                            </div>
    
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Next</button>
                                            </div>
                                        </form>
    
                                        <div class="mt-2 pt-2 text-center">
                                            <p class="text-muted mb-0">Already have an account ? <a href="{{route('getLoginPage')}}" class="text-primary fw-semibold"> Login </a> </p>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-center">
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
