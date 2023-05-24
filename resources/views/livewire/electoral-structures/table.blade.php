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
                <th class="min-w-100px sorting_disabled" rowspan="1" colspan="1">&nbsp;</th>
                <th class="text-end min-w-50px sorting_disabled" rowspan="1" colspan="1" style="width: 91.25px;">META</th>
                <th class="text-end sorting_disabled" rowspan="1" colspan="1" style="width: 25.6667px;"></th>
            </tr>
            <!--end::Table row-->
        </thead>

        <tbody class="fw-bold text-gray-700">
            @foreach($structures as $structure)
 
                <tr class="border-dashed border-bottom-2 bg-secondary border-gray-100">

                
                    <td style="padding-left: 10px">
                        <a href="#" class="text-gray-800 text-hover-primary">{{ $structure["name"] }}</a>
                    </td>
                    <td align="right">

                        <span class="@if($structure["promoteds"] > $structure["goal"]) text-success @else text-muted @endif text-hover-primary">
                            {{ $structure["promoteds"] }}
                        </span> / 
                        <span class="text-info text-hover-primary">
                            {{ $structure["goal"] }}
                        </span>

                    </td>
                    <td class="text-end" style="padding-right: 10px">
                    </td>

                </tr>

       

                    @foreach ($structure['childrens'] as $item)



                        <tr class="border-dotted border-bottom-2 border-gray-400">                                
                            <td style="padding-left: 40px">
                                <span class="text-gray-700 text-hover-primary">{{ $item->name }}</span>
                            </td>
                            <td align="right">

                                <span class="@if($item->promoteds > $item->totalGoal) text-success @else text-muted @endif text-hover-primary">
                                    {{ $item->promoteds }}
                                </span> / 
                                <span class="text-info text-hover-primary">
                                    {{ $item->totalGoal }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-icon btn-bg-info btn-active-color-default btn-sm" href="{{ route('estructura.secciones', $item->id) }}"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Secciones">
                                 <span class="svg-icon svg-icon-3 ">
                                    <i class="fa-solid fa-sitemap text-white"></i>
                                 </span>
                                </a>
                            </td>

                        </tr>
                        
                    @endforeach
                
                
            
                

                @php
                    $i++;
                @endphp

            @endforeach
        </tbody>

    </table>

</div>


</div>


