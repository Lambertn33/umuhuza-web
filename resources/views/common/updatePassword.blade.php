@extends('common.layouts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Password Change Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 ms-lg-auto">
                            @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <b>{{ Session::get('error') }}</b>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> 
                            @else
                            <div class="alert alert-info mb-0" role="alert">
                                <b>Dear {{$authenticatedUser->names}} you must update your default password to proceed</b>
                            </div>
                             @endif
                            <br>
                            <div class="mt-5 mt-lg-4 mt-xl-0">    
                                <form action="{{route('updatePassword')}}" method="POST">
                                    @csrf
                                    <div class="row mb-4">
                                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                          <input type="password" value="{{old('password')}}" name="password" class="form-control" placeholder="Enter Password" required id="horizontal-password-input">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                          <input type="password" value="{{old('confirm_password')}}" name="confirm_password" class="form-control" placeholder="Confirm Password" required id="horizontal-password-input">
                                        </div>
                                    </div>
    
                                    <div class="row justify-content-end">
                                        <div class="col-sm-9">    
                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection