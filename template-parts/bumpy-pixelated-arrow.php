<?php if (!defined('ABSPATH')) exit;
$classes = isset($args['class']) ? $args['class'] : "";
$alt = isset($args['alt']) ? $args['alt'] : "";
$fields = [
    'bumpy_arrow' => get_field('bumpy_arrow', 'option'),
];
?>

<?php if ($fields['bumpy_arrow']) : ?>
    <img class="hoverable <?= $classes; ?>" src="<?= $fields['bumpy_arrow']['url']; ?>" alt="<?= $alt; ?>">
<?php endif; ?>