<?php if (!defined('ABSPATH')) exit; ?>

			</main>
			<footer class="bg-background<?= isset($args['snap']) ? ' snap-start' : ''; ?>">
				<div class="container pb-4 lg:pb-8">
					<div class="pt-4 lg:pt-8<?= isset($args['border_top']) ? ' border-t' : ''; ?>">
						<?php if ($email = get_field('footer_email', 'option')) : ?>
							<a class="uppercase text-[8.8vw] leading-none font-bold cursor-email lg:text-6xl" href="mailto:<?= $email ?>" data-cursor-tooltip="HIT<br />US UP!"><?= $email; ?></a>
						<?php endif; ?>
						<div class="flex flex-col justify-between gap-5 mt-2 text-22px lg:flex-row lg:mt-4 lg:text-36px">
							<?php if ($socials = get_field('footer_socials', 'option')) : ?>
								<ul class="hoverable-content flex items-center flex-wrap gap-5">
									<?php foreach ($socials as $social) : ?>
										<li>
											<a href="<?= $social['link']['url']; ?>" target="<?= $social['link']['target']; ?>">
												<?= $social['link']['title']; ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							<div class="relative flex justify-end grow overflow-hidden">
								<div class="copyright flex items-center group">
									<div class="year transition-transform duration-500 group-hover:-translate-x-40">©<?= date("Y"); ?></div>
									<div class="absolute right-0 opacity-0 translate-x-full transition-all duration-500 group-hover:translate-x-0 group-hover:opacity-100">Hoo Yeaah</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<?php get_template_part('/template-parts/fanfare-form-popup'); ?>

		<div id="site-cursor" class="opacity-0 fixed top-0 left-0 w-30px h-30px pointer-events-none z-cursor [transform:translate3d(50vw,-50px,0)] transition-opacity duration-500 mix-blend-normal will-change-transform">
			<div class="group cursor-circle flex items-center justify-center text-center text-background text-[0.625rem]/[1] italic absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 origin-[50%_50%] w-30px h-30px rounded-full bg-secondary duration-300 [backface-visibility:hidden]">
				<div class="text opacity-0 duration-300"></div>
			</div>
		</div>
		<div id="site-cursor-overlay" class="hidden fixed top-0 left-0 w-30px h-30px pointer-events-none z-[1001] mix-blend-darken contrast-100">
			<div class="cursor-circle absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 origin-[50%_50%] w-30px h-30px rounded-full duration-300 [backface-visibility:hidden] bg-primary"></div>
		</div>

		<?php wp_footer(); ?>

	</body>
</html>
