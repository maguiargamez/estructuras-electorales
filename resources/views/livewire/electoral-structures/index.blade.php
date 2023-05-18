<div>
   
    <div  class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">

            <x-breadcrumb 
            :breadcrumb="$breadcrumb"
            :title="$title"
            ></x-breadcrumb>
        

            <!--<div class="d-flex align-items-center gap-2 gap-lg-3 form">
                <x-select 
                wire:model="election_id" 
                id="election_id"
                :options="$elections"
                ></x-select>
            </div>-->

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
                                
                                <span class="text-muted">{{ number_format($promotedNumber) }} </span>/
                                <span class="text-info">{{ number_format($this->electionGoal) }} </span> 
                                
                            </span>
                            
                        </div>
                        <span class="text-gray-500 fs-6 d-block fw-bold">META GENERAL</span>

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


        <div class="card card-flush h-xl-100">
            <div class="card-header pt-7">
                
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Metas</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Avg. 57 orders per day</span>
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

                @include('livewire.electoral-structures.table')


            </div>

        </div>
        
    </div>


</div>
@push('scripts_content')
    <script>
        $(document).ready(function() {
            
        });
    </script>            
@endpush