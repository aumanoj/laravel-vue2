<?php

	/* get a global option */
	function userpro_msg_get_option( $option ) {
		$userpro_default_options = userpro_msg_default_options();
		$settings = get_option('userpro_msg');
		switch($option){
		
			default:
				if (isset($settings[$option])){
					return $settings[$option];
				} else {
					return $userpro_default_options[$option];
				}
				break;
	
		}
	}
	
	/* set a global option */
	function userpro_msg_set_option($option, $newvalue){
		$settings = get_option('userpro_msg');
		$settings[$option] = $newvalue;
		update_option('userpro_msg', $settings);
	}
	
	/* default options */
	function userpro_msg_default_options(){
		$array = array();
		$array['msg_privacy'] = 'public';
		return apply_filters('userpro_msg_default_options_array', $array);
	}