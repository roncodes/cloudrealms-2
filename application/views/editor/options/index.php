<div class="page-header">
	<a href="<?=base_url('admin/options/create')?>" class="btn pull-right">Create Option</a>
	<h1>All Options</h1>
</div>
<?php if ( ! empty($settings)): ?>
<table class="table">
	<thead>
		<tr>
			<th>Option Name</th>
			<th>Option Value</th>
			<th class="span1"></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($settings as $name => $value): ?>
		<tr>
			<td><?=$name?></td>
			<td><?=$value?></td>
			<td><a href="<?=base_url('admin/options/edit/'.$name)?>"><i class="icon-pencil"></i></a></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<div class="alert alert-error">There are currently no options in the database.</div>
<?php endif; ?>