<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('dashboard_files/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/jqvmap/jqvmap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/bootstrap-tags/tagsinput.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard_files/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

    <!-- overlayScrollbars -->

    <link rel="stylesheet"
          href="{{ asset('dashboard_files/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard_files/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard_files/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard_files/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard_files/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard_files/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard_files/plugins/ekko-lightbox/ekko-lightbox.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{--    {{ asset('dashboard_files/css/bootstrap.min.css') }}       --}}

    @if (app()->getLocale() == 'ar')
        {{--        <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome-rtl.min.css') }}">--}}
        {{--        <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE-rtl.min.css') }}">--}}
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        {{--        <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap-rtl.min.css') }}">--}}
        {{--        <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">--}}
    <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl/adminlte.min.css') }}">
        <!-- Bootstrap 4 RTL -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
        <!-- Custom style for RTL -->
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/custom.css') }}">

        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif !important;
            }


        </style>
    @else
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/adminlte.css') }}">
    @endif

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layouts.dashboard.navbar')
    @include('layouts.dashboard._aside')
    @yield('content')
    {{--    @include('partials._session')--}}
    @include('layouts.dashboard.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('dashboard_files/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('dashboard_files/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dashboard_files/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('dashboard_files/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('dashboard_files/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('dashboard_files/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('dashboard_files/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('dashboard_files/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('dashboard_files/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('dashboard_files/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script
    src="{{ asset('dashboard_files/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('dashboard_files/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('dashboard_files/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('dashboard_files/plugins/bootstrap-tags/tagsinput.js') }}"></script>
<script src="{{ asset('dashboard_files/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>


<script src="{{ asset('dashboard_files/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('dashboard_files/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<script
    src="{{ asset('dashboard_files/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script
    src="{{ asset('dashboard_files/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('dashboard_files/plugins/bootstrap-tags/tagsinput.js') }}"></script>
{{--<script src="{{ asset('dashboard_files/plugins/bootstrap-tags/bootstrap-tagsinput-angular.min.js') }}"></script>--}}
<script src="{{ asset('dashboard_files/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<!-- overlayScrollbars -->
<script
    src="{{ asset('dashboard_files/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard_files/js/adminlte.js') }}"></script>
<script type="text/javascript">
    $('.summernote').summernote({
        tabsize: 2,
        height: 100
    });
    // image preview
    $(".dest_banner_image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.dest_banner_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });
    $(".dest_thumb_image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.dest_thumb_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });
    $(".cat_banner_image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.cat_banner_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });
    $(".user_banner_image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.user_banner_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });
    $(".cat_thumb_image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.cat_thumb_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });
    $(".ex_banner_image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.ex_banner_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });
    $(".ex_thumb_image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.ex_thumb_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });
    $(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        @if (session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        })
        @endif
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        Toast.fire({
            icon: 'error',
            title: '{{ $error }}'
        })
        @endforeach
        @endif

        $('.swalDefaultSuccess').click(function () {
            Toast.fire({
                icon: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultInfo').click(function () {
            Toast.fire({
                icon: 'info',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultError').click(function () {
            Toast.fire({
                icon: 'error',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultWarning').click(function () {
            Toast.fire({
                icon: 'warning',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultQuestion').click(function () {
            Toast.fire({
                icon: 'question',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });

        $('.toastrDefaultSuccess').click(function () {
            toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultInfo').click(function () {
            toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultError').click(function () {
            toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultWarning').click(function () {
            toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });

        $('.toastsDefaultDefault').click(function () {
            $(document).Toasts('create', {
                title: 'Toast Title',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultTopLeft').click(function () {
            $(document).Toasts('create', {
                title: 'Toast Title',
                position: 'topLeft',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultBottomRight').click(function () {
            $(document).Toasts('create', {
                title: 'Toast Title',
                position: 'bottomRight',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultBottomLeft').click(function () {
            $(document).Toasts('create', {
                title: 'Toast Title',
                position: 'bottomLeft',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultAutohide').click(function () {
            $(document).Toasts('create', {
                title: 'Toast Title',
                autohide: true,
                delay: 750,
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultNotFixed').click(function () {
            $(document).Toasts('create', {
                title: 'Toast Title',
                fixed: false,
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultFull').click(function () {
            $(document).Toasts('create', {
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                icon: 'fas fa-envelope fa-lg',
            })
        });
        $('.toastsDefaultFullImage').click(function () {
            $(document).Toasts('create', {
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                image: '../../dist/img/user3-128x128.jpg',
                imageAlt: 'User Picture',
            })
        });
        $('.toastsDefaultSuccess').click(function () {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultInfo').click(function () {
            $(document).Toasts('create', {
                class: 'bg-info',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultWarning').click(function () {
            $(document).Toasts('create', {
                class: 'bg-warning',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultDanger').click(function () {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.toastsDefaultMaroon').click(function () {
            $(document).Toasts('create', {
                class: 'bg-maroon',
                title: 'Toast Title',
                subtitle: 'Subtitle',
                body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });

    });
    $('.swalDefaultErrorCheck').click(function () {
        Swal.fire({
            title: 'Do you want to Delete This Item',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire('Deleted', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    });
</script>
@stack('scripts')
</body>
</html>
