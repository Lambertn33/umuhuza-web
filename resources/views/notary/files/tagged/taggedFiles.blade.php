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
                                                <li><a class="dropdown-item" target="_blank" href="">Delete File</a></li>
                                            @endif
                                        </ul>
                                    </div>
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