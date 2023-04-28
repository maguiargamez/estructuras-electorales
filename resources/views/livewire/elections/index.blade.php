@section('breadcrumb')
    <x-breadcrumb 
    :pageTitle="$pageTitle" 
    :pageBreadcrumb="$pageBreadcrumb"
    >
    </x-breadcrumb>
@endsection

<div>  
    
    <div id="kt_app_toolbar" class="app-toolbar py-0 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">                
                <button wire:click="openElectionModal" type="button" class="btn btn-sm btn-primary fw-bold mr-2">
                    <i class="fa-solid fa-plus"></i> Nueva elección
                </button>
            </div>
        </div>
    </div>

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
		
    <div wire:ignore.self class="modal fade" id="election_modal"  tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-900px">
            <div class="modal-content">

                <div class="modal-header">
                    <h2>Nueva elección</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>							
                    </div>						
                </div>

                <div class="modal-body py-lg-10 px-lg-10">
                    

                        <div class="fv-row mb-10">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="required">Descripción</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Especifica el nombre que describa a el proceso electoral"></i>
                            </label>
                            <input wire:model="newElection.description" type="text" class="form-control form-control-lg form-control-solid" placeholder="" value="" />

                            @error('newElection.description')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    <div data-field="newElection.description">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror

                            
                        </div>

                        <div class="fv-row mb-10">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="required">Tipo de elección</span>
                            </label>

                            <x-select wire:model="newElection.election_type_id"  :options="$electionTypes" class="form-control form-control-lg form-control-solid"></x-select>

                            @error('newElection.election_type_id')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    <div data-field="newElection.election_type_id">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>

                        @if ($showDiv)
                        <div class="fv-row mb-10">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="required">Municipio</span>
                            </label>

                            <x-select wire:model="newElection.municipality_id" :options="$municipalities" class="form-control form-control-lg form-control-solid"></x-select>

                            @error('newElection.municipality_id')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    <div data-field="newElection.municipality_id">
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>
                        @endif

                    
                </div>

            </div>
        </div>
    </div>

     

          


</div>

@push('scripts')
    <script>
        $(document).ready(function() {

            Livewire.on('openElectionModal', () => {
                $('#election_modal').modal('show');
            });
        });
            
        


    </script>
@endpush

