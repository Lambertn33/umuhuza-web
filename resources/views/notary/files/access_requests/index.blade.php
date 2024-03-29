@extends('notary.layouts')

@section('title')
<h4 class="page-title">Files Access Requests</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="display: flex;justify-content:space-between;">
                <h4 class="card-title">Files Access Requests</h4>
            </div>
            <div class="card-body">
                <p class="card-title-desc">All Files Access Requests</p>    
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                        <b>{{Session::get('success')}}</b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                        <b>{{Session::get('error')}}</b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>File title</th>
                                <th>File number</th>
                                <th>Requester Names</th>
                                <th>Requester Telephone</th>
                                <th>Request Status</th>
                                <th>File Read</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($fileAccessRequests as $item)
                                <tr>
                                    <th scope="row">{{$counter}}</th>
                                    <?php $counter++ ?>
                                    <td>{{$item->file->filename}}</td>
                                    <td>{{$item->file->file_number}}</td>
                                    <td>{{$item->requested_by}}</td>
                                    <td>{{$item->telephone}}</td>
                                    <td>
                                        @if ($item->status == \App\Models\File_Access_Request::PENDING)
                                            <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @elseif($item->status == \App\Models\File_Access_Request::REJECTED)
                                            <span class="badge badge-pill badge-soft-danger font-size-11">Rejected</span>
                                        @else
                                            <span class="badge badge-pill badge-soft-success font-size-11">Approved</span>
                                        @endif
                                     </td>
                                    <td>
                                        @if ($item->has_been_viewed)
                                            <span class="badge badge-pill badge-soft-success font-size-11">File Opened</span>
                                        @else
                                            <span class="badge badge-pill badge-soft-danger font-size-11">File Not Opened</span>
                                        @endif
                                     </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-eva="more-horizontal-outline" data-eva-width="20" data-eva-height="20"
                                                    class=""></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">                                    
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target=".bs-{{$item->file->id}}">View More</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target=".bs-{{$item->file->id}}-approve-request">Approve Request</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target=".bs-{{$item->file->id}}-reject-request">Reject Request</a></li>
                                            </ul>
                                        </div>
                                        <!--View Reason Modal-->
                                        <div class="modal fade bs-example-modal-lg bs-{{$item->file->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Access Request for file #{{$item->file->file_number}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>Reason For Access Request</h3>
                                                        <br>
                                                        <p>{{$item->reason}}</p>                
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

                                        <!--Approve Modal-->
                                        <div class="modal fade bs-example-modal-lg bs-{{$item->file->id}}-approve-request" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Approve Access Request for file #{{$item->file->file_number}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('giveAccessToFile', $item->id)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                           <div class="row file-form">
                                                             <div class="col-md-12 mb-3">
                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label">Secret Code (<b class="text-danger">Provide a secret code to be sent to {{$item->requested_by}} for file access</b>)</label>
                                                                    <input type="number" name="accessCode"  required class="form-control">
                                                                </div>
                                                             </div>
                                                           </div>
                                                            <div>
                                                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                            </div>
                                                        </form>         
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- end col -->
</div>
@endsection
<script src="{{mix('js/app.js')}}"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" />  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>  
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" type="text/javascript"></script>  
<script type="text/javascript">  
$(document).ready(function ()  
    {  
        $('.table').dataTable({});  
    });  
</script>  