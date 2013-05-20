<?php 
//include port and hostname from config file
require_once "config.php";
require_once "jsonquery.php";
require_once 'server_func.php';
include "head.php"
?>

</head>
<body>
<?php

if (isset($_GET["p"]))
{

	$data = '{"jsonrpc": "2.0", "method": "JSONRPC.Ping", "id": 1}';
	$array = jsonQuery ($data);

	//show options or warning message
	if ($array[result] == 'pong')
	{
		if (isset($_POST["code"]))
		{
			$data = '{"jsonrpc": "2.0", "method": "Device.PairResponse", "params":{"deviceid": "BoxeeWebRemote", "code": "'.$_POST["code"].'"},"id": 1}';
			$array = jsonQuery ($data);
						
			echo '<div align="center"></br></br>';
			echo "SImple Boxee Web Remote and your Boxee Box ***SHOULD*** be paired.<br/>
				You can check in Boxee's param in 'paired device' menu.<br/>
				If Simple Boxee Web Remote doesn't show up in this menu, check your configuration file<br/> 
				and be sure to enter properly the 4 digit number given by the boxee box.";
			echo '<br/><br/>';
				echo '<form name="form" action="index.php" method="post">
				   <input type="submit" value="Use Boxe Web Remote !" />
				 </form>';	
			echo '<br/><br/>';
				echo '<form name="Reform" action="pair.php?p=1" method="post">
				   <input type="submit" value="Restart pairing!" />
				 </form>';	
			echo '</div>'; 						 

		}
		else
		{

			$data='{"jsonrpc": "2.0", "method": "Device.PairChallenge", "params": {"deviceid": "BoxeeWebRemote", "applicationid": "BoxeeWebRemote", "label": "Boxee Web Remote", "icon": "'.getServer()."/img/boxee.png".'", "type": "remote"}, "id": 1}';
			$array = jsonQuery ($data);
			
			echo '<div align="center"></br></br>';
			echo "Your BoxeeBox should show a 4 digit number on your screen.
					Please enter the digit in the field below.";

			echo '<br/><br/>
				<form name="form" action="pair.php?p=1" method="post">
				Pairing Code: <input type="text" name="code" maxlength="4"/>
			   <input type="submit" />
			 </form>';
		echo '</div>'; 			 
		}
		
	}
	else
	{
		echo '<div align="center"></br></br>';
		echo "Unable to communicate with your boxee. Check your Boxee configuration and the config.php file.";
		echo '</div>'; 
	}

}
else
{
echo '<div align="center"></br></br>';
echo 'click on the button to start the pairing process</br></br></br>';
echo '<form name="form" action="pair.php?p=1" method="post">
   <input type="submit" value="start pairing!" />
 </form>';
echo '</div>'; 
}



?>

</body>
</html>

