<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 23/03/2016
 *
 * Domain: 
 * Global
 *
 * Type:
 * Functions
 * 
 * Description:
 * Global functions
 */

function is_active( $route, $text = '' )
{
	if ( empty($route) )
		return false;

	$router = app('router');
	if ( is_array($route) ) {
		foreach($route as $name) {
			if ( $router->is($name) ) {
				if ( $text != '' ) {
					return $text;
				}
				else {
					return true;
				}
			}
		}
	}
	else {
		if ( $router->is($route) ) {
			if ( $text != '' ) {
				return $text;
			}
			else {
				return true;
			}
		}
	}

	return false;
}

function cbPermissions( $name, $data = [] )
{
  foreach ( ['can_view', 'can_edit', 'can_delete'] as $permission )
  {
    $checked = '';
    if ( ! empty($data) && in_array($name . '_' . $permission, $data) ) {
      $checked = ' checked';
    }
  ?>
  <label class="ckbox">
    <input type="checkbox" name="<?php echo 'permissions['. $name . '_' . $permission .']'?>" <?php echo $checked?>><span><?php echo trans('global.' . $permission)?></span>
  </label>
  <?php
  }
}

function redactor( $name )
{
	?><script src="/public/manager/assets/lib/redactor/redactor.min.js"></script>
  <script src="/public/manager/assets/lib/redactor/plugins.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('textarea[name=<?php echo $name?>]').redactor({
			minHeight: 200,
      imageUpload: '/manager/media/upload',
      plugins: ['imagemanager', 'fullscreen']
		});
	});
	</script>
	<?php
}
