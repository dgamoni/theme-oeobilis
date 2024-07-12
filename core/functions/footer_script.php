<?php 


add_action('wp_footer', 'custom_preloader');
function custom_preloader() { 

	global $post;

	?>

	<div class="mazloader-items">
		<div id="mazloader-item-1" class="mazloader-item bg_img_type_cover bg_img_position_center_center dc_desktop dc_tablet dc_smartphone _is-hidden" data-settings="{&quot;minimum_loading_time&quot;:2000,&quot;duration&quot;:1000,&quot;delay&quot;:0,&quot;show_on_homepage&quot;:&quot;off&quot;}" data-appearance="{&quot;disable_page_scroll&quot;:true}" data-loader-id="1" style="background:#ffffff;">
			<div class="mazloader-item-overlay "></div>
			<div class="mazloader-items-wrapper  position_center">
				<div class="mazloader-item-icon" style="margin:0px 0px 0px 0px;">
					<div style="padding:0px 0px 0px 0px;">
						<img src="<?php echo CORE_URL . '/img/svg/10.svg'; ?>" alt="preloader image">
					</div>
				</div>
				<div class="mazloader-item-text" style="font-size:14px;margin:0px 0px 0px 0px;">
					<div style="padding:0px 0px 0px 0px;">Chargement</div>
				</div>
			</div>
		</div>
	</div>
		
	<script>
		jQuery(document).ready(function($) {

			let retryLimit = 3; // Set the retry limit
			let retryCount = {};
			let retryDelay = 2000; // 2 seconds delay

			$('video').each(function() {
				retryCount[this.src] = 0; // Initialize retry count for each video

				const retryVideo = (video) => {
					if (retryCount[video.src] < retryLimit) {
						retryCount[video.src]++;
						console.log(`Retrying to load video: ${video.src}, attempt ${retryCount[video.src]}`);
						setTimeout(() => {
							video.load(); // Retry loading the video
							video.play(); // Attempt to play the video again
						}, retryDelay);
					} else {
						console.log(`Failed to load video: ${video.src} after ${retryLimit} attempts`);
					}
				};

				$(this).on('error', function() {
					retryVideo(this);
				});
			});

			// Function to check if all videos are loaded and playing
			function checkVideos() {
				let allVideosLoaded = true;
				$('video').each(function() {
					//console.log(this.readyState);
					if ( this.readyState !== 4 ) {
						allVideosLoaded = false;
						return false; // break out of the loop
					}
				});
				return allVideosLoaded;
			}

			// Function to hide the preloader and add class to videos
			function hidePreloader() {
				$('#mazloader-item-1').addClass('is-hidden');
			}

			// Check initially and on video events
			// Interval to repeatedly check video states
			let checkInterval = setInterval(function() {
				//console.log(checkVideos());
				if (checkVideos()) {
					hidePreloader();
					clearInterval(checkInterval); // Stop checking once all videos are loaded and playing
				}
			}, 1000); // Check every second
		});
	</script>
	





	<?php
}




