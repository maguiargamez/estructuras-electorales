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
	<li class="breadcrumb-item text-muted">Listado de promovidos por municipio</li>
@endsection

@section('buttons')
    <a href="{{ url('/home') }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left"></i>Regresar</a> 
@endsection

@section('content')
    <input type="hidden" id="id_municipio" name="id_municipio" value="{{$id_municipio}}">
    <div class="card">
        <div class="card-body p-5 px-lg-19 py-lg-16">
            <div class="mb-14">              
                <div class="card">
                    <div class="card-header">
                        <div class="card-title flex-column">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="fs-2x text-dark mb-6">{!! $municipio->municipality !!}</h1>
                                    <div class="fs-4 text-gray-800 fw-bold">
                                        Coordinador municipal: {!! $municipio->firstname.' '.$municipio->lastname !!} <br>                                
                                        Total promovidos: <span id="spTotalPromovidos">0</span>                                 
                                    </div>
                                </div>                                    
                            </div>
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
                </div>

                <div class="mb-14">
                    <div id="promoteds"></div>                                
                </div>                           
            </div>                       
        </div>
    </div>	
@endsection

@section('js')
	<script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('views/dashboard/promovidos_municipio.js') }}"></script>
@endsection

@section('scripts')
@endsection