<div class="relative">
  <div class="row">
    <h3 class="widget-title">Bạn có thể quan tâm</h3>
  </div>
  <div class="row">
      <?php
          $cat_slug = get_curent_slug();
          $args = array(
          'category_name'  => $cat_slug,
          'post_type' => 'post',
          'posts_per_page' => '4'
          );                                                                           
          $team_query = new WP_Query($args);
         if ($team_query->have_posts()) {
          while ($team_query->have_posts()) {
            $team_query->the_post();  
            $id = get_the_ID();
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium', false );
            //$price = get_post_meta( $id, 'meta-unit-price', true );              
             if(!$thumbnail){
              $_thumbnail = no_thumbnail;
            }else{
              $_thumbnail = $thumbnail[0];
            }
           ?>
           <div class="col-sm-3 col-xs-6 desc text-left">
                <a class="hidden-relative" href="<?php the_permalink(); ?>"><img src="<?php echo $_thumbnail; ?>" alt=""></a>  
                <h3 class="title-hidden-relative"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>            
          </div>  
           <?php 
              }
          } else {
              echo "nothing found";
          }
          wp_reset_query();  ?>
  </div>
</div> 