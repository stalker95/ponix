<section class="login">
    <div class="d-flex flex-column align-items-center mr-auto ml-auto col-10 col-sm-9">
        <div class="info">
            <h1 class="title"><?= __('התחבר') ?></h1>
            <p class="description"><?= __('היכנס כדי להמשיך') ?></p>
        </div>

        <div class="social d-flex flex-row-reverse justify-content-center">
            <a href="" class="social-item"><i class="fab fa-google-plus-g"></i></a>
            <a href="" class="social-item"><i class="fab fa-twitter"></i></a>
            <a href="" class="social-item"><i class="fab fa-facebook-f"></i></a>
        </div>
        <p class="divider"><?= __('או') ?></p>
         <form action="<?= \Cake\Routing\Router::url(array("controller" => "login", "action" => "login")); ?>" class="login-form d-flex flex-column flex-nowrap" method="POST">


            <div class="d-flex flex-column flex-sm-column flex-md-row flex-nowrap justify-content-between align-items-center">
                <div class="form-group">
                    <input type="text" class="form-item" placeholder="<?= __('שם משתמש או דואל') ?>">
                    <i class="fas fa-check-circle">
                        <a href="" class="form-link"><?= __('הישאר מחובר') ?></a>
                    </i>
                </div>

                <div class="form-group">
                    <input type="password" id="password-field" class="form-item" placeholder="<?= __('סיסמה') ?>">
                    <span class="fas fa-eye toggle-password" toggle="#password-field"></span>
                    <a href="" class="form-link"><?= __('שכחת את הסיסמא') ?></a>
                </div>
            </div>

            <div class="form-group d-flex flex-column align-items-center mr-auto ml-auto">
                <input type="submit" class="btn" value="<?= __('התחברות') ?>">
               <!-- <p class="description"><?= __('לא חברים?') ?>
                    <?= $this->Html->link('הרשם עכשיו', ['controller' => 'signup', 'action' => 'index'], ['class' => 'form-link']) ?>
                </p> -->
            </div>
        </form>
    </div>
</section>

<script>
    $(".toggle-password").click(function () {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $(".header").css({"position": "absolute", "background": "transparent", "box-shadow": "none", "width": "100%"});
    $(".nav .nav-item .nav-link").css({"color": "#fff"});
</script>