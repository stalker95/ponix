<?php
    if (!isset($params['escape']) || $params['escape'] !== false) {
        $message = h($message);
    }
?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> <?php echo (isset($params['title']) ? $params['title'] : __('Success!')); ?></h4>
    <?php echo $message ?>
</div>