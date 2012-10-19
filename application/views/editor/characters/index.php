<div class="pane">
	<div class="row-fluid">
		<div class="span4">
			<ul class="nav nav-list well">
				<li class="nav-header">Manage</li>
				<li <?php if($this->uri->segment(3)==''){ ?>class="active"<?php } ?>><a href="<?=base_url('editor/characters')?>">All Characters</a></li>
				<li <?php if($this->uri->segment(3)=='create'){ ?>class="active"<?php } ?>><a href="<?=base_url('editor/characters/create')?>">Create Character</a></li>
				<li class="nav-header">Properties</li>
				<li <?php if($this->uri->segment(3)=='classes'){ ?>class="active"<?php } ?>><a href="<?=base_url('editor/characters/classes')?>">Classes</a></li>
				<li <?php if($this->uri->segment(3)=='zodiacs'){ ?>class="active"<?php } ?>><a href="<?=base_url('editor/characters/zodiacs')?>">Zodiacs</a></li>
			</ul>
		</div>
		<div class="span7">
			<div class="page-header">
				<h1>All Characters</h1>
			</div>
		</div>
	</div>
</div>