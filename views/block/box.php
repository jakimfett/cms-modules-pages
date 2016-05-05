<section id="<?= $id; ?>" class="<?= $classes; ?>">
	<div class="bcg skrollable skrollable-between" <?= $container_tween; ?>>
		<div class="hsContainer">
			<div class="hsContent skrollable skrollable-between<?php if (isset($content_classes)) { echo " " . $content_classes; } ?>" <?= $content_tween; ?>>
				<?php
					if (is_array($content))
						foreach ($content as $element)
							echo $element;
					else
						echo $content;
				?>
			</div>
		</div>
	</div>
</section>