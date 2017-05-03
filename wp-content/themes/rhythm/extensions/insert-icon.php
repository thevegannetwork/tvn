<?php
/**
 * Insert Icon popup window.
 *
 */
$path = realpath(dirname(__FILE__));
$position = strrpos($path, 'wp-content');
$wp_path = substr($path, 0, $position);
require_once($wp_path . 'wp-load.php');

$nav_item_id = 0;
if (isset($_GET['nav_item_id'])) {
	$nav_item_id = intval($_GET['nav_item_id']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php _e('Insert Icon', 'rhythm'); ?></title>
	</head>
	<body>
		<script>
			var $nav_item_id = <?php echo esc_js($nav_item_id); ?>;

			jQuery(document).ready( function($) {

				var formatIconItem = function(item) {

					var value = String(item.id).toLowerCase(),
						text = item.text;

					if ( value.indexOf('fa-') >= 0 ) {

						var item_text = text.replace('fa-','');

						return '<i class="' + value + '"></i> ' + item_text;

					}

					return text;

				}

				$('#icon-item').select2({
					templateResult: formatIconItem,
					templateSelection: formatIconItem,
					escapeMarkup: function(m) { return m; }
				});

				/**
				 * Click on "Insert icon" button
				 */
				$('#insert-icon').click(function (event) {

					event.preventDefault();
					$('#icon-item').select2('destroy');

					$icon = $('#icon-item').val();

					$('#edit-menu-preview-icon-' + $nav_item_id).html('<i class="' + $icon + '"></i>');
					$('#edit-menu-item-icon_' + $nav_item_id).val($icon);

					tb_remove();
				});
			});
		</script>

		<form class="insert-icon-form">
			<div class="insert-icon-field">
				<select name="icon-item" id="icon-item">
					<?php $icons = ts_get_icons_array();
					if (is_array($icons)):
						foreach ($icons as $key => $icon): ?>
							<option value="<?php echo esc_attr($icon); ?>"><?php echo esc_html($key); ?></option>
						<?php endforeach;
					endif; ?>
				</select>
			</div>
			<input id="insert-icon" name="save" type="submit" class="button button-primary button-large" value="<?php echo esc_attr(__('Insert', 'rhythm')); ?>" />
		</form>
	</body>
</html>
