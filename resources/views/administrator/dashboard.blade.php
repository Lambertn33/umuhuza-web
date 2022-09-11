@extends('administrator.layouts')

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
                                        <i data-eva="pie-chart-2" class="fill-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Total Notaries</p>
                                <h4 class="mb-0">{{$totalNotaries}}</h4>
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
                                        <i data-eva="shopping-bag" class="fill-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Total Clients</p>
                                <h4 class="mb-0">{{$totalClients}}</h4>
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
                                <p class="text-muted mb-1">Total Files</p>
                                <h4 class="mb-0">{{$totalFiles}}</h4>
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
                        <h5 class="card-title mb-3">Latest Notaries</h5>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle">Code</th>
                                <th class="align-middle">Names</th>
                                <th class="align-middle">Telephone</th>
                                <th class="align-middle">District</th>
                                <th class="align-middle">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestNotaries as $item)
                            <tr>
                                <td><a href="javascript: void(0);" class="text-body fw-semibold">{{$item->notary_code}}</a> </td>
                                <td>{{$item->user->names}}</td>
                                <td>
                                    {{$item->user->telephone}}
                                </td>
                                <td>
                                   {{$item->district}}
                                </td>
                                <td class="text-center">
                                    @if ($item->status == \App\Models\Notary::APPROVED)
                                    <span class="badge badge-pill badge-soft-success font-size-11">Approved</span>
                                    @elseif($item->status == \App\Models\Notary::PENDING)
                                    <span class="badge badge-pill badge-soft-warning font-size-11">Pending</span>
                                    @else
                                    <span class="badge badge-pill badge-soft-danger font-size-11">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="" class="btn mt-2 btn-primary btn-rounded waves-effect waves-light">View More</a>
                    <!-- end table -->
                </div>
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
                    <h5 class="card-title mb-3">Notaries Chart</h5>
                </div>
            </div>
            {!! $notariesChart->container() !!}
        </div>
       </div>
    </div>
</div>

<script src="{{ $notariesChart->cdn() }}"></script>
{{ $notariesChart->script() }}
@endsection

