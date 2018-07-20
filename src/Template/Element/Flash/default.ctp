<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="<?= h($class) ?> alert alert-info alert-dismissable" onclick="this.classList.add('hidden');">
	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
	<?= $message ?>
</div>
