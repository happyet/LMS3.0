<?php
/*
Template Name: Links
*/
?>
<?php get_header(); ?>
<div id="content" class="widecolumn" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="single-post post">
			<h2 class="post-title"><?php the_title(); ?></h2>
			<div class="post-meta">
				<span><?php the_time(__('Y年m月j日')) ?></span>
				<span><?php lmsim_theme_views(); ?> 浏览</span> 
				<span><?php comments_popup_link('0 评论', '1 评论', '% 评论', '', '评论已关闭'); ?></span>
			</div>
			<div class="entry">
				<?php the_content(); ?>
                <div class="links-entry"><?php wp_list_bookmarks(); ?></div>
			</div>
		</div>
		<?php comments_template(); ?>
	<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>