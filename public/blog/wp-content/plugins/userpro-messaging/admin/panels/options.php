<form method="post" action="">

<h3><?php _e('','userpro-msg'); ?></h3>
<table class="form-table">
	
	<tr valign="top">
		<th scope="row"><label for="msg_privacy"><?php _e('Global Messaging Privacy','userpro'); ?></label></th>
		<td>
			<select name="msg_privacy" id="msg_privacy" class="chosen-select" style="width:300px">
				<option value="public" <?php selected('public', userpro_msg_get_option('msg_privacy')); ?>><?php _e('Open to all','userpro-msg'); ?></option>
				<option value="mutual" <?php selected('mutual', userpro_msg_get_option('msg_privacy')); ?>><?php _e('Mutual Followers','userpro-msg'); ?></option>
				<option value="none" <?php selected('none', userpro_msg_get_option('msg_privacy')); ?>><?php _e('Disable Messaging','userpro-msg'); ?></option>
			</select>
		</td>
	</tr>
	
</table>

<p class="submit">
	<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes','userpro-msg'); ?>"  />
	<input type="submit" name="reset-options" id="reset-options" class="button" value="<?php _e('Reset Options','userpro-msg'); ?>"  />
</p>

</form>