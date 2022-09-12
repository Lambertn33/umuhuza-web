@extends('client.layouts')

@section('title')
<h4 class="page-title">Uploaded Files</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="display: flex;justify-content:space-between;">
                <h4 class="card-title">Files</h4>
                <a href="{{route('addNewClientFile')}}" class="btn btn-primary waves-effect waves-light" style="display: flex;align-items:center;">
                    <i class="bx bx-plus font-size-16 align-middle me-2"></i> Upload New File
                </a>
            </div>
            <div class="card-body">
                <p class="card-title-desc">All Uploaded Files</p>    
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                        <b>{{Session::get('success')}}</b>
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
                                <th>Tagged Notary</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($myUploadedFiles as $file)
                                <tr>
                                    <th scope="row">{{$counter}}</th>
                                     <?php $counter++ ?>
                                     <td>{{$file->filename}}</td>
                                     <td>{{$file->file_number}}</td>
                                     <td>{{$file->sending->receiver->user->names}}</td>
                                     <td>
                                        @if ($file->sending->status == \App\Models\File_Sending::PENDING)
                                            <span class="badge badge-pill badge-soft-danger font-size-12">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-12">Processed</span>
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
                                                <li><a class="dropdown-item" target="_blank" href="{{route('downloadClientFile',[$file->id,'client_uploaded_files'])}}">View Uploaded File</a></li>
                                                <li><a class="dropdown-item" target="_blank" href="{{route('downloadClientFile',[$file->id, 'client_photocopy_ids'])}}">View Uploaded National ID</a></li>
                                                @if (($file->sending->status == \App\Models\File_Sending::PENDING))
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