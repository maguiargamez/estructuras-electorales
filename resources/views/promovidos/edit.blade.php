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
	<li class="breadcrumb-item">
		<span class="bullet bg-gray-400 w-5px h-2px"></span>
	</li>
	<li class="breadcrumb-item text-muted">Edicion de promovidos</li>
@endsection

@section('buttons')
	<a href="{{ url('promovidos') }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left"></i>Regresar</a> 
    <button id="btn-edit-promovido" class="btn btn-sm btn-primary btn-edit-promovido"><i class="far fa-save"></i> Guardar</button>
@endsection

@section('content')
	<form id="frmPromovido" name="frmPromovido" novalidate>
		<input type="hidden" name="id" id="id" value="{{ $id }}">
		@include('promovidos.form')
	</form>
@endsection

@section('js')
	<script src="{{ asset('views/promovidos/edit.js') }}"></script>
	<script src="{{ asset('views/helpers/clsTools.js') }}"></script>
    <script src="{{ asset('views/helpers/clsSelectsEdit.js') }}"></script> 
    <script src="{{ asset('views/helpers/clsValidate.js') }}"></script> 
@endsection

@section('scripts')
	$('#birth_date').flatpickr({dateFormat: "d/m/Y"});
@endsection