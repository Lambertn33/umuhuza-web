@extends('notary.layouts')

@section('title')
<h4 class="page-title">Dashboard</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="row">
            <div class="col-xl-4 col-lg-6">
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
                                <p class="text-muted mb-1">Total Received Files</p>
                                <h4 class="mb-0">0</h4>
                            </div>

                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-4 col-lg-6">
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
                                <h4 class="mb-0">0</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <div class="avatar-title rounded bg-primary bg-gradient">
                                        <i data-eva="people" class="fill-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Total Files Users Confirmation</p>
                                <h4 class="mb-0">0</h4>
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

    <h2>Notary Dashboard Overview</h2>
    <!-- end col -->
</div>
@endsection