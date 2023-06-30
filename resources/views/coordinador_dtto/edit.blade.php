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
	<li class="breadcrumb-item">
		<span class="bullet bg-gray-400 w-5px h-2px"></span>
	</li>
	<li class="breadcrumb-item text-muted">Editar un coordinador distrital</li>
@endsection

@section('buttons')
	<a href="{{ url('coordinador-distrital') }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left"></i>Regresar</a> 
    <button id="btn-edit-coordinador-dtto" class="btn btn-sm btn-primary btn-edit-coordinador-dtto"><i class="far fa-save"></i> Guardar</button>
@endsection

@section('content')
	<form id="frmCoordinadorDtto" name="frmCoordinadorDtto" novalidate>
		<input type="hidden" id="idCoordinator" name="idCoordinator" value="{{$id}}">
		@include('coordinador_dtto.form')
	</form>
@endsection

@section('js')
	<script src="{{ asset('views/coordinadores/distrital/edit.js') }}"></script>
	<script src="{{ asset('views/helpers/clsTools.js') }}"></script>
    <script src="{{ asset('views/helpers/clsSelects.js') }}"></script> 
    <script src="{{ asset('views/helpers/clsValidate.js') }}"></script> 
@endsection

@section('scripts')
	$('#birth_date').flatpickr({dateFormat: "d/m/Y"});
@endsection