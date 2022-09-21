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
                                            <h5 class="mb-0"> File #{{$fileToView->file_number}}</h5>                                            
                                            @if (!$searchRecord->has_been_viewed)

                                            <b class="text-danger">Click to view the requested file</b>
                                            <a href="{{route('downloadSearchedFile', $searchRecord->id)}}" onclick="setTimeout(function(){location.reload();},1000);" target="_blank">
                                                <img src="/assets/images/file_image.png" alt="" width="100">
                                            </a>
                                            @else
                                               <b class="text-danger">File Already Viewed...Access Denied</b>
                                            @endif
                                        </div>
                                                                
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
