@extends('layouts.app-js')

@section('meta')
    <meta name="csrf-token" content="<?= csrf_token() ?>">
@endsection

@section('css')
@endsection

@section('title')
    Panel de control
@endsection

@section('breadcrumbs')
	<li class="breadcrumb-item text-muted">
		<a href="#" class="text-muted text-hover-primary">Inicio</a>
	</li>
	<li class="breadcrumb-item">
		<span class="bullet bg-gray-400 w-5px h-2px"></span>
	</li>
	<li class="breadcrumb-item text-muted">Estadisticas generales</li>
@endsection

@section('buttons')
@endsection

@section('content')
	<div class="row g-5 g-xl-10">
		<div class="col-xl-12 mb-xl-10">
			<div class="card border-transparent" data-theme="light" style="background-color: #080655">
				<div class="card-body d-flex ps-xl-15 flex-column justify-content-between">
					<div class="m-0">
						<div class="position-relative text-center fs-2x z-index-2 fw-bold text-white mb-1">
							<span class="me-2">Elección {{ $election->electionType->description }}
							<span class="position-relative d-inline-block text-danger">
								<a href="#" class="text-danger opacity-75-hover">{{ $election->description }}</a>
								<span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
							</span></span>
							<div class="text-center">
			                    <div class="fs-4x d-flex justify-content-center align-items-start">
			                        <span class="lh-sm fw-semibold">                             
			                            <span class="text-muted"><span id="spTotalGlobalPromovidos"></span></span>/
			                            <span class="text-info"><span id="spTotalGlobal"></span> </span>                             
			                        </span>                        
			                    </div>
			                    <span class="text-gray-500 fs-3 d-block fw-bold">META GENERAL</span>
			                </div>
							
							<div class="d-flex align-items-center flex-column mt-1">
		                        <div class="d-flex justify-content-between w-100 mt-auto mb-1">
		                            <span class="fw-semibold fs-3 text-gray-400">Avance</span>
		                            <span class="fw-bold fs-3"><span id="spAvance"></span>%</span>
		                        </div>
		                        <div class="h-20px mx-3 w-100 bg-light mb-1 rounded">
		                            <div id="dvPorcentajeAvance"></div>
		                        </div>
		                    </div> 
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="row gy-5 g-xl-8">

    	<div class="col-xxl-4">
            <div class="card card-xxl-stretch">
                <div class="card-header border-0 py-5" style="background: linear-gradient(112.14deg, #00b4db 0%, #0083b0 100%)">
                    <h3 class="card-title fw-bolder text-white"><span class="fw-bold fs-2x mb-3">Estadisticas personal registrado</span></h3>
                </div>
           

                <div class="card-body p-0">                
                    <div class="card-rounded-bottom bg-danger" style="height: 30px; background: linear-gradient(112.14deg, #00b4db 0%, #0083b0 100%)"></div>
                   
                    <div class="card-p mt-n20 position-relative">
                       
                        <div class="row g-0 text-center">
                            <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                   <i class="fs-3x fas fa-users-cog text-warning"></i>
                                </span>                            
                                <div class="fs-1 fw-bolder text-warning">
                                    <span id="spTotalCordEstatal"></span>
                                </div>
                                <a href="#" class="text-warning fw-bold fs-6">
                                	<span class="text-warning fw-semibold fs-3">Coordinadores estatales</span>
                                </a>
                            </div>

                            <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                    <i class="fs-3x fas fa-globe text-primary"></i>
                                </span>
                                <div class="fs-1 fw-bolder text-primary">
                                    <span id="spTotalCordDistrital"></span>
                                </div>
                                <a href="#" class="text-primary fw-bold fs-6">
                                	<span class="text-primary fw-semibold fs-3">Coordinadores distritales</span>
                                </a>
                            </div>
                        </div>
                        
                        <div class="row g-0 text-center">
                            <div class="col bg-light-danger px-6 py-6 rounded-2 me-7">
                                <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                    <i class="fs-3x fas fa-route text-danger"></i>
                                </span>
                                <div class="fs-1 fw-bolder text-danger">
                                    <span id="spTotalCordMunicipal"></span>
                                </div>
                                <a href="#" class="text-danger fw-bold fs-6 mt-2">
                                	<span class="text-danger fw-semibold fs-3">Coordinadores municipales</span>
                                </a>
                            </div>

                            <div class="col bg-light-success px-6 py-6 rounded-2">
                                <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                    <i class="fs-3x fas fa-person-booth text-success"></i>
                                </span>
                                <div class="fs-1 fw-bolder text-success">
                                    <span id="spTotalPromovidos"></span>
                                </div>
                                <a href="#" class="text-success fw-bold fs-6 mt-2">
                                	<span class="text-success fw-semibold fs-3">Simpatizantes promovidos</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4">
            <div class="card shadow-sm">
                <div class="card-header mt-1" style="background: linear-gradient(90deg, #efd5ff 0%, #515ada 100%);">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">ESTADISTICAS PROMOVIDOS</span>                    
                    </h3>
                    <div class="card-toolbar"  data-bs-toggle="tooltip" title="Clik para ver opciones de filtrado">
                        <button type="button" class="btn btn-sm btn-secondary btn-icon" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">                        
                            <span class="svg-icon svg-icon-2">
                                <i class="fa fa-bars"></i>
                            </span>                        
                        </button>
                                                        
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                            
                            <div class="menu-item px-3">
                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Opciones de filtrado</div>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">Ver por distritos</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link flex-stack px-3">Ver por municipio</a>
                            </div>                                                        
                        </div>
                    </div>                                              
                </div>
                <div class="card-body align-middle gs-0 gy-4"> 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card h-100">
                                <div class="card-body p-3">
                                    <div class="fs-6 d-flex justify-content-between mb-3">
                                        <div class="fw-bold">Meta promovidos: </div>
                                        <div class="d-flex fw-bolder">
                                            <span id="spMetaPromovidos"></span>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                    <div class="fs-6 d-flex justify-content-between my-3">
                                        <div class="fw-bold">Avance promovidos:</div>
                                        <div class="d-flex fw-bolder">
                                            <span id="spAvancePromovidos"></span>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed"></div>
                                    <div class="fs-6 d-flex justify-content-between my-3">
                                        <div class="fw-bold">Faltantes promovidos:</div>
                                        <div class="d-flex fw-bolder">
                                            <span id="spFaltantesPromovidos"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 text-gray-800 text-center">
                            <div class="card bg-light-info card-xl-stretch mb-xl-1">
                                <div class="card-body my-1">
                                    <a href="#" class="card-title fw-bolder text-info fs-5 mb-3 d-block">
                                        <span id="spPromovidosAv"></span> Promovidos de <span id="spPromovidosTot">
                                    </a>
                                    <div class="py-1">
                                        <span class="text-dark fs-1 fw-bolder me-2"><span id="spPorcentajePromovidos"></span> %</span>
                                        <span class="fw-bold text-muted fs-7">de Avance</span>
                                    </div>                                
                                    <div id="dvPorcentajeAvance" class="dvPorcentajeAvance"></div> 
                                </div>
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4"> 
            <div class="row gy-5 g-xl-8">
                <div class="col-xxl-12">
                    <div class="card card-xxl-stretch">
                        <div class="card-body pt-5 bg-secondary">
                            <div class="d-flex align-items-center">
                                <div class="w-100 d-flex flex-column flex-center rounded-3">
                                    <div class="text-center">                                                               
                                        <h3 class="text-gray-800 mb-1 fw-boldest">NÚMERO DE SECCIONES CON PROMOVIDOS</h3>
                                        <div class="text-center mt-4">
                                            <span id="spTotalSeccionesConPromovidos" class="fs-2x fw-bolder text-gray-700">0</span> 
                                            <span class="mb-2 fs-2x fw-bolder text-gray-700">de</span>
                                            <span id="spTotalSecciones" class="fs-2x fw-bolder text-gray-700">0</span>    
                                        </div>
                                    </div>
                                    <div class="w-100 mt-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">Porcentaje de avance</span>                                        
                                            <div class="fw-bolder text-primary fs-3"><span id="spPorcentajeSecciones">0</span> %</div>                                        
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">Secciones sin promovidos</span>
                                            <div class="fw-bolder text-primary fs-3"><span id="spSeccionesSinPromovidos">0</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="col-xxl-12">
	                <div class="card card-xxl-stretch">
	                    <div class="card-body pt-5 bg-secondary">
	                        <div class="d-flex align-items-center">
	                            <div class="w-100 d-flex flex-column flex-center rounded-3">
	                                <div class="text-center">                                                               
	                                    <h3 class="text-gray-800 mb-1 fw-boldest">NÚMERO DE MUNICIPIOS CON PROMOVIDOS</h3>
	                                    <div class="text-center mt-4">
	                                        <span id="spTotalMunicipiosConPromovidos" class="fs-2x fw-bolder text-gray-700">0</span> 
	                                        <span class="mb-2 fs-2x fw-bolder text-gray-700">de</span>
	                                        <span id="spTotalMunicipios" class="fs-2x fw-bolder text-gray-700">0</span>    
	                                    </div>
	                                </div>
	                                <div class="w-100 mt-4">
	                                    <div class="d-flex align-items-center mb-2">
	                                        <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">Porcentaje de avance</span>                                        
	                                        <div class="fw-bolder text-primary fs-3"><span id="spPorcentajeAvanceMunicipios">0</span> %</div>                                        
	                                    </div>
	                                    <div class="d-flex align-items-center mb-2">
	                                        <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">Municipios sin promovidos</span>
	                                        <div class="fw-bolder text-primary fs-3"><span id="spMunicipiosSinPromovidos">0</span></div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div> 
	            </div> 
            </div>                   
        </div>	    			
	</div>
	
	<div class="row g-5 g-xl-8">
		<div class="col-xxl-4 mb-xl-10">
	       <div class="card">
	            <div class="card-header" style="background: linear-gradient(90deg, #F72E60 0%, #008DDE 100%);">
	                <div class="card-title flex-column">
	                    <h3 class="fs-3 text-white w-bolder mb-1">Sexo</h3>
	                    <div class="fs-6 fw-bold text-white">Estadisticas por sexo de los simpatizantes</div>
	                </div>                
	            </div>
	            <div class="card-body p-9">
	                <div class="d-flex flex-wrap">                	
	                    <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
	                        <div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
	                            <span class="fs-2qx fw-bolder"><span id="spTotalSexo"></span></span>
	                            <span class="fs-6 fw-bold text-gray-400">
	                                <a href="#" class="text-gray-700">
	                                    Simpatizantes
	                                </a>
	                            </span>
	                        </div>
	                        <canvas id="kt_chart_sexo"></canvas>
	                    </div>

	                    <div class="d-flex flex-column justify-content-center flex-row-fluid  mb-5">                      
	                        
	                        <div class="d-flex align-items-center mb-5">
	                            <div class="d-flex align-items-center me-2">
	                                <div class="bullet bg-primery me-3"></div>
	                                <div>
	                                    <a href="#" class="fs-6 text-gray-800 text-hover-primery fw-bolder">Hombres</a>
	                                    <div class="fs-7 text-muted fw-bold mt-1">
	                                        Porcentaje: <span id="spPorcentajeHombres"></span> %
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="ms-auto fw-bolder text-gray-700">
	                                <span id="spSexoHombres" class="fs-4"></span>
	                            </div>
	                        </div>
	                        <div class="d-flex align-items-center mb-5">
	                            <div class="d-flex align-items-center me-2">
	                                <div class="bullet bg-danger me-3"></div>
	                                <div>
	                                    <a href="#" class="fs-6 text-gray-800 text-hover-danger fw-bolder">Mujeres</a>
	                                    <div class="fs-7 text-muted fw-bold mt-1">
	                                        Porcentaje del: <span id="spPorcentajeMujeres"></span> %
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="ms-auto fw-bolder text-gray-700">
	                                <span id="spSexoMujeres" class="fs-4"></span>
	                            </div>
	                        </div>     
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="col-xxl-4 mb-xl-10">
	       <div class="card">
	            <div class="card-header" style="background: linear-gradient(90deg, #E68A00 0%, #77B708 100%);">
	                <div class="card-title flex-column">
	                    <h3 class="fs-3 text-white w-bolder mb-1">Votantes</h3>
	                    <div class="fs-6 fw-bold text-white">Estadisticas por votantes</div>
	                </div>                
	            </div>
	            <div class="card-body p-9">
	                <div class="d-flex flex-wrap">                	
	                    <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
	                        <div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
	                            <span class="fs-2qx fw-bolder"><span id="spTotalVotantes"></span></span>
	                            <span class="fs-6 fw-bold text-gray-400">
	                                <a href="#" class="text-gray-700">
	                                    Votantes
	                                </a>
	                            </span>
	                        </div>
	                        <canvas id="kt_chart_votantes"></canvas>
	                    </div>

	                    <div class="d-flex flex-column justify-content-center flex-row-fluid  mb-5">                      
	                        
	                        <div class="d-flex align-items-center mb-5">
	                            <div class="d-flex align-items-center me-2">
	                                <div class="bullet bg-success me-3"></div>
	                                <div>
	                                    <a href="#" class="fs-6 text-gray-800 text-hover-success fw-bolder">18 años</a>
	                                    <div class="fs-7 text-muted fw-bold mt-1">
	                                        Porcentaje: <span id="spPorcentajeMenores"></span> %
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="ms-auto fw-bolder text-gray-700">
	                                <span id="spMenorEdad" class="fs-4"></span>
	                            </div>
	                        </div>
	                        <div class="d-flex align-items-center mb-5">
	                            <div class="d-flex align-items-center me-2">
	                                <div class="bullet bg-warning me-3"></div>
	                                <div>
	                                    <a href="#" class="fs-6 text-gray-800 text-hover-warning fw-bolder">Mas de 18 años</a>
	                                    <div class="fs-7 text-muted fw-bold mt-1">
	                                        Porcentaje del: <span id="spPorcentajeMayores"></span> %
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="ms-auto fw-bolder text-gray-700">
	                                <span id="spMayorEdad" class="fs-4"></span>
	                            </div>
	                        </div>     
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="row g-5 g-xl-8">
		<div class="col-xxl-12 mb-xl-10">
	       <div class="card">
	            <div class="card-header" style="background: linear-gradient(90deg, #3C3B3F 0%, #605C3C 100%);">
	                <div class="card-title flex-column">
	                    <h3 class="fs-3 text-white w-bolder mb-1">Promovidos por municipio</h3>
	                    <div class="fs-6 fw-bold text-white">Listado de municipios y los promovidos registrados</div>
	                </div> 
	                <div class="card-toolbar">               
	                	<div class="d-flex flex-stack flex-wrap gap-4">
		                    <div class="position-relative my-1">
		                        <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
		                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
		                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
		                            </svg>
		                        </span>
		                        <input type="text" data-kt-docs-table-filter="search" class="form-control w-350px fs-7 ps-12" placeholder="Ingresar dato a buscar" />
		                    </div>
		                </div>
	                </div>
	            </div>
	            <div class="card-body p-3">	            	
		            	<div id="promoteds"></div>
	            </div>
	        </div>
	    </div>
	</div>
	
@endsection

@section('js')
	<script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('views/dashboard/index.js') }}"></script>
@endsection

@section('scripts')
    loadData();
@endsection