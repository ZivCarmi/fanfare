<?php if (!defined('ABSPATH')) exit;
$classes = isset($args['class']) ? $args['class'] : "";
$alt = isset($args['alt']) ? $args['alt'] : "";
?>

<img class="w-12 <?= $classes; ?>" src="<?= wp_get_attachment_url(400); ?>" alt="<?= $alt; ?>">