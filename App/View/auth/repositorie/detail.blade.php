@extends('layout.base_auth')
@section('css')
<style>
	#fontSizeWrapper { font-size: 16px; }

#fontSize {
  width: 100px;
  font-size: 1em;
  }

/* ————————————————————–
  Tree core styles
*/
.tree { margin: 1em; }

.tree input {
  position: absolute;
  clip: rect(0, 0, 0, 0);
  }

.tree input ~ ul { display: none; }

.tree input:checked ~ ul { display: block; }

/* ————————————————————–
  Tree rows
*/
.tree li {
  line-height: 1.2;
  position: relative;
  padding: 0 0 1em 1em;
  }

.tree ul li { padding: 1em 0 0 1em; }

.tree > li:last-child { padding-bottom: 0; }

/* ————————————————————–
  Tree labels
*/
.tree_label {
  position: relative;
  display: inline-block;
  background: #fff;
  }

label.tree_label { cursor: pointer; }

label.tree_label:hover { color: #666; }

/* ————————————————————–
  Tree expanded icon
*/
label.tree_label:before {
  background: #000;
  color: #fff;
  position: relative;
  z-index: 1;
  float: left;
  margin: 0 1em 0 -2em;
  width: 1em;
  height: 1em;
  border-radius: 1em;
  content: '+';
  text-align: center;
  line-height: .9em;
  }

:checked ~ label.tree_label:before { content: '–'; }

/* ————————————————————–
  Tree branches
*/
.tree li:before {
  position: absolute;
  top: 0;
  bottom: 0;
  left: -.5em;
  display: block;
  width: 0;
  border-left: 1px solid #777;
  content: "";
  }

.tree_label:after {
  position: absolute;
  top: 0;
  left: -1.5em;
  display: block;
  height: 0.5em;
  width: 1em;
  border-bottom: 1px solid #777;
  border-left: 1px solid #777;
  border-radius: 0 0 0 .3em;
  content: '';
  }

label.tree_label:after { border-bottom: 0; }

:checked ~ label.tree_label:after {
  border-radius: 0 .3em 0 0;
  border-top: 1px solid #777;
  border-right: 1px solid #777;
  border-bottom: 0;
  border-left: 0;
  bottom: 0;
  top: 0.5em;
  height: auto;
  }

.tree li:last-child:before {
  height: 1em;
  bottom: auto;
  }

.tree > li:last-child:before { display: none; }

.tree_custom {
  display: block;
  background: #eee;
  padding: 1em;
  border-radius: 0.3em;
}
</style>
@endsection
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fab fa-git-alt fa-2x text-gray-300"></i> {{ $repo_detail->name }}</h1>
    <small>{{ $repo_detail->description }}</small>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Author: {{ $repo_detail->owner->login }}</h1>
</div>
<div class="row">
    <div class="col-3">
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-3">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Branhces</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
					<ul class="tree">
						@foreach($repo_branches as $branch)
						    <li>
						        <input type="checkbox" id="{{ $branch->name }}" />
						        <label class="tree_label" for="{{ $branch->name }}">{{ $branch->name }}</label>
						    </li>
					    @endforeach
					</ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-6">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Description</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
					       <p>{{ $repo_detail->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection