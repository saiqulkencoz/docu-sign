<div class="topbar">
    <nav class="navbar navbar-expand-lg navbar-light">
       <div class="full">
          <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
          <div class="logo_section">
             {{-- <a href="index.html"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a> --}}
          </div>
          <div class="right_topbar">
             <div class="icon_info">
                <ul class="user_profile_dd">
                   <li>
                      <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="" alt="" /><span class="name_user">{{auth()->user()->nama}}</span></a>
                      <div class="dropdown-menu">
                         <a class="dropdown-item" href="{{route('logout')}}"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                      </div>
                   </li>
                </ul>
             </div>
          </div>
       </div>
    </nav>
 </div>