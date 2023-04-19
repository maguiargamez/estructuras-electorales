@props([
    'pageTitle'=> "Inicio",
    'pageBreadcrumb' => []
    ])

<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
    {{ $pageTitle }}
</h1>

<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

    @php
        $i=0;
    @endphp

    @foreach ( $pageBreadcrumb as $key => $value )
        @if($i!=0)
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
        @endif
        @if($value!=null)
            <li class="breadcrumb-item text-muted">
                <a href="{{ route($value) }}" class="text-muted text-hover-primary">{{ $key }}</a>
            </li>
        @else
            <li class="breadcrumb-item text-muted">{{ $key }}</li>
        @endif

        @php
            $i++;
        @endphp

    @endforeach

</ul>