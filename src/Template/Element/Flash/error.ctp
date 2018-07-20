<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error alert alert-danger alert-dismissable" onclick="this.classList.add('hidden');">
	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
	<?= $message ?>
</div>
