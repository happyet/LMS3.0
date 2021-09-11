<?php get_header(); ?>
<div id="content" class="narrowcolumn" role="main">
	<div id="nav">
		<a href="<?php echo get_option('home'); ?>/">首页</a>
		<?php  if (is_category()) { ?> » <?php single_cat_title(); ?><?php } ?>
		<?php  if( is_tag() ) { ?> » Posts Tagged "<?php single_tag_title(); ?>"<?php } ?>
		<?php  if (is_date()) { ?> » Archive for <?php the_time('Y年m月'); ?><?php } ?>
	</div>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h2>
				<div class="post-excerpt">
					<?php 
						if(preg_match('/<!--more.*?-->/',$post->post_content)){
							the_content('', TRUE);
						}else{
							if( has_post_thumbnail() ){
								echo '<p class="text-center">';
									the_post_thumbnail();
								echo '</p>';
							}
							the_excerpt();
						}
					?>	
				</div>
				<div class="post-meta">
					<?php if(is_sticky()) echo '<span class="tj">推荐</span>'; ?>
					<span><?php the_time(__('Y年m月j日')) ?></span>
					<span><?php the_category(','); ?></span>
					<span><?php lmsim_theme_views(); ?> 浏览</span> 
					<span><?php comments_popup_link('0 评论', '1 评论', '% 评论', '', '评论已关闭'); ?></span>
				</div>
			</div>
		<?php endwhile; ?>
		<?php the_posts_pagination(); ?>
		</nav>
	<?php else : ?>
		<h2 class="center"><?php _e('Not Found'); ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that isn&#8217;t here.'); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>