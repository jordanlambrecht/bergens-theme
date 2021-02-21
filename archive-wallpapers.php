<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BergensTheme
 */

get_header();
?>

<div class="container container-wallpaper h-100 my-4 py-3 d-flex flex-column  justify-content-around">

<?php

$args = array(
	'post_type' => 'wallpapers',
	'post_status' => 'publish',
	'order' => 'RAND'
);

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) : $loop->the_post();
		print the_title();
endwhile;

wp_reset_postdata();


 ?>


	<div class="my-3 flex-fill d-flex justify-content-center">
		<div class=" width-adjusting-to-height">
			<!-- the viewbox will provide the desired aspect ratio -->
			<svg viewBox="0 0 500 300" xmlns="http://www.w3.org/2000/svg">
				<ellipse cx="85.2" cy="35.1" class="st0" rx="4.5" ry="4.4" />
				<ellipse cx="98.5" cy="35.1" class="st0" rx="4.5" ry="4.4" />
				<ellipse cx="111.9" cy="35.1" class="st0" rx="4.5" ry="4.4" />
				<path d="M444.4 0H55.6c-4.6 0-8.4 3.7-8.4 8.3v272.9c0 4.5 3.8 8.3 8.4 8.3h388.8c4.6 0 8.4-3.7 8.4-8.3V8.3c0-4.6-3.8-8.3-8.4-8.3zm-10.9 249.8c0 4.1-3.4 7.5-7.6 7.5H74.2c-4.2 0-7.6-3.4-7.6-7.5V26.4c0-4.1 3.4-7.5 7.6-7.5h351.7c4.2 0 7.6 3.4 7.6 7.5v223.4z" class="st0" />
				<path fill="#fff" d="M488.1 269.6H310v1.6c0 4.9-4.1 9-9.2 9H199.2c-5 0-9.2-4-9.2-9v-1.6H11.9c-4.3 0-7.8 3.4-7.8 7.6v11c0 4.2 3.5 7.6 7.8 7.6H488c4.3 0 7.8-3.4 7.8-7.6v-11c0-4.2-3.5-7.6-7.7-7.6z" />
				<path d="M488.1 300H11.9C5.4 300 0 294.7 0 288.2v-11c0-6.5 5.4-11.8 11.9-11.8h182.2v5.8c0 2.6 2.2 4.8 5 4.8h101.6c2.8 0 5-2.2 5-4.8v-5.8h182.2c6.6 0 11.9 5.3 11.9 11.8v11c.2 6.5-5.2 11.8-11.7 11.8zM11.9 273.7c-2 0-3.6 1.6-3.6 3.5v11c0 1.9 1.6 3.5 3.6 3.5H488c2 0 3.6-1.6 3.6-3.5v-11c0-1.9-1.6-3.5-3.6-3.5H313.9c-1.2 6-6.6 10.6-13.1 10.6H199.2c-6.4 0-11.8-4.5-13.1-10.6H11.9z" class="st0" />
			</svg>

			<div class="main-carousel content ">
				

				<?php
				$args = array(
					'post_type' => 'wallpapers',
					'post_status' => 'publish',
					'order' => 'RAND'
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
						$img =  get_field('wallpaper_image');

						if( $img ):
							$imgURL = $img['url']; ?>

							<img class="carousel-cell inner" alt="<?php echo $img['title']; ?>" src="<?php echo $imgURL; ?>" />

			<?php	endif; endwhile;
				wp_reset_postdata();


				 ?>



		</div>

		</div>
	</div>

	<div class="container d-flex justify-content-center align-items-middle ">
		<a class="wp-nav-button wp-nav-button-left mx-2"><i class="bi bi-caret-left"></i></a>
		<div class=" mx-1 px-1 colorpicker d-flex justify-content-center align-items-middle" class="color">
			<form name="colorpicker">
				<!-- Transparent is Always Shown	  -->
				<input type="radio" name="color" id="transparent" value="rgba(0,0,0,0)" class="color" checked="checked" />
				<label for="transparent">
					<span class="transparent"></span>
				</label>
				<?php
				if( have_rows('border_colors', 'options') ):
			    while( have_rows('border_colors', 'options') ) : the_row();

			        $border_color = get_sub_field('color');
							$border_color_ID= (str_replace("#", "", $border_color));

							?>

							<input type="radio" name="color" id="<?php echo $border_color_ID;?>" value="<?php echo $border_color?>" class="color" />
							<label for="<?php echo $border_color_ID;?>">
								<span class="<?php echo $border_color_ID;?>" style="background: <?php echo $border_color;?>"></span>
							</label>


				    <?php endwhile;


				else :
				    // Do something...
				endif;
				?>

			</form>
			<!-- You've selected:
			<div class="currentValue"></div> -->
		</div>
		<a class="wp-nav-button wp-nav-button-right mx-2"><i class="bi bi-caret-right"></i></a>
	</div>

	<div class="d-flex justify-content-center align-items-middle mb-3 py-4">
		<form class="toggle mx-2" name="deviceToggle">
			<input id="dt" type="checkbox" name="dt"/>
			<label class="toggle-item" for="dt">

			</label>

		</form>

		<a class="download  mx-2">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
				<path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
				<path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
			</svg>
		</a>
	</div>
</div>
<?php
get_footer();
