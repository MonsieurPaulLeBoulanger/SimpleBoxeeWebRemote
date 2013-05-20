<?php
include "topline.php";
include "config.php";
require_once "jsonquery.php";

//get active or inactive players
$request = '{"jsonrpc": "2.0", "method": "Player.GetActivePlayers", "id": 1}';
$array = jsonQuery($request);


echo "<br>";

if(!empty($_GET['id'])) {

	if ($_GET['id'] == 'AudioPlaylist.SkipPrevious') 
	{
		//audio skip previous
		$request = '{"jsonrpc": "2.0", "method": "AudioPlayer.SkipPrevious", "id": 1}';
		$array = jsonQuery($request);
	}

	if ($_GET['id'] == 'AudioPlaylist.SkipNext') 
	{
		//audio skip next
		$request = '{"jsonrpc": "2.0", "method": "AudioPlayer.SkipNext", "id": 1}';
		$array = jsonQuery($request);
	}

	if ($_GET['id'] == 'AudioPlayer.PlayPause') 
	{
		//audio play or pause
  		$request = '{"jsonrpc": "2.0", "method": "AudioPlayer.PlayPause", "id": 1}';
 		$array = jsonQuery($request);
	}

	//Action Move up
	if ($_GET['id'] == 'Action.Move.Up') 
	{
        $request = '{"jsonrpc": "2.0", "method": "Input.Up", "id": 1}';
        $array = jsonQuery($request);
	}

	//Action Move down
	if ($_GET['id'] == 'Action.Move.Down') 
	{
        $request = '{"jsonrpc": "2.0", "method": "Input.Down", "id": 1}';
        $array = jsonQuery($request);
	}

	//Action Move left
	if ($_GET['id'] == 'Action.Move.Left') 
	{
        $request = '{"jsonrpc": "2.0", "method": "Input.Left", "id": 1}';
        $array = jsonQuery($request);
	}

	//Action Move right
	if ($_GET['id'] == 'Action.Move.Right') 
	{
        $request = '{"jsonrpc": "2.0", "method": "Input.Right", "id": 1}';
        $array = jsonQuery($request);
	}

	//Action Select
	if ($_GET['id'] == 'Action.Select') 
	{
		fopen("$xbmchttpapi/xbmcCmds/xbmcHttp?command=Action(7)", "r");
	}

	//Action Previous
	if ($_GET['id'] == 'Action.Previous') 
	{
        $request = '{"jsonrpc": "2.0", "method": "Input.Back", "id": 1}';
        $array = jsonQuery($request);
	}

	//Action Show Info
	if ($_GET['id'] == 'Action.Show.Info') 
	{
		fopen("$xbmchttpapi/xbmcCmds/xbmcHttp?command=Action(11)", "r");
	}

	//Action Show Info
	if ($_GET['id'] == 'Action.Context') 
	{
		fopen("$xbmchttpapi/xbmcCmds/xbmcHttp?command=Action(117)", "r");
	}

	//Action Stop
	if ($_GET['id'] == 'Action.Stop') 
	{
		fopen("$xbmchttpapi/xbmcCmds/xbmcHttp?command=Action(13)", "r");
	}

    //Action Shutdown
    if ($_GET['id'] == 'Shutdown')
    {
        //audio skip previous
        $request = '{"jsonrpc": "2.0", "method": "System.Shutdown", "id": 1}';
        $array = jsonQuery($request);
var_dump ($array);
    }

}

  //get current volume
  $request = '{"jsonrpc": "2.0", "method": "XBMC.GetVolume", "id": 1}';
 $array = jsonQuery($request);

  //increase and decrease volumes
  $decreasevolume = $array['result'] - 5;
  $increasevolume = $array['result'] + 5;

if(!empty($_GET['id'])) {

//incease volume
if ($_GET['id'] == 'Increase.Volume') {
  $request = '{"jsonrpc": "2.0", "method": "XBMC.SetVolume", "params": ' . $increasevolume . ', "id": 1}';
  $array = jsonQuery($request);
}

//decrease volume
if ($_GET['id'] == 'Decrease.Volume') {
  $request = '{"jsonrpc": "2.0", "method": "XBMC.SetVolume", "params": ' . $decreasevolume . ', "id": 1}';
 $array = jsonQuery($request);
}

}

include "downline.php";

?>

