@extends('notary.layouts')

@section('title')
<h4 class="page-title">Tagged Files</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="display: flex;justify-content:space-between;">
                <h4 class="card-title">Tagged Files</h4>
            </div>
            <div class="card-body">
                <p class="card-title-desc">All Tagged Files</p>    
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
                                <th>File Sender</th>
                                <th>Sender Telephone</th>
                                <th>Sent Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($myTaggedFiles as $item)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <?php $counter++ ?>
                                <td>{{$item->file->filename}}</td>
                                <td>{{$item->file->file_number}}</td>
                                <td>{{$item->sender->user->names}}</td>
                                <td>{{$item->sender->user->telephone}}</td>
                                <td>{{$item->created_at->format('m-d-Y')}}</td>
                                <td>
                                    @if ($item->status == \App\Models\File_Sending::PENDING)
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                    @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Processed</span>
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
                                            <li><a class="dropdown-item" target="_blank" href="{{route('downloadClientFile',[$item->file->id,'client_uploaded_files'])}}">View Uploaded File</a></li>
                                            <li><a class="dropdown-item" target="_blank" href="{{route('downloadClientFile',[$item->file->id, 'client_photocopy_ids'])}}">View Uploaded National ID</a></li>
                                            @if (($item->file->sending->status == \App\Models\File_Sending::PENDING))
                                                <li><a class="dropdown-item" href="{{route('getFileToProcess',$item->file->id)}}">Process File</a></li>
                                            @else
                                                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target=".bs-{{$item->file->id}}">View Confirmed Users</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="modal fade bs-example-modal-lg bs-{{$item->file->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Confirmation Users for file #{{$item->file->file_number}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php $count = 1 ?>
                                                    <ul class="list-group list-group-flush">
                                                        @if ($item->file->confirmation)
                                                            @foreach ($item->file->confirmation->confirmation_users as $user)
                                                                <li class="list-group-item">#{{$count}}- Names: <b>{{$user->names}}</b>   -Telephone: <b>{{$user->telephone}}</b>   -National ID: <b>{{$user->national_id}}</b></li>
                                                                <?php $count++ ?>
                                                            @endforeach
                                                        @endif
                                                    </ul>
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