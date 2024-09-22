<?php if (!defined('ABSPATH')) exit; ?>
		</main>
		<footer class="container">
			<div class="footer-container border-t py-4 lg:pt-8">
				<?php if ($email = get_field('footer_email', 'option')) : ?>
					<a class="uppercase text-3xl font-bold" href="mailto:<?= $email ?>"><?= $email; ?></a>
				<?php endif; ?>
				<div class="flex flex-col justify-between gap-5 mt-2 text-22px lg:flex-row">
					<?php if ($socials = get_field('footer_socials', 'option')) : ?>
						<ul class="flex items-center gap-5">
							<?php foreach ($socials as $social) : ?>
								<li>
									<a href="<?= $social['link']['url']; ?>" target="<?= $social['link']['target']; ?>">
										<?= $social['link']['title']; ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<span class="self-end">©<?= date("Y"); ?></span>
				</div>
			</div>
		</footer>

		<?php get_template_part('/template-parts/fanfare-form'); ?>

		<?php wp_footer(); ?>

	</body>
</html>
