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
			<div class="card border-transparent" data-theme="light" style="background-color: #dfdfdf;">
				<div class="card-body d-flex ps-xl-15 flex-column justify-content-between">
					<div class="m-0">
						<div class="position-relative text-center fs-2hx z-index-2 fw-bold text-white mb-1">
							<span class="me-2">Elección {{ $election->electionType->description }}
							<span class="position-relative d-inline-block text-danger">
								<a href="#" class="text-danger opacity-75-hover">{{ $election->description }}</a>
								<span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
							</span></span>
							<div class="text-center">
			                    <div class="fs-5x d-flex justify-content-center align-items-start">
			                        <span class="lh-sm fw-semibold">                             
			                            <span class="text-muted"><span id="spTotalGlobalPromovidos"></span></span>/
			                            <span class="text-info"><span id="spTotalGlobal"></span> </span>                             
			                        </span>                        
			                    </div>
			                    <span class="text-gray-500 fs-6 d-block fw-bold">META GENERAL</span>
			                </div>
							
							<div class="d-flex align-items-center flex-column mt-1">
			                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
			                            <span class="fw-semibold fs-6 text-gray-400">Avance</span>
			                            <span class="fw-bold fs-6"><span id="spAvance"></span>%</span>
			                        </div>
			                        <div class="h-30px mx-3 w-100 bg-light mb-3 rounded">
			                            <div id="dvPorcentajeAvance"></div>
			                        </div>
			                    </div> 
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="row g-5 g-xl-10">
		<div class="col-xl-4 mb-xl-10">
				<div class="card">
					<div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url('{{ asset('metronic/assets/media/svg/shapes/top-green.png') }}" data-theme="light">
						<h3 class="card-title align-items-start flex-column text-white pt-15">
							<span class="fw-bold fs-2x mb-3">Estadisticas personal registrado</span>							
						</h3>
					</div>

					<div class="card-body mt-n20">
						<div class="mt-n20 position-relative">
							<div class="row g-3 g-lg-6">
								<div class="col-6">
									<div class="bg-gray-100 bg-opacity-70 text-center rounded-2 px-6 py-5">
										<div class="symbol symbol-30px me-5 mb-8">
											<span class="symbol-label">
												<span class="svg-icon svg-icon-1 svg-icon-primary">
													<i class="fs-3x fas fa-users-cog"></i>
												</span>
											</span>
										</div>
										<div class="m-0">
											<span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><span id="spTotalCordEstatal"></span></span>
											<span class="text-gray-500 fw-semibold fs-6">Coordinadores estatales</span>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="bg-gray-100 bg-opacity-70 text-center rounded-2 px-6 py-5">
										<div class="symbol symbol-30px me-5 mb-8">
											<span class="symbol-label">
												<span class="svg-icon svg-icon-1 svg-icon-primary">
													<i class="fs-3x fas fa-globe"></i>
												</span>
											</span>
										</div>
										<div class="m-0">
											<span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><span id="spTotalCordDistrital"></span></span>
											<span class="text-gray-500 fw-semibold fs-6">Coordinadores distritales</span>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="bg-gray-100 bg-opacity-70 text-center rounded-2 px-6 py-5">
										<div class="symbol symbol-30px me-5 mb-8">
											<span class="symbol-label">
												<span class="svg-icon svg-icon-1 svg-icon-primary">
													<i class="fs-3x fas fa-route"></i>
												</span>
											</span>
										</div>
										<div class="m-0">
											<span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><span id="spTotalCordMunicipal"></span></span>
											<span class="text-gray-500 fw-semibold fs-6">Coordinadores municipales</span>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="bg-gray-100 bg-opacity-70 text-center rounded-2 px-6 py-5">
										<div class="symbol symbol-30px me-5 mb-8">
											<span class="symbol-label">
												<span class="svg-icon svg-icon-1 svg-icon-primary">
													<i class="fs-3x fas fa-person-booth"></i>
												</span>
											</span>
										</div>
										<div class="m-0">
											<span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><span id="spTotalPromovidos"></span></span>
											<span class="text-gray-500 fw-semibold fs-6">Simpatizantes promovidos</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>

	    <div class="col-xxl-4 mb-xl-10">
	       <div class="card">
	            <div class="card-header mt-6">
	                <div class="card-title flex-column">
	                    <h3 class="fs-3 text-gray-800 w-bolder mb-1">Sexo</h3>
	                    <div class="fs-6 fw-bold text-gray-400">Estadisticas por sexo de los simpatizantes</div>
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
	            <div class="card-header mt-6">
	                <div class="card-title flex-column">
	                    <h3 class="fs-3 text-gray-800 w-bolder mb-1">Votantes</h3>
	                    <div class="fs-6 fw-bold text-gray-400">Estadisticas por votantes</div>
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
	
@endsection

@section('js')
    <script src="{{ asset('views/dashboard/index.js') }}"></script>
@endsection

@section('scripts')
    loadData();
@endsection