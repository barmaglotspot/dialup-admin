<?php
if (is_file("../lib/sql/drivers/$config[sql_type]/functions.php3"))
	include_once("../lib/sql/drivers/$config[sql_type]/functions.php3");
else{
	echo "<b>Could not include SQL library</b><br>\n";
	exit();
}
$link = @da_sql_pconnect($config);
if ($link){
	$res = @da_sql_query($link,$config,
		"DELETE FROM $config[sql_groupreply_table] WHERE GroupName = '$login';");
	if ($res){
		$res = @da_sql_query($link,$config,
			"DELETE FROM $config[sql_groupcheck_table] WHERE GroupName = '$login';");
		if ($res){
			$res = @da_sql_query($link,$config,
				"DELETE FROM $config[sql_usergroup_table] WHERE GroupName = '$login';");
				if ($res)
					echo "<b>Group $login deleted successfully</b><br>\n";
				else
					echo "<b>Error deleting group $login from usergroup table</b><br>\n";
		}
		else
			echo "<b>Error deleting group $login from group check table</b><br>\n";
	}
	else
		echo "<b>Error deleting group $login from group reply table</b><br>\n";
}
else
	echo "<b>Could not connect to database</b><br>\n";
?>
