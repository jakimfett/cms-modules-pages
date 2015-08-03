<div id="tagline">
    <h1>
        <?php if (isset($mediatitle)) : ?>
            <?= trim($mediatitle); ?>
        <?php endif; ?>
    </h1>
</div>
<div id="video-pitch">
    <?php if (isset($video)) : ?>
        <?= trim($video); ?>
    <?php endif; ?>
</div>

<div id="tagline">
    <h1>
        <?php if (isset($fivewords)) : ?>
            <?= trim($fivewords); ?>
        <?php endif; ?>
    </h1>
</div>

<div id="rooms">

    <div>
        <img src="media/labyrinth/images/inheritance.png"/>
        <?= trim($lroom); ?>
    </div>
    <div>
        <img src="media/labyrinth/images/horror.png"/>
        <?= trim($rroom); ?>
    </div>
</div>
<div id="blurbs">
    <div id="blurb-left">
        <div class="circle">
            <i class="fa fa-cogs"></i>
        </div>
        <?= trim($blurbleft); ?>
    </div>
    <div id="blurb-center">
        <div class="circle">
            <i class="fa fa-leanpub"></i>
        </div>
        <?= trim($blurbcenter); ?>
    </div>
    <div id="blurb-right">
        <div class="circle">
            <i class="fa fa-key"></i>
        </div>
        <?= trim($blurbright); ?>
    </div>
</div>