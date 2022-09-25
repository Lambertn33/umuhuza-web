@extends('administrator.layouts')

@section('title')
<h4 class="page-title">Pending Notaries List</h4>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Notaries</h4>
            </div>
            <div class="card-body">
                <p class="card-title-desc">All Active Notaries</p>  
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
                                <th>Names</th>
                                <th>Telephone</th>
                                <th>National ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter=1 ?>
                            @foreach ($pendingNotaries as $item)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <?php $counter++ ?>
                                <td>{{$item->user->names}}</td>
                                <td>{{$item->user->telephone}}</td>
                                <td>{{$item->national_id}}</td>
                                <td>
                                   <a href="{{route('getPendingNotaryInfo', $item->id)}}" class="btn btn-info btn-sm">view full info</a>
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

<!-- end row -->
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