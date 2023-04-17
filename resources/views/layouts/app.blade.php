<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="../../../"/>
		<title>Estructuras electorales</title>
		<meta charset="utf-8" />		
		
		<meta property="og:locale" content="en_US" />
		<meta property="og:site_name" content="Estructuras electorales" />
		<link rel="shortcut icon" href="{{ asset('img/logos/favicon.ico') }}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

        <link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('metronic/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/custom-styles.css') }}" rel="stylesheet" type="text/css"/>
        @livewireStyles
		@stack('custom_styles')

	</head>


	<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

		<script>
            var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }
        </script>
        
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">

			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">

				<div id="kt_app_header" class="app-header">					
					<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
						
						@include('layouts.app.mobile')						
						@include('layouts.app.header-wrapper')

					</div>					
				</div>


				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

					@include('layouts.app.sidebar')

					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">


							@include('layouts.app.toolbar')


							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">

								<!--begin::Content container-->
								<div id="kt_app_content_container" class="app-container container-fluid">

									{{ $slot }}								

								</div>
								<!--end::Content container-->

							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->

					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>



        @livewireScripts

		<script>var hostUrl = "{{ asset('metronic/assets/') }}";</script>
        <script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('metronic/assets/js/custom/authentication/sign-in/general.js') }}"></script>
                            
    </body>

</html>
