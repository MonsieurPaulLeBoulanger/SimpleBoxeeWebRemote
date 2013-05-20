<?php 
//include port and hostname from config file
require_once "config.php";
require_once "jsonquery.php";
include "head.php";

$data = '{"jsonrpc": "2.0", "method": "JSONRPC.Ping", "id": 1}';
$array = jsonQuery ($data);

?>

</head>
<body>

<?php 
include 'top.php';
//show options or warning message

if ($array[result] == 'pong') {
	echo '	<div id="content">
			<ul>
				<li><a href="getmusicsources.php">Audio Sources</a></li>
				<li><a href="getvideosources.php">Video Sources</a></li>
				<li><a href="remote.php">Remote Control</a></li>

				<li>
					<form name="input" action="index.php" method="post">
						&nbsp; Weblink: <input size="auto" type="text" name="source" />
						<input type="submit" value="Submit" />
					</form> 	
				</li>
			</ul>
		</div>';
}
else
{
	echo "Could not connect to the jsonrpc Boxee service.";
	echo "<br><br>";
	echo "- Check if the option \"Allow control of Boxee via http\" is enabled in the Network Settings.";
	echo "<br>";
	echo "- Check if the port number in config.php matches the port number from the Network Settings.";
}

if(!empty($_POST['source']))
{
	//get argument of the source
	$location = $_POST['source'];

	$request = '{"jsonrpc" : "2.0", "method": "XBMC.Play", "params" : { "file" : "' . $location . '"}, "id": 1}'; 
	$array = jsonQuery($request); 

//	echo "&nbsp; going to URL: <b>" . $location . "</b>"; 
}
?>
</body>
</html>

