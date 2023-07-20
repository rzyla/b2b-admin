<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="set-show" content="{{ route('setShow', ['prefix' => $filter->getPrefix(), 'action' => $filter->getAction()]) }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/assets/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="/assets/styles/style.css">
    <link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="/assets/plugins/bs-stepper/css/bs-stepper.min.css">
    <link rel="stylesheet" href="/assets/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="/assets/styles/adminlte.min.css">

    @yield('styles')
    <style>
        .custom-file-label:after {
            content: "{{ __('view.form.select_file_to_upload') }}" !important;
        }
    </style>
    <title>{{ $application->getMetaTitle() }}</title>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      @include('_partials.navbar')
      @include('_partials.sidebar')
      <div class="content-wrapper">
        @include('_partials.breadcrumb')
        <section class="content">
          <div class="container-fluid">
            @include('_partials/alert')
            @yield('content')
          </div>
        </section>
      </div>
    </div>
    @include('_partials.modal')
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="/assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="/assets/scripts/adminlte.min.js"></script>
    <script src="/assets/scripts/script.js"></script>

    <script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>

    {{--<script src="/assets/plugins/chart.js/Chart.min.js"></script>
    <script src="/assets/plugins/sparklines/sparkline.js"></script>
    <script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    
    <script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>--}}
    <script>
      $(function () {
        bsCustomFileInput.init();
        $('.select2').select2();
        $('.select2-no-search').select2({
            minimumResultsForSearch: -1
        });
        $('.jq-summernote').summernote();
        $('.jq-summernote-200').summernote({height: 200});
        $('.jq-summernote-500').summernote({height: 500});
      });
    </script>
    <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    </script>
    @yield('scripts')
  </body>
</html>