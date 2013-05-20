<?php

function create_m3u($location)
{
	//get the results from the directory
	$request2 = '{"jsonrpc" : "2.0", "method" : "Files.GetDirectory", "params" : { "directory" : "' . $location . '" }, "id" : 1}';

	$array2 = jsonQuery($request2);

	//query below contains both files and directories
	$xbmcresults = $array2['result'];

	if (array_key_exists('files', $xbmcresults))
	{
		$files = $xbmcresults['files'];
		//sort on name
		usort($files, 'array_sort');
		foreach ($files as $value)
		{
			if ($value['filetype']=='file')
			{
				$innhoud = utf8_decode($value['label']);
				$display = urlencode($value['file']);

            	//make directory and mp3 name url friendly
				$location2 = urlencode($location);
				$inhoud2 = urlencode($inhoud);
				$extension=strtoupper(substr(strrchr($value['file'],'.'),1));

				if ($extension=='MP3' || $extension=='OGG' || $extension=='FLAC')
				{
					$_SESSION["m3u"] .= "#EXTINF:100,Dummy Artist-Dummy title\n";
					$_SESSION["m3u"] .= iconv("utf-8", "iso-8859-1//IGNORE", $value['file'] );
					$_SESSION["m3u"] .= "\n";
				}
			}
			else
			{
				//DIRECTORY
				$display = $value['file'];
				create_m3u($display);
			}
		}
	}
}	

?>
