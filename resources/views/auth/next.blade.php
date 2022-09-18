@extends('auth.layouts')

@section('content')
<div class="col-xxl-4 col-lg-4 col-md-6">
    <div class="row justify-content-center g-0">
        <div class="col-xl-9">
            <div class="p-4">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="auth-full-page-content rounded d-flex p-3 my-2">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <a href="#" class="d-block auth-logo">
                                           <img src="/assets/images/umurinzi_logo.jpg" width="100%" alt="">
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            @if (Session::has('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <b>{{ Session::get('error') }}</b>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div> 
                                            @else
                                            <div class="alert alert-info fade show mb-0" role="alert">
                                                Thank you <b>{{$names}}</b> for your interest of joining as a <b>{{$role}}</b>! Please provide the information below
                                            </div>
                                             @endif
                                        </div>
                                        <form class="mt-4 pt-2" action="{{route('submitRegistration')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="number" 
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength = "16"
                                                class="form-control" value="{{old('national_id')}}" id="input-national_id" name="national_id" placeholder="Enter National ID" required>
                                                <label for="input-national_id">National ID Number</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="person-add-outline"></i>
                                                </div>
                                            </div> 
                                            @if ($role == \App\Models\Role::NOTARY)
                                            <div class="form-floating form-floating-custom mb-4">
                                                <select class="form-select province pb-0 pt-0" name="province" required>
                                                    <option selected disabled value="">Select Province</option>
                                                </select>
                                                <div class="form-floating-icon">
                                                    <i data-eva="navigation-outline"></i>
                                                </div>
                                            </div>   
                                            <div class="form-floating form-floating-custom mb-4">
                                                <select class="form-select district pb-0 pt-0" name="district" required>
                                                    <option selected disabled>Select District</option>
                                                </select>
                                                <div class="form-floating-icon">
                                                    <i data-eva="navigation-outline"></i>
                                                </div>
                                            </div> 
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="text" class="form-control sector" id="sector" name="sector" placeholder="Enter Setor" required>
                                                <label for="sector">Sector</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="navigation-outline"></i>
                                                </div>
                                            </div>  
                                            <div class="form-floating form-floating-custom mb-4">
                                                <input type="text" class="form-control cell" id="cell" name="cell" placeholder="Enter Cell" required>
                                                <label for="cell">Cell</label>
                                                <div class="form-floating-icon">
                                                    <i data-eva="navigation-outline"></i>
                                                </div>
                                            </div>  
                                            <div class="form-floating form-floating-custom mb-4">
                                                <div class="mt-3">
                                                    <label for="formFile" class="form-label">Upload National ID Copy (<b class="text-danger">Only PDF allowed</b>)</label>
                                                    <input name="national_id_photocopy" accept="application/pdf" required class="form-control" type="file" id="formFile">
                                                </div>
                                            </div>  
                                            <div class="form-floating form-floating-custom mb-4">
                                                <div class="mt-3">
                                                    <label for="formFile" class="form-label">Upload Passport Photo (<b class="text-danger">Upload Visible Photo</b>)</label>
                                                    <input name="image" required class="form-control" accept="image/*" type="file" id="formFile">
                                                </div>
                                            </div>  
                                            @endif  
                                            <div class="mb-3">
                                                <button class="btn btn-success w-100 waves-effect waves-light" type="submit">Submit</button>
                                            </div>
                                        </form>
                                        <a class="btn btn-primary w-100 mb-3 waves-effect waves-light" href="{{route('getRegistrationPage')}}">Back</a>
                                    </div>
                                    <div class="mt-2 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end auth full page content -->
</div>
@endsection
<script src="{{mix('js/app.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
 $(document).ready(function (){
    const $provinceInput = $('.province');
    const $districtInput = $('.district');
    const $sectorInput = $('.sector');
    const $cellInput = $('.cell');
    $districtInput.prop('disabled', true);
    $sectorInput.prop('disabled', true);
    $cellInput.prop('disabled', true);
    const provinces = ['East', 'Kigali', 'North', 'South', 'West'];
    const districts = {
        'Kigali': [
            'Gasabo',
            'Kicukiro',
            'Nyarugenge'
        ],
        'East': [
            'Bugesera',
            'Gatsibo',
            'Kayonza',
            'Kirehe',
            'Ngoma',
            'Nyagatare',
            'Rwamagana'
       ],
       'North': [
            'Burera',
            'Gakenke',
            'Gicumbi',
            'Musanze',
            'Rulindo'
       ],
       'South': [
            'Gisagara',
            'Huye',
            'Kamonyi',
            'Muhanga',
            'Nyamagabe',
            'Nyanza',
            'Nyaruguru',
            'Ruhango'
       ],
       'West': [
            'Karongi',
            'Ngororero',
            'Nyabihu',
            'Nyamasheke',
            'Rubavu',
            'Rusizi',
            'Rutsiro'
       ]
    };
    $provinceInput.append(
        provinces.map(function(item){
            return $('<option/>', {
                value: `${item} Province`,
                text: `${item} Province`
            })
        })
    );

    const appendValuesToInput = (input, values) => {
        return input.append(
            values.map(function(item){
                return $('<option/>', {
                    value: `${item}`,
                    text: `${item}`
                })
            })
        );
    }

    $provinceInput.change(function (){
        let selectedProvince = $(this).val().split(' ')[0].toString();
        let provinceDistricts = districts[`${selectedProvince}`];
        $districtInput.find('option').remove();
        $districtInput.append(
           '<option value="" selected disabled>Select District:.</option>'
        );
        appendValuesToInput($districtInput, provinceDistricts);
        $districtInput.prop('disabled', false);
    });

    $districtInput.change(function (){
        let selectedDistrict = $(this).val();
        if ($(this).val()) {
            $sectorInput.prop('disabled', false);
        }
    });

    $sectorInput.on('input', function(){
        if ($(this).val() !== "") {
            $cellInput.prop('disabled', false);
        } else {
            $cellInput.prop('disabled', true);
        }
    })
 });
</script>