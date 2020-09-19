<?php
  if (!isset($is_forgot)) {
    $is_forgot = false;
  }

  $this->assign('title', __('Login'));
?>
<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body flip-container <?= $is_forgot ? 'flip' : '' ?>">
    <?= $this->Flash->render() ?>
    <div class="login_images">
      <img src="<?= $baseUrl ?>/img/pr_logo_one.png      " alt="  ">
      <img src="<?= $baseUrl ?>/img/pr_logo_two.png      " alt="  ">
    </div>
    <div class="flipper">      
      <div class="login-panel" style="<?= $is_forgot ? 'display: none;' : '' ?>">
        <p class="login-box-msg"><?php echo __('Для входу в систему введіть логін і пароль') ?></p>        
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
            <input type="password" name="password" class="form-control" placeholder="Пароль">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label >
                  <input type="checkbox" style="margin-right: 20px;">Запам'ятати мене
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn  btn-block btn-flat login_to_admin">Увійти</button>
            </div>
            <!-- /.col -->
          </div>
        <?php echo $this->Form->end(); ?>
        <a href="#" onclick="displayForgotPassword(); return false;" style="font-size: 11px;">Забули пароль</a><br>
      </div>
      <div class="forgot-panel" style="<?= $is_forgot ? 'display: block;' : '' ?>">
        <div class="alert alert-info alert-dismissible" style="    background-color: #3c8dbc !important;">
          <h4><i class="icon fa fa-question-circle"></i> <?= __('Забули свій пароль?') ?></h4>
          <?= __('Щоб отримати код доступу електронною поштою, введіть адресу, яку ви вказали під час реєстрації.') ?>
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
              <a href="#" onclick="displayLogin(); return false;"><?= __('Назад до авторизації') ?></a>
            </div>
            <div class="col-xs-4">
              <button type="submit" class="btn  btn-block btn-flat login_to_admin"><?= __('Надіслати') ?></button>
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