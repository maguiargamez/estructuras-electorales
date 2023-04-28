@extends('layouts.login')

@section('content')


<form class="form w-100" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="text-center mb-11">
        <h1 class="text-dark fw-bolder mb-3">Estructuras electorales</h1>
        <div class="text-gray-500 fw-semibold fs-6">Bienvenid@</div>
    </div>
    <div class="fv-row mb-8">

        <input id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" autofocus/>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>

    <div class="fv-row mb-3">
        <input id="password" name="password" type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror" />

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror        
        
    </div>


    <div class="d-grid mb-10">
        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
            <!--begin::Indicator label-->
            <span class="indicator-label">{{ __('Ingresar') }}</span>
            <!--end::Indicator label-->
            <!--begin::Indicator progress-->
            <span class="indicator-progress">Por favor espere...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            <!--end::Indicator progress-->
        </button>

    </div>


</form>


@endsection
