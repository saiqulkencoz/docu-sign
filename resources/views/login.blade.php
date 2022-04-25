
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Login</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      {{-- <link rel="icon" href="images/fevicon.png" type="image/png" /> --}}
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{asset('master/css/bootstrap.min.css')}}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{asset('master/style.css')}}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{asset('master/css/responsive.css')}}" />
      <!-- color css -->
      <link rel="stylesheet" href="{{asset('master/css/colors.css')}}" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{asset('master/css/bootstrap-select.css')}}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{asset('master/css/perfect-scrollbar.css')}}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{asset('master/css/custom.css')}}" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="{{asset('master/js/semantic.min.css')}}" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="{{asset('master/images/logo/logo.png')}}" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <form action="{{route('postlogin')}}" method="POST">
                        {{csrf_field()}}
                        <fieldset>
                           <div class="field">
                              <label class="label_field">NIP</label>
                              <input type="text" name="nip" placeholder="Masukkan NIP" />
                           </div>
                           <div class="field">
                              <label class="label_field">Password</label>
                              <input type="password" name="password" placeholder="Password" />
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button type="submit" class="main_bt">Sing In</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="{{asset('masterjs/jquery.min.js')}}"></script>
      <script src="{{asset('masterjs/popper.min.js')}}"></script>
      <script src="{{asset('masterjs/bootstrap.min.js')}}"></script>
      <!-- wow animation -->
      <script src="{{asset('masterjs/animate.js')}}"></script>
      <!-- select country -->
      <script src="{{asset('masterjs/bootstrap-select.js')}}"></script>
      <!-- nice scrollbar -->
      <script src="{{asset('masterjs/perfect-scrollbar.min.js')}}"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="{{asset('masterjs/custom.js')}}"></script>
   </body>
</html>