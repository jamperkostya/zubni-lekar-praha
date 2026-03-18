<?php
/**
 * The template part for displaying content single loop item
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<a href="<?=esc_url( get_permalink() );?>">
	<article>
		<img src="<?=get_the_post_thumbnail_url(get_the_ID());?>" alt="<?the_title();?>">
		<header><?the_title();?></header>
		<div><?the_excerpt();?>
	</article>
</a>