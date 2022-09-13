@extends('administrator.layouts')

@section('title')
    <h4 class="page-title">
        {{$notary->user->names }}
    </h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Uploaded Files</h4>
            </div>
            <div class="card-body">
                <p class="card-title-desc">All Uploaded Files for {{$notary->user->names}}</p>                 
                <div class="table-responsive">
                    <table class="table table-striped mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>File Title</th>
                                <th>File Code</th>
                                <th>Uploaded Date</th>
                                <th>File Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter=1 ?>
                            @foreach ($notaryFiles as $item)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <?php $counter++ ?>
                                <td>{{$item->filename}}</td>
                                <td>{{$item->file_number}}</td>
                                <td>{{$item->created_at->format('Y-m-d')}}</td>
                                <td>
                                    <a href="{{route('downloadFile',[$item->id,'notary_uploaded_files'])}}" target="_blank">
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