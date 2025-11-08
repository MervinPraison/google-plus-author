<?php

/*
Plugin Name: WP Google Authorship
Plugin URI: https://mer.vin/google-plus-author
Description: Google Plus Profile Picture appear in Google Search. Very Easy to implement. Just 4 step Process. Including Google authorship for multiple authors and multisite
Version: 2.1
Author: Mervin Praison
Author URI: https://mer.vin
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: google-plus-author


  Copyright 2012  Mervin Praison  

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function google_plus_author () {
	// Output is already escaped in google_plus_author_short()
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo google_plus_author_short();
}

function google_plus_author_short () {
	global $post;
	$author_id = get_post_field( 'post_author', $post->ID );
	$gplus_author_name = esc_attr( get_the_author_meta( 'prefname', $author_id ) );
	$gplus_author_display = esc_attr( get_the_author_meta( 'display_name', $author_id ) );
	$gplus_author_url = esc_url( get_the_author_meta( 'gplusauthor', $author_id ) );
	
	if($gplus_author_name==NULL) 
	{
		$authorizing = $gplus_author_display;
	}
	else{
		$authorizing = $gplus_author_name;
	}

	$rel = is_author() ? 'author' : 'me';
	$gplusreturn = sprintf(
		'<a href="%s" rel="%s" title="%s">%s</a>',
		esc_url($gplus_author_url),
		esc_attr($rel),
		esc_attr('Google Plus Profile for ' . $authorizing),
		esc_html($authorizing)
	);

	return $gplusreturn;
} 

add_shortcode( 'googleplusauthor', 'google_plus_author_short' );
add_action( 'show_user_profile', 'gplus_author_profile_fields' );
add_action( 'edit_user_profile', 'gplus_author_profile_fields' );

function gplus_author_profile_fields( $user ) { 
	
	$current_user = wp_get_current_user();
	$gplus_author_name = esc_attr( get_the_author_meta( 'prefname', $current_user->ID ) );
	$gplus_author_url = esc_attr( get_the_author_meta( 'gplusauthor', $current_user->ID ) );

	wp_nonce_field('gplus_author_update', 'gplus_author_nonce');
	?>
	<h3><?php esc_html_e('Google Plus profile information', 'google-plus-author'); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="gplusauthor"><?php esc_html_e('Google Plus Profile URL', 'google-plus-author'); ?></label></th>

			<td>
				<input type="text" name="gplusauthor" id="gplusauthor" value="<?php echo esc_attr( get_the_author_meta( 'gplusauthor', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Please enter your Google Plus Profile URL. (with "https://plus.google.com/1234567890987654321")', 'google-plus-author'); ?></span>
			</td>
		</tr>
		<tr>

			<th><label for="prefname"><?php esc_html_e('Preferred Name', 'google-plus-author'); ?></label></th>
			<td>
				<input type="text" name="prefname" id="prefname" value="<?php echo esc_attr( get_the_author_meta( 'prefname', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e('Enter Your Preferred Name', 'google-plus-author'); ?></span>
			</td>
		</tr>

	</table>
<?php }


add_action( 'personal_options_update', 'gplus_author_profile_save' );

function gplus_author_profile_save( $user_id ) {
	// Verify nonce
	if (!isset($_POST['gplus_author_nonce']) || !wp_verify_nonce($_POST['gplus_author_nonce'], 'gplus_author_update')) {
		return false;
	}

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	if (isset($_POST['gplusauthor'])) {
		update_user_meta( $user_id, 'gplusauthor', esc_url_raw($_POST['gplusauthor']) );
	}
	if (isset($_POST['prefname'])) {
		update_user_meta( $user_id, 'prefname', sanitize_text_field($_POST['prefname']) );
	}
}

?>