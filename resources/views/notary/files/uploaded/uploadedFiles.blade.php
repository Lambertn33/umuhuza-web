@extends('notary.layouts')

@section('title')
<h4 class="page-title">Uploaded Files</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="display: flex;justify-content:space-between;">
                <h4 class="card-title">Files</h4>
                <a href="{{route('addNewNotaryFile')}}" class="btn btn-primary waves-effect waves-light" style="display: flex;align-items:center;">
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
                                <th>Number of Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($myUploadedFiles as $item)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <?php $counter++ ?>
                                <td>{{$item->filename}}</td>
                                <td>{{$item->file_number}}</td>
                                <td>{{$item->confirmation->confirmation_users->count()}}</td>
                                <td>
                                    <a  href="{{route('downloadFile',$item->id)}}" target="_blank" class="btn btn-success btn-sm waves-effect waves-light">
                                        View File
                                    </a>
                                    <button data-bs-toggle="modal" data-bs-target=".bs-{{$item->id}}" class="btn btn-primary btn-sm waves-effect waves-light">
                                        View Confirmations
                                    </button>
                                    <!--  Large modal example -->
                                    <div class="modal fade bs-example-modal-lg bs-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Confirmation Users for file #{{$item->file_number}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php $count = 1 ?>
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($item->confirmation->confirmation_users as $user)
                                                            <li class="list-group-item">#{{$count}}- Names: <b>{{$user->names}}</b>   -Telephone: <b>{{$user->telephone}}</b>   -National ID: <b>{{$user->national_id}}</b></li>
                                                            <?php $count++ ?>
                                                        @endforeach
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