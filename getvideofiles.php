<?php
include 'topline.php';
require_once 'jsonquery.php';
require_once 'm3u_func.php';
require_once 'server_func.php';


include 'top.php';


//array_sort function
function array_sort($a, $b)
{
    return strnatcmp($a['label'], $b['label']);
}

echo "<div id=\"content\"><ul>";


if(!empty($_GET['source']))
{

	//get argument of the source
	$location = $_GET['source'];

	//get the results from the directory
	$request2 = '{"jsonrpc" : "2.0", "method" : "Files.GetDirectory", "params" : { "directory" : "' . $location . '" }, "id" : 1}';
	//$array2 = json_decode(curl_exec($ch),true);

	$array2 = jsonQuery($request2);
	//query below contains both files and directories
	$xbmcresults = $array2['result'];

	//if the directory has content call AudioPlaylist.ttt
	if(!empty($_GET['directorycontent'])) 
	{
	  //get selected songs
	  $addplaylist = $_GET['directorycontent'];

	  //only the files
	  $files = $xbmcresults['files'];

	  //sort files on name
	  usort($files, 'array_sort');

	  //count the number of songs
	  $songcount = count($files);

	  //put counter on zero
	  $i = 0;

	  //search the array_key of the selected song
	  foreach ($files as $value)
	  {

		$song = utf8_decode($value['label']);

		//there's a match
		if ($song == $addplaylist)
		{
		  //count remaining songs
		  $songqueue = $songcount - $i;

		  //we still need i
		  $y = $i;

		  $arraysongs = $files[$y];
		  $songlocations = utf8_decode($arraysongs['file']);
	
		  $request = '{"jsonrpc" : "2.0", "method": "XBMC.Play", "params" : { "file" : "' . $songlocations . '"}, "id": 1}';
		  $array = jsonQuery($request);
		}
		//loop for array_key
		$i++;
	  }
// ajout 08/12/2012 : retour sur la télécommande une fois la vidéo lancé
    echo '<script language="javascript">document.location = "remote.php";   </script>';
// fin 08/12/2012
	//end for argument empty
	}
	echo "<ul>";

	//show directories
	if (array_key_exists('directories', $xbmcresults)) 
	{
	  $directories = $xbmcresults['directories'];
	  //sort directories
	  usort($directories, 'array_sort');
	  foreach ($directories as $value)
	  {
		$inhoud = utf8_decode($value['label']);
		$display = urlencode($value['file']);
		  echo "<li><a href=getvideofiles.php?source=$display>$inhoud</a></li>";
	  }
	}


	echo "</ul>";

	echo "<ul>";

	//show files in directory
	if (array_key_exists('files', $xbmcresults)) 
	{
	  $files = $xbmcresults['files'];
	  //sort on name
	  usort($files, 'array_sort');
	  foreach ($files as $value)
	  {
		if ($value['filetype']=='file')
		{
			$inhoud = utf8_decode($value['label']);
			$display = urlencode($value['file']);
		
			//make directory and mp3 name url friendly
			$location2 = urlencode($location);
			$inhoud2 = urlencode($inhoud);
			echo "<li><a href=getvideofiles.php?source=$location2&directorycontent=$inhoud2>$inhoud</a></li>";
		}
		else
		{
			//DIRECTORY
			$inhoud = utf8_decode($value['label']);
			$display = urlencode(utf8_decode($value['file']));
			echo '<li>
					<table width="100%">
						<tr>
							<td>
								 <a href=getvideofiles.php?source='.$display.'>'.$inhoud.'</a>
							</td>
						</tr>
					</table>
				</li>';			
			// }
		}

	  }
	}

	echo "</ul></div>";
}
else 
{ 
	echo "No source given!"; 
}

include "downline.php";

?>
