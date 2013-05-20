<?php 
require_once 'jsonquery.php';
require_once 'nowplaying.php';
echo "
		<div id=\"container\">
			<center>
				<div id=\"header\">
					<h1>
						<a href=\"index.php\">Simple Boxee Web Remote</a>
					</h1>
				</div>
			</center>
			<div id=\"blank\">&nbsp;</div>
		</div>";
$enCours = nowPlaying();

if ($enCours != '')
{
	echo "<div id=\"nowPlaying\"><center>".$enCours;
	echo "</center></div>";
}
?>
