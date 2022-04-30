 @extends('layouts.admin.app')
 @section('title', 'Dashboard')
 @section('dashboard', 'active')
 @section('content')
     <div class="iq-navbar-header" style="height: 215px;">
         <div class="container-fluid iq-container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="flex-wrap d-flex justify-content-between align-items-center">
                         <div>
                             <h1>Dashboard</h1>
                             <p>We are on a mission to help developers like you build successful projects for FREE.</p>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
         <div class="iq-header-img">
             <img src="{{ asset('admindata/dashboard/images/top-header.png') }}" alt="header"
                 class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
             <img src="{{ asset('admindata/dashboard/images/top-header1.png') }}" alt="header"
                 class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
             <img src="{{ asset('admindata/dashboard/images/top-header2.png') }}" alt="header"
                 class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
             <img src="{{ asset('admindata/dashboard/images/top-header3.png') }}" alt="header"
                 class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
             <img src="{{ asset('admindata/dashboard/images/top-header4.png') }}" alt="header"
                 class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
             <img src="{{ asset('admindata/dashboard/images/top-header5.png') }}" alt="header"
                 class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">

         </div>
     </div>
     <div class="conatiner-fluid content-inner mt-n5 py-0">
         <div class="row">
             <div class="col-md-12 col-lg-12">
                 <div class="row row-cols-1">
                     <div class="overflow-hidden d-slider1 ">
                         <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                             <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                                 <div class="card-body">
                                     <div class="progress-widget">
                                         <div id="circle-progress-01"
                                             class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                             data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                             <svg class="card-slie-arrow " width="24" height="24px" viewBox="0 0 24 24">
                                                 <path fill="currentColor"
                                                     d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                             </svg>
                                         </div>
                                         <div class="progress-detail">
                                             <p class="mb-2">Total Sales</p>
                                             <h4 class="counter">$560K</h4>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                             <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                                 <div class="card-body">
                                     <div class="progress-widget">
                                         <div id="circle-progress-02"
                                             class="text-center circle-progress-01 circle-progress circle-progress-info"
                                             data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                             <svg class="card-slie-arrow " width="24" height="24" viewBox="0 0 24 24">
                                                 <path fill="currentColor"
                                                     d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                             </svg>
                                         </div>
                                         <div class="progress-detail">
                                             <p class="mb-2">Total Profit</p>
                                             <h4 class="counter">$185K</h4>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                             <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                                 <div class="card-body">
                                     <div class="progress-widget">
                                         <div id="circle-progress-03"
                                             class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                             data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                             <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                                 <path fill="currentColor"
                                                     d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                             </svg>
                                         </div>
                                         <div class="progress-detail">
                                             <p class="mb-2">Total Cost</p>
                                             <h4 class="counter">$375K</h4>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                             <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                                 <div class="card-body">
                                     <div class="progress-widget">
                                         <div id="circle-progress-04"
                                             class="text-center circle-progress-01 circle-progress circle-progress-info"
                                             data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                             <svg class="card-slie-arrow " width="24px" height="24px" viewBox="0 0 24 24">
                                                 <path fill="currentColor"
                                                     d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                             </svg>
                                         </div>
                                         <div class="progress-detail">
                                             <p class="mb-2">Revenue</p>
                                             <h4 class="counter">$742K</h4>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                             <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                                 <div class="card-body">
                                     <div class="progress-widget">
                                         <div id="circle-progress-05"
                                             class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                             data-min-value="0" data-max-value="100" data-value="50" data-type="percent">
                                             <svg class="card-slie-arrow " width="24px" height="24px" viewBox="0 0 24 24">
                                                 <path fill="currentColor"
                                                     d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                             </svg>
                                         </div>
                                         <div class="progress-detail">
                                             <p class="mb-2">Net Income</p>
                                             <h4 class="counter">$150K</h4>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                             <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                                 <div class="card-body">
                                     <div class="progress-widget">
                                         <div id="circle-progress-06"
                                             class="text-center circle-progress-01 circle-progress circle-progress-info"
                                             data-min-value="0" data-max-value="100" data-value="40" data-type="percent">
                                             <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                                 <path fill="currentColor"
                                                     d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                             </svg>
                                         </div>
                                         <div class="progress-detail">
                                             <p class="mb-2">Today</p>
                                             <h4 class="counter">$4600</h4>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                             <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                                 <div class="card-body">
                                     <div class="progress-widget">
                                         <div id="circle-progress-07"
                                             class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                             data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                                             <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                                 <path fill="currentColor"
                                                     d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                             </svg>
                                         </div>
                                         <div class="progress-detail">
                                             <p class="mb-2">Members</p>
                                             <h4 class="counter">11.2M</h4>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                         </ul>
                         <div class="swiper-button swiper-button-next"></div>
                         <div class="swiper-button swiper-button-prev"></div>
                     </div>
                 </div>
             </div>

         </div>
     </div>
 @endsection
