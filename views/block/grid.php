<div class="grid <?= $mode; ?>"<?php if (isset($id)) { echo 'id="' . $id . '"'; } ?>>
	<?php if (isset($one)) { echo "<div>" . $one . "</div>"; } ?>
	<?php if (isset($two)) { echo "<div>" . $two . "</div>"; } ?>
	<?php if (isset($three)) { echo "<div>" . $three . "</div>"; } ?>
	<?php if (isset($four)) { echo "<div>" . $four . "</div>"; } ?>
</div>