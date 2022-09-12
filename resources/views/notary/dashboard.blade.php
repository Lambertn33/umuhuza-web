@extends('notary.layouts')

@section('title')
<h4 class="page-title">Notary Dashboard</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <div class="avatar-title rounded bg-primary bg-gradient">
                                        <i data-eva="file" class="fill-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Total Pending Files</p>
                                <h4 class="mb-0">{{$myTotalPendingFiles}}</h4>
                            </div>

                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <div class="avatar-title rounded bg-primary bg-gradient">
                                        <i data-eva="file" class="fill-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Total Uploaded Files</p>
                                <h4 class="mb-0">{{$myTotalFiles}}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <div class="avatar-title rounded bg-primary bg-gradient">
                                        <i data-eva="file" class="fill-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Total Processed Files</p>
                                <h4 class="mb-0">{{$myTotalProcessedFiles}}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <div class="avatar-title rounded bg-primary bg-gradient">
                                        <i data-eva="file" class="fill-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Start Uploading...</p>
                                <a href="{{route('addNewNotaryFile')}}" class="btn btn-success waves-effect waves-light btn-sm" style="display: flex;align-items:center;">
                                    <i class="bx bx-plus font-size-16 align-middle me-2"></i> Upload New File
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-3">My Latest Tagged Files</h5>
                    </div>
                </div>

                @if ($myLatestTaggedFiles->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle">File Title</th>
                                <th class="align-middle">File Code</th>
                                <th class="align-middle">Sender</th>
                                <th class="align-middle">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myLatestTaggedFiles as $taggedFile)
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body fw-semibold">{{$taggedFile->file->filename}}</a> </td>
                                    <td>{{$taggedFile->file->file_number}}</td>
                                    <td>{{$taggedFile->sender->user->names}}</td>
                                    <td>
                                        @if ($taggedFile->status == \App\Models\File_Sending::PENDING)
                                            <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                            <span class="badge badge-pill badge-soft-success font-size-11">Processed</span>
                                        @endif
                                     </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{route('myTaggedFiles')}}" class="btn mt-2 btn-primary btn-rounded waves-effect waves-light">View More</a>
                    <!-- end table -->
                </div>
                @else
                <h5 class="text-center text-danger">No Latest Tagged Files Available</h5>
                @endif
                <!-- end table responsive -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
         <div class="card-body">
             <div class="d-flex align-items-start">
                 <div class="flex-grow-1">
                     <h5 class="card-title mb-3">My Files Chart</h5>
                 </div>
             </div>
             {!! $notaryFilesChart->container() !!}
         </div>
        </div>
     </div>
</div>
<script src="{{ $notaryFilesChart->cdn() }}"></script>
{{ $notaryFilesChart->script() }}
@endsection