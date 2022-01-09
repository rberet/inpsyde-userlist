<?php
get_header();
the_post();
?>

<section id="primary" class="content-area inpsyde-block">
	<main id="main" class="site-main">
		<article id="inpsyde_template" class="format-standard entry inpsyde-template">
			<header class="entry-header">
			<center><h1 class="entry-title">Inpsyde Userlist API showcase</h1></center>
			</header>
			<div class="entry-content">
				<div class="users-table-container" id="users_table_container">
					<table class="users-table" id="users_table">
						<tbody>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Username</th>
								<th>Email</th>
							</tr>
						</tbody>
					</table>
					<div class="loader-container">
						<span class="loader"></span>
					</div>
				</div>
				<div class="user-info" id="details">
					<div class="loader-container">
						<span class="loader"></span>
					</div>
					<h2>User Details</h2>
					<div class="user-details">
					</div>
				</div>
			</div><!-- .entry-content -->
		</article>
	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
?>