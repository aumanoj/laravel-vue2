<?php
/**
 * Language functions
 *
 * @package Top_Ten
 */

/**
 * Function to create an excerpt for the post.
 *
 * @since	1.6
 * @param	int        $id             Post ID.
 * @param	int|string $excerpt_length Length of the excerpt in words.
 * @param   bool       $use_excerpt Use Excerpt.
 * @return	string     Excerpt
 */
function tptn_excerpt( $id, $excerpt_length = 0, $use_excerpt = true ) {
	$content = '';

	if ( $use_excerpt ) {
		$content = get_post( $id )->post_excerpt;
	}

	if ( '' === $content ) {
		$content = get_post( $id )->post_content;
	}

	$output = strip_tags( strip_shortcodes( $content ) );

	if ( $excerpt_length > 0 ) {
		$output = wp_trim_words( $output, $excerpt_length );
	}

	/**
	 * Filters excerpt generated by tptn.
	 *
	 * @since	1.9.10.1
	 *
	 * @param	array	$output			Formatted excerpt
	 * @param	int		$id				Post ID
	 * @param	int		$excerpt_length	Length of the excerpt
	 * @param	boolean	$use_excerpt	Use the excerpt?
	 */
	return apply_filters( 'tptn_excerpt', $output, $id, $excerpt_length, $use_excerpt );
}


/**
 * Function to limit content by characters.
 *
 * @since	1.9.8
 * @param	string $content    Content to be used to make an excerpt.
 * @param	int    $no_of_char Maximum length of excerpt in characters.
 * @return 	string			   Formatted content.
 */
function tptn_max_formatted_content( $content, $no_of_char = -1 ) {
	$content = strip_tags( $content );

	if ( ( $no_of_char > 0 ) && ( strlen( $content ) > $no_of_char ) ) {
		$no_of_words = preg_split( '/[\s]+/', substr( $content, 0, $no_of_char ) );

		// Break back down into a string of words, but drop the last one if it's chopped off.
		if ( substr( $content, $no_of_char, 1 ) === ' ' ) {
			$content = implode( ' ', $no_of_words );
		} else {
			$content = implode( ' ', array_slice( $no_of_words, 0, -1 ) ) . '&hellip;';
		}
	}

	/**
	 * Filters formatted content after cropping.
	 *
	 * @since	1.9.10.1
	 *
	 * @param	string	$content	Formatted content
	 * @param	int		$no_of_char	Maximum length of excerpt in characters
	 */
	return apply_filters( 'tptn_max_formatted_content' , $content, $no_of_char );
}


