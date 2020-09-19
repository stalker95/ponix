<div class="header-player">
    <div class="container">
        <div class="header-content">
            <div class="col-3 col-xs-3 col-md-2 col-lg-2 p-0">
                <?= $this->Html->link('', ['controller' => 'main', 'action' => 'index'], ['class' => 'logo-player']) ?>
            </div>
            <div class="search">
                <input type="search" placeholder="<?= __('לחפש') ?>">
                <i class="fas fa-search"></i>
            </div>
            <?= $this->element('user_nav'); ?>
        </div>
    </div>
</div>
