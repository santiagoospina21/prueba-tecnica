<!DOCTYPE html>
<html lang="es">
    <head>
        <base href="{{ url('/') }}/">
        <meta charset="utf-8">
        <title>{{ __('Prueba técnica') }} - {{ __('Gestor de archivos') }}</title>
        <meta name="description" content="Layout shell">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css">

        <link rel="shortcut icon" href="{{ asset('assets/media/favicon.ico') }}">
        @stack('styles')
    </head>
    <body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
        
        
        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile kt-header-mobile--fixed">
            <div class="kt-header-mobile__logo">
                <a href="{{ route('index') }}">
                    <img alt="Logo" src="{{ asset('assets/media/logo-10-sm.png') }}" />
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
            </div>
        </div>

        <!-- end:: Header Mobile -->

        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">

                    <!-- begin:: Header -->
                    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
                        <div class="kt-header__top">
                            <div class="kt-container ">

                                <!-- begin:: Brand -->
                                <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                                    <div class="kt-header__brand-logo">
                                        <a href="{{ route('index') }}">
                                            <img alt="Logo" src="{{ asset('assets/media/logo-10.png') }}" class="kt-header__brand-logo-default" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-header__bottom">
							<div class="kt-container ">

								<!-- begin: Header Menu -->
								<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
								<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
									<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
										<ul class="kt-menu__nav">
											<li class="kt-menu__item kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                                <a href="{{ route('index') }}" class="kt-menu__link kt-menu__toggle">
                                                    <span class="kt-menu__link-text">{{ __('Menú') }}</span>
                                                </a>
												<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
													<ul class="kt-menu__subnav">
														<li class="kt-menu__item " aria-haspopup="true">
                                                            <a href="{{ route('index') }}" class="kt-menu__link ">
                                                                <i class="kt-menu__link-icon flaticon2-architecture-and-city"></i>
                                                                <span class="kt-menu__link-text">{{ __('Pagina principal') }}</span>
                                                            </a>
                                                        </li>
                                                        <li class="kt-menu__item" aria-haspopup="true">
                                                            <a href="#" class="kt-menu__link ">
                                                                <i class="kt-menu__link-icon flaticon-folder"></i>
                                                                <span class="kt-menu__link-text">{{ __('Gestor de archivos') }}</span>
                                                            </a>
                                                        </li>
													</ul>
												</div>
											</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-container  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch">
						<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
							<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

								<!-- begin:: Content Head -->
								<div class="kt-subheader kt-grid__item" id="kt_subheader">
									<div class="kt-container">
										<div class="kt-subheader__main">
											<h3 class="kt-subheader__title">{{ __('Bienvenid@') }}</h3>
											<span class="kt-subheader__separator kt-subheader__separator--v"></span>
											<span class="kt-subheader__desc">{{ __('Prueba técnica') }}</span>
										</div>
										<div class="kt-subheader__toolbar">
										</div>
									</div>
								</div>

								<!-- end:: Content Head -->

								<!-- begin:: Content -->
								<div class="kt-container  kt-grid__item kt-grid__item--fluid">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var KTAppOptions = {
                colors: {
                    state: {
                        brand: "#5d78ff",
                        light: "#ffffff",
                        dark: "#282a3c",
                        primary: "#5867dd",
                        success: "#34bfa3",
                        info: "#36a3f7",
                        warning: "#ffb822",
                        danger: "#fd3995"
                    },
                    base: {
                        label: ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        shape: ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                    }
                }
            };
        </script>

        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
        @stack('scripts')
    </body>
</html>