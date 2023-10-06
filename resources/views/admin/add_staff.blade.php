@extends('layouts.admin')

@section('page_title')
    Add A Staff
@endsection
@section('page_content')
    <link href="{{ asset('admin/vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">


    <form method="post" action="/admin/add-staff" enctype="multipart/form-data" class="row">@csrf
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Personal Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Full Name<span
                                                class="required">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" placeholder="James">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-primary">Email<span class="required">*</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" placeholder="hello@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Address<span
                                                class="required">*</span></label>
                                        <textarea class="form-control" name="address" rows="6"></textarea>
                                    </div>

                                </div>
                                <div class="col-xl-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label text-primary">Staff
                                                    Role<span class="required">*</span></label>
                                                <select name="role" class="form-control" id="">
                                                    <option>Administrator</option>
                                                    <option>Delivery</option>
                                                    <option>Dispatch</option>
                                                    <option>Graphics</option>
                                                    <option>Marketer</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label">Date of Birth<span class="required">*</span></label>
                                            <input class="form-control" name="dob" value="{{ old('dob') }}"
                                                type="date" id="datepicker">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-primary">Phone
                                            Number<span class="required">*</span></label>
                                        <input type="number" name="phone" value="{{ old('phone') }}"
                                            class="form-control" placeholder="+123456789">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Photo<span class="required">*</span></label>
                                        <div class="avatar-upload">
                                            <div class="avatar-preview">
                                                <div id="imagePreview"
                                                    style="background-image: url(images/no-img-avatar.png);">
                                                </div>
                                            </div>
                                            <div class="change-btn mt-1">
                                                <input type="file" name="image" class="form-control d-none"
                                                    id="imageUpload" accept=".png, .jpg, .jpeg">
                                                <label for="imageUpload"
                                                    class="dlab-upload mb-0 btn btn-primary btn-sm">Choose File</label>
                                                <a href="javascript:void(0);"
                                                    class="btn btn-danger light remove-img ms-2 btn-sm">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-sm-6">
                                    <div class="d-flex justify-content-end ">
                                        <button class="btn btn-primary">Save Details</button>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection


@push('scripts')
    <script src="{{ asset('assets/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(function() {

        })
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
        $('.remove-img').on('click', function() {
            var imageUrl = "assets/images/no-img-avatar.png";
            $('.avatar-preview, #imagePreview').removeAttr('style');
            $('#imagePreview').css('background-image', 'url(' + imageUrl + ')');
        });
    </script>
@endpush
