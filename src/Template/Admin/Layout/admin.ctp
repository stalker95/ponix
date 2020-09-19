<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo __('Admin') ?> | <?= $this->fetch('title') ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?= $this->Url->build('/settings/'.$settings->favicon, ['fullBase' => true]) ?>" type="image/x-icon">
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="admin/bootstrap/dist/css/bootstrap.min.css"> -->
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="admin/font-awesome/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="admin/Ionicons/css/ionicons.min.css"> -->
  <!-- jvectormap -->
  <!-- <link rel="stylesheet" href="admin/jvectormap/jquery-jvectormap.css"> -->
<link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<?php
  echo $this->Html->css('admin/bootstrap/dist/css/bootstrap.min.css');
  echo $this->Html->css('admin/font-awesome/css/font-awesome.min.css');
  echo $this->Html->css('admin/Ionicons/css/ionicons.min.css');
  echo $this->Html->css('admin/AdminLTE.min.css'); 
  echo $this->Html->css('admin/_all-skins.min.css');
  echo $this->Html->css('admin/morris.css');
  echo $this->Html->css('admin/jvectormap/jquery-jvectormap.css');
  echo $this->Html->css('admin/jvectormap/bootstrap-datepicker.min.css');

  echo $this->Html->css('admin/bootstrap/dist/css/daterangepicker.css');
  echo $this->Html->css('admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
 echo $this->Html->css('admin/custom.css');

?>

  <!-- Theme style -->

  <!-- AdminLTE Skins. Choose a skin from the css/skins1
       folder instead of downloading all of them to reduce the load. -->

    <?php echo $this->Html->css('admin/dataTables.bootstrap.min.css'); ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"> -->

  <script type="text/javascript">
    var baseUrl = '<?php echo $baseUrl; ?>',
      user= '<?php echo json_encode($user); ?>   ',
      employee_id = ' ';
  </script>
          <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>
<body class="hold-transition <?= $employee->getTheme(); ?> sidebar-mini">
  
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo $baseUrl; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <?= $_SERVER['SERVER_NAME'] ?>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <div class="search_product"> 
          <?= $this->Form->create('',['url'   => array(
               'controller' => 'products','action' => 'search','method' => 'post'
           )])  ?>
           <i class="fa fa-search">  </i>
           <input type="text" name="name">
            <?=   $this->Form->end() ?>
         </div>
        <div class="currency_curs">
          <div class="currency_curs_title">
            курс валют
          </div> 
          <?php if ($currency->type == 2){ ?> 
          <div class="currency_curs_item">
            USD: <?= $currency->value_dollar ?>
          </div>
          <div class="currency_curs_item">
            EUR: <?= $currency->value ?>
          </div>
        <?php } else { ?>
      <div class="currency_curs_item">
            USD: <span class="translate_price" data-currency="3">1</span>
          </div>
          <div class="currency_curs_item">
            EUR: <span class="translate_price" data-currency="2">1</span>
          </div>
        <?php } ?>
        </div>
        <ul class="nav navbar-nav">

          <?php if (false && $employee->isMaster()) : ?>
            <li class="dropdown messages-menu" style="">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="notify_show_companies();return false;">
                <i class="fa fa-building"></i>
                <span class="label label-success">N</span>
              </a>
              <ul class="dropdown-menu">
                <li id="n_companies_header" class="header"></li>
                <li id="n_companies_content" class="load">
                  <i id="req-spinner" class="fa fa-spinner fa-spin"></i>
                </li>
                <li class="footer">
                  <?= $this->Html->link(__('See all companies'), ['controller' => 'companies', 'action' => 'index', 'prefix' => 'admin', 'plugin' => false, '_full' => true]) ?>
                </li>
              </ul>
            </li>
          <?php endif; ?>
          <!-- Notifications: style can be found in dropdown.less -->
          <?php if (false): ?>
          <li class="dropdown notifications-menu" style="display: none;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu" style=" display: none;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <!-- User Account: style can be found in dropdown.less -->
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               
             <?php echo $this->Html->image($employee->getAvatar(), ['class' => 'user-image', 'alt' => __('User Image')]); ?>
              <span class="hidden-xs"><?php echo trim($employee->firstname.' '.$employee->lastname); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                
               <?php echo $this->Html->image($employee->getAvatar(), ['class' => 'img-circle', 'alt' => __('User Image')]); ?> 

                <p>
                  <?php echo trim($employee->firstname.' '.$employee->lastname); ?><!-- - Web Developer -->
                  <!--<small>Member since Nov. 2012</small> -->
                </p>
              </li>
              <!-- Menu Body -->
              <!--<li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $this->Url->build(['controller' => 'settings', 'action' => 'edit', 'plugin' => false]); ?>" class="btn btn-default btn-flat"><?php echo __('Profile'); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'logout', 'prefix' => 'admin', '_full' => true, 'plugin' => false]); ?>" class="btn btn-default btn-flat"><?php echo __('Sign out') ?></a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" >
    <?php echo $this->element('admin_left_sidebar'); ?>
  </aside>



    <!-- Main content -->
    <section class="content-wrapper">
      <div class="container" style="padding-top: 15px;">
      <?php echo $this->Flash->render(); ?>
      </div>
      <?php echo $this->fetch('content'); ?>
    </section>


  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Розроблено компанією Project Solution</strong>
  </footer>

</div>
<!-- ./wrapper -->
  <?php echo $this->Html->css('admin/custom.css') ?>

  <!-- jQuery 3 -->
  <?php echo $this->Html->script('admin/jquery/dist/jquery.min.js'); ?>
  <?php echo $this->Html->script('admin/jquery/dist/jquery-ui.js'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js">  </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <?php echo $this->Html->script('admin/bootstrap/dist/js/bootstrap.min.js'); ?>
  <?php  echo $this->Html->script('admin/raphael/raphael.js'); ?>
  <?php  echo $this->Html->script('admin/chart.js/Chart.js'); ?>
  <?php  echo $this->Html->script('admin/morris.js/morris.js'); ?> 
  <!-- FastClick -->
  <?php  echo $this->Html->script('admin/jquery.sparkline/jquery.sparkline.min.js'); ?> 

  <?php  echo $this->Html->script('admin/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?> 
    <?php  echo $this->Html->script('admin/jvectormap/jquery-jvectormap-world-mill-en.js'); ?> 
    <?php  echo $this->Html->script('admin/jquery.knob.min.js'); ?> 

  <?php echo $this->Html->script('admin/fastclick/lib/fastclick.js'); ?>

  <!-- AdminLTE App -->
  <?php echo $this->Html->script('admin/dist/js/adminlte.min.js'); ?>
   
  <!-- Sparkline -->

  <!-- jvectormap  -->
  <!-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->

  <!-- SlimScroll -->
  <?php echo $this->Html->script('admin/jquery-slimscroll/jquery.slimscroll.min.js'); ?>

  <!-- ChartJS -->
  <?php echo $this->Html->script('admin/chart.js/Chart.js'); ?>

  <?php echo $this->Html->script('admin/dist/js/demo.js'); ?>
<?php echo $this->Html->script('admin/admin.js'); ?>

  <?= $this->fetch('scriptBottom') ?>
    <script>
      $(".dropdown-toggle").click(function() {
        $(this).parent().find(".dropdown-menu-notification").slideToggle();
      });

          setTimeout(function() {
var flickerAPI = "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5";
  $.getJSON( flickerAPI, {
    tags: "mount rainier",
    tagmode: "any",
    format: "json"
  })
  .done(function(data) {
    global_curs = data[1]['buy'];
    global_curs_dollar = data[0]['buy'];
    console.log(data);
   $(".translate_price").each(function() {
        var price= parseInt($(this).text());
        if ($(this).attr('data-currency') == 2) {
        $(this).text((price * global_curs).toFixed(2));
      }
      if ($(this).attr('data-currency') == 3) {
        $(this).text((price * global_curs_dollar).toFixed(2));
      }
        $(this).css("opacity","1");
    });

     $(".translate_price_two").each(function() {
        var price= parseInt($(this).text());
        if ($(this).attr('data-currency') == 2) {
        $(this).text((price * global_curs).toFixed(2));
      }
      if ($(this).attr('data-currency') == 3) {
        $(this).text((price * global_curs_dollar).toFixed(2));
      }
        $(this).css("opacity","1");
    });

  })
}, 500);

    </script>
  <?= $this->fetch('script') ?>
  
</body>
</html>
