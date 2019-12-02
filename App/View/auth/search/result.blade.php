@extends('layout.base_auth')
@section('css')
<style>
</style>
@endsection
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Search Result For: {{ $search_term }}</h1>

	@foreach($search_result as $result)
	<div class="row">
		@foreach($result->items as $item)
			@if(!$item->description)
				@php continue; @endphp
			@endif
		    <div class="col-lg-6">
				<div class="card shadow mb-4" style="min-height: 240px;">
				    <div class="card-header py-3 border-left-{{ changeBorderColor($result->language) }}">
				        <h6 class="m-0 font-weight-bold text-{{ changeBorderColor($result->language) }}"><a href="{{ url('auth/repo/detail/') }}?repo={{ base64_encode($item->url) }}"> {{ $item->name }} - {{ strtoupper($result->language) }} </a></h6>
				    </div>
				    <div class="card-body">
				        {!! strlen($item->description) <= 500 ? $item->description : substr($item->description, 0, 500) !!} ... <a href="{{ url('auth/repo/detail/') }}?repo={{ base64_encode($item->url) }}"> Read More</a>
				    </div>
				</div>
		    </div>
	    @endforeach
    </div>
    @endforeach
@endsection
@section('script')

@endsection