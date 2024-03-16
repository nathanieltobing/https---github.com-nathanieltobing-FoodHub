@extends('master-clean')

@section('content')
<script type="text/javascript">


document.addEventListener("DOMContentLoaded", function(arg) {

  let role = document.getElementById("hidden1");
  let customerButton = document.getElementById("customerBtn");
  let vendorButton = document.getElementById("vendorBtn");
  let adminButton = document.getElementById("adminBtn");
  let url = document.getElementById("googleUrl");

  customerButton.addEventListener("click", updateButton);
  vendorButton.addEventListener("click", updateButton);
  adminButton.addEventListener("click", updateButton);


  let btnElementHighlight =customerButton;
  function updateButton(button){
    if(button.currentTarget.value === "CUSTOMER" ){
      btnElementHighlight.style.border="none";
      btnElementHighlight = customerButton;
      btnElementHighlight.style.border="1px solid gray";
      role.value = "CUSTOMER";
      url.href="/auth/google/customer";
      url.style.display = "flex";
    }
    else if(button.currentTarget.value === "VENDOR"){
      btnElementHighlight.style.border="none";
      btnElementHighlight = vendorButton;
      btnElementHighlight.style.border="1px solid gray";
      role.value = "VENDOR";
      url.href="/auth/google/vendor";
      url.style.display = "flex";
    }
    else if(button.currentTarget.value === "ADMIN"){
      btnElementHighlight.style.border="none";
      btnElementHighlight = adminButton;
      btnElementHighlight.style.border="1px solid gray";
      role.value = "ADMIN";
      url.style.display = "none";
    }
  }


});

</script>

<section class="vh-100" style="background-color: #eee;margin-bottom: -50px;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black mb-5" style="border-radius: 25px;">
            <div class="card-body p-md-5">
                <a href="/"> <i class="fa-solid fa-arrow-left fa-xl me-3 fa-fw"></i></a>
              <div class="row justify-content-center">
                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 " style=" font-weight: 700; color:#222; font-family: Poppins;">Login</p>
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1" style ="margin-top: 48px">
                         <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 " style=" font-weight: 700; color:#222; font-family: Poppins;">FH</p>

                  <h2 class="text-center  fw-bold  mx-1 mx-md-4 " style=" font-size:20px; font-weight: 700; color:#222; font-family: Poppins;">WELCOME TO FOODHUB</h2>
                  <h2 class="text-center  fw-bold mb-5 mx-1 mx-md-4 " style="font-size:20px; font-weight: 700; color:#222; font-family: Poppins;">LET'S GET STARTED</h2>


                  <form action="/login" method="POST" enctype="multipart/form-data" class="mx-1 mx-md-4 ">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw" style="margin-bottom: -5px;"></i>
                      <div class="form-outline flex-fill mb-0" style="margin-top: 35px">
                        <input type="email" id="inputEmail" name="email" class="form-control" aria-describedby="passwordHelpBlock"  value = {{Cookie::get('email') != null ? Cookie::get('email') : ""}}>
                        <label class="form-label" for="form3Example3c">Email</label>
                      </div>
                    </div>
                    <input type="hidden" id="hidden1" name="role" value="CUSTOMER">
                    <div class="d-flex flex-row align-items-center mb-2">
                      <i class="fas fa-lock fa-lg me-3 fa-fw" style="margin-bottom: 30px"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="inputPassword" name="password" class="form-control" aria-describedby="passwordHelpBlock" value = {{Cookie::get('password') != null ? Cookie::get('password') : ""}}>
                        <label class="form-label" for="form3Example4c">Password</label>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4" style="margin-left:42px">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                          <input class="form-check-input me-2" name="remember_me" type="checkbox" id="remember_me" checked/>
                          <label class="form-check-label" for="remember_me">
                            Remember me
                          </label>
                        </div>

                    </div>




                    <div class="d-grid gap-2 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg" style="line-height :1.66; font-weight: 500; font-family: Poppins;background-color:var(--indigo-500)">Login</button>
                    </div>

                    <div class="d-grid gap-2 mb-3 mb-lg-4" id="googleButton"> 
                      <a href="{{url('/auth/google/customer')}}" class="btn btn-primary btn-lg" id="googleUrl"
                      style="display: flex;justify-content:start;gap:64px;line-height :1.66; font-weight: 500; font-family: Poppins;background-color:var(--white); color:#222;font-size: 18px;">
                      <img src="https://fonts.gstatic.com/s/i/productlogos/googleg/v6/24px.svg"/>
                      Continue with Google
                    </a>
                    </div>
                    {{-- <div class="row text-danger"> --}}

                      @if(session()->has('error'))
                              <p>{{ session()->get('error') }}</p>
                          @endif
                          @if ($errors->any())
                          <ul class="ps-5">
                              @foreach ($errors->all() as $error)
                                  <li class="text-danger">{{ $error }}</li>
                              @endforeach
                          </ul>
                          @endif


                </div>

                <div class="col-md-10 col-lg-6 col-xl-7 d-flex flex-column align-items-center order-1 order-lg-2" >
                    <div class="d-flex flex-row align-items-center mb-4 text-center h1 fw-bold">
                        <h1 style="line-height :1.66; font-weight: 700; color:#222; font-family: Poppins; margin-top:55px">PLEASE SELECT YOUR ROLE</h1>

                      </div>

                        <div class="d-flex flex-row align-items-center mb-4" style="gap: 10px;">

                             <input style="border: 1px solid gray ;width: 10rem;" type="button" id="customerBtn" name="role_button" value="CUSTOMER">


                                    <input style="border: none ;width: 10rem;" type="button" id="vendorBtn" name="role_button" value="VENDOR">





                                    <input style="border: none ;width: 10rem;" type="button" id="adminBtn" name="role_button" value="ADMIN">



                            
                    </div>

                  </form>

                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid" alt="Sample image">
                    <h1>Don't have an account ? <a href="/register/customer" class="signup-image-link" style="text-decoration: underline;">Register</a></h1>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
