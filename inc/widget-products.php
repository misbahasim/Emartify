<?php
/**
* Adds WPAcademy - Latest Products widget
*/
class Wpacademylatestprod_Widget extends WP_Widget {
 /**
 * Register widget with WordPress
 */
 function __construct() {
  parent::__construct(
   'wpacademylatestprod_widget', // Base ID
   esc_html__( 'WPAcademy - Latest Products', 'stcustom' ), // Name
   array( 'description' => esc_html__( 'Displays latest woocommerce products', 'stcustom' ), ) // Args
  );
 }
 /**
 * Widget Fields
 */
 private $widget_fields = array(
  array(
   'label' => 'Limit Products',
   'id' => 'limit',
   'type' => 'number',
  ),
  array(
   'label' => 'Category ID',
   'id' => 'category_id',
   'type' => 'hide_it',
  ),
 );
 /**
 * Front-end display of widget
 */
 public function widget( $args, $instance ) {
  echo $args['before_widget']; ?>
  <div class="widget-title-row row ml-0 mr-0">
   <h2><?php echo $instance['title'] ?></h2>
  </div>
  <div class="widget-content-row row ml-0 mr-0">
  <?php
  $args = array (
   'posts_per_page' => $instance['limit'],
   'post_status'   => 'publish',
   'post_type'    => 'product',
   'tax_query'    => array (
    array(
     'taxonomy' => 'product_cat',
     'field'   => 'term_id',
     'terms'   => $instance['category_id']
    )
   ),
  );
  $query = new WP_Query ( $args );
  if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();
   $product = new WC_Product ( get_the_ID() );
   ?>
      <div class="wpa-product pull-left col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <div class="product-inner">
      <div class="product-thumb">
       <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
      </div>
      <div class="product-title">
       <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      </div>
      <div class="product-price">
       <?php echo $product->get_price_html() ?>
      </div>
     </div>
    </div>
   <?php
   endwhile;
  else :
    //D this instead
  endif; ?>
  </div>
  <?php
  echo $args['after_widget'];
  }
 /**
 * Back-end widget fields
 */
 public function field_generator( $instance ) {
  $output = '';
  foreach ( $this->widget_fields as $widget_field ) {
   $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $widget_field['default'], 'stcustom' );
   switch ( $widget_field['type'] ) {
    case "hide_it":
     $output .= '';
     break;
    default:
     $output .= '<p>';
     $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'stcustom' ).':</label> ';
     $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
     $output .= '</p>';
   }
  }
  echo $output;
  ?>
  <p>
         <label for="<?php echo $this->get_field_name( 'category_id' ); ?>"><?php _e( 'Select Category:' ); ?></label>
         <br />
         <select name="<?php echo $this->get_field_name( 'category_id' ); ?>" id="<?php echo $this->get_field_id( 'category_id' ); ?>">
         <?php
         $def_category = $instance['category_id'];
         if(isset($def_category) && $def_category != "") {
   if( $term = get_term_by( 'id', $def_category, 'product_cat' ) ){
     $def_cat_name = $term->name;
   }
             ?>
          <option value="<?php echo $def_category ?>"><?php echo $def_cat_name ?></option>
         <?php } ?>
                <?php
                $taxonomy     = 'product_cat';
                $orderby      = 'name';
                $show_count   = 0;      // 1 for yes, 0 for no
                $pad_counts   = 0;      // 1 for yes, 0 for no
                $hierarchical = 1;      // 1 for yes, 0 for no
                $title        = '';
                $empty        = 0;
                $args = array(
                     'taxonomy'     => $taxonomy,
                     'orderby'      => $orderby,
                     'show_count'   => $show_count,
                     'pad_counts'   => $pad_counts,
                     'hierarchical' => $hierarchical,
                     'title_li'     => $title,
                     'hide_empty'   => $empty
                );
                $all_categories = get_categories( $args );
                foreach ($all_categories as $cat) {
                    if($cat->category_parent == 0) {
                        $category_id = $cat->term_id;
                        echo '<option value="'.$cat->term_id.'">'.$cat->name.'</option>';
                        $args2 = array(
                                'taxonomy'     => $taxonomy,
                                'child_of'     => 0,
                                'parent'       => $category_id,
                                'orderby'      => $orderby,
                                'show_count'   => $show_count,
                                'pad_counts'   => $pad_counts,
                                'hierarchical' => $hierarchical,
                                'title_li'     => $title,
                                'hide_empty'   => $empty
                        );
                        $sub_cats = get_categories( $args2 );?>
                            <?php
                            if($sub_cats) {
                                foreach($sub_cats as $sub_category) {
                                    echo  '<option value="'.$sub_category->term_id.'">'.$sub_category->name.'</option>' ;
                                }
                            } ?>

                <?php }
                }
                ?>
   </select>
     </p>
  <?php
 }
 public function form( $instance ) {
  $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'stcustom' );
  ?>
  <p>
  <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'stcustom' ); ?></label>
  <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
  </p>
  <?php
  $this->field_generator( $instance );
 }
 /**
 * Sanitize widget form values as they are saved
 */
 public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
  foreach ( $this->widget_fields as $widget_field ) {
   switch ( $widget_field['type'] ) {
    case 'checkbox':
     $instance[$widget_field['id']] = $_POST[$this->get_field_id( $widget_field['id'] )];
     break;
    default:
     $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
   }
  }
  return $instance;
 }
} // class Wpacademylatestprod_Widget
// register WPAcademy - Latest Products widget
function register_wpacademylatestprod_widget() {
 register_widget( 'Wpacademylatestprod_Widget' );
}
add_action( 'widgets_init', 'register_wpacademylatestprod_widget' );