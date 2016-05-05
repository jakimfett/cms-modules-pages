<?php 
if (isset($classed) && $classed) { ?><div class="<?= $classes; ?>"><?php }
if (isset($heading)) { ?><h<?= $heading_level; ?>><?= $heading; ?></h<?= $heading_level; ?>><?php } 
?>
<?= $content; ?>
<?php if (isset($classed) && $classed) { ?></div><?php } 