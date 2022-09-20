@extends('administrator.layouts')

@section('title')
<h4 class="page-title">Application for {{$pendingNotary->user->names}}</h4>
@endsection

@section('content')
<div class="card">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab">
                <i class="bx bx-user-circle font-size-20"></i>
                <span class="d-none d-sm-block">About</span> 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#files" role="tab">
                <i class="bx bx-clipboard font-size-20"></i>
                <span class="d-none d-sm-block">Uploaded Documents</span> 
            </a>
        </li>
    </ul>
    <!-- Tab content -->
    <div class="tab-content p-4">

        <div class="tab-pane active" id="about" role="tabpanel">
            <div>
                <div>
                    <h5 class="font-size-16 mb-4">Personal Information</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Names: <b>{{$pendingNotary->user->names}}</b></li>
                        <li class="list-group-item">Email: <b>{{$pendingNotary->user->email}}</b></li>
                        <li class="list-group-item">Telephone: <b>{{$pendingNotary->user->telephone}}</b></li>
                        <li class="list-group-item">National ID Number: <b>{{$pendingNotary->national_id}}</b></li>
                      </ul>
                </div>
                <br>
                <div>
                    <h5 class="font-size-16 mb-4">Personal Address</h5>
                    <ul class="list-group">
                        <li class="list-group-item">District: <b>{{$pendingNotary->district}}</b></li>
                        <li class="list-group-item">Sector: <b>{{$pendingNotary->sector}}</b></li>
                        <li class="list-group-item">Cell: <b>{{$pendingNotary->cell}}</b></li>
                      </ul>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="files" role="tabpanel">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="font-size-16 mb-4">Passport Image (<b class="text text-danger">Click to view</b>)</h5>
                        <a href="{{route('downloadNotaryPassportPicture',[$pendingNotary->id,'notary_passport_images'])}}" target="_blank">
                            <img src="/assets/images/picture_image.png" alt="" width="100">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <h5 class="font-size-16 mb-4">Uploaded National ID Photocopy (<b class="text text-danger">Click to view</b>)</h5>
                        <a href="{{route('downloadNotaryNationalId',[$pendingNotary->id,'notary_photocopy_ids'])}}" target="_blank">
                            <img src="/assets/images/file_image.png" alt="" width="100">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div>
            <a href="#" onclick="document.getElementById('{{$pendingNotary->id}}-approve').submit();" class="btn btn-success">Approve Application</a>
            <a href="" class="btn btn-danger">Reject Application</a>
            <a href="{{route('getPendingNotaries')}}" class="btn btn-primary">Back To Pending Applications</a>
            <form action="{{route('approveNotary', $pendingNotary->id)}}" id="{{$pendingNotary->id}}-approve" method="POST" style="display: none">
                @csrf
                <input type="hidden" name="_method" value="PUT">
            </form>
        </div>
    </div>
</div>
<br>
@endsection