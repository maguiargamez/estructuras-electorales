<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">    
    
    <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_wrapper'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">

        @include('layouts.app.header.breadcrumb')

    </div>

    <div class="app-navbar flex-shrink-0">        

        @include('layouts.app.header.user-menu')
        
    </div>
</div>