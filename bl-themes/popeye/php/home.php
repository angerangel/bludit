<header class="p-3">
	<div class="container text-center">

		<!-- Site logo -->
		<div class="site-logo">
			<img class="img-thumbnail rounded-circle mx-auto d-block" height="150px" width="150px" src="<?php echo ($site->logo()?$site->logo():HTML_PATH_THEME_IMG.'logo.svg') ?>" alt="">
		</div>
		<!-- End Site logo -->

		<!-- Site description -->
		<?php if ($site->description()) : ?>
			<div class="site-description mt-2">
				<p><?php echo $site->description(); ?></p>
			</div>
		<?php endif ?>
		<!-- End Site description -->

	</div>
</header>

<!-- Print all the content -->
<section class="mt-4 mb-4">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">

				<!-- Search input -->
				<?php if (pluginActivated('pluginSearch')): ?>
				<form class="d-flex mb-4">
					<input id="search-input" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-primary" type="button" onClick="searchNow()">Search</button>
				</form>
				<script>
					function searchNow() {
						var searchURL = "<?php echo HTML::siteUrl(); ?>search/";
						window.open(searchURL + document.getElementById("search-input").value, "_self");
					}
					document.getElementById("search-input").onkeypress = function(e) {
						if (!e) e = window.event;
						var keyCode = e.keyCode || e.which;
						if (keyCode == '13') {
							searchNow();
							return false;
						}
					}
				</script>
				<?php endif ?>
				<!-- End Search input -->

				<!-- Content not available -->
				<?php if (empty($content)) : ?>
					<div class="text-center p-4">
						<h3><?php $language->p('No pages found') ?></h3>
					</div>
				<?php endif ?>
				<!-- End Content not available -->

				<!-- Pages -->
				<div class="list-group list-group-flush">
					<?php foreach ($content as $tmp) : ?>
						<div class="list-group-item pt-4 pb-4" aria-current="true">
							<div class="d-flex w-100 justify-content-between">

								<!-- Page title -->
								<a href="<?php echo $tmp->url() ?>">
									<h5 class="mb-1"><?php echo $tmp->title() ?></h5>
								</a>
								<!-- End Page title -->

								<!-- Page date -->
								<small class="color-blue"><?php echo $tmp->relativeTime() ?></small>
								<!-- End Page date -->

							</div>

							<!-- Page description -->
							<?php if ($tmp->description()): ?>
							<p class="mb-1 form-text"><?php echo $tmp->description(); ?></p>
							<?php endif ?>
							<!-- End Page description -->

							<!-- Page tags -->
							<?php
							$tagsList = $tmp->tags(true);
							if (!empty($tagsList)) {
								echo '<small>';
								foreach ($tagsList as $tagKey => $tagName) {
									echo '<a class="badge bg-gray text-dark text-decoration-none me-2" href="' . DOMAIN_TAGS . $tagKey . '">' . $tagName . '</a>';
								}
								echo '</small>';
							}
							?>
							<!-- End Page tags -->

						</div>
					<?php endforeach ?>
				</div>
				<!-- End Pages -->

				<!-- Pagination -->
				<?php if (Paginator::numberOfPages() > 1) : ?>
					<nav class="mt-4">
						<ul class="pagination pagination-sm">

							<!-- Older pages -->
							<?php if (Paginator::showNext()) : ?>
							<li class="page-item">
								<a class="page-link" href="<?php echo Paginator::nextPageUrl() ?>">&#9664; <?php echo $L->get('Previous'); ?></a>
							</li>
							<?php endif; ?>
							<!-- End Older pages -->

							<!-- Newer pages -->
							<?php if (Paginator::showPrev()) : ?>
							<li class="page-item ms-auto">
								<a class="page-link" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1"><?php echo $L->get('Next'); ?> &#9658;</a>
							</li>
							<?php endif; ?>
							<!-- End Newer pages -->

						</ul>
					</nav>
				<?php endif ?>
				<!-- End Pagination -->

			</div>
		</div>
	</div>
</section>
<!-- End Print all the content -->