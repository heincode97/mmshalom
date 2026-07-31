<?php
$search_refer = isset($_REQUEST["site-section"]) ? $_REQUEST["site-section"]: '';
if ($search_refer == 'event') :
	$is_default_query = true;
?>
<?php get_header('fullwidth'); ?>
<div class="section-pd">
  <div class="container">
    <h4 class="mb-4"><?php _e("Search Results"); ?></h4>
    <div class="module">
    <?php 
      global $wp_query;
      if( $wp_query->post_count > 0 ){
        //if event is search thru multiple categories, we need to attach the category name to the title
        if( $_REQUEST['caltype'] && $_REQUEST['caltype'] == 'm' ){
          $is_event_search = true;
        }
        get_template_part('loop', 'fbi_event'); 
      }
      else{
        echo '<p>No event is found.</p>';	
      }
    ?>
    </div>
  </div>
</div>
<?php	get_footer('fullwidth'); ?>

<?php else: ?>

<?php get_header(); ?>
<div class="search-pg bg-color-2">
  <div class="search-results-bg module-search-results">
    <div class="search-header section-pt">
      <div class="container">
        <div class="row">
          <div class="offset-lg-1 col-lg-10 col-12">
            <div class="module module-header-tools mb-5">
              <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                <fieldset class="form form-search-mini">
                      <input type="text" name="s" id="s" class="input-132 clearInput" placeholder="Search..."
                          value="<?php echo get_search_query(); ?>" 
                          title="Site search" 
                      />
                  <button type="submit" name="Search" class="button btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>

                </fieldset>
              </form>
            </div>
          </div>
        </div>
        <?php $search_value = get_search_query(); ?>
        <h5 class="mb-4">Search Results for: <span><?php echo "'" . $search_value . "'"; ?></span></h5>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="module module-content">
      <div class="module-search-results">
        <div class="row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
          <div class="col-lg-6 col-12">
            <div class="result-style">
              <h4 class="mb-3"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
              <span>
                <?php $post_name = get_post_type($post->ID); ?>
                <?php //echo $post_name; ?></span>
              <?php //echo $post->post_excerpt; ?>
              <?php if( get_the_content() ) { ?>
              <p>
                <?php echo wp_trim_words(apply_filters('the_content', $post->post_content), 30, '...'); ?>
              </p>
              <?php } ?>
              <div class="mt-4">
                <a href="<?php the_permalink(); ?>" class="btn btn-secondary search">Learn More</a>
              </div>
            </div>
          </div>
          
        <?php 
        endwhile; 
        ?>
        <div class="pagination d-flex align-items-center justify-content-center pb-5">
          <?php //echo dd_pagination(); ?>
        </div>
          <?php 
        else: ?>
        <div class="section-pb">
          <p class="mb-0">
            <?php _e('No result has found!'); ?>
          </p>
        </div>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer('fullwidth') ?>
<?php endif; ?>