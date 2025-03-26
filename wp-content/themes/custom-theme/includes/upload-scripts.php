<script type="text/javascript">

	function common_remove_upload(img_id){
		var answer = confirm("Are you sure?");
		if (answer) {
			jQuery(img_id).val('');
		}else {
			return false; // Do nothing.
		}
	}

		jQuery(document).ready(function() {
			if (jQuery('window').tb_show){
				alert('error');
			}
			
				jQuery('.upload-button').click(function() {
					var up_image_text = jQuery(this).parents('.upload-image').find('.up-image');
					var up_image_container = jQuery(this).parents('.upload-image').find('.upload-image-container');
					tb_show('','media-upload.php?type=image&TB_iframe=true');
					window.send_to_editor = function(html) {
						var $new = html;
				     var imgurl = jQuery($new).attr('src');
					//var imgurl = jQuery('img',html).attr('src');
					up_image_text.val(imgurl);
					up_image_container.html('<br/><img src="'+imgurl+'" style="max-width:300px;max-height: 150px;" alt="banner-image" />');
					tb_remove();
					}
					return false;
					
				});
			
				jQuery('.file-upload-button').click(function() {
				
					var up_file_text = jQuery(this).parents('.upload-file').find('.up-file');
					var up_file_container = jQuery(this).parents('.upload-file').find('.upload-file-container');
					
					tb_show('','media-upload.php?type=file&TB_iframe=true');
					window.send_to_editor = function(html) {
					var imgurl = jQuery(html).attr('href');
					
					jQuery(up_file_text).val(imgurl);
					jQuery(up_file_container).html('<br/><a href="'+imgurl+'" target="_blank">Download File</a>');
					tb_remove();
					}
					return false;
				});
			
				jQuery('.remove-button').click(function() {
					var path = jQuery(this).parent('.upload-image').find('.up-image');
					common_remove_upload(path);
					jQuery(this).parents('.upload-image').find('.upload-image-container').html('');
				});
				
				jQuery('.remove-file').click(function() {
					var path =  jQuery(this).parents('.upload-file').find('.up-file');
					common_remove_upload(path);
					jQuery(this).parents('.upload-file').find('.upload-file-container').html('');
				});
			
		});
	</script>
