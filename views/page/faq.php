<div class="center-icon">
    <i class="fa fa-question-circle"></i>
</div>
<div id="faq-maintext">
    <?= $maintext; ?>
</div>
<div id="faq">
    <?php foreach ($faqs as $faq) : ?>
        <?= $faq; ?>
    <?php endforeach; ?>
</div>