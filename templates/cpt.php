
  
<div class="wrap">
	<h1>CPT Manager</h1>
	<?php settings_errors(); ?>

	
			<form method="post" action="options.php">
				<?php 
					settings_fields( 'yoast_focus_kw_auto_complete_cpt_settings' );
					do_settings_sections( 'yoast_focus_kw_auto_complete_cpt' );
					submit_button();
				?>
			</form>
		
	 
</div>
