<section class="faq">
    <div class="d-flex flex-column align-items-center mr-auto ml-auto col-10 col-sm-9 col-lg-7">
        <h1 class="title"><?= $title[0]['title'] ?></h1>

        <div class="faq-container container d-flex flex-column">
           <?php foreach ($faq as $key => $value): ?>
            <div class="faq-item">
                <div class="faq-header">
                <?= $value['title'] ?>
                <i class="fas fa-chevron-down"></i>
            </div>
            <ul class="description desc-show">
                <?= $value['description'] ?>
            </ul>
            </div>
        <?php endforeach; ?>

       

       

        
    </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $(".faq-item").click(function () {
            $(this).children(".description").toggleClass("show");
            $(this).find('.fas.fa-chevron-down').toggleClass("faq-rotate");
        });
    });


</script>