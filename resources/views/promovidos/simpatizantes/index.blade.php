@extends('layouts.app-js')

	@section('meta')
	    <meta name="csrf-token" content="<?= csrf_token() ?>">
	@endsection

	@section('css')
	@endsection

	@section('title')
	    Promovidos
	@endsection

	@section('breadcrumbs')
		<li class="breadcrumb-item text-muted">
			<a href="#" class="text-muted text-hover-primary">Inicio</a>
		</li>	
	@endsection

	@section('content')

		<!--begin::Card-->
		<div class="card mb-7">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<!--begin::Input group-->
					<div class="position-relative w-md-600px me-md-2">
						<span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
							</svg>
						</span>
						<input type="text" class="form-control form-control-solid ps-10" id="_search" data-kt-docs-table-filter="search" placeholder="Ingresar dato a buscar" />
					</div>
					<div class="d-flex align-items-center">
						<!-- <button type="submit" class="btn btn-primary me-5">Search</button> -->
						<a id="kt_horizontal_search_advanced_link" class="btn btn-link" data-bs-toggle="collapse" href="#kt_advanced_search_form">
							Busqueda avanzada
						</a>
					</div>
				</div>
				<div class="collapse" id="kt_advanced_search_form">
					<div class="separator separator-dashed mt-9 mb-6"></div>
					<div class="row g-8 mb-8">
						<div class="col-xxl-4">
							<label class="fs-6 form-label fw-bold text-dark">Distrito</label>
							<select class="form-select form-select-solid" id="local_district" name="local_district" data-control="select2" data-placeholder="-- Seleccionar --" data-hide-search="true"></select>
						</div>
						<div class="col-xxl-4">
							<label class="fs-6 form-label fw-bold text-dark">Municipio</label>
							<select class="form-select form-select-solid" id="municipality_key" name="municipality_key" data-control="select2" data-placeholder="-- Seleccionar --" data-hide-search="true"></select>
						</div>
						<div class="col-xxl-4">
							<label class="fs-6 form-label fw-bold text-dark">Coordinadores Municipales</label>
							<select class="form-select form-select-solid" id="coordinator_id" name="coordinator_id" data-control="select2" data-placeholder="-- Seleccionar --" data-hide-search="true"></select>
						</div>
						<div class="col-xxl-6">
							<label class="fs-6 form-label fw-bold text-dark">Promotor</label>
							<select class="form-select form-select-solid" id="promoter_id" name="promoter_id" data-control="select2" data-placeholder="-- Seleccionar --" data-hide-search="true"></select>
						</div>
						<div class="col-xxl-6">
							<label class="fs-6 form-label fw-bold text-dark">Clave INE</label>
							<input type="text" class="form-control form-control form-control-solid" id="electoral_key" name="electoral_key" />
						</div>
						<div class="col-xxl-12 text-center">
							<button class="btn btn-bg-light btn-icon-danger btn-text-danger me-2 mb-2 btn-clear">
			                    <i class="bi bi-trash"></i> Limpiar
			                </button>
							<button href="#" class="btn btn-bg-light btn-icon-success btn-text-success me-2 mb-2 btn-search">
			                    <i class="bi bi-search"></i> Buscar
			                </button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end::Card-->


		<div class="card card-flush mb-xxl-10">
			<div class="card-header pt-5">
				<h3 class="card-title align-items-start flex-column">
	                <span class="card-label fw-bold text-gray-800">Resultados de la busqueda</span>
	                <span class="text-gray-400 mt-1 fw-semibold fs-6">
	                	<span class="badge badge-info">
	                		<span class="spTotal_1"></span>
	                		<span class="spTotal_2"></span>
	                		<span class="spTotal_3"></span>
	                		<span class="spTotal_4"></span>
	                	</span>
	                </span>
	            </h3>
				<div class="card-toolbar">
					<button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
						<span class="svg-icon svg-icon-1 svg-icon-gray-300 me-n1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor"></rect>
								<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor"></rect>
								<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor"></rect>
								<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor"></rect>
							</svg>
						</span>
					</button>
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
						<div class="menu-item px-3">
							<div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
						</div>
						<div class="separator mb-3 opacity-75"></div>
						<div class="menu-item px-3">
							<a href="#" class="menu-link px-3">New Ticket</a>
						</div>
						<div class="menu-item px-3">
							<a href="#" class="menu-link px-3">New Customer</a>
						</div>
						<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
							<a href="#" class="menu-link px-3">
								<span class="menu-title">New Group</span>
								<span class="menu-arrow"></span>
							</a>
							<div class="menu-sub menu-sub-dropdown w-175px py-4">
								<div class="menu-item px-3">
									<a href="#" class="menu-link px-3">Admin Group</a>
								</div>
								<div class="menu-item px-3">
									<a href="#" class="menu-link px-3">Staff Group</a>
								</div>
								<div class="menu-item px-3">
									<a href="#" class="menu-link px-3">Member Group</a>
								</div>
							</div>
						</div>
						<div class="menu-item px-3">
							<a href="#" class="menu-link px-3">New Contact</a>
						</div>
						<div class="separator mt-3 opacity-75"></div>
						<div class="menu-item px-3">
							<div class="menu-content px-3 py-3">
								<a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<ul class="nav nav-pills nav-pills-custom mb-3" role="tablist">
					<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
						<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden py-4 _a_tab_1 active" data-bs-toggle="pill" href="#_tab_no_definido" aria-selected="false" role="tab" tabindex="-1">
							<div class="nav-icon">
								<i class="las la-user-slash text-danger fs-4x"></i>
							</div><hr />
							<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">NO DEFINIDO 
								<div class="text-gray-800 fs-1 fw-bold text-center _ttl_no_definido">0</div>
							</span>
							<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-danger"></span>
						</a>
					</li>
					<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
						<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden py-4 _a_tab_2" data-bs-toggle="pill" href="#_tab_indeciso" aria-selected="false" role="tab" tabindex="-1">
							<div class="nav-icon">
								<i class="las la-user-clock text-warning fs-4x"></i>
							</div><hr />
							<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">INDECISOS
								<div class="text-gray-800 fs-1 fw-bold text-center _ttl_indeciso">0</div>
							</span>
							<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-warning"></span>
						</a>
					</li>
					<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
						<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden py-4 _a_tab_3" data-bs-toggle="pill" href="#_tab_no_simpatizante" aria-selected="false" role="tab" tabindex="-1">
							<div class="nav-icon">
								<i class="las la-user-times text-info fs-4x"></i>
							</div><hr />
							<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">NO SIMPATIZANTES
								<div class="text-gray-800 fs-1 fw-bold text-center _ttl_no_simpatizante">0</div>
							</span>
							<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-info"></span>
						</a>
					</li>
					<li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
						<a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden py-4 _a_tab_4" data-bs-toggle="pill" href="#_tab_simpatizante" aria-selected="true" role="tab">
							<div class="nav-icon">
								<i class="las la-user-check text-success fs-4x"></i>
							</div><hr />
							<span class="nav-text text-gray-600 fw-bold fs-6 lh-1">SIMPATIZANTES
								<div class="text-gray-800 fs-1 fw-bold text-center _ttl_simpatizante">0</div>
							</span>
							<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-success"></span>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active show" id="_tab_no_definido" role="tabpanel">
						<h1 class="fw-semibold text-gray-800 text-center lh-lg">
							Listado de Promovidos <span class="fw-bolder">No Definidos</span>
						</h1>
						<div class="table-responsive _tbl_r_no_definido"></div>
					</div>
					<div class="tab-pane fade" id="_tab_indeciso" role="tabpanel">
						<h1 class="fw-semibold text-gray-800 text-center lh-lg">
							Listado de Promovidos <span class="fw-bolder">Indecisos</span>
						</h1>
						<div class="table-responsive _tbl_r_indeciso"></div>
					</div>
					<div class="tab-pane fade" id="_tab_no_simpatizante" role="tabpanel">
						<h1 class="fw-semibold text-gray-800 text-center lh-lg">
							Listado de Promovidos <span class="fw-bolder">No Simpatizantes</span>
						</h1>
						<div class="table-responsive _tbl_r_no_simpatizante"></div>
					</div>
					<div class="tab-pane fade" id="_tab_simpatizante" role="tabpanel">
						<h1 class="fw-semibold text-gray-800 text-center lh-lg">
							Listado de Promovidos <span class="fw-bolder">Simpatizantes</span>
						</h1>
						<div class="table-responsive _tbl_r_simpatizante"></div>
					</div>
				</div>
			</div>
		</div>


		<!--begin::Modal - New Target-->
		<div class="modal fade" id="mdl-sympathizer" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<div class="modal-content rounded">
					<div class="modal-header pb-0 border-0 justify-content-end">
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
						</div>
					</div>
					<div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
						<form name="frm-sympathizer" id="frm-sympathizer" onsubmit="return: false;">
							<div class="mb-13 text-center">								
								<h1 class="mb-3">Simpatizantes</h1>								
								<div class="text-muted fw-semibold fs-5">Registro de 
									<span class="fw-bold text-primary">Simpatizantes</span>.
								</div>
							</div>
							
							<div class="d-flex flex-column mb-8 fv-row">
								<label class="required fs-6 fw-semibold mb-2">Estatus simpatizantes</label>
								<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="-- Seleccionar --" name="promoted_type_id" id="promoted_type_id"></select>
							</div>

							<div class="d-flex flex-column mb-8">
								<label class="required fs-6 fw-semibold mb-2">Observación</label>
								<textarea class="form-control form-control-solid" rows="3" name="description" id="description" placeholder="Observación simpatizante"></textarea>
							</div>

							<div class="text-center">
								<!-- <button type="button" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cerrar</button> -->
								<button type="button" id="kt_modal_new_target_submit" class="btn btn-primary">
									<span class="indicator-label btn-sympathizer-store">Guardar</span>
									<span class="indicator-progress">Por favor espere ...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
									</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--end::Modal - New Target-->


		<!--begin::Modal - New Target-->
		<div class="modal fade" id="mdl-sympathizer-list" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<div class="modal-content rounded">
					<div class="modal-header pb-0 border-0 justify-content-end">
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
						</div>
					</div>
					<div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
						<div class="mb-13 text-center">								
							<h1 class="mb-3">Simpatizantes</h1>								
							<div class="text-muted fw-semibold fs-5">Listado de seguimiento
								<span class="fw-bold text-primary">Simpatizantes</span>.
							</div>
						</div>
						
						<div class="_sympathizer-list"></div>

					</div>
				</div>
			</div>
		</div>
		<!--end::Modal - New Target-->

	@endsection

	@section('js')

		<script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>s
		<script src="{{ asset('views/promovidos/simpatizantes/index.js') }}"></script> 

	@endsection

	@section('scripts')
	@endsection