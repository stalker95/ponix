<?php
  if (!isset($is_forgot)) {
    $is_forgot = false;
  }

  $this->assign('title', __('Login'));
?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo $this->Url->build(['controller' => 'main', 'action' => 'index', 'prefix' => false, '_full' => true]); ?>"><b>Omry</b>TV</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body flip-container <?= $is_forgot ? 'flip' : '' ?>">
    <?= $this->Flash->render() ?>
    <div class="flipper">      
      <div class="login-panel" style="<?= $is_forgot ? 'display: none;' : '' ?>">
        <p class="login-box-msg"><?php echo __('Sign in to start your session') ?></p>        
        <?php echo $this->Form->create(null, array('type' => 'POST', 'url' => ['action' => 'login', 'prefix' => 'admin', '?' => $this->request->getQuery(), '_full' => true])); ?>
          <div class="form-group has-feedback">
            <?php 
              echo $this->Form->control(
                'mail',
                array(
                  'type' => 'email',
                  'class' => 'form-control',
                  'placeholder' => __('Email'),
                  'label' => false,
                  'div' => false,
                )
              );
            ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        <?php echo $this->Form->end(); ?>
        <a href="#" onclick="displayForgotPassword(); return false;">I forgot my password</a><br>
      </div>
      <div class="forgot-panel" style="<?= $is_forgot ? 'display: block;' : '' ?>">
        <div class="alert alert-info alert-dismissible" style="    background-color: #3c8dbc !important;">
          <h4><i class="icon fa fa-question-circle"></i> <?= __('Forgot your password?') ?></h4>
          <?= __('In order to receive your access code by email, please enter the address you provided during the registration process.') ?>
        </div>
        <?php echo $this->Form->create(null, array('url' => ['controller' => 'users', 'action' => 'forgot', 'prefix' => 'admin', '_full' => true], 'type' => 'POST')); ?>
          <div class="form-group has-feedback">
            <!--<input type="email" class="form-control" placeholder="Email"> -->
            <?php 
              echo $this->Form->control(
                'mail',
                array(
                  'id' => 'email_forgot',
                  'type' => 'email',
                  'class' => 'form-control',
                  'placeholder' => __('Email'),
                  'label' => false,
                  'div' => false,
                  'required' => true,
                )
              );
            ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <a href="#" onclick="displayLogin(); return false;"><?= __('Back to login') ?></a>
            </div>
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><?= __('Send') ?></button>
            </div>
          </div>
        <?= $this->Form->end(); ?>
      </div>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php echo $this->Html->scriptStart(['block' => true]); ?>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
<?php echo $this->Html->scriptEnd(); ?>