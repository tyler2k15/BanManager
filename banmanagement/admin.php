<?php
if($settings['password'] == '')
	errors('You have not yet set a password!');
else if(!isset($_SESSION['admin']) && !isset($_POST['password'])) {
	?><form action="" method="post" class="well form-inline">
    <input type="password" class="input-xlarge" name="password" placeholder="Password">
    <button type="submit" class="btn">Sign in</button>
    </form><?php
} else if(isset($_POST['password']) && !isset($_SESSION['admin'])) {
	if($_POST['password'] != $settings['password'])
		redirect('index.php?action=admin');
	else {
		$_SESSION['admin'] = true;
		redirect('index.php?action=admin');
	}
} else if(isset($_SESSION['admin']) && $_SESSION['admin']) {
	?>
	<table class="table table-striped table-bordered" id="servers">
		<thead>
			<th>Server Name</th>
			<th>Options</th>
		</thead>
		<tbody><?php
	if(empty($settings['servers']))
		echo '<tr id="noservers"><td colspan="2">No Servers Defined</td></tr>';
	else {
		$id = array_keys($settings['servers']);
		$i = 0;
		foreach($settings['servers'] as $server) {
			echo '
				<tr>
					<td>'.$server['name'].'</td>
					<td><!-- <a href="#" class="btn btn-warning editServer"><i class="icon-edit icon-white"></i></a> --> <a href="#" class="btn btn-danger deleteServer" data-serverid="'.$id[$i].'"><i class="icon-trash icon-white"></i></a></td>
				</tr>';
			++$i;
		}
	}
		?></tbody>
	</table>
	<a class="btn btn-primary btn-large" data-toggle="modal" href="#addserver" >Add Server</a>
	<div class="modal hide fade" id="addserver">
		<form class="form-horizontal" action="" method="post">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>Add Server</h3>
			</div>
			<div class="modal-body">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="servername">Server Name:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="servername" id="servername">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="host">MySQL Host:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="host" id="host">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="database">MySQL Database:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="database" id="database">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="username">MySQL Username:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="username" id="usernme">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">MySQL Password:</label>
						<div class="controls">
							<input type="password" class="input-xlarge" name="password" id="password">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="banstable">Bans Table:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="banstable" id="banstable" value="mb_bans">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="recordtable">Bans Record Table:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="recordtable" id="recordtable" value="mb_ban_records">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="iptable">IP Bans Table:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="iptable" id="iptable" value="mb_ip_bans">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="iprecordtable">IP Record Table:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="iprecordtable" id="iprecordtable" value="mb_ip_records">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mutestable">Mutes Table:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="mutestable" id="mutestable" value="mb_mutes">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mutesrecordtable">Mutes Record Table:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="mutesrecordtable" id="mutesrecordtable" value="mb_mutes_records">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="kickstable">Kicks Table:</label>
						<div class="controls">
							<input type="text" class="input-xlarge required" name="kickstable" id="kickstable" value="mb_kicks">
						</div>
					</div>
				</fieldset>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<input type="submit" class="btn btn-primary" value="Save" />
			</div>
		</form>
	</div>
	<?php
}
?>
<script src="js/admin.js"></script>