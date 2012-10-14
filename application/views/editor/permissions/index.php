<div class="page-header">
	<h1>Permissions</h1>
</div>
<?=form_open(current_url(), 'class="form-vertical"')?>
	<table class="table">
		<thead>
			<tr>
				<th class="span2">Group</th>
				<?php foreach ($controllers as $class_slug => $class_name): ?>
				<th style="text-align: center;"><?=$class_name?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($groups as $group): ?>
			<tr>
				<td class="span2"><?=$group->description?></td>
				<?php foreach ($controllers as $class_slug => $class_name): ?>
				<td style="text-align: center;">
					<input type="checkbox" name="permissions[<?=$group->name?>][<?=$class_slug?>]" value="1" <?=(isset($group->permissions->$class_slug)) ? 'checked="checked"' : ''?>>
				</td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<div class="form-actions">
		<?=bootstrap_submit('submit', 'Save Permissions', 'class="btn btn-primary"')?>
	</div>
</form>