<div class="userpro-notifier">

	<a href="#" class="userpro-notifier-link userpro-show-chat" data-user_id="<?php echo $user_id; ?>">
		<span class="count"><i class="userpro-icon-comment"></i><?php echo $userpro_msg->new_chats_notifier($user_id); ?></span>
	</a>

</div>

<span class="userpro-notifier-thumbs"><?php echo $userpro_msg->new_chats_user_thumbs($user_id); ?></span>