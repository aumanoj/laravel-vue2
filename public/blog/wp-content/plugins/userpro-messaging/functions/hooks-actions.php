<?php

	/* Enqueue Scripts */
	add_action('wp_enqueue_scripts', 'userpro_msg_enqueue_scripts', 99);
	function userpro_msg_enqueue_scripts(){
	
		wp_register_style('userpro_msg', userpro_msg_url . 'css/userpro-msg.css');
		wp_enqueue_style('userpro_msg');
		
		wp_register_style('userpro_mcsroll', userpro_msg_url . 'css/jquery.mCustomScrollbar.css');
		wp_enqueue_style('userpro_mcsroll');
		
		wp_register_script('userpro_msg', userpro_msg_url . 'scripts/userpro-msg.js');
		wp_enqueue_script('userpro_msg');
		
		wp_register_script('userpro_textarea_auto', userpro_msg_url . 'scripts/jquery.textareaAutoResize.js');
		wp_enqueue_script('userpro_textarea_auto');
	
		wp_register_script('userpro_mousewheel', userpro_msg_url . 'scripts/jquery.mousewheel.min.js');
		wp_enqueue_script('userpro_mousewheel');
		
		wp_register_script('userpro_mcsroll', userpro_msg_url . 'scripts/jquery.mCustomScrollbar.min.js');
		wp_enqueue_script('userpro_mcsroll');
		
	}
	
	/* Add messages button / send chat button to profile */
	add_action('userpro_social_buttons', 'userpro_msg_profile_buttons');
	function userpro_msg_profile_buttons( $user_id ){
		global $userpro_msg;
		if ( $userpro_msg->can_chat_with( $user_id ) ) {
			
			$res = '<a href="#" class="userpro-button chat userpro-init-chat" data-chat_with="'.$user_id.'" data-chat_from="'.get_current_user_id().'"><i class="userpro-icon-comment"></i>'.__('Send Message','userpro');

			$res .= '</a>';
			
		} else if (userpro_is_logged_in() && $user_id == get_current_user_id() ) {
			
			$res = '<a href="#" class="userpro-button secondary userpro-show-chat userpro-tip" data-user_id="'.$user_id.'" title="'.$userpro_msg->new_chats_notifier($user_id).'"><i class="userpro-icon-comments"></i>'.__('My Messages','userpro');
			
			if ($userpro_msg->new_chats_notifier_count($user_id) > 0 ) {
				$res .= '<span>'.$userpro_msg->new_chats_notifier_count($user_id).'</span>';
			}
			
			$res .= '</a>';
			
		}
		
		echo $res;
		
	}
	
	/* Add chat/message badge */
	add_filter('userpro_after_all_badges','userpro_show_msg_icon', 99, 1);
	function userpro_show_msg_icon($user_id){
	
		global $userpro_msg;
		
		if ( $userpro_msg->can_chat_with( $user_id ) ) {
			$res = '<img data-chat_with="'.$user_id.'" data-chat_from="'.get_current_user_id().'" class="userpro-profile-badge userpro-profile-badge-msg userpro-init-chat" src="'.userpro_msg_url . 'img/icon-chat-small.png" alt="" title="'.__('Send a message','userpro-msg').'" />';
		} else if (userpro_is_logged_in() && $user_id == get_current_user_id() ) {
			$res = '<img data-user_id="'.get_current_user_id().'" class="userpro-profile-badge userpro-profile-badge-msg userpro-show-chat" src="'.userpro_msg_url . 'img/icon-messages-small.png" alt="" title="'.__('My Messages','userpro-msg').'" />';
		}
		
		return $res;
	}
	
	/* Notification of new messages */
	add_filter('wp_footer', 'userpro_show_new_notification');
	function userpro_show_new_notification(){
		global $userpro_msg;
		if (userpro_is_logged_in()){
			$user_id = get_current_user_id();
			if ($userpro_msg->has_new_chats($user_id)) {
				require_once userpro_msg_path . 'templates/notification.php';
			}
		}
	}