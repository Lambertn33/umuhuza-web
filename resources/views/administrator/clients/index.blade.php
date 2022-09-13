@extends('administrator.layouts')

@section('title')
<h4 class="page-title">Clients List</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="display: flex;justify-content:space-between;">
                <h4 class="card-title">Clients</h4>
            </div>
            <div class="card-body">
                <p class="card-title-desc">All Clients</p>    
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
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Files Uploaded</th>
                                <th>Account Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter=1 ?>
                            @foreach ($allSystemClients as $item)
                            <th scope="row">{{$counter}}</th>
                            <?php $counter++ ?>
                            <td>{{$item->user->names}}</td>
                            <td>{{$item->user->email}}</td>
                            <td>{{$item->user->telephone}}</td>
                            <td>{{$item->sentFiles->count()}}</td>
                            <td>
                                <span class="badge badge-pill badge-soft-{{$item->user->is_active ? "success" : "danger" }} font-size-12">
                                    {{$item->user->is_active ? "Active" : "Closed"}}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i data-eva="more-horizontal-outline" data-eva-width="20" data-eva-height="20"
                                            class=""></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item"  href="{{route('getClientFiles', $item->id)}}">View Uploaded Files</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="document.getElementById('{{$item->id}}-update').submit();">
                                         {{$item->user->is_active? "Close Account": "Re-Activate Account"}}
                                        </a>
                                            <form action="{{route('changeAccountStatus', $item->id)}}" method="POST" id="{{$item->id}}-update" style="display: none">
                                                @csrf
                                                @method('put')
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
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