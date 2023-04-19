@section('toolbar-actions')
    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">
        <i class="fa-solid fa-plus"></i> Nueva elección
    </a>

@endsection

@section('breadcrumb')
    <x-breadcrumb 
    :pageTitle="$pageTitle" 
    :pageBreadcrumb="$pageBreadcrumb"
    >
    </x-breadcrumb>
@endsection

<div>  
   
    <div class="card card-flush">

        <div class="card-header pt-8">

            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>       
                    <input type="text" data-kt-filemanager-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar..." wire:model='search'>


                </div>
            </div>



        </div>

        <div class="card-body">

            <div id="kt_file_manager_list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                
                <div class="table-responsive">

                    <table id="kt_file_manager_list" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">

                        
                        <thead>
                            
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">

                                <th class="w-10px">#</th>                                
                                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" style="width: 29.8906px;">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" wire:model="selectAllItems">
                                    </div>
                                </th>

                                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">
                                    Descripción
                                </th>

                                <th class="min-w-250px sorting_disabled" rowspan="1" colspan="1" style="width: 250px;">
                                    Tipo de elección
                                </th>
                                <th class="min-w-300px sorting_disabled align-items-center" rowspan="1" colspan="1" style="width: 300px;" align="center">
                                    Estado
                                </th>

                                <th class="min-w-80px sorting_disabled align-items-center" rowspan="1" colspan="1"  align="center">
                                    Municipio
                                </th>
                               

                                <th class="w-80px sorting_disabled" rowspan="1" colspan="1" style="width: 80px;"></th>


                            </tr>
                            
                        </thead>

                        <tbody class="fw-semibold text-gray-600">          
                                                
                            @forelse ( $items as $index => $item )                
                                <tr class="odd">

                                    <td class="ps-1">{{ $items->firstItem() + $index }}</td>
                                                          
                                    <td align="center">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input type="checkbox" class="form-check-input" wire:model="selectedItems" value="{{ $item->id }}">
                                        </div>
                                    </td>

                                    <td class="align-items-center"> 
                                        {{ $item->description }}
                                    </td>
                                   
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 position-relative">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px">
                                                    <img alt="Imagen" src="{{ ($item->photo!=null) ? asset('media/'.$item->photo): asset('img/favicon.jpg') }}" />
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-start">

                                                <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                     {{ $item->tree->tree_key }}
                                                </a>
                                                <a href="#" class="text-muted text-hover-primary fw-semibold text-muted d-block fs-7">
                                                    <span class="text-dark"> Plan: </span> {{ $item->plan->description }}
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </td>

                                    <td>                                        
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-column justify-content-start">


                                                @if($item->is_available==0)  
                                                    <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                        <span class="badge badge-primary">
                                                            <i class="fa-solid fa-user-tie text-white fs-8"></i>&nbsp;{{ $item->beneficiary }}
                                                        </span>
                                                    </a>  
                                                    <a href="#" class="text-gray-700 text-hover-primary fw-semibold d-block fs-7">
                                                        <span class="text-dark"> 
                                                            <i class="fa-solid fa-envelope"></i> 
                                                        </span> {{ $item->email }}
                                                    </a>
                                                    
                                                    <a href="#" class="text-muted text-hover-primary fw-semibold d-block fs-7">
                                                        <span class="text-muted"> 
                                                            <i class="fa-solid fa-closed-captioning"></i> 
                                                        </span> {{ $item->email_cc }} 
                                                    </a>
                                                @else  
                                                
                                                        <span class="badge badge-success d-block">Libre</span>
                                                    
                                                @endif


                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>{{ $item->plan->description }}{{ $item->tree->tree_key }}</td>

                                    <td class="text-end" data-kt-filemanager-table="action_dropdown">


                                        <a class="btn btn-icon btn-bg-info btn-active-color-default btn-sm" href="{{ route('clientes.edit', $item) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Asignar Beneficiario">
                                         <span class="svg-icon svg-icon-3 ">
                                            <i class="fa-solid fa-user-plus text-white"></i>
                                         </span>
                                        </a>

                                        <a class="btn btn-icon btn-bg-warning btn-active-color-default btn-sm" href="{{ route('clientes.edit', $item) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                         <span class="svg-icon svg-icon-3 ">
                                            <i class="fa-solid fa-edit text-white"></i>
                                         </span>
                                        </a>

                                        <a class="btn btn-icon btn-bg-danger btn-active-color-default btn-sm" href="#"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"
                                        wire:click="delete({{ $item->id }})">
                                         <span class="svg-icon svg-icon-3">
                                            <i class="fa-solid fa-trash text-white"></i>
                                         </span>
                                        </a>

                                    </td>

                                </tr>
                            @empty
                            @endforelse                                
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end py-0">
                        
                    </div>



                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">

                    </div>
                    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"><div class="dataTables_paginate paging_simple_numbers" id="kt_file_manager_list_paginate">
                        {{ $items->links() }}
                    </div>
                </div>
                </div>


            </div>
        </div>


    </div>

    <div class="modal d-block" id="exampleModalSizeSm" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm"  data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            ...
        </div>
    </div>

</div>
