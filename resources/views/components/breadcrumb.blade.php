@props([
    'breadcrumb'=> [],    
    'title'=> 'Inicio',    
    ])

<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        {{ $title }}
    </h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        @foreach ($breadcrumb as $key=>$route)
            <li class="breadcrumb-item text-muted">
                @if($route)
                    <a href="{{ route($route) }}" class="text-muted text-hover-primary">{{ $key }}</a>
                @else
                    {{ $key }}
                @endif
            </li>
            @if(!$loop->last)
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
            @endif

        @endforeach
    </ul>
</div>