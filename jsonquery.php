<?php
//include "config.php";

function jsonQuery($query){
include "config.php";

	$socket = fsockopen($boxee_host, $boxee_json_port);


	$auth = '{"jsonrpc": "2.0", "method": "Device.Connect", "params":{"deviceid": "BoxeeWebRemote" },"id": 1}';
    fputs($socket,$auth);


	$ret = fgets($socket, 4096);

	fputs($socket,$query);

    $ret = fgets($socket, 65536); 

	fclose($socket);

	//utf8_encode needed otherwise issue while decoding, json_return will return NULL
	$ret = utf8_encode($ret);

	$ret = json_decode($ret,true);
	
    return $ret;
}

?>
