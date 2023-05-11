<div>
   
    <div  class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">

            <x-breadcrumb 
            :breadcrumb="$breadcrumb"
            :title="$title"
            ></x-breadcrumb>
        

            <div class="d-flex align-items-center gap-2 gap-lg-3 form">
                <x-select 
                wire:model="election_id" 
                id="election_id"
                :options="$elections"
                ></x-select>
            </div>

        </div>
    </div>

    <div id="kt_app_content_container" class="app-container">
        <div class="card card-flush h-md-100">
            <div class="card-body d-flex flex-column justify-content-between mt-9 bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0" style="background-position: 100% 50%; background-image:url('assets/media/stock/900x600/42.png')">
                <div class="mb-10">
                    <div class="fs-2hx fw-bold text-gray-800 text-center mb-5">
                    <span class="me-2">Elección {{ $election->electionType->description }}
                    <span class="position-relative d-inline-block text-danger">
                        <a href="#" class="text-danger opacity-75-hover">{{ $election->description }}</a>
                        <span class="position-absolute opacity-15 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                    </span></span></div>
                    <div class="text-center">
                        <div class="fs-5x d-flex justify-content-center align-items-start">
                            <span class="lh-sm fw-semibold"> 
                                <span class="text-info">{{ number_format($electionGoal) }} </span> 
                                
                            </span>
                            
                        </div>
                        <span class="text-gray-500 fs-6 d-block fw-bold">META GENERAL</span>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
