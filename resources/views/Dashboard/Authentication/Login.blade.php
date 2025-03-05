@extends('layout.form')
@section('myform')

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- ... other head elements ... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Login</h3>

                            <form enctype="multipart/form-data" id="formSubmit">
                                @csrf

                                <div class="form-group">
                                    <label for="floatingText">Email</label>
                                    <input type="email" name="email" id="floatingText" value="{{ old('email') }}"
                                        class="form-control p_input" placeholder="Email">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="floatingText">Password</label>
                                    <input type="password" name="pass" id="floatingText" value="{{ old('pass') }}"
                                        class="form-control p_input" placeholder="Password">
                                    @error('pass')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input"> Remember me </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div> --}}
                                <div class="text-center">
                                    <button class="btn btn-primary btn-block enter-btn">Login</button>
                                </div>
                                {{-- <div class="d-flex">
                  <button class="btn btn-facebook mr-2 col">
                    <i class="mdi mdi-facebook"></i> Facebook </button>
                  <button class="btn btn-google col">
                    <i class="mdi mdi-google-plus"></i> Google plus </button>
                </div> --}}
                                <p class="sign-up">Don't have an Account?<a href="{{ url('/register') }}"> Sign Up</a></p>
                                <p class="sign-up">Back To Home ?<a href="{{ url('/Admindashboard') }}"> &nbsp; Dashboard</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->



    <script>
        // Assuming you are using jQuery for simplicity
        $(document).ready(function() {
            $('#formSubmit').on('submit', function(e) {

                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: '/loginstore',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Good',
                            text: `Why do I have this issue? ${ response.message}`,
                        })

                        window.location.href = response.redirect;

                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `Why do I have this issue? ${ xhr.responseJSON.message}`,
                        })
                    },
                });
            });
        });
    </script>
<style>

.swal2-title {
    color: rgb(0, 0, 0) !important;
    font-size: 40px !important;
    font-weight: bold !important;
}

</style>
@endsection
