@extends('layouts.app-js')

@section('meta')
    <meta name="csrf-token" content="<?= csrf_token() ?>">
@endsection

@section('css')
@endsection

@section('title')
    Promotores
@endsection

@section('breadcrumbs')
	<li class="breadcrumb-item text-muted">
		<a href="#" class="text-muted text-hover-primary">Inicio</a>
	</li>
	<li class="breadcrumb-item">
		<span class="bullet bg-gray-400 w-5px h-2px"></span>
	</li>
	<li class="breadcrumb-item text-muted">Edicion de promotores</li>
@endsection

@section('buttons')
	<a href="{{ url('promotores') }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left"></i>Regresar</a> 
    <button id="btn-edit-promotor" class="btn btn-sm btn-primary btn-edit-promotor"><i class="far fa-save"></i> Guardar</button>
@endsection

@section('content')
	<form id="frmPromotor" name="frmPromotor" novalidate>
		<input type="hidden" name="id" id="id" value="{{ $id }}">
		@include('promotores.form')
	</form>
@endsection

@section('js')
	<script src="{{ asset('views/promotores/edit.js') }}"></script>
	<script src="{{ asset('views/helpers/clsTools.js') }}"></script>
    <script src="{{ asset('views/helpers/clsSelects.js') }}"></script> 
    <script src="{{ asset('views/helpers/clsValidate.js') }}"></script> 
@endsection

@section('scripts')
	$('#birth_date').flatpickr({dateFormat: "d/m/Y"});
@endsection