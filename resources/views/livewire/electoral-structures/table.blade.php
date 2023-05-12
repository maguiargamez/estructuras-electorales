
<div id="kt_table_widget_4_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle table-row-dashed table-row-gray-400 fs-6 gy-3" id="kt_table_widget_4_table">
        <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">&nbsp;</th>
                    <th class="text-end min-w-50px sorting_disabled" rowspan="1" colspan="1" style="width: 91.25px;">META</th>
                    <th class="text-end sorting_disabled" rowspan="1" colspan="1" style="width: 25.6667px;"></th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-bold text-gray-600">

                @foreach ($structures as $tructure)
                    @php
                        $randomName= Str::random(6);
                    @endphp
                    <tr id="kt_accordion_3" class="odd border-bottom-0 bg-secondary">
                        <td style="padding-left: 10px">
                            <span class="text-gray-900 text-hover-primary">{{ $tructure["name"] }}</span>
                        </td>
                        <td align="right">
                            <span class="text-gray-800 text-hover-primary">{{ $tructure["promoteds"].' / '.$tructure["goal"] }}</span>
                        </td>
                        <td class="text-end" style="padding-right: 10px">

                            <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#accordion_body_{{ $randomName }}">
                                <span class="accordion-icon">
                                    <i class="fa fa-plus-square fs-3 accordion-icon-off">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <i class="fa fa-minus-square fs-3 accordion-icon-on">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </button>
                        </td>

                    </tr>

                    @if(array_key_exists("childrens", $tructure))
                        @foreach ($tructure["childrens"] as $municipality)
                            @php
                                $randomName2= Str::random(6);
                            @endphp

                            <tr id="accordion_body_{{ $randomName }}" class="accordion-collapse collapse" class="d-none">
                            
                                <td style="padding-left: 40px">
                                    <span class="text-gray-700 text-hover-primary">{{ $municipality["name"] }}</span>
                                </td>
                                <td align="right">{{ $municipality["promoteds"].' / '.$municipality["goal"] }}</td>
                                <td class="text-end">
                                    <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#accordion_body_{{ $randomName2 }}">
                                        <span class="accordion-icon">
                                            <i class="fa fa-plus-square fs-3 accordion-icon-off">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            <i class="fa fa-minus-square fs-3 accordion-icon-on">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </button>
                                </td>
        
                            </tr>

                            @if(array_key_exists("childrens", $municipality))
                                @foreach ($municipality["childrens"] as $item1)
                                    @php
                                        $randomName3= Str::random(3);
                                    @endphp
                                    <tr id="accordion_body_{{ $randomName2 }}" class="accordion-collapse collapse" class="d-none">
                                
                                        <td style="padding-left: 80px">
                                            <span class="text-gray-600 text-hover-primary">{{ $item1["name"] }}</span>
                                        </td>
                                        <td align="right">{{ $item1["promoteds"].' / '.$item1["goal"] }}</td>
                                        <td class="text-end">
                                            @if(array_key_exists("childrens", $item1))
                                                <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#accordion_body_{{ $randomName3 }}">
                                                    <span class="accordion-icon">
                                                        <i class="fa fa-plus-square fs-3 accordion-icon-off">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                        <i class="fa fa-minus-square fs-3 accordion-icon-on">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </button>
                                            @endif

                                        </td>
                
                                    </tr>

                                    @if(array_key_exists("childrens", $item1))
                                        @foreach ($item1["childrens"] as $item2)
                                            <tr id="accordion_body_{{ $randomName3 }}" class="accordion-collapse collapse" class="d-none">
                                    
                                                <td style="padding-left: 80px">
                                                    <span class="text-gray-600 text-hover-primary">{{ $item2["name"] }}</span>
                                                </td>
                                                <td align="right">{{ $item2["promoteds"].' / '.$item2["goal"] }}</td>
                                                <td class="text-end">

        
                                                </td>
                        
                                            </tr>
                                        @endforeach 
                                    @endif
                                @endforeach

                            @endif

                        @endforeach                        
                    @endif


                @endforeach
            </tbody> 
        </table>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
        </div>
        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
        </div>
    </div>
</div>