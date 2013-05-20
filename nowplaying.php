<?php


function nowPlaying() 
{

	$enCours = '';
    
	$request = '{"jsonrpc" : "2.0", "method": "Player.GetActivePlayers", "id": 1}';
    $array = jsonQuery($request);
	
	if ($array[result][audio] == true || $array[result][video] == true )
	{
		if ($array[result][audio] == true)
		{
    		$request = '{"jsonrpc" : "2.0", "method": "AudioPlayer.State", "id": 1}';
		}
        if ($array[result][video] == true)
        {
            $request = '{"jsonrpc" : "2.0", "method": "VideoPlayer.State", "id": 1}';
        }

    	$array = jsonQuery($request);
        $enCours =  utf8_decode($array[result][state][stream]);
    
        $title = substr($enCours,strrpos($enCours,'/')+1,strlen($enCours));

		$tmp = strrpos($enCours,$title);		

		$album =  substr($enCours,0,$tmp-1);
		$album = substr($album,strrpos($album,'/')+1,strlen($album));
	
		$artiste = '';
        if ($array[result][audio] == true)
        {
			$tmp = strrpos($enCours,$album);
	  		$artiste =  substr($enCours,0,$tmp-1);
        	$artiste = substr($artiste,strrpos($artiste,'/')+1,strlen($artiste));
			$artiste = $artiste." - ";
		}

        $enCours = "::: ".$artiste.$album." - ".$title." :::";
	} 

return $enCours;

}

?>
