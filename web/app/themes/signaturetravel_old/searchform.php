<div class="search-form module module-header-tools">
	<form action="<?php echo esc_url(home_url('/')); ?>" method="get">
      <fieldset class="form form-search-mini">

          <input type="text" name="s" id="s" class="input-132 clearInput" placeholder="Search..." 
                 value="<?php echo get_search_query(); ?>" 
                 title="Site search" />

          <button type="submit" name="Search" class="button btn-search">
              <i class="fa-solid fa-magnifying-glass"></i>
          </button>

      </fieldset>
  </form>
</div>
