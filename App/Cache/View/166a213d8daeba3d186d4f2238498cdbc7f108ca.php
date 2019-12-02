<?php $__env->startSection('css'); ?>
<style>
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Search Result For: <?php echo e($search_term); ?></h1>
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
	<?php $__currentLoopData = $search_result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="row" id="results-rows">
		<?php $__currentLoopData = $result->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php 
				$item->description = isset($item->descitption) ? $item->descitption : 'Not Description';
			?>
		    <div class="col-lg-6 box-language-<?php echo e($result->language); ?>">
				<div class="card shadow mb-4" style="min-height: 240px;">
				    <div class="card-header py-3 border-left-<?php echo e(changeBorderColor($result->language)); ?>">
				        <h6 class="m-0 font-weight-bold text-<?php echo e(changeBorderColor($result->language)); ?>"><a href="<?php echo e(url('auth/repo/detail/')); ?>?repo=<?php echo e(base64_encode($item->url)); ?>"> <?php echo e($item->name); ?> - <?php echo e(strtoupper($result->language)); ?> </a></h6>
				    </div>
				    <div class="card-body">
				        <?php echo strlen($item->description) <= 500 ? $item->description : substr($item->description, 0, 500); ?> ... <a href="<?php echo e(url('auth/repo/detail/')); ?>?repo=<?php echo e(base64_encode($item->url)); ?>"> Read More</a>
				    </div>
				</div>
		    </div>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.base_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/mudah-framework/App/View/auth/search/result.blade.php ENDPATH**/ ?>