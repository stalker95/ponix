<section class="login">
    <div class="d-flex flex-column align-items-center mr-auto ml-auto col-10 col-sm-9">
        <div class="info">
            <h1 class="title"><?= __('הירשם') ?></h1>
            <p class="description"><?= __('היכנס כדי להמשיך') ?></p>
        </div>

        <div class="social d-flex flex-row-reverse justify-content-center">
            <a href="" class="social-item"><i class="fab fa-google-plus-g"></i></a>
            <a href="" class="social-item"><i class="fab fa-twitter"></i></a>
            <a href="" class="social-item"><i class="fab fa-facebook-f"></i></a>
        </div>
        <p class="divider"><?= __('או') ?></p>
        <form action="" class="login-form d-flex flex-column flex-nowrap">

            <div class="d-flex flex-column flex-sm-column flex-md-row flex-nowrap justify-content-between align-items-start">
                <div class="form-group">
                    <input type="text" class="form-item" name="username" autocomplete="off" placeholder="<?= __('שם משתמש') ?>">
                </div>
                <div class="form-group">
                    <input type="email" class="form-item" name="email" autocomplete="off" placeholder="<?= __('דוא"ל') ?>">
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-column flex-md-row flex-nowrap justify-content-between align-items-start">

                <div class="form-group">
                    <input type="password" id="password-field" name="password" class="form-item" autocomplete="off" placeholder="<?= __('סיסמה') ?>">
                    <span class="fas fa-eye toggle-password" toggle="#password-field"></span>
                    <i class="fas fa-check-circle">
                        <a href="" class="form-link"><?= __('הישאר מחובר') ?></a>
                    </i>
                </div>

                <div class="form-group">
                    <input type="password" id="confirm-password-field" class="form-item" name="confirm-password"
                           autocomplete="off" placeholder="<?= __('אשר סיסמה') ?>">
                    <span class="fas fa-eye toggle-password" toggle="#confirm-password-field"></span>
                </div>

            </div>

            <div class="form-group d-flex flex-column align-items-center mr-auto ml-auto">
                <input type="submit" class="btn" value="<?= __('צור חשבון') ?>">
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