@extends('notary.layouts')

@section('title')
<h4 class="page-title">File #{{$fileToProcess->file_number}}</h4>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header" style="display: flex;justify-content:space-between;align-items:center">
                <h4 class="card-title">Proccess File</h4>
                <a href="{{route('myTaggedFiles')}}" class="btn btn-success waves-effect waves-light" style="display: flex;align-items:center;">
                    Back to Tagged Files
               </a>
            </div>
            <div class="card-body">
                @if (Session::has("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-block-helper me-2"></i>
                    <b>{{Session::get('error')}}</b>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{route('processClientFile', $fileToProcess->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                   <div class="row file-form">
                     <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">File title</label>
                            <input type="text" class="form-control" value="{{$fileToProcess->filename}}" readonly placeholder="Enter File Title" id="title" required name="title">
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">File Code</label>
                            <input type="text" class="form-control" value="{{$fileToProcess->file_number}}" id="code" readonly name="code">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Uploaded File Document</label>
                            <a target="_blank" href="{{route('downloadClientFile',[$fileToProcess->id,'client_uploaded_files'])}}">
                                <img src="/assets/images/file_image.png" width="10%" alt="">
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Uploaded National ID Document</label>
                            <a target="_blank" href="{{route('downloadClientFile',[$fileToProcess->id,'client_photocopy_ids'])}}">
                                <img src="/assets/images/file_image.png" width="10%" alt="">
                            </a>
                        </div>
                        <div>
                            <button type="button" class="btn users-confirmation-addition btn-success w-md">Add Confirmation Users</button>
                        </div>
                     </div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $(".users-confirmation-addition").on('click', function(){
            $('.file-form').append(`
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="names" class="form-label">User Names</label>
                        <input type="text" class="form-control" placeholder="Enter Names" id="names" required name="names[]">
                    </div>
                    <div class="mb-3">
                        <label for="national_id" class="form-label">User National ID</label>
                        <input type="number"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        maxlength = "16"
                        class="form-control" id="national_id" placeholder="Enter National ID" required name="national_ids[]">
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">User Telephone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephones[]" maxlength="12" required>
                    </div>
                    <div>
                        <button class="btn users-confirmation-remove btn-danger w-md">Remove  User</button>
                    </div>
                </div>
            `);
        });
    });
    $(document).on('click','.users-confirmation-remove',function(){
        $(this).parent().parent().remove()
    });
</script>