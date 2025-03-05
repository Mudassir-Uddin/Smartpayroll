@extends('layout.form')
@section('myform')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Register</h3>
              <form action="{{ url('/registerstore') }}" method="POST" enctype="multipart/form-data" id="loginForm">
                @csrf
                
                <div class="form-group">
                  <label for="floatingText">Name</label>
                  <input type="text" class="form-control p_input" id="floatingText" name="name"
                      value="{{ old('name') }}" placeholder="Name">
                  @error('name')
                      <p class="text-danger">{{ $message }}</p>
                  @enderror
              </div>

              <div class="form-group">
                <label for="floatingText">Email</label>
                <input type="email" name="email" class="form-control p_input" value="{{ old('email') }}"
                    id="floatingText" placeholder="Email">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
              <label for="floatingText">Password</label>
              <input type="password" name="pass" id="floatingText" class="form-control p_input"
                  value="{{ old('pass') }}" placeholder="Password">
              @error('pass')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>

                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input"> Remember me </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                </div>
                <div class="d-flex">
                  <button class="btn btn-facebook col mr-2">
                    <i class="mdi mdi-facebook"></i> Facebook </button>
                  <button class="btn btn-google col">
                    <i class="mdi mdi-google-plus"></i> Google plus </button>
                </div>
                <p class="sign-up text-center">Already have an Account?<a href="#"> Login</a></p>
                <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
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
 

@endsection