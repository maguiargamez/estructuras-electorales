<div>
    <div  class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <x-breadcrumb 
            :breadcrumb="$breadcrumb"
            :title="$title"
            ></x-breadcrumb>

            <a href="{{ route('coordinadores.create') }}" type="button" class="btn btn-sm btn-primary">
                <i class="fa-solid fa-plus"></i>   
                Registrar promovido
            </a>
        </div>

    </div>

    <div id="kt_app_content_container" class="app-container">
        
        <div class="g-5 g-xl-10">

            <div class="card card-custom card-flush">
                <div class="card-body">

                    <div class="">
                        <div class="fs-2hx fw-bold text-gray-800 text-center mb-5">
                            <span class="me-2">META GENERAL</span>
                        </div>
                        <div class="text-center">
                            <div class="fs-5x d-flex justify-content-center align-items-start">
                                <span class="lh-sm fw-semibold"> 
                                    
                                    <span class="text-muted">{{ number_format($promotedNumber) }} </span>/
                                    <span class="text-info">{{ number_format($this->electionGoal) }} </span> 
                                    
                                </span>
                                
                            </div>                            
    
                            <div class="d-flex align-items-center flex-column mt-3">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-semibold fs-6 text-gray-400">Avance</span>
                                    <span class="fw-bold fs-6">{{ number_format((($promotedNumber*100)/$this->electionGoal),2)  }}%</span>
                                </div>
                                <div class="h-40px mx-3 w-100 bg-light mb-3">
                                    <div role="progressbar" style="width: {{ number_format((($promotedNumber*100)/$this->electionGoal),2)  }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="bg-success rounded h-40px"></div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="separator separator-dashed my-3"></div>    

        <div class="row g-5 g-xl-10">

            <div class="col-sm-6 col-xl-3 mb-xl-10">
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
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ number_format($promotedMales,0) }}</span>
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-400">Hombres</span>
                            </div>
                        </div>
                        <span class="badge badge-light-success fs-base">
                        <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        2.1%</span>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3 mb-xl-10">
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
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ number_format($promotedFemales, 0) }}</span>
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-400">Mujeres</span>
                            </div>
                        </div>
                        <span class="badge badge-light-success fs-base">
                        <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        2.1%</span>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-xl-6 mb-xl-10">
                <div class="card card-flush h-xl-100">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Tipo de promovidos</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">De acuerdo a las encuestas realizadas</span>
                        </h3>
                    </div>
                    <div class="card-body pt-5">

                        @foreach ($dashboards as $dashboard)
                            @php
                                $color= [1=>"success",2=>"danger",3=>"warning"];
                            @endphp
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-3">
                                    <div class="flex-grow-1">
                                       
                                        <span class="fw-bold text-gray-800 fs-7">
                                            {{ $dashboard->promotedType->description }} :
                                        </span>                                         
                                        <span class="text-info text-hover-primary">
                                            {{ number_format($dashboard->total, 0) }}
                                        </span>
                                        
                                        
                                    </div>
                                </div>
                                <div class="d-flex align-items-center w-100 mw-125px">
                                    
                                    <div class="progress h-6px w-100 me-2 bg-light-{{ $color[$dashboard->promotedType->id] }}">
                                        <div class="progress-bar bg-{{ $color[$dashboard->promotedType->id] }}" role="progressbar" style="width: {{ number_format((($dashboard->total*100)/$promotedNumber),2)  }}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-gray-400 fw-semibold">{{ number_format((($dashboard->total*100)/$promotedNumber),2)  }}%</span>
                                </div>
                            </div>  
                            <div class="separator separator-dashed my-3"></div>       
                        @endforeach                    
                    </div>
                </div>
            </div>

        </div>

        <div class="separator separator-dashed my-3"></div>    

        <div class="card card-custom card-flush h-xl-100">

            <div class="card-header pt-7">
                
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Resultados de la busqueda</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6"><span class="badge badge-info">{{ $items->total() }} registros</span></span>
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
                            <input wire:model="search" type="text" data-kt-table-widget-4="search" class="form-control w-150px fs-7 ps-12" placeholder="Buscar...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body pt-2">




                
                <div id="kt_file_manager_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                
                    <div class="table-responsive">
                    @php
                        $i=0;
                    @endphp
                
                    <table class="table table-bordered align-middle table-row-gray-400 fs-6 gy-3" id="kt_table_widget_4_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-10px sorting_disabled" rowspan="1" colspan="1">#</th>
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">NOMBRE</th>
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">SECCION</th>
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">MUNICIPIO</th>
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">DISTRITO</th>
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">PROMOTOR</th>
                                <!--<th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">AVANCE</th>
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">%AVANCE</th>
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">FALTANTE</th>-->
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">TIPO DE PROMOVIDO</th>

                                <th class="text-end sorting_disabled" rowspan="1" colspan="1" style="width: 100px;"></th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                
                        <tbody class="fw-bold text-gray-700">
                            @foreach($items as $index => $item)
                 
                                <tr class="border-dashed border-bottom-2 border-gray-400">
                
                                    <td class="ps-1">{{ $items->firstItem() + $index }}</td>
                                    <td style="padding-left: 10px">                                        
                                            {{ $item->member->firstname.' '.$item->member->lastname }}
                                    </td>
                                    <td style="padding-left: 10px">                                        
                                        {{ $item->structure->section }}
                                    </td>
                                    <td style="padding-left: 10px">                                        
                                        {{ $item->structure->municipality }}
                                    </td>
                                    <td style="padding-left: 10px">                                        
                                        Distrito {{ $item->structure->local_district }}
                                    </td>

                                    <td style="padding-left: 10px">                                        
                                        {{ $item->promoter }}
                                    </td>

                                    <td>
                                        {{ $item->promotedType->description  }}
                                    </td>


                                    <td class="text-end" style="padding-right: 10px">
                                        <a class="btn btn-icon btn-bg-info btn-sm" href="{{ route('promovidos.apoyos.index', $item) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Apoyos">
                                         <span class="svg-icon svg-icon-3">
                                            <i class="fa-solid fa-headset text-white"></i>
                                         </span>
                                        </a>
                                        <a class="btn btn-icon btn-bg-info btn-sm" href="{{ route('promovidos.segumiento.index', $item) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Seguimientos">
                                         <span class="svg-icon svg-icon-3">
                                            <i class="fa-solid fa-comments text-white"></i>
                                         </span>
                                        </a>
                                    </td>
                
                                </tr>                                 
                
                                @php
                                    $i++;
                                @endphp
                
                            @endforeach
                        </tbody>
                
                    </table>
                
                </div>
                <div class="d-flex justify-content-end py-0">
                    {{$items->links()}}
                </div>
                
                
            </div>
                
                
                








            </div>

        </div>

    </div>
</div>
