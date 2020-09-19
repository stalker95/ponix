<section class="terms">
    <div class="d-flex flex-column align-items-center mr-auto ml-auto col-10 col-sm-9">
        <h1 class="title"><?= __('תנאי השימוש באתר האינטרנט של OmryTV') ?></h1>

        <div class="term-container container d-flex flex-column">
            <?php foreach ($terms as $key => $value): ?>
            <div class="term-item">
            <span class="term-header">
                <?=  $value['title']; ?>
            </span>
                <p class="description">
                    <?= $value['description']; ?>
                </p>
            </div>
            <?php endforeach; ?> 

           

           

           

            

        </div>
    </div>
</section>