@extends('administrator.layouts')

@section('title')
<div>
    <h4 class="page-title">{{$client->user->names}}</h4>
</div>
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="display: flex;justify-content:space-between;align-items:center">
                <h4 class="card-title">Files</h4>
                <a href="{{route('getAllClients')}}" class="btn btn-success">Back To Clients Page</a>
            </div>
            <div class="card-body"> 
                <p class="card-title-desc">{{$client->user->names}} Files</p>  
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Notary</th>
                                <th>Uploaded Date</th>
                                <th>Status</th>
                                <th>Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter=1 ?>
                            @foreach ($clientFiles as $item)
                                <tr>
                                    <th scope="row">{{$counter}}</th>
                                    <?php $counter++ ?>
                                    <td>{{$item->file->filename}}</td>
                                    <td>{{$item->receiver->user->names}}</td>
                                    <td>{{$item->created_at->format('Y-m-d')}}</td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-{{$item->status == \App\Models\File_Sending::RECEIVED ? "success" : "danger" }} font-size-12">
                                            {{$item->status == \App\Models\File_Sending::RECEIVED  ? "Received" : "Pending"}}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{route('downloadClientFile',[$item->file->id,'client_uploaded_files'])}}" target="_blank">
                                            <i class="icon nav-icon" data-eva="cloud-download-outline"></i>
                                        </a>
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