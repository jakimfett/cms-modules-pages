<div class="cols <?= $mode; ?>"<?php
if (isset($id)) {
    echo 'id="' . $id . '"';
}
?>>
    <div class="left<?php if (isset($left_classes)) echo " " . $left_classes; ?>">
        <div class="wrap"><?= $left; ?></div>
    </div>
    <div class="right<?php if (isset($right_classes)) echo " " . $right_classes; ?>">
        <div class="wrap"><?= $right; ?></div>
    </div>
</div>