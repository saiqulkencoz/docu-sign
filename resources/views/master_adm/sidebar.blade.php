<nav id="sidebar">
    <div class="sidebar_blog_1">
       <div class="sidebar-header">
          <div class="logo_section">
             {{-- <a href="index.html"><img class="logo_icon img-responsive" src="{{asset('master/images/logo/logo_icon.png')}}" alt="#" /></a> --}}
          </div>
       </div>
       <div class="sidebar_user_info">
          <div class="icon_setting"></div>
          <div class="user_profle_side">
             {{-- <div class="user_img"><img class="img-responsive" src="{{asset('master/images/layout_img/user_img.jpg')}}" alt="#" /></div> --}}
             <div class="user_info">
                <h6>{{auth()->user()->nama}}</h6>
                <p><span class="online_animation"></span> Online</p>
             </div>
          </div>
       </div>
    </div>
    <div class="sidebar_blog_2">
       <h4>Admin {{Auth()->user()->instansi->nama}}</h4>
       <ul class="list-unstyled components">
          <li class="active">
             <a href="{{route('adm-pengajuan')}}" aria-expanded="false"><i class="fa fa-file-code-o purple_color2"></i> <span>Input Pengajuan</span></a>
          </li>
          <li><a href="#"><i class="fa fa-download orange_color"></i> <span>Download Pengajuan</span></a></li>
       </ul>
    </div>
 </nav>