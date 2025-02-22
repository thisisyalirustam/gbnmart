<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Settings</title>
    <link rel="stylesheet" href="{{asset('admin/settings/vendors/mdi/css/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/settings/vendors/flag-icon-css/css/flag-icon.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/settings/vendors/css/vendor.bundle.base.css')}}" />
    <link rel="stylesheet" href=" {{asset('admin/settings/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href=" {{asset('admin/settings/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/settings/css/style.css')}}" />
    <link rel="shortcut icon" href="{{asset('admin/settings/images/favicon.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
        @include('admin.pages.settings.components.setting_sidebar');
    
      <div class="container-fluid page-body-wrapper">
        @include('admin.pages.settings.components.setting_header')
        <div class="main-panel">
            @yield('setting_content')
            @include('admin.pages.settings.components.setting_footer')
        </div>
        
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('admin/settings/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('admin/settings/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin/settings/vendors//bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('admin/settings/vendors/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('admin/settings/vendors/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('admin/settings/vendors/flot/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('admin/settings/vendors/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('admin/settings/vendors/')}}"></script>
    <script src="{{asset('admin/settings/vendors/flot/jquery.flot.pie.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('admin/settings/js/off-canvas.js')}}"></script>
    <script src="{{asset('admin/settings/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('admin/settings/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('admin/settings/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
  </body>
</html>