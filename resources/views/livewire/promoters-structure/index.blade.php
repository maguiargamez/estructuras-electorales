<div>
    <div  class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <x-breadcrumb 
            :breadcrumb="$breadcrumb"
            :title="$title"
            ></x-breadcrumb>

            <a href="{{ route('coordinadores.create') }}" type="button" class="btn btn-sm btn-primary">
                <i class="fa-solid fa-plus"></i>   
                Registrar promotor
            </a>
        </div>

    </div>

    <div id="kt_app_content_container" class="app-container">
        
        <div class="row g-5 g-xl-10">
            <div class="col-xl-8">
                <div class="card card-flush h-xl-100">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Filtros de busqueda</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Avg. 72% completed lessons</span>
                        </h3>
                        <div class="card-toolbar">
                            <a href="#" class="btn btn-sm btn-light">All Lessons</a>
                        </div>
                    </div>
                    <div class="card-body pt-5">

                                          
                    </div>
                </div>
            </div>
            <div class="col-xl-4">

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
                            <input type="text" data-kt-table-widget-4="search" class="form-control w-150px fs-7 ps-12" placeholder="Search">
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
                                <!--<th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">AVANCE</th>
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">%AVANCE</th>
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">FALTANTE</th>-->
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">TIPO COORDINADOR</th>

                                <th class="text-end sorting_disabled" rowspan="1" colspan="1" style="width: 25.6667px;"></th>
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
                                        {{ $item->section }}
                                    </td>
                                    <td style="padding-left: 10px">                                        
                                        {{ $item->municipality }}
                                    </td>
                                    <td style="padding-left: 10px">                                        
                                        Distrito {{ $item->local_district }}
                                    </td>
                                    <!--<td style="padding-left: 10px">                                        
                                        {{ $item->goal2 }}
                                    </td>

                                    <td>0</td>
                                    <td>0</td>-->
                                    <td>
                                        {{ $item->position->description  }}
                                    </td>


                                    <td class="text-end" style="padding-right: 10px">
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
