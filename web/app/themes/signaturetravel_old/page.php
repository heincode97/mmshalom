<?php get_header(); ?>
  
</div>
<?php the_content(); ?>

<?php if(is_page(372)) { ?> 
<h1>Contact Us</h1>

<?php }elseif(is_page(295)) { ?> 
<h1>Testing</h1>
<?php } ?>

<?php get_footer(); ?>