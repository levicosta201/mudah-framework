<form action="<?php echo e(url('auth/search/')); ?>" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" name="q" placeholder="Search for..." value="<?php echo e(@$search_term); ?>" aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form><?php /**PATH /var/www/mudah-framework/App/View/layout/static/top_search.blade.php ENDPATH**/ ?>