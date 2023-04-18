@props([
    'customer'=> [],
    'currentRouteName' => \Route::currentRouteName(),
    'totalTrees' => \App\Models\CustomerAdoptionTree::whereHas('customerAdoption', function ($query) use($customer) {
                $query->where('customer_id','=',$customer->id);
            })->count(),
    'totalBeneficiaries' => \App\Models\CustomerAdoptionTree::whereNotNull('beneficiary')->whereHas('customerAdoption', function ($query) use($customer) {
                $query->where('customer_id','=',$customer->id);
            })->count(),
    'freeTrees' => \App\Models\CustomerAdoptionTree::whereNull('beneficiary')->whereHas('customerAdoption', function ($query) use($customer) {
                $query->where('customer_id','=',$customer->id);
            })->count(),

    ])


<div class="card mb-6">
    <div class="card-body pt-9 pb-0">
        
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img alt="Imagen" src="{{ ($customer->photo!=null) ? asset('media/'.$customer->photo): asset('img/favicon.jpg') }}" />
                    
                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $customer->fullname }}</a>
                            <a href="#">
                                <i class="ki-duotone ki-verify fs-1 text-primary"><span class="path1"></span>
                                    <span class="path2"></span></i></a>
                        </div>                      
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="fa-solid fa-id-card fs-4 me-1"></i> {{ $customer->identity_key }}
                            </a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="fa-regular fa-calendar-days fs-4 me-1"></i> {{ $customer->start_date }}
                            </a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="fa-solid fa-envelope fs-4 me-1"></i> {{ $customer->email }}
                            </a>
                        </div>
                    </div>
                    <div class="d-flex my-4">
                        <a href="{{ route('clientes.adopciones.create', $customer) }}" type="button" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-tree"></i>    
                            Nueva adopción
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-wrap flex-stack">
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="d-flex flex-wrap">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                    <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $totalTrees }}</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-400">Árboles adoptados</div>

                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2"><span class="path1"></span><span class="path2"></span></i>                                    <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ $totalBeneficiaries }}</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-400">Beneficiarios</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                    <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%" data-kt-initialized="1">{{ $freeTrees }}</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-400">Árboles libres</div>

                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                            <span class="fw-semibold fs-6 text-gray-400">Árboles con beneficiarios</span>
                            <span class="fw-bold fs-6">{{ round(($totalBeneficiaries*100)/$totalTrees, 2) }} %</span>
                        </div>

                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                            <div class="bg-success rounded h-5px" role="progressbar" style="width: {{ round(($totalBeneficiaries*100)/$totalTrees, 2) }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item mt-2">

                    <a class="nav-link text-active-primary ms-0 me-10 py-5 @if ($currentRouteName == 'clientes.adopciones.index') active @endif" href="{{ route('clientes.adopciones.index', $customer->id) }}">Adopciones</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 @if ($currentRouteName == 'clientes.arboles.index') active @endif" href="{{ route('clientes.arboles.index', $customer->id) }}">Árboles</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo1/../demo1/pages/user-profile/campaigns.html">
                        Beneficiarios                    </a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo1/../demo1/pages/user-profile/documents.html">
                        Contacto                    </a>
                </li>
                    </ul>
    </div>
</div>