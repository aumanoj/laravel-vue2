<?php
/**
 * Manage columns on All Posts and All pages screens.
 *
 * @package   Top_Ten
 * @author    Ajay D'Souza <me@ajaydsouza.com>
 * @license   GPL-2.0+
 * @link      http://ajaydsouza.com
 * @copyright 2008-2015 Ajay D'Souza
 */

/**** If this file is called directly, abort. ****/
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Add an extra column to the All Posts page to display the page views.
 *
 * @since	1.2
 *
 * @param	array	$cols	Array of all columns on posts page
 * @return	array	Modified array of columns
 */
function tptn_column( $cols ) {
	global $tptn_settings;

	if ( ( current_user_can('manage_options') ) || ( $tptn_settings['show_count_non_admins'] ) ) {
		if ( $tptn_settings['pv_in_admin'] ) {
			$cols['tptn_total'] = __( 'Total Views', TPTN_LOCAL_NAME );
		}
		if ( $tptn_settings['pv_in_admin'] ) {
			$cols['tptn_daily'] = __( "Today's Views", TPTN_LOCAL_NAME );
		}
		if ( $tptn_settings['pv_in_admin'] ) {
			$cols['tptn_both'] = __( 'Views', TPTN_LOCAL_NAME );
		}
	}
	return $cols;
}
add_filter( 'manage_posts_columns', 'tptn_column' );
add_filter( 'manage_pages_columns', 'tptn_column' );


/**
 * Display page views for each column.
 *
 * @since	1.2
 *
 * @param	string		$column_name	Name of the column
 * @param	int|string	$id				Post ID
 */
function tptn_value( $column_name, $id ) {
	global $wpdb, $tptn_settings;

	// Add Total count
	if ( ( $column_name == 'tptn_total' ) && ( $tptn_settings['pv_in_admin'] ) ) {
		$table_name = $wpdb->base_prefix . "top_ten";

		$resultscount = $wpdb->get_row( $wpdb->prepare( "SELECT postnumber, cntaccess from {$table_name} WHERE postnumber = %d", $id ) );
		$cntaccess = number_format_i18n( ( ( $resultscount ) ? $resultscount->cntaccess : 0 ) );
		echo $cntaccess;
	}

	// Now process daily count
	if ( ( $column_name == 'tptn_daily' ) && ( $tptn_settings['pv_in_admin'] ) ) {
		$table_name = $wpdb->base_prefix . "top_ten_daily";

		$daily_range = $tptn_settings['daily_range'];
		$hour_range = $tptn_settings['hour_range'];

		if ( $tptn_settings['daily_midnight'] ) {
			$current_time = current_time( 'timestamp', 0 );
			$from_date = $current_time - ( max( 0, ( $daily_range - 1 ) ) * DAY_IN_SECONDS );
			$from_date = gmdate( 'Y-m-d 0' , $from_date );
		} else {
			$current_time = current_time( 'timestamp', 0 );
			$from_date = $current_time - ( $daily_range * DAY_IN_SECONDS + $hour_range * HOUR_IN_SECONDS );
			$from_date = gmdate( 'Y-m-d H' , $from_date );
		}

		$resultscount = $wpdb->get_row( $wpdb->prepare( "SELECT postnumber, SUM(cntaccess) as sumCount FROM {$table_name} WHERE postnumber = %d AND dp_date >= '%s' GROUP BY postnumber ", $id, $from_date ) );
		$cntaccess = number_format_i18n( ( ( $resultscount ) ? $resultscount->sumCount : 0 ) );

		echo $cntaccess;
	}

	// Now process both
	if ( ( $column_name == 'tptn_both' ) && ( $tptn_settings['pv_in_admin'] ) ) {
		$table_name = $wpdb->base_prefix . "top_ten";

		$resultscount = $wpdb->get_row( $wpdb->prepare("SELECT postnumber, cntaccess from {$table_name} WHERE postnumber = %d", $id ) );
		$cntaccess = number_format_i18n((($resultscount) ? $resultscount->cntaccess : 0));

		$table_name = $wpdb->base_prefix . "top_ten_daily";

		$daily_range = $tptn_settings['daily_range'];
		$hour_range = $tptn_settings['hour_range'];

		if ( $tptn_settings['daily_midnight'] ) {
			$current_time = current_time( 'timestamp', 0 );
			$from_date = $current_time - ( max( 0, ( $daily_range - 1 ) ) * DAY_IN_SECONDS );
			$from_date = gmdate( 'Y-m-d 0' , $from_date );
		} else {
			$current_time = current_time( 'timestamp', 0 );
			$from_date = $current_time - ( $daily_range * DAY_IN_SECONDS + $hour_range * HOUR_IN_SECONDS );
			$from_date = gmdate( 'Y-m-d H' , $from_date );
		}

		$resultscount = $wpdb->get_row( $wpdb->prepare( "SELECT postnumber, SUM(cntaccess) as sumCount FROM {$table_name} WHERE postnumber = %d AND dp_date >= '%s' GROUP BY postnumber ", $id, $from_date ) );
		$cntaccess .= ' / '.number_format_i18n( ( ( $resultscount ) ? $resultscount->sumCount : 0 ) );

		echo $cntaccess;
	}
}
add_action( 'manage_posts_custom_column', 'tptn_value', 10, 2 );
add_action( 'manage_pages_custom_column', 'tptn_value', 10, 2 );


/**
 * Register the columns as sortable.
 *
 * @since	1.9.8.2
 *
 * @param	array	$cols	Array with column names
 * @return	array	Filtered columns array
 */
function tptn_column_register_sortable( $cols ) {
	$tptn_settings = tptn_read_options();

	if ( $tptn_settings['pv_in_admin'] ) {
		$cols['tptn_total'] = array( 'tptn_total', true );
		$cols['tptn_daily'] = array( 'tptn_daily', true );
	}

	return $cols;
}
add_filter( 'manage_edit-post_sortable_columns', 'tptn_column_register_sortable' );
add_filter( 'manage_edit-page_sortable_columns', 'tptn_column_register_sortable' );


/**
 * Add custom post clauses to sort the columns.
 *
 * @since	1.9.8.2
 *
 * @param	array	$clauses	Lookup clauses
 * @param	object	$wp_query	WP Query object
 * @return	array	Filtered clauses
 */
function tptn_column_clauses( $clauses, $wp_query ) {
	global $wpdb;
	$tptn_settings = tptn_read_options();

	if ( isset( $wp_query->query['orderby'] ) && 'tptn_total' == $wp_query->query['orderby'] ) {

		$table_name = $wpdb->base_prefix . "top_ten";
		$clauses['join'] .= "LEFT OUTER JOIN {$table_name} ON {$wpdb->posts}.ID={$table_name}.postnumber";
		$clauses['orderby']  = "cntaccess ";
		$clauses['orderby'] .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
	}

	if ( isset( $wp_query->query['orderby'] ) && 'tptn_daily' == $wp_query->query['orderby'] ) {

		$table_name = $wpdb->base_prefix . "top_ten_daily";

		$daily_range = $tptn_settings['daily_range'];
		$hour_range = $tptn_settings['hour_range'];

		if ( $tptn_settings['daily_midnight'] ) {
			$current_time = current_time( 'timestamp', 0 );
			$from_date = $current_time - ( max( 0, ( $daily_range - 1 ) ) * DAY_IN_SECONDS );
			$from_date = gmdate( 'Y-m-d 0' , $from_date );
		} else {
			$current_time = current_time( 'timestamp', 0 );
			$from_date = $current_time - ( $daily_range * DAY_IN_SECONDS + $hour_range * HOUR_IN_SECONDS );
			$from_date = gmdate( 'Y-m-d H' , $from_date );
		}

		$clauses['join'] .= "LEFT OUTER JOIN {$table_name} ON {$wpdb->posts}.ID={$table_name}.postnumber";
		$clauses['where'] .= " AND {$table_name}.dp_date >= '$from_date' ";
		$clauses['groupby'] = "{$table_name}.postnumber";
		$clauses['orderby']  = "SUM({$table_name}.cntaccess) ";
		$clauses['orderby'] .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
	}

	return $clauses;
}
add_filter( 'posts_clauses', 'tptn_column_clauses', 10, 2 );


/**
 * Output CSS for width of new column.
 *
 * @since	1.2
 *
 */
function tptn_admin_css() {
?>
<style type="text/css">
	#tptn_total, #tptn_daily, #tptn_both { max-width: 100px; }
</style>
<?php
}
add_action( 'admin_head', 'tptn_admin_css' );

?>