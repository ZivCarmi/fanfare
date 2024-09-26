<?php if (!defined('ABSPATH')) exit;

$border_top = $args && $args['border_top'];
?>

			</main>
			<footer class="bg-background">
				<div class="container pb-4">
					<div class="pt-4 lg:pt-8<?= $border_top ? ' border-t' : ''; ?>">
						<?php if ($email = get_field('footer_email', 'option')) : ?>
							<a class="uppercase text-[8.8vw] leading-none font-bold lg:text-6xl" href="mailto:<?= $email ?>"><?= $email; ?></a>
						<?php endif; ?>
						<div class="flex flex-col justify-between gap-5 mt-2 text-22px lg:flex-row lg:mt-4 lg:text-36px">
							<?php if ($socials = get_field('footer_socials', 'option')) : ?>
								<ul class="flex items-center flex-wrap gap-5">
									<?php foreach ($socials as $social) : ?>
										<li>
											<a class="relative hover:after:opacity-100 after:opacity-0 after:w-full after:h-[2px] after:absolute after:bottom-0 after:left-0 after:bg-foreground" href="<?= $social['link']['url']; ?>" target="<?= $social['link']['target']; ?>">
												<?= $social['link']['title']; ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							<span class="self-end">©<?= date("Y"); ?></span>
						</div>
					</div>
				</div>
			</footer>
		</div>
		<?php get_template_part('/template-parts/fanfare-form'); ?>

		<?php wp_footer(); ?>

	</body>
</html>
