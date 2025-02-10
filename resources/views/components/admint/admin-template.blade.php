<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">

<head>

    <meta charset="utf-8"/>
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Aplikasi My Klinik" name="description"/>
    <meta content="MyKlinik" name="RSAMtdev"/>
    <x-admint.header-layout-admin/>
    @stack('customCss')
</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- Start: Topbar -->
    <x-admint.topbar-layout-admin/>
    <!-- End: Topbar -->

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                   colors="primary:#f7b84b,secondary:#f06548"
                                   style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!
                        </button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Start: Sidebar -->
    @if(Auth::user()->role_id == "2")
        <!-- Role: Admin -->
        <x-admint.sidebar-layout-admin :first-menu="$firstMenu" :second-menu="$secondMenu"/>
    @elseif(Auth::user()->role_id == "4")
        <!-- Role: Dokter -->
        <x-admint.sidebar-layout-dokter :first-menu="$firstMenu" :second-menu="$secondMenu"/>
    @elseif(Auth::user()->role_id == "5")
        <!-- Role: Dokter -->
        <x-admint.sidebar-layout-apotik :first-menu="$firstMenu" :second-menu="$secondMenu" />
    @else
        <!-- Role: Pendaftaran -->
        <x-admint.sidebar-layout-front :first-menu="$firstMenu" :second-menu="$secondMenu"/>
    @endif
    <!-- End: Sidebar -->

    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <!-- Start: Content -->
        {{$slot}}
        <!-- End: Content -->

        <!-- Start: Footer -->
        <x-admint.footer-layout-admin/>
        <!-- End: Footer -->
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-primary btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!-- Start: Javascript -->
<x-admint.js-layout-admin/>
<!-- End: Javascript -->
@stack('customJs')
</body>

</html>
