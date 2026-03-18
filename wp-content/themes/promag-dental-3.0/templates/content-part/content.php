<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<a href="<?=esc_url( get_permalink() );?>">
	<article>
		<h2><?the_title();?></h2>
		<div><?the_excerpt();?>
	</article>
</a>