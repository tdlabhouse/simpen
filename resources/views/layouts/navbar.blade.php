 <!-- partial:partials/_sidebar.html -->
 <nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
     <div class="user-info">
         <img src="{{asset('star/images/face.jpg')}}" alt="">
         <p class="name">Akbar</p>
         <p class="designation">HR/GA</p>
         <span class="online"></span>
     </div>
     <ul class="nav">
         <li class="nav-item {{ (Route::currentRouteName()=== 'dashboard') ? 'active' : '' }}">
             <a class="nav-link" href="{{asset('/dashboard')}}">
                 <img src="{{asset('star/images/icons/1.png')}}" alt="">
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>
         <hr>
         <li class="nav-item {{ (Route::currentRouteName()=== 'barang' || Route::currentRouteName()=== 'add-barang' || Route::currentRouteName()=== 'edit-barang') ? 'active' : '' }}">
             <a class="nav-link" href="{{asset('/barang')}}">
                 <img src="{{asset('star/images/icons/5.png')}}" alt="">
                 <span class="menu-title">Master Barang</span>
             </a>
         </li>
         <li class="nav-item {{ (Route::currentRouteName()=== 'bagian' || Route::currentRouteName()=== 'add-bagian' || Route::currentRouteName()=== 'edit-bagian') ? 'active' : '' }}">
             <a class="nav-link" href="{{asset('/bagian')}}">
                 <img src="{{asset('star/images/icons/9.png')}}" alt="">
                 <span class="menu-title">Master Bagian</span>
             </a>
         </li>
         <li class="nav-item {{ (Route::currentRouteName()=== 'supplier' || Route::currentRouteName()=== 'add-supplier' || Route::currentRouteName()=== 'edit-supplier') ? 'active' : '' }}">
             <a class="nav-link" href="{{asset('/supplier')}}">
                 <img src="{{asset('star/images/icons/2.png')}}" alt="">
                 <span class="menu-title">Master Supplier</span>
             </a>
         </li>
         <hr>
         <li class="nav-item {{ (Route::currentRouteName()=== 'fpb' || Route::currentRouteName()=== 'add-fpb') ? 'active' : '' }}">
             <a class="nav-link" href="{{asset('/fpb')}}">
                 <img src="{{asset('star/images/icons/3.png')}}" alt="">
                 <span class="menu-title">Permintaan Barang</span>
             </a>
         </li>
         <li class="nav-item {{ (Route::currentRouteName()=== 'po' ) ? 'active' : '' }}">
             <a class="nav-link" href="{{asset('/po')}}">
                 <img src="{{asset('star/images/icons/3.png')}}" alt="">
                 <span class="menu-title">Purchase Order</span>
             </a>
         </li>
         <hr>
         <li class="nav-item">
             <a class="nav-link" href="{{asset('/logout')}}">
                 <img src="{{asset('star/images/icons/10.png')}}" alt="">
                 <span class="menu-title">Logout</span>
             </a>
         </li>
         <!-- <li class="nav-item">
             <a class="nav-link" href="pages/widgets.html">
                 <img src="images/icons/2.png" alt="">
                 <span class="menu-title">Widgets</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="pages/forms/index.html">
                 <img src="images/icons/005-forms.png" alt="">
                 <span class="menu-title">Forms</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="pages/ui-elements/buttons.html">
                 <img src="images/icons/4.png" alt="">
                 <span class="menu-title">Buttons</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="pages/tables/index.html">
                 <img src="images/icons/5.png" alt="">
                 <span class="menu-title">Tables</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="pages/charts/index.html">
                 <img src="images/icons/6.png" alt="">
                 <span class="menu-title">Charts</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="pages/icons/index.html">
                 <img src="images/icons/7.png" alt="">
                 <span class="menu-title">Icons</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="pages/ui-elements/typography.html">
                 <img src="images/icons/8.png" alt="">
                 <span class="menu-title">Typography</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#sample-pages" aria-expanded="false" aria-controls="sample-pages">
                 <img src="images/icons/9.png" alt="">
                 <span class="menu-title">Sample Pages<i class="fa fa-sort-down"></i></span>
             </a>
             <div class="collapse" id="sample-pages">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item">
                         <a class="nav-link" href="pages/samples/blank_page.html">
                             Blank Page
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="pages/samples/login.html">
                             Login
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="pages/samples/register.html">
                             Register
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="pages/samples/404.html">
                             404
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="pages/samples/500.html">
                             500
                         </a>
                     </li>
                 </ul>
             </div>
         </li>
          -->
     </ul>
 </nav>