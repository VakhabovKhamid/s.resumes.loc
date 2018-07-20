<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message success alert alert alert-success alert-dismissable" onclick="this.classList.add('hidden')">
	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
	<?= $message ?>
</div>
