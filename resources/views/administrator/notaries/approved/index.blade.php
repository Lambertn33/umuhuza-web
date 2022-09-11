@extends('administrator.layouts')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Notaries</h4>
            </div>
            <div class="card-body">
                <p class="card-title-desc">All Active Notaries</p>    
                
                <div class="table-responsive">
                    <table class="table table-striped mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Names</th>
                                <th>Telephone</th>
                                <th>Code</th>
                                <th>National ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter=1 ?>
                            @foreach ($approvedNotaries as $item)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <?php $counter++ ?>
                                <td>{{$item->user->names}}</td>
                                <td>{{$item->user->telephone}}</td>
                                <td>{{$item->notary_code}}</td>
                                <td>{{$item->national_id}}</td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm waves-effect waves-light">
                                        Full Details
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm waves-effect waves-light">
                                        Close Account
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