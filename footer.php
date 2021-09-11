</main>
<footer id="footer" role="contentinfo">
	<p>
		&copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>/"><?php bloginfo('name'); ?></a>, 主题 <a href="https://lms.im/" target="_blank" title="自娱自乐，不亦乐乎！" rel="nofollow">LMS</a><br />
		<?php
			$icp_bei = get_option( 'zh_cn_l10n_icp_num' );
			if($icp_bei) echo '<a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow" title="工业和信息化部ICP/IP地址/域名信息备案管理系统">' .	esc_attr( get_option( 'zh_cn_l10n_icp_num' ) ) . '</a>';
		?>
	</p>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
