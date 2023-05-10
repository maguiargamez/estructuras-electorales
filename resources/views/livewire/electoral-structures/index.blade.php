<div>
   
    <div  class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container d-flex flex-stack">

            <x-breadcrumb 
            :breadcrumb="$breadcrumb"
            :title="$title"
            ></x-breadcrumb>
        

            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--<a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Nuevo árbol</a>-->
            </div>

        </div>
    </div>

    <div id="kt_app_content_container" class="app-container">
        <div class="card card-flush h-md-100">
            <div class="card-body d-flex flex-column justify-content-between mt-9 bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0" style="background-position: 100% 50%; background-image:url('assets/media/stock/900x600/42.png')">
                <div class="mb-10">
                    <div class="fs-2hx fw-bold text-gray-800 text-center mb-13">
                    <span class="me-2">{{ $election }}
                    <br>
                    <span class="position-relative d-inline-block text-danger">
                        <a href="../../demo1/dist/pages/user-profile/overview.html" class="text-danger opacity-75-hover">Pro Plan</a>
                        <span class="position-absolute opacity-15 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                    </span></span>for Free</div>
                    <div class="text-center">
                        <a href="#" class="btn btn-sm btn-dark fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade Now</a>
                    </div>
                </div>
                <img class="mx-auto h-150px h-lg-200px theme-light-show" src="assets/media/illustrations/misc/upgrade.svg" alt="">
                <img class="mx-auto h-150px h-lg-200px theme-dark-show" src="assets/media/illustrations/misc/upgrade-dark.svg" alt="">
            </div>
        </div>
    </div>


</div>
