<?php
class wpex_port_posts_thumb_widget extends WP_Widget {

    public function wpex_port_posts_thumb_widget() {
        parent::__construct(
            'wpex_port_posts_thumb_widget',
            esc_html__( 'Portfolio Posts w/ Thumb', 'pytheas' )
        );
    }

    public function widget($args, $instance) {      
        extract( $args );

        $title    = apply_filters( 'widget_title', $instance['title']);
        $category = apply_filters( 'widget_title', $instance['category']);
        $number   = apply_filters( 'widget_title', $instance['number']);
        $offset   = apply_filters( 'widget_title', $instance['offset']);

        echo $before_widget; ?>
          <?php if ( $title )
                echo $before_title . $title . $after_title; ?>
                    <ul class="wpex-widget-recent-posts">
                        <?php
                        if ( $category !== 'all-cats' ) {
                            $tax_query = array ( array (
                                    'taxonomy' => 'portfolio_category',
                                    'field' => 'id',
                                    'terms' => $category
                            ) );
                        } else {
                            $tax_query = NULL;
                        }
                        
                        global $post;
                        $tmp_post = $post;
                        $args = array(
                            'post_type' => 'portfolio',
                            'numberposts' => $number,
                            'offset'=> $offset,
                            'tax_query' => $tax_query,
                            'suppress_filters' => false
                        );
                        $myposts = get_posts( $args );
                        foreach( $myposts as $post ) : setup_postdata($post);
                        if( has_post_thumbnail() ) {  ?>
                            <li class="clr">                                        
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="title"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
                                <div class="wpex-recent-posts-content clr">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    <div class="wpex-widget-recent-posts-date"><i class="icon-time"></i><?php echo get_the_date(); ?></div>
                                </div>
                            </li>
                       <?php
                       } endforeach;
                       wp_reset_postdata();
                       $post = $tmp_post; ?>
                    </ul>
              <?php echo $after_widget; ?>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['category'] = strip_tags($new_instance['category']);
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['offset'] = strip_tags($new_instance['offset']);
        return $instance;
    }

    public function form($instance) {   
        extract( wp_parse_args( (array) $instance, array(
            'title'    => __( 'Recent Work', 'pytheas' ),
            'category' => '',
            'number'   => '5',
            'offset'   => '0'
        ) ) ); ?>

         <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'pytheas' ); ?></label> 
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title','pytheas' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select a Category:', 'pytheas' ); ?></label>
            <br />
            <select class='att-select' name="<?php echo $this->get_field_name( 'category' ); ?>" id="<?php echo $this->get_field_id( 'category' ); ?>">
            <option value="all-cats" <?php if($category == 'all-cats' ) { ?>selected="selected"<?php } ?>><?php _e( 'All', 'pytheas' ); ?></option>
            <?php
            //get terms
            $cat_terms = get_terms( 'portfolio_category', array( 'hide_empty' => '1' ) );
            foreach ( $cat_terms as $cat_term) { ?>
                <option value="<?php echo $cat_term->term_id; ?>" id="<?php echo $cat_term->term_id; ?>" <?php if($category == $cat_term->term_id) { ?>selected="selected"<?php } ?>><?php echo $cat_term->name; ?></option>
            <?php } ?>
            </select>
        </p>
        
        <p>
          <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number to Show:', 'pytheas' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Offset (the number of posts to skip):', 'pytheas' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" type="text" value="<?php echo $offset; ?>" />
        </p>
        <?php
    }
}
add_action( 'widgets_init', create_function( '', 'return register_widget("wpex_port_posts_thumb_widget");' ));