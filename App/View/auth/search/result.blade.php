@extends('layout.base_auth')
@section('css')
<style>
</style>
@endsection
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Search Result For: {{ $search_term }}</h1>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="card shadow mb-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Filter by language</h6>
	            </div>
	            <div class="card-body">
	                <div class="row">
	                	<div class="col-lg-2">
	                		<a href="#" class="btn btn-primary btn-icon-split" id="all">
			                    <span class="icon text-white-50">
			                      <i class="fas fa-code"></i>
			                    </span>
			                    <span class="text">All</span>
			                </a>
	                	</div>
	                	<div class="col-lg-2">
	                		<a href="#" class="btn btn-primary btn-icon-split" id="box-language-php">
			                    <span class="icon text-white-50">
			                      <i class="fas fa-code"></i>
			                    </span>
			                    <span class="text">PHP</span>
			                </a>
	                	</div>
	                	<div class="col-lg-2">
	                		<a href="#" class="btn btn-success btn-icon-split" id="box-language-java">
			                    <span class="icon text-white-50">
			                      <i class="fas fa-code"></i>
			                    </span>
			                    <span class="text">Java</span>
			                </a>
	                	</div>
	                	<div class="col-lg-2">
	                		<a href="#" class="btn btn-info btn-icon-split" id="box-language-javascript">
			                    <span class="icon text-white-50">
			                      <i class="fas fa-code"></i>
			                    </span>
			                    <span class="text">JavaScript</span>
			                </a>
	                	</div>
	                	<div class="col-lg-2">
	                		<a href="#" class="btn btn-warning btn-icon-split" id="box-language-c">
			                    <span class="icon text-white-50">
			                      <i class="fas fa-code"></i>
			                    </span>
			                    <span class="text">C</span>
			                </a>
	                	</div>
	                	<div class="col-lg-2">
	                		<a href="#" class="btn btn-danger btn-icon-split" id="box-language-c++">
			                    <span class="icon text-white-50">
			                      <i class="fas fa-code"></i>
			                    </span>
			                    <span class="text">C++</span>
			                </a>
	                	</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	@foreach($search_result as $result)
	<div class="row" id="results-rows">
		@foreach($result->items as $item)
			@php 
				$item->description = isset($item->descitption) ? $item->descitption : 'Not Description';
			@endphp
		    <div class="col-lg-6 box-language-{{ $result->language }}">
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
<script>
	var btns = $('.btn').click(function() {
		if (this.id == 'all') {
		  $('#results-rows > div').fadeIn(450);
		} else {
		  var element = $('.' + this.id).fadeIn(450);
		  $('#results-rows > div').not(element).hide();
		}
		btns.removeClass('active');
		$(this).addClass('active');
	})
</script>
@endsection