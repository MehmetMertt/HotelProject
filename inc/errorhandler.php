<br>
<?php if(isset($message)): ?>
<div class="container">
    <div class="alert alert-danger alert-dismissible fade show">
        <strong>Error!</strong> <?php echo $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php endif; ?>
<?php if(isset($messageErfolg)): ?>
<div class="container">
    <div class="alert alert-success alert-dismissible fade show">
        <strong>Success!</strong> <?php echo $messageErfolg; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php endif; ?>
<br>