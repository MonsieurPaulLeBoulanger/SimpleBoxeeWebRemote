<?php
include "topline.php";
include "config.php";
require_once "jsonquery.php";


//prepare the field values being posted to the service
$request = '{"jsonrpc": "2.0", "method": "Files.GetSources", "params" : { "media" : "video" }, "id": 1}';

$array = jsonQuery($request);

$results = $array['result']['shares'];

include 'top.php';

echo "<div id=\"content\"><ul>";

//loop video sources
foreach ($results as $value)
{
  //show video sources
  $sourcename = utf8_decode($value['label']);
  $sourcelocation = urlencode(utf8_decode($value['file']));
  echo '<li>
			<a href=getvideofiles.php?source='.$sourcelocation.'>'.$sourcename.'</a>
		</li>';
}

	

echo "</ul></div>";

include "downline.php";

?>

