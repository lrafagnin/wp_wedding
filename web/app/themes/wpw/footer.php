<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpw
 */

?>

</div><!-- #content -->

<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<span class="copyright">Copyright &copy; Lucas Rafagnin 2016</span>
			</div>
			<div class="col-md-4">
				<ul class="list-inline social-buttons">
					<li><a href="https://www.facebook.com/lrafagnin" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<li><a href="https://au.linkedin.com/in/rafagnin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul class="list-inline quicklinks">
					<li><a href="#page-top" class="page-scroll" data-localize="footer.top">Top</a></li>
				</ul>
			</div>
		</div>
		<?php //dynamic_sidebar('sidebar-footer'); ?>
	</div>
</footer>

</div><!-- #page -->


<div class="info-modal modal fade" id="modal-content" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="close-modal" data-dismiss="modal">
				<div class="lr">
					<div class="rl">
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="modal-body">
							<div id="the_content"></div>

							<button type="button" class="btn btn-primary btn-dismiss" data-dismiss="modal"><i class="fa fa-times"></i> Take me back</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
