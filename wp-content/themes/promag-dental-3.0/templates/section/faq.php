<?$crb_faq = carbon_get_the_post_meta('faq');?>
<?if(count($crb_faq)):?>
<section class="faq__block content__block">
	<h2><?pll_e('FAQ');?></h2>
	<section class="blocks grid faq" itemscope="" itemtype="https://schema.org/FAQPage">
		<?foreach($crb_faq as $question):?>
		<article class="blocks__item faq__item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
			<header class="faq__item__question" itemprop="name"><?=$question['crb_title'];?></header>
			<div class="faq__item__answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><?=$question['crb_description'];?></div>
		</article>
		<?endforeach;?>
	</section>
</section>
<?endif;?>