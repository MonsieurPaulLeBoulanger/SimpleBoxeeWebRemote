<?php
include "topline.php";
include "config.php";
require_once "jsonquery.php";


//prepare the field values being posted to the service
$request = '{"jsonrpc": "2.0", "method": "Files.GetSources", "params" : { "media" : "music" }, "id": 1}';

$array = jsonQuery($request);

$results = $array['result']['shares'];

include 'top.php';

echo "<div id=\"content\"><ul>";

//loop music sources
foreach ($results as $value)
{
  //show music sources
  // 08/12/2012 devrait permettre de ne plus avoir
  // de pb avec les accents :)

  $sourcename = utf8_decode($value['label']);
  $sourcelocation = urlencode(utf8_decode($value['file']));

//  $sourcename = $value['label'];
//  $sourcelocation = urlencode($value['file']);
  echo '<li>
			<a href=getmusicfiles.php?source='.$sourcelocation.'>'.$sourcename.'</a>
		</li>';
}

	

echo "</ul></div>";

include "downline.php";

?>

