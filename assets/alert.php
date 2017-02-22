<?php
global $message, $success;
?>
<br />
<br />
<br />
<?php if ($success) { ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Congratulations!</strong> <?php echo $message; ?>
    </div>
<?php } else { ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Oh snap!</strong> <?php echo $message; ?>
    </div>
<?php } ?>