<div>
    <div  class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <x-breadcrumb 
            :breadcrumb="$breadcrumb"
            :title="$title"
            ></x-breadcrumb>

            <a href="{{ route('coordinadores.create') }}" type="button" class="btn btn-sm btn-primary">
                <i class="fa-solid fa-user-tie"></i>   
                Crear coordinador
            </a>
        </div>

    </div>

    <div id="kt_app_content_container" class="app-container">

        <div class="card card-custom card-flush h-xl-100">
            <div class="card-header pt-7">                
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Información del coordinador</span>                    
                </h3>
            </div>

            <div class="card-body pt-2">

                @if(session('flashError'))
                    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">          
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-danger">Error!</h4>
                            <span>{{ session('flashError') }}</span>
                        </div>
                        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endif

                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tipo de coordinador</label>
                    <div class="col-lg-8">
                        <div class="row">

                            <div class="input-group mb-5">


                                <x-select wire:model="positionId" :options="$positions" placeholder="Seleccionar" id="positionId"></x-select>
                                @error('positionId')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror 

                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Distrito</label>
                    <div class="col-lg-8">
                        <div class="row">

                            <div class="input-group mb-5">


                                <x-select wire:model="structureCoordinator.local_district" :options="$localDistricts" placeholder="Seleccionar" id="local_district"></x-select>
                                @error('structureCoordinator.local_district')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror 

                            </div>

                        </div>
                    </div>
                </div>

                @if($positionId==3)
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Municipio</label>
                        <div class="col-lg-8">
                            <div class="row">

                                <div class="input-group mb-5">


                                    <x-select wire:model="structureCoordinator.municipality_key" :options="$municipalities" placeholder="Seleccionar" id="municipality_key"></x-select>
                                    @error('structureCoordinator.municipality_key')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror 

                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                <!--<div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Distrito</label>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                <input type="text" name="fname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="Max">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                <input type="text" name="lname" class="form-control form-control-lg form-control-solid" placeholder="Last name" value="Smith">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                    </div>
                </div>-->


                <label class="col-lg-2 col-form-label fw-semibold fs-6">Nombre del árbol</label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-list-ol"></i></span>
                            <input wire:model="tree.tree_name" type="text" class="form-control @error('tree.tree_name') is-invalid @enderror">  
                            
                            @error('tree.tree_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                </div>



            </div>

        </div>

    </div>
</div>
