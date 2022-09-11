@extends('client.layouts')

@section('title')
<h4 class="page-title">New File</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Upload New File</h4>
            </div>
            <div class="card-body">
                @if (Session::has("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-block-helper me-2"></i>
                    A simple danger alert—check it out!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{route('saveNewClientFile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                   <div class="row file-form">
                     <div class="col-md-12">
                        <div class="mb-3">
                            <label for="title" class="form-label">File title</label>
                            <input type="text" class="form-control" placeholder="Enter File Title" id="title" required name="title">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File Document</label>
                            <input type="file" class="form-control" required accept="application/pdf" name="document">
                        </div>
                        <div class="mb-3">
                            <label for="client-select-notary" class="form-label">Select Notary to Tag</label>
                            <select class="form-control" data-trigger name="notary"
                                id="client-select-notary"
                                placeholder="This is a search placeholder" required>
                                <option selected disabled>Select Notary</option>
                                @foreach ($allApprovedNotaries as $notary)
                                <option value="{{$notary->id}}">{{$notary->user->names}} - {{$notary->district}}</option>
                                @endforeach
                            </select>
                        </div>
                     </div>
                   </div>
                   <br><br>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <!-- end col -->
</div>
@endsection