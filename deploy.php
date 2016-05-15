<?PHP

require("settings.php");
require("libraries/ts3admin.class.php");

// chdir(dirname(__FILE__));

$ts3_ip = $ip;
$ts3_queryport = $query_port;
$ts3_user = $login_name; 
$ts3_pass = $login_password;
$ts3_port = $virtualserver_port;
$mode = 3; 
$target = $sid;
$botName = 'Backup Deploy Bot';


$tsAdmin = new ts3admin($ts3_ip, $ts3_queryport);
if(isset($_POST['button1'])) {
if($tsAdmin->getElement('success', $tsAdmin->connect())) {
$tsAdmin->login($ts3_user, $ts3_pass);
$tsAdmin->selectServer($ts3_port);

$snapshot = $_POST["deploy"];
$tsAdmin->serverSnapshotDeploy($snapshot);

$tsAdmin->setName($botName);
$tsmessage = "<div class='alert alert-success'><strong><center>Backup deploy successful!</strong></center></div>";
$tsmessage2 = 'Backup deploy successful !';
echo $tsmessage;
$tsAdmin->sendMessage($mode, $target, $tsmessage2);
  }


  else{


	 echo "<div class='alert alert-danger'><strong><center>Connection could not be established.</strong></center></div>";

}
}
if(count($tsAdmin->getDebugLog()) > 0) {
	foreach($tsAdmin->getDebugLog() as $logEntry) {
		echo '<script>alert("'.$logEntry.'");</script>';
	}
}

?>
