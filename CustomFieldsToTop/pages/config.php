<?php
/**
*
* MantisBT Plugin: CustomFieldsToTop - Moves selected custom fields to the top of the Report Issue form and the Update Issue form.
*
* @copyright (c) 2021, LukeWCS
*
*/

layout_page_header(plugin_lang_get('title'));
layout_page_begin('manage_overview_page.php');
print_manage_menu('manage_plugin_page.php');

?>

<div class="col-md-12 col-xs-12">
	<div class="space-10"></div>

	<div class="form-container">
		<form action="<?php echo plugin_page('config_update') ?>" method="post">
			<?php echo form_security_field('plugin_CustomFieldsToTop_config_update') ?>
			<div class="widget-box widget-color-blue2">
				<div class="widget-header widget-header-small">
					<h4 class="widget-title lighter">
						<?php print_icon('fa-cogs', 'ace-icon') ?>
						<?php echo plugin_lang_get('title') . ': ' . plugin_lang_get('configuration') ?>
					</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding table-responsive">
						<table class="table table-bordered table-condensed table-striped">
							<tr>
								<th class="category">
									<label>
										<?php echo plugin_lang_get('custom_fields_report_title') ?>
										<br><span class="small"><?php echo plugin_lang_get('custom_fields_description') ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="custom_fields_report" class="input-sm" size="80" maxlength="200" pattern="[0-9,]*" placeholder="1,2,3" value="<?php echo plugin_config_get('custom_fields_report') ?>">
									<br><span class="small">&bull; <?php echo plugin_lang_get('custom_fields_input_note1') ?></span>
									<br><span class="small">&bull; <?php echo plugin_lang_get('custom_fields_input_note2') ?></span>
								</td>
							</tr>
							<tr>
								<th class="category">
									<label>
										<?php echo plugin_lang_get('custom_fields_update_title') ?>
										<br><span class="small"><?php echo plugin_lang_get('custom_fields_description') ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="custom_fields_update" class="input-sm" size="80" maxlength="200" pattern="[0-9,]*" placeholder="1,2,3" value="<?php echo plugin_config_get('custom_fields_update') ?>">
									<br><span class="small">&bull; <?php echo plugin_lang_get('custom_fields_input_note1') ?></span>
									<br><span class="small">&bull; <?php echo plugin_lang_get('custom_fields_input_note2') ?></span>
								</td>
							</tr>
							<tr>
								<th class="category">
									<label>
										<?php echo plugin_lang_get('show_after_move_title') ?>
										<br><span class="small"><?php echo plugin_lang_get('show_after_move_description')?></span>
									</label>
								</th>
								<td>
									<label>
										<input type="checkbox" class="ace input-sm" name="show_after_move" value="1"<?php echo (plugin_config_get('show_after_move') ? ' checked="checked"': '') ?>>
										<span class="lbl padding-6"></span>
									</label>
								</td>
							</tr>
						</table>
					</div>

					<div class="widget-toolbox padding-8 clearfix">
						<button class="btn btn-primary btn-white btn-round">
							<?php echo lang_get('change_configuration') ?>
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>

</div>

<?php
layout_page_end();
