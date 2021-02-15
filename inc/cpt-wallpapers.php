<?php

// Register Custom Post Type Wallpaper
// Post Type Key: wallpaper
function create_wallpaper_cpt() {

	$labels = array(
		'name' => _x( 'Wallpapers', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Wallpaper', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Wallpapers', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Wallpaper', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Wallpaper Archives', 'textdomain' ),
		'attributes' => __( 'Wallpaper Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Wallpaper:', 'textdomain' ),
		'all_items' => __( 'All Wallpapers', 'textdomain' ),
		'add_new_item' => __( 'Add New Wallpaper', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Wallpaper', 'textdomain' ),
		'edit_item' => __( 'Edit Wallpaper', 'textdomain' ),
		'update_item' => __( 'Update Wallpaper', 'textdomain' ),
		'view_item' => __( 'View Wallpaper', 'textdomain' ),
		'view_items' => __( 'View Wallpapers', 'textdomain' ),
		'search_items' => __( 'Search Wallpaper', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Wallpaper', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Wallpaper', 'textdomain' ),
		'items_list' => __( 'Wallpapers list', 'textdomain' ),
		'items_list_navigation' => __( 'Wallpapers list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Wallpapers list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Wallpaper', 'textdomain' ),
		'description' => __( 'Upload custom photography and make wallpapers', 'textdomain' ),
		'labels' => $labels,
			'menu_icon' => 'dashicons-format-image',
		'supports' => array('title'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'wallpapers', $args );

}
add_action( 'init', 'create_wallpaper_cpt', 0 );



function on_publish_pending_post( $post ) {
// A function to perform actions when a post is published.

if ( "wallpapers" === get_post_type()) { // check the custom post type
		$contactBool = true;

    $name   = get_the_title( $post->ID );

		$image =  get_field('wallpaper_image', $post_id  );
		$border = get_field('wallpaper_border_1', $post_id);
		$maskURL = get_stylesheet_directory() . '/images/bergenborders_mask.jpg';
		$signatureURL = get_stylesheet_directory() . '/images/bergen_signature.png';
		$compositetitle = $image['title'] . "-withborders" . ".jpg";
		$imageURL = $image['url'];
		$borderURL = $border['url'];


		$base = new \Imagick($imageURL);
		$mask = new \Imagick($maskURL);
		$over = new \Imagick($borderURL);
		$signature = new \Imagick($signatureURL);

		// Setting same size for all images
		$base->resizeImage(5120, 2880, Imagick::FILTER_LANCZOS, 1);

		// Add overlay
		$base->compositeImage($over, Imagick::COMPOSITE_DEFAULT, 0, 0);
		$base->compositeImage($signature, Imagick::COMPOSITE_DEFAULT, 0, 0);

		$upload_dir   = wp_upload_dir();
		$our_dir = $upload_dir['basedir'] . "/testing";

		$base -> writeImage($our_dir . $compositetitle);
		header("Content-Type: image/jpg");

		echo $base;











		$headers = array (
        'From: "Bergenjohnston.com" <admin@bergenjohnston.com>' ,
        'X-Mailer: PHP/' . phpversion(),
        'MIME-Version: 1.0' ,
        'Content-type: text/html; charset=iso-8859-1'
    );
    $headers = implode( "\r\n" , $headers );

		$post_url = get_permalink( $post_id );
		$post = get_post( $post_id );
		$subject = 'Status for ' .  $name . ' Changed To: Approved';
		$body = "This is an automated update to inform you that your entry for ". $name ." has been published.<br><br>";
		$body .=  "Img URL: " . $imageURL . "<br /><br />";
		$body .=  "Img URL: " . $borderURL . "<br /><br />";
		$body .= "<a href='" . $post_url . "'>Click here to view Post</a><br><br>";
		$body .= "<a href='" . $imageURL . "'>Click here to view Image</a><br><br>";
		$body .= "With Love,<br><br>";
		$body .= "–The Nebraska Creative Team";
		$email = "jordan@pixelbakery.co";

		if($email and $contactBool){
			//sends email
			wp_mail($email, $subject, $body, $headers );
		}
		else{
			return;
		}

}
}
add_action( "save_post_wallpapers", "on_publish_pending_post", 10, 1 );


function register_watermarked_size() {
  add_image_size( 'watermarked', 550, 550, true ); // This is what should be uploaded
}
add_action( 'init', 'register_watermarked_size' );

class Watermark_Image {

  // The attachment meta array
  public $meta = array();

  // The upload dir (including year and month)
  private $upload_dir = '';

  // The path to the uploaded and unprocessed file
  private $uploaded_file_path = '';

  public function __construct($meta) {

    $this->meta = $meta;

    $this->generate();

  }

  public function get_meta() {
    return $this->meta;
  }

  public function generate() {


		$time = 'test';
    $this->upload_dir = wp_upload_dir( $time );

    $filename = $this->meta['sizes']['watermarked']['file'];

    $this->uploaded_file_path = trailingslashit( $this->upload_dir['path'] ) . $filename;

    $this->watermark_image();

  }

  private function watermark_image() {

    $image_resource = new Imagick( $this->uploaded_file_path );
    $image_resource->blurImage( 20, 10 );

    $watermark_resource = new Imagick( get_stylesheet_directory() . '/images/bergenborders.png' );
    $image_resource->compositeImage( $watermark_resource, Imagick::COMPOSITE_DEFAULT, 100, 250 );
    $this->save_image( $image_resource );

  }

  private function save_image( $image_resource ) {

    $image_data = pathinfo( $this->uploaded_file_path );

    $watermarked_filename = $image_data['filename'] . '-watermarked.' . $image_data['extension'];

    $watermarked_file_path = str_replace( $image_data['basename'], $watermarked_filename, $this->uploaded_file_path );

    if ( ! $image_resource->writeImage( $watermarked_file_path ) )
      return $image_data['basename'];

    unlink( $this->uploaded_file_path ); // Because that file isn't referred to anymore

    $this->meta['sizes']['watermarked']['file'] = $watermarked_filename;

  }

}

function generate_watermarked_image( $meta ) {

  $watermark_image = new Watermark_Image( $meta );
  $meta = $watermark_image->get_meta();

  return $meta;

}
add_filter( 'wp_generate_attachment_metadata', 'generate_watermarked_image' );


 ?>
