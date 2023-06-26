<?php

	$max_allowed = 5;

	if(isset($widgetarea_4)):
		foreach ($widgetarea_4 as $widget):
			if (!empty($max_allowed)):
				?>
				<div >
					<?php $this->load->view($widget->widget_path, array('w' => $widget)); ?>
				</div>

				<?php
			endif;
			$max_allowed--;
		endforeach;
	endif;
?>