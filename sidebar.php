<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
<div id="sidebar">
	<div class="sidebar-inner">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div>
<?php endif; ?>