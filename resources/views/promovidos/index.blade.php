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

	@section('buttons')

		<a href="{{ route('promovidos.create') }}" type="button" class="btn btn-sm btn-primary">
            <i class="fa-solid fa-plus"></i> Registrar Promovido
        </a>

	@endsection

	@section('content')

		<div class="row g-5 g-xl-10">
			<div class="col-sm-6 col-xl-8 mb-xl-10">
				<div class="card card-custom card-flush">
	                <div class="card-body">
	                    <div class="">
	                        <div class="fs-2hx fw-bold text-gray-800 text-center mb-5">
	                            <span class="me-2">META GENERAL</span>
	                        </div>
	                        <div class="text-center">
	                            <div class="fs-3x d-flex justify-content-center align-items-start">
	                                <span class="lh-sm fw-semibold">                                    
	                                    <span class="text-muted spTotal_promovido">00 </span>/
	                                    <span class="text-info spTotal_meta">00</span> 
	                                </span>
	                            </div>    
	                            <div class="d-flex align-items-center flex-column mt-3">
	                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
	                                    <span class="fw-semibold fs-6 text-gray-400">Avance</span>
	                                    <span class="fw-bold fs-6 spTotal_avance">00 %</span>
	                                </div>
	                                <div class="h-40px mx-3 w-100 bg-light mb-3">
	                                    <div role="progressbar" style="width: 35%;" aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" class="rounded h-40px _meta"></div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>                    
	                </div>
	            </div>
			</div>
            <div class="col-sm-6 col-xl-2 mb-xl-10">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <div class="m-0">
                            <div class="symbol me-3">
                                <div class="symbol-label bg-light">
                                    <i class="fas fa-mars fs-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column my-7">
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2 spTotalHombres">0</span>
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-400">Hombres</span>
                            </div>
                        </div>
                        <span class="badge badge-light-success fs-base spPromedioHombres">0%</span>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-2 mb-xl-10">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <div class="m-0">
                            <div class="symbol me-3">
                                <div class="symbol-label bg-light">
                                    <i class="fas fa-venus fs-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column my-7">
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2 spTotalMujeres">0</span>
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-400">Mujeres</span>
                            </div>
                        </div>
                        <span class="badge badge-light-success fs-base spPromedioMujeres">0%</span>
                    </div>
                </div>
            </div>
		</div>

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

		<div class="card card-custom card-flush h-xl-100">
	        <div class="card-header pt-7">            
	            <h3 class="card-title align-items-start flex-column">
	                <span class="card-label fw-bold text-gray-800">Resultados de la busqueda</span>
	                <span class="text-gray-400 mt-1 fw-semibold fs-6"><span class="badge badge-info"><span class="spTotal"></span>&nbsp;&nbsp; registros</span></span>
	            </h3>
	            <div class="card-toolbar">
	                <div class="d-flex flex-stack flex-wrap gap-4"></div>
	            </div>
	        </div>

	        <div class="card-body pt-2">            
	            <div id="kt_file_manager_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"> 
	            	<div class="table-responsive">
		                <table id="tbl-promovidos" class="table table-bordered align-middle table-row-gray-400 fs-6 gy-3" width="100%">
		                    <thead>
		                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
		                            <th class="min-w-10px sorting_disabled" rowspan="1" colspan="1">#</th>
		                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">DISTRITO</th>
		                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">MUNICIPIO</th>
		                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">NOMBRE</th>
		                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">CLAVE INE</th>
		                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">VIGENCIA INE</th>              
		                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">COORDINADOR</th>
		                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">PROMOTOR</th>
		                            <th class="text-end sorting_disabled" rowspan="1" colspan="1">OPCION</th>
		                        </tr>
		                    </thead>
		                    <tbody id="body-content"></tbody>
		                </table>
		            </div>
	        	</div>                
	        </div>
	    </div>
	@endsection

	@section('js')

		<script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>s
		<script src="{{ asset('views/promovidos/index.js') }}"></script> 

	@endsection

	@section('scripts')
	@endsection