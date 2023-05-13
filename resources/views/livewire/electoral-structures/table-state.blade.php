
<div class="accordion accordion-icon-collapse" id="accordion_structure">
    @php
        $i=0;
    @endphp

    <table class="table table-bordered align-middle table-row-dashed table-row-gray-400 fs-6 gy-3" id="kt_table_widget_4_table">
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

    @foreach($structures as $structure)

        <tr class="accordion-item odd border-bottom-0 bg-secondary">
            <td style="padding-left: 10px">
                <span class="text-gray-900 text-hover-primary">{{ $structure["name"] }}</span>
            </td>
            <td align="right">
                <span class="text-gray-800 text-hover-primary">{{ $structure["promoteds"].' / '.$structure["goal"] }}</span>
            </td>
            <td class="text-end" style="padding-right: 10px">

                <button class="btn btn-sm accordion-button bg-secondary fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion_{{ $i }}_body" aria-expanded="true" aria-controls="accordion_{{ $i }}_body">
                </button>
            </td>

        </tr>

  

            @foreach ($structure['childrens'] as $item)

                <tr id="accordion_{{ $i }}_body" class="accordion-collapse collapse" aria-labelledby="accordion_{{ $i }}_header" data-bs-parent="#accordion_structure">                                
                    <td style="padding-left: 40px">
                        <span class="text-gray-700 text-hover-primary">{{ $item->name }}</span>
                    </td>
                    <td align="right">{{ $item->promoteds.' / '.$item->totalGoal }}</td>
                    <td class="text-end">

                    </td>

                </tr>
                
            @endforeach
        
        
      
        

        @php
            $i++;
        @endphp

    @endforeach

    </table>




</div>


