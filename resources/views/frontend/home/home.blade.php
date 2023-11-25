
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Student Performance Analyzer</title>
    <!--=================================
    Meta tags
    =================================-->
    <meta name="description" content="">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />
    <!--=================================
    Style Sheets
    =================================-->

    <link href='http://fonts.googleapis.com/css?family=Cabin:400,500,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
</head>
<body class="eschool" data-spy="scroll" data-target="#navbar" data-offset="70">

<!--====================================
Body Content
=======================================-->
<div class="navbar-custom">
    <div class="container">
        <a href="/" class="logo"><img src="/frontend/demo-data/logo.jpg" alt="logo"></a>
        <nav id="navbar">
            <a href="#" class="nav-triger"><span class="fa fa-navicon"></span></a>
            <ul class="main-menu nav">
                <!-- <li><a href="#section0">Home</a></li> -->
                <!-- <li><a href="#">School Registration</a></li>
                <li><a href="#section1">Student Registration</a></li> -->
            </ul>
        </nav>

    </div>
</div>

<section id="section0" class="header">
    <div class="container">
        <div class="headerInner">
            <h2>{{ \App\Helpers\CustomHelper::MY_APP_NAME() }}</h2>
            <p>Evaluate student performance easiest way.</p>
            <div class="row mt-30">
                <div class="col-md-4 col-sm-6">
                    <form id="store">
                        @csrf
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                        <div style="margin-bottom: 20px;">
                            <input type="email" name="username" placeholder="Email" required style="margin-top: 0px;">
                        </div>
                        <div style="margin-bottom: 20px;">
                            <input type="password" name="password" placeholder="Password" required style="margin-bottom: 0px;">
                        </div>

                        <a style="font-size:1.4rem;float:left" href="#">Forgot Password?</a>

                        <div style="width:100%;margin-bottom:20rem">
                            <button style="float:right" type="submit" class="btn btn-default mt-20 btn-head mb-50">Sign In</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="section1" class="our-courses mt-30 mb-50">
    <div class="container">
        <div class="text-center mb-50 head">
            <h2 class="mb-25"><span>ONLINE</span> INSTITUTES</h2>
        </div>
        <div class="row courses top">

            <div class="col-sm-4 course text-bold clearfix">
                <a href="#">
                    <figure class="pull-left mt-10"><img alt="" style="width: 75px; height: 75px" src="/frontend/demo-data/school3.PNG"></figure>
                </a>
                <div class="info">
                    <a href="#">
                        <h5>Schoolartika New School</h5>
                    </a>
                    <p>Mohakhali, Dhaka, Bangladesh.</p>
                </div>
            </div>

            <div class="col-sm-4 course text-bold clearfix">
                <a href="#">
                    <figure class="pull-left mt-10"><img alt="" style="width: 75px; height: 75px" src="/frontend/demo-data/school.png"></figure>
                </a>
                <div class="info">
                    <a href="#">
                        <h5>Ideal School</h5>
                    </a>
                    <p>Mirpur-1, Dhaka, Bangladesh.</p>
                </div>
            </div>

            <div class="col-sm-4 course text-bold clearfix">
                <a href="#">
                    <figure class="pull-left mt-10"><img alt="" style="width: 75px; height: 75px" src="/frontend/demo-data/bsckbone.png"></figure>
                </a>
                <div class="info">
                    <a href="#">
                        <h5>Mohammadpur Boys School</h5>
                    </a>
                    <p>Mohammadpur, Dhaka, Bangladesh.</p>
                </div>
            </div>

        </div>
    </div>
</section>


<footer class="text-center color-white text-bold">
    <strong>Copyright &copy; 2023-2024 <a style="color:#0069D9" href="#">{{ \App\Helpers\CustomHelper::MY_APP_NAME() }}</a>.</strong> All rights reserved.
</footer>

<script src="{{ asset('frontend/js/lib/jquery.js') }}"></script>
<script src="{{ asset('frontend/js/lib/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('frontend/js/app/main.js') }}"></script>

<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
<script>
  const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>

<script>
    // function login(){
      $("#store").submit(function(e){
          e.preventDefault();
          let form_data = $("#store").serialize()
          $(document).find("div.text-danger").remove();
          $.ajax({
              url: "{{ route('auth.signin') }}",
              method: "POST",
              data: new FormData(document.getElementById("store")),
              dataType: 'JSON',
              contentType: false,
              cache: false,
              processData: false,
              success: function(res) {
                  Toast.fire({
                    icon: 'success',
                    title: 'Login successfull'
                  })
                  window.location.href ='/dashboard';
              },
              error: function(res) {
                const result = res.responseJSON
                Swal.fire({
                    icon: 'error',
                    title: 'Access Denied',
                    text: result.message
                })

                $.each(result.errors, function(field_name, error){
                    $(document).find('[name='+field_name+']').after('<div class="w-100" style="color:red; font-size:14px;">' +error+ '</div>')
                })
              }
          })
      });

</script>

</body>
</html>