<div class="userpro-conv-ajax">

	<!-- Conversation History should appear here -->
	<?php
	
	$conversation = $userpro_msg->get_conv_read($chat_from, $chat_with);
	$a = file_get_contents($conversation);
	$a = explode('[/]', $a);
	$b = array_reverse($a, true);
	foreach($b as $k => $item) {

		if ( strlen($item) > 10 ) {
		
		$message = $userpro_msg->get_msg_content( $item );
		if (isset($message['mode']) && $message['mode'] == 'sent') {
			$id = $chat_from;
		} else {
			$id = $chat_with;
		} ?>
		
	<div class="userpro-conv-item">
	
		<div class="userpro-conv-left">
			<div class="userpro-conv-user"><?php echo get_avatar( $id, 30); ?></div>
			<div class="userpro-conv-username"><?php if ($id == $chat_from) { _e('you said:','userpro-msg'); } else { printf(__('%s said:','userpro-msg'), userpro_profile_data('display_name', $id) ); } ?></div>
		</div>
		
		<div class="userpro-conv-right">
			<div class="userpro-conv-timestamp"><i class="userpro-icon-comment-alt"></i><?php echo $message['timestamp']; ?></div>
		</div><div class="userpro-clear"></div>
		
		<div class="userpro-conv-body">
			<?php echo $message['content']; ?>
		</div>
	
	</div>
	
	<?php }
		
		} ?>

</div>