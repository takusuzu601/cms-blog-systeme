@if ($paginator->hasPages())
<nav class="flexbox mt-30">
@if ($paginator->onFirstPage())
<a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> 戻る</a>
@else 
<a href="{{ $paginator->previousPageUrl() }}" class="btn btn-white"><i class="ti-arrow-left fs-9 mr-4"></i>戻る</a>
@endif

@if ($paginator->hasMorePages())
<a class="btn btn-white" href="{{ $paginator->nextPageUrl() }}">次<i class="ti-arrow-right fs-9 ml-4"></i></a>
@else
<a class="btn btn-white disabled" href="#">次 <i class="ti-arrow-right fs-9 ml-4"></i></a>
@endif

  </nav>
@endif