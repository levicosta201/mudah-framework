<?php $__env->startSection('css'); ?>
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-primary shadow h-100 py-2">
	    <div class="card-body">
	      <div class="row no-gutters align-items-center">
	        <div class="col mr-2">
	          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Public Repos</div>
	          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($user_data->public_repos); ?></div>
	        </div>
	        <div class="col-auto">
	          <i class="fab fa-git-alt fa-2x text-gray-300"></i>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-primary shadow h-100 py-2">
	    <div class="card-body">
	      <div class="row no-gutters align-items-center">
	        <div class="col mr-2">
	          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Public Gists</div>
	          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($user_data->public_gists); ?></div>
	        </div>
	        <div class="col-auto">
	          <i class="fas fa-code fa-2x text-gray-300"></i>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-primary shadow h-100 py-2">
	    <div class="card-body">
	      <div class="row no-gutters align-items-center">
	        <div class="col mr-2">
	          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Followers</div>
	          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($user_data->followers); ?></div>
	        </div>
	        <div class="col-auto">
	          <i class="fas fa-users fa-2x text-gray-300"></i>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-primary shadow h-100 py-2">
	    <div class="card-body">
	      <div class="row no-gutters align-items-center">
	        <div class="col mr-2">
	          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Following</div>
	          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($user_data->following); ?></div>
	        </div>
	        <div class="col-auto">
	          <i class="fas fa-users fa-2x text-gray-300"></i>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 col-md-12 mb-12">
		<!-- DataTales Example -->
		<div class="card shadow mb-12">
		    <div class="card-header py-3">
		        <h6 class="m-0 font-weight-bold text-primary">Your Repos</h6>
		    </div>
		    <div class="card-body">
		        <div class="table-responsive">
		            <table class="table table-bordered" id="repos-table" width="100%" cellspacing="0">
		                <thead>
		                    <tr>
		                        <th>Name</th>
		                        <th>Privacity</th>
		                        <th>Description</th>
		                        <th>Language</th>
		                        <th>Action</th>
		                    </tr>
		                </thead>
		                <tfoot>
		                    <tr>
		                        <th>Name</th>
		                        <th>Privacity</th>
		                        <th>Description</th>
		                        <th>Language</th>
		                        <th>Action</th>
		                    </tr>
		                </tfoot>
		                <tbody>
		                	<?php $__currentLoopData = $repos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                    <tr>
			                        <td><a href="<?php echo e($repo->html_url); ?>" target="_blank"><?php echo e($repo->name); ?></a></td>
			                        <td class=""><?php echo e(strtoupper($repo->private ? 'Private' : 'Public')); ?></td>
			                        <td><?php echo e($repo->description); ?></td>
			                        <td><?php echo e($repo->language ?? 'Not Identified'); ?></td>
			                        <td><a href="<?php echo e(url('auth/repo/detail/')); ?>?repo=<?php echo e(base64_encode($repo->url)); ?>">Detail</a></td>
			                    </tr>
		                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                </tbody>
		            </table>
		        </div>
		    </div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- Page level plugins -->
<script src="<?php echo e(url('dashboard/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(url('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script>
	$(document).ready(function() {
	  $('#repos-table').DataTable();
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.base_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/mudah-framework/App/View/auth/dashboard/index.blade.php ENDPATH**/ ?>