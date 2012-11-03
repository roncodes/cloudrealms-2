<div class="pane">
	<div class="page-header">
		<h1>Permissions</h1>
	</div>
	<?=form_open(current_url(), 'class="form-vertical"')?>
		<?php foreach(array('controllers', 'editor', 'world') as $control){ ?>
		<div class="well">
		<h3><?=ucfirst($control)?></h3>
		<table class="table" style="overflow:scroll;">
			<thead>
				<tr>
					<th class="span2">Group</th>
					<?php foreach ($controllers as $class_slug => $class_name): ?>
					<?php if($class_name[1]==$control){ ?>
					<th style="text-align: center;"><?=$class_name[0]?></th>
					<?php } ?>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($groups as $group): ?>
				<tr>
					<td class="span2"><?=$group->description?></td>
					<?php foreach ($controllers as $class_slug => $class_name): ?>
					<?php if($class_name[1]==$control){ ?>
					<td style="text-align: center;">
						<input type="checkbox" name="permissions[<?=$group->name?>][<?=$class_slug?>]" value="1" <?=(isset($group->permissions->$class_slug)) ? 'checked="checked"' : ''?>>
					</td>
					<?php } ?>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>
		<?php } ?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Save Permissions', 'class="btn btn-primary"')?>
		</div>
	</form>
</div>