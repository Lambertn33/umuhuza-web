@extends('notary.layouts')

@section('title')
<h4 class="page-title">File #{{$file->file_number}}</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Users Code Confirmation</h4>
            </div>
            <div class="card-body">
                @if (Session::has("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-block-helper me-2"></i>
                    <b>{{Session::get('error')}}</b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{route('confirmFileUsers', $fileConfirmation->id)}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                   <div class="row">
                     @foreach ($users as $key=>$user)
                     <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Code Confirmation for <b>{{$user->names}}</b></label>
                            <input type="hidden" name="userIds[]" value="{{$user->id}}">
                            @if (old('confirmationCodes'))
                                @for( $i =0; $i < count(old('confirmationCodes')); $i++)                            
                                    @if ($key == $i)
                                        <input type="text" value="{{ old('confirmationCodes.'.$i)}}"  name="confirmationCodes[]" class="form-control" />  
                                    @endif                                     
                                @endfor
                            @else
                            <input type="text" class="form-control" placeholder="Enter Code got in the SMS" id="title" required name="confirmationCodes[]">   
                            @endif
                        </div>
                     </div>
                     @endforeach
                   </div>
                   <br><br>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <!-- end col -->
</div>
@endsection
