<?php
/* xlo code */
function true_style_frontend() {
 	wp_enqueue_style( 'true_style', get_stylesheet_directory_uri() . '/style.css');
}
 add_action( 'wp_enqueue_scripts', 'true_style_frontend' );
function xlo_create_post_type() {
  register_post_type( 'xlo_nedvizh',
    array(
      'labels' => array(
        'name' => __( 'Недвижимость' ),
        'singular_name' => __( 'Недвижимость' ),
		'add_new' => 'Добавить'
      ),
	  'menu_icon' => 'dashicons-admin-home',
	  'supports' => array('title', 'editor', 'thumbnail', 'post-formats', 'excerpt'),
      'public' => true,
	  'rewrite' => 'nedvizh',
      'has_archive' => true,
	  'taxonomies' => array( 'nedv_type' )
    )
  );
  // create a new taxonomy
	register_taxonomy(
		'nedv_type',
		'xlo_nedvizh',
		array(
			'label' => __( 'Тип недвижимости' ),
			'rewrite' => array( 'slug' => 'nedv_type' ),
			/*'capabilities' => array(
				'assign_terms' => 'edit_guides',
				'edit_terms' => 'publish_guides'
			),*/
			'hierarchical' => true,
			'labels' =>
				array(
					'add_new_item' => __( 'Добавить тип недвижимости' )
				),
			'show_in_menu' => true
		)
		
		
	);
	
	//города
	register_post_type( 'xlo_city',
    array(
      'labels' => array(
        'name' => __( 'Города' ),
        'singular_name' => __( 'city_single' ),
		'add_new' => 'Добавить'
      ),
	  'menu_icon' => 'dashicons-nametag',
	  'supports' => array('title', 'editor', 'thumbnail', 'post-formats', 'excerpt'),
      'public' => true,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'xlo_create_post_type' );
// link city
add_action('add_meta_boxes', function () {
	add_meta_box( 'palyer_team', 'Города', 'player_team_metabox', 'xlo_nedvizh', 'side', 'low'  );
}, 1);
//id html / Заголовок /Функция, кот выв на экр HTML содерж блока/Название экрана для которого добавляется блок/Место где должен показываться блок/Приоритет блока
// метабокс с селектом команд
function player_team_metabox( $post ){
	$cities = get_posts(array( 'post_type'=>'xlo_city', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

	if( $cities ){
		// чтобы портянка пряталась под скролл...
		echo '
		<div style="max-height:200px; overflow-y:auto;">
			<ul>
		';

		foreach( $cities as $city ){
			echo '
			<li><label>
				<input type="radio" name="post_parent" value="'. $city->ID .'" '. checked($city->ID, $post->post_parent, 0) .'> '. esc_html($city->post_title) .'</label></li>';
		}

		echo '
			</ul>
			
		</div>';

	}
	else
		echo 'Городов нет...';
}
//*********************
add_action( 'save_post', 'action_function_name_85245_', 10, 3 );
function action_function_name_85245_( $post_ID, $post, $update ) {
  $id_city = $post->post_parent; // id выбранного города
  update_field('id_city', $id_city);
}

add_action( 'widgets_init', 'xlo_widgets_init' );

if ( ! function_exists( 'xlo_widgets_init' ) ){
	function xlo_widgets_init(){
		register_sidebar( array(
			'name' => __('City Sidebar', 'xlo'),
			'id' => 'sidebar-city',
			'description'   => __( 'City Sidebar widget area', 'xlo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
		register_sidebar( array(
			'name' => __('Nedvizh Sidebar', 'xlo'),
			'id' => 'sidebar-nedvizh',
			'description'   => __( 'Nedvizh Sidebar widget area', 'xlo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
		register_sidebar( array(
			'name' => __('Form Sidebar', 'xlo'),
			'id' => 'sidebar-form',
			'description'   => __( 'Form Sidebar widget area', 'xlo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
	}
}
add_action('wp_ajax_addnedv', 'addnedv');
add_action('wp_ajax_nopriv_addnedv', 'addnedv');
function addnedv(){
	echo $_POST['plosh']."\n".$_POST['zhil_plosh']."\n".$_POST['stoimost']."\n".$_POST['adress']."\n".$_POST['floor'];
	$name = wp_strip_all_tags($_POST['name']);
	$plosh = wp_strip_all_tags($_POST['plosh']);
	$zhil_plosh = wp_strip_all_tags($_POST['zhil_plosh']);
	$stoimost = wp_strip_all_tags($_POST['stoimost']);
	$adress = wp_strip_all_tags($_POST['adress']);
	$floor = wp_strip_all_tags($_POST['floor']);
	
	$nedv = array(
		'post_type' => 'xlo_nedvizh', 
		'post_status'=>'publish',
		'post_title' => $name
	);
	$post_id = wp_insert_post($nedv);
	update_field('plosh', $plosh, $post_id);
	update_field('zhil_plosh', $zhil_plosh, $post_id);
	update_field('stoimost', $stoimost, $post_id);
	update_field('adress', $adress, $post_id);
	update_field('floor', $floor, $post_id);
	wp_die();
}