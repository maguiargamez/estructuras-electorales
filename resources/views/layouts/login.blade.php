<html lang="en">
	<!--begin::Head-->
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
	</head>
	<body id="kt_body" class="app-blank app-blank">
		<script>
            var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }
        </script>
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<div class="w-lg-500px p-10">

                            @yield('content')


                        </div>
					</div>

					<!--
                    <div class="d-flex flex-center flex-wrap px-5">
						<div class="d-flex fw-semibold text-primary fs-base">
							<a href="../../demo1/dist/pages/team.html" class="px-5" target="_blank">Terms</a>
							<a href="../../demo1/dist/pages/pricing/column.html" class="px-5" target="_blank">Plans</a>
							<a href="../../demo1/dist/pages/contact.html" class="px-5" target="_blank">Contact Us</a>
						</div>
					</div>
                    -->

				</div>
				</div>
			</div>
		</div>

		<script>var hostUrl = "{{ asset('metronic/assets/') }}";</script>

        <script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('metronic/assets/js/custom/authentication/sign-in/general.js') }}"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
                            
    </body>

</html>