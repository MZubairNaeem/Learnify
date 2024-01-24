<!-- Success Session Message -->
<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> <?php echo e($message); ?>

  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Warning Session Message -->
<?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Warning!</strong> <?php echo e($message); ?>

  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<script>
  
  //Hide Session Message after 5 seconds
  setTimeout(function() {
    $('.alert').alert('close');
  }, 5000);
  
</script><?php /**PATH Z:\ZappFinity\LMS\learnify\resources\views/partials/session.blade.php ENDPATH**/ ?>