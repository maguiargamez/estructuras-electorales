@extends('layouts.app-js')

@section('meta')
    <meta name="csrf-token" content="<?= csrf_token() ?>">
@endsection

@section('css')
@endsection

@section('title')
    Coordinadores distritales
@endsection

@section('breadcrumbs')
	<li class="breadcrumb-item text-muted">
		<a href="#" class="text-muted text-hover-primary">Inicio</a>
	</li>	
@endsection

@section('buttons')
	<a href="{{ route('coordinador-distrital.create') }}" type="button" class="btn btn-sm btn-primary">
        <i class="fa-solid fa-plus"></i>   
        Registrar coordinador distrital
    </a>
@endsection

@section('content')
	<div class="card card-custom card-flush h-xl-100">
        <div class="card-header pt-7">            
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">Resultados de la busqueda</span>
                <span class="text-gray-400 mt-1 fw-semibold fs-6"><span class="badge badge-info"><span id="spTotal"></span>&nbsp;&nbsp; registros</span></span>
            </h3>
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

        <div class="card-body pt-2">            
            <div id="kt_file_manager_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"> 
            	<div class="table-responsive">
	                <table id="table-coordinadores" class="table table-bordered align-middle table-row-gray-400 fs-6 gy-3" width="100%">
	                    <thead>
	                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
	                            <th class="min-w-10px sorting_disabled" rowspan="1" colspan="1">#</th>
	                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">DISTRITO</th>
	                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">TIPO COORDINADOR</th>
	                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">NOMBRE</th>
	                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">CLAVE INE</th>
	                            <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">VIGENCIA INE</th>              
	                            <th class="text-end sorting_disabled" rowspan="1" colspan="1" style="width: 25.6667px;">OPCION</th>
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
	<script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
	<script src="{{ asset('views/coordinadores/distrital/index.js') }}"></script> 
@endsection

@section('scripts')
@endsection