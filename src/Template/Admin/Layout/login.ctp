<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo __('Admin') ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?php echo $this->Html->css('admin/bootstrap/dist/css/bootstrap.min.css'); ?>
    <?php echo $this->Html->css('admin/font-awesome/css/font-awesome.min.css'); ?>
    <?php echo $this->Html->css('admin/Ionicons/css/ionicons.min.css'); ?>
    <?php echo $this->Html->css('admin/AdminLTE.min.css'); ?>
    <?php echo $this->Html->css('admin/iCheck/square/blue.css'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    
    <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
    
    <?= $this->fetch('content') ?>

    <?php echo $this->Html->script('admin/jquery/dist/jquery.min.js'); ?>
    <?php echo $this->Html->script('admin/bootstrap/dist/js/bootstrap.min.js'); ?>
    <?php echo $this->Html->script('admin/iCheck/icheck.min.js'); ?>
    <?= $this->Html->css('admin/login.css') ?>
    <?= $this->Html->script('admin/login.js') ?>

    <?= $this->fetch('script') ?>
</body>
</html>