function up_update_conversation( content ){

				jQuery('.userpro-conv-ajax').append( content );
				jQuery('.userpro-conv-ajax').mCustomScrollbar('destroy');
				jQuery('.userpro-conv-ajax').mCustomScrollbar({
					theme:"dark-2",
					advanced:{
						updateOnContentResize: true,
					}
				});
				up_msg_overlay_resize();
				jQuery('.userpro-conv-ajax').imagesLoaded(function(){
					jQuery(this).mCustomScrollbar("scrollTo", "bottom",{scrollInertia:0});
				});
				
}

function up_msg_overlay( chat_from, chat_with ) {

	up_msg_cancel();
	
	jQuery('body').append('<div class="userpro-msg-overlay"></div>');
	jQuery('body').append('<div class="userpro-msg-overlay-loader"></div>');
	
	/* prepare ajax file */
	str = 'action=userpro_init_chat&chat_from=' + chat_from + '&chat_with=' + chat_with;
	jQuery.ajax({
		url: userpro_ajax_url,
		data: str,
		dataType: 'JSON',
		type: 'POST',
		success:function(data){
			if (jQuery('.userpro-msg-overlay-loader').length == 1) {
				jQuery('.userpro-msg-overlay-loader').remove();
				jQuery('body').append( data.html );

				/* limit textarea */
				jQuery('.userpro-msg-overlay-content textarea').autoResize({
					animate: {enabled: true},
					maxHeight: '300px'
				});
				
				/* update overlay, responsive, etc */
				up_msg_overlay_resize();
				userpro_chosen();
				
			}
		}
	});
	
}

function up_msg_overlay_show( user_id ) {

	up_msg_cancel();
	
	jQuery('body').append('<div class="userpro-msg-overlay"></div>');
	jQuery('body').append('<div class="userpro-msg-overlay-loader"></div>');
	
	/* prepare ajax file */
	str = 'action=userpro_show_chat&user_id=' + user_id;
	jQuery.ajax({
		url: userpro_ajax_url,
		data: str,
		dataType: 'JSON',
		type: 'POST',
		success:function(data){
			if (jQuery('.userpro-msg-overlay-loader').length == 1) {
				jQuery('.userpro-msg-overlay-loader').remove();
				jQuery('body').append( data.html );
				
				/* fancy textarea */
				jQuery('.userpro-msg-overlay-content textarea').autoResize({
					animate: {enabled: true},
					maxHeight: '300px'
				});
				
				/* limit content by scrollbar */
				jQuery('.userpro-msg-body.alt').css({'max-height': jQuery(window).height() - 200 + 'px'});
				jQuery('.userpro-msg-body.alt').mCustomScrollbar({
					theme:"dark-2",
					advanced:{
						updateOnContentResize: true,
						autoScrollOnFocus: false,
					}
				});
				
				/* update overlay, responsive, etc */
				up_msg_overlay_resize();
				userpro_chosen();
				
			}
		}
	});
	
}

/* Responsive overlay */
function up_msg_overlay_resize(){
	jQuery('.userpro-msg-overlay-content').animate({
			'opacity' : 1,
			'margin-top' : '-' + jQuery('.userpro-msg-overlay-content').innerHeight() / 2 + 'px'
	});
}

/* Remove overlay */
function up_msg_cancel(){
	jQuery('.tipsy').remove();
	jQuery('.userpro-msg-overlay-content, .userpro-msg-overlay-loader, .userpro-msg-overlay').remove();
}

/* Cancel reply */
function up_msg_cancel_quick_reply(){
	jQuery('.userpro-send-chat').css({'display' : 'none'});
}

/* Prepare message */
function up_msg_before_sending() {
	jQuery(".userpro-msg-overlay-content input[type=submit]").attr("disabled","disabled");
	jQuery('.userpro-msg-submit img').show();
}

/* Clear message */
function up_msg_clear(){
	jQuery(".userpro-msg-overlay-content textarea").val('');
	jQuery('.userpro-msg-submit img').hide();
}

jQuery(document).ready(function() {

	/* Back to inbox */
	jQuery(document).on('click', 'a.userpro-back-to-inbox',function(){
		jQuery(this).hide();
		jQuery('form.userpro-send-chat').hide().appendTo('.userpro-msg-body');
		jQuery('.userpro-conv').remove();
		jQuery('.userpro-msg-body').show();
		up_msg_overlay_resize();
	});
	
	/* read conversation */
	jQuery(document).on('click', '.userpro-msg-col:not(.disabled)', function(){
		jQuery('.userpro-msg-body').hide();
		jQuery('.userpro-msg-body').after('<div class="userpro-conv"></div>');
		jQuery('.userpro-msg-result').hide();
		jQuery('form.userpro-send-chat').hide();
		jQuery('form.userpro-send-chat').appendTo('.userpro-conv');
		jQuery('.userpro-conv').animate({'height' : '200px'}).addClass('loading');
		var chat_from = jQuery(this).data('chat_from');
		var chat_with = jQuery(this).data('chat_with');
		jQuery.ajax({
			url: userpro_ajax_url,
			data: "action=userpro_view_conversation&chat_from=" + chat_from + "&chat_with=" + chat_with,
			dataType: 'JSON',
			type: 'POST',
			error: function(){

			},
			success:function(data){
				
				jQuery('a.userpro-back-to-inbox').fadeIn();
				jQuery('.userpro-conv').removeClass('loading').prepend( data.html );

				jQuery('form.userpro-send-chat').find('input[type=button],button').hide();
				jQuery('form.userpro-send-chat').show();
				jQuery('form.userpro-send-chat').find('input#chat_with').val( chat_with );
				
				jQuery('.userpro-conv').height('auto');
				
				if (jQuery(window).height() > 700 ) {
					delimiter = 700 / 2;
				} else {
					delimiter = 250;
				}
				
				jQuery('.userpro-conv-ajax').css({
					'height' :  jQuery(window).height() - jQuery('.userpro-msg-user').innerHeight() - jQuery('.userpro-send-form').innerHeight() - delimiter
				});
				
				jQuery('.userpro-conv-ajax').mCustomScrollbar({
					theme:"dark-2",
					advanced:{
						updateOnContentResize: true,
					}
				});
				up_msg_overlay_resize();
				jQuery('.userpro-conv-ajax').imagesLoaded(function(){
					jQuery(this).mCustomScrollbar("scrollTo", "bottom",{scrollInertia:0});
				});
				
			}
		});
		
	});

	/* init Quick Reply */
	jQuery(document).on('click', '.userpro-msg-user-name span.bubble', function(e){
		e.stopPropagation();
		jQuery(this).parents('.userpro-msg-col').addClass('disabled');
		var elem = jQuery(this).parents('.userpro-msg-user-info');
		jQuery('.userpro-msg-result').hide();
		jQuery('form.userpro-send-chat').appendTo( elem ).show();
		jQuery('form.userpro-send-chat').find('input[type=button],button').show();
		var chat_with = jQuery(this).data('chat_with');
		jQuery('form.userpro-send-chat').find('input#chat_with').val( chat_with );
		jQuery('form.userpro-send-chat').find('textarea').focus();
		return false;
	});
	
	/* Show chats notifier */
	if (jQuery('.userpro-notifier').length) {
		jQuery('.userpro-notifier').delay(1000).animate({'bottom' : '0px'}, 300).animate({'bottom' : '-10px'}, 300).animate({'bottom' : '-4px'}, 300, function() { jQuery('.userpro-notifier-thumbs').fadeIn('slow'); });
	}
	
	/* Init chat */
	jQuery(document).on('click', '.userpro-init-chat', function(){
		chat_from = jQuery(this).data('chat_from');
		chat_with = jQuery(this).data('chat_with');
		up_msg_overlay( chat_from, chat_with );
	});
	
	/* Show chat */
	jQuery(document).on('click', '.userpro-show-chat', function(){
		user_id = jQuery(this).data('user_id');
		up_msg_overlay_show( user_id );
	});
	
	/* Submitting message */
	jQuery(document).on('submit', 'form.userpro-send-chat', function(e){
		e.preventDefault();
		form = jQuery(this);
		
		/* before sending message */
		up_msg_before_sending();
		
		/* sending message */
		jQuery.ajax({
			url: userpro_ajax_url,
			data: form.serialize() + "&action=userpro_start_chat",
			dataType: 'JSON',
			type: 'POST',
			error: function(){
				up_msg_clear();
				if (jQuery('.userpro-conv').length == 0){
				jQuery('.userpro-msg-result').html(data.message).fadeIn('slow');
				} else {
					up_update_conversation( data.html );
				}
			},
			success:function(data){
				up_msg_clear();
				if (jQuery('.userpro-conv').length == 0){
				jQuery('.userpro-msg-result').html(data.message).fadeIn('slow');
				} else {
					up_update_conversation( data.html );
				}
			}
		});
		return false;
		
	});
	
	/* Close overlay */
	jQuery(document).on('click', '.userpro-msg-overlay, a.userpro-msg-close',function(){
		up_msg_cancel();
	});
	
	/* Changing textarea state */
	jQuery(document).on('change keyup paste', ".userpro-msg-overlay-content textarea", function(){
		var emptyTextarea = false
		jQuery(".userpro-msg-overlay-content textarea").each(function(){
			if(jQuery(this).val().replace(/\n/g, "") =="" || jQuery.trim(jQuery(this).val()) == 0 )
			{
				emptyTextarea = true;
			}
		});
		if(!emptyTextarea)
		{
			jQuery('.userpro-msg-result').hide();
			jQuery(".userpro-msg-overlay-content input[type=submit]").removeAttr("disabled");
		} else {
			jQuery(".userpro-msg-overlay-content input[type=submit]").attr("disabled","disabled");
		}
	});

	/* Cancel message */
	jQuery(document).on('click', '.userpro-send-chat input[type=button]',function(){
		if (jQuery(this).parents('.userpro-msg-user-info').length > 0){
			jQuery(this).parents('.userpro-msg-col').removeClass('disabled');
			up_msg_cancel_quick_reply();
		} else {
			up_msg_cancel();
		}
	});
	
	/* Quick reply hover */
	jQuery(document).on('mouseenter', '.userpro-msg-user-name span.bubble', function(){
		parent = jQuery(this).parents('.userpro-msg-col');
		parent.find('.userpro-msg-user-name span.bubble-text').show();
		parent.find('.userpro-msg-view').hide();
	});
	
	jQuery(document).on('mouseleave', '.userpro-msg-user-name span.bubble', function(){
		parent = jQuery(this).parents('.userpro-msg-col');
		parent.find('.userpro-msg-user-name span.bubble-text').hide();
		parent.find('.userpro-msg-view').show();
	});
	
});