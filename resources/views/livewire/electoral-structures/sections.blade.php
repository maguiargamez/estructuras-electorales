<div>
    <div  class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">

            <x-breadcrumb 
            :breadcrumb="$breadcrumb"
            :title="$title"
            ></x-breadcrumb>      



        </div>
    </div>

    <div id="kt_app_content_container" class="app-container">
        
        <div class="card card-flush h-xl-100">
            <div class="card-body ">
            <div class="">
                <!--begin::Headin-->
                <div class="d-flex flex-stack mb-6">
                    <!--begin::Title-->
                    <div class="flex-shrink-0 me-5">
                        <span class="text-gray-400 fs-7 fw-bold me-2 d-block lh-1 pb-1">Distrito {{ $structure->local_district }}</span>
                        <span class="text-gray-800 fs-1 fw-bold">{{ $structure->municipality }}</span>
                    </div>

                    <div class="d-flex align-items-center flex-column mt-3 w-200px w-sm-300px">
                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                            <span class="fw-semibold fs-6 text-gray-400">
                                Avance: 
                                <span class="text-gray-800">{{ number_format($totalPromoteds) }}</span> / <span class="fw-bold text-info">{{ number_format($totalGoal) }}</span>
                            </span>
                            <span class="fw-bold fs-6">{{ $percentageCompletion  }}%</span>
                        </div>
                        <div class="h-10px mx-3 w-100 bg-light mb-3">
                            <div role="progressbar" style="width: {{ $percentageCompletion  }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="bg-success rounded h-10px"></div>
                        </div>
                    </div>

                </div>
                <!--end::Heading-->
                <!--begin::Items-->
                <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                    <!--begin::Item-->
                    <div class="d-flex align-items-center me-5 me-xl-13">
                        <div class="m-0">
                            <span class="fw-semibold text-gray-400 d-block fs-8">Coordinador distrital</span>
                            <a href="../../demo1/dist/pages/user-profile/overview.html" class="fw-bold text-gray-800 text-hover-primary fs-7">Robert Fox</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="m-0">
                            <span class="fw-semibold text-gray-400 d-block fs-8">Coordinador municipal</span>
                            <span class="fw-bold text-gray-800 fs-7">$64.800</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="card card-flush h-xl-100">
            <div class="card-header pt-7">
                
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Metas</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6"><span class="badge badge-info">{{ count($items) }} secciones</span></span>
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
                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">SECCIÓN</th>
                                <th class="text-end min-w-50px sorting_disabled" rowspan="1" colspan="1" style="width: 91.25px;">META</th>
                                <th class="text-end sorting_disabled" rowspan="1" colspan="1" style="width: 25.6667px;"></th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                
                        <tbody class="fw-bold text-gray-700">
                            @foreach($items as $item)
                 
                                <tr class="border-dashed border-bottom-2 @if(array_key_exists('childrens', $item))bg-secondary border-gray-100 @else border-gray-400 @endif">
                
                                
                                    <td style="padding-left: 10px">
                                        <a href="#" class="text-gray-800 text-hover-primary">{{ $item["name"] }}</a>
                                    </td>
                                    <td align="right">
                
                                        <span class="@if($item["promoteds"] > $item["goal"]) text-success @else text-muted @endif text-hover-primary">
                                            {{ $item["promoteds"] }}
                                        </span> / 
                                        <span class="text-info text-hover-primary">
                                            {{ $item["goal"] }}
                                        </span>
                
                                    </td>
                                    <td class="text-end" style="padding-right: 10px">
                                    </td>
                
                                </tr>
                
                       
                
                                    @if(array_key_exists('childrens', $item))
                                        @foreach ($item['childrens'] as $item1)
                    
                    
                    
                                            <tr class="border-dotted border-bottom-2 border-gray-400">                                
                                                <td style="padding-left: 40px">
                                                    <span class="text-gray-700 text-hover-primary">{{ $item1['promnameoteds'] }}</span>
                                                </td>
                                                <td align="right">
                    
                                                    <span class="@if($item1['promoteds'] > $item1['totalGoal']) text-success @else text-muted @endif text-hover-primary">
                                                        {{ $item1['promoteds'] }}
                                                    </span> / 
                                                    <span class="text-info text-hover-primary">
                                                        {{ $item1['totalGoal'] }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                    
                                                </td>
                    
                                            </tr>
                                            
                                        @endforeach
                                    @endif

                                
                                
                            
                                
                
                                @php
                                    $i++;
                                @endphp
                
                            @endforeach
                        </tbody>
                
                    </table>
                
                </div>
                
                
                </div>
                
                
                








            </div>

        </div>
    </div>
</div>