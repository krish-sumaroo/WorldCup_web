<?php


class ImportPlayersManager
{

    public static function importPlayers()
    {
	ini_set("display_errors", 1); //debug

	$path = "/opt/lampp/htdocs/applications/git/WorldCup_web/backend/data/brazil.txt";

	$fileContents = file_get_contents($path);

	echo $fileContents;

	$contentArray = explode("\n", $fileContents);

	Debug::dumpArray($contentArray); //debug

	$keeperArray = explode(" ", $contentArray[1]);
	$keeperArray = preg_split('/[0-9]+/', $contentArray[1]);
	$defenderArray = explode(" ", $contentArray[3]);
	$midfielderArray = explode(" ", $contentArray[5]);
	$forwardArray = explode(" ", $contentArray[7]);

	Debug::dumpArray($keeperArray); //debug

	for($i = 1; $i < count($keeperArray); $i = $i++)
	{
	    echo "<p>keeper: ".$keeperArray[$i];
	}
    }

    public static function importPlayers1()
    {
	$pageContent = file_get_contents('http://www.bbc.com/sport/football/teams/brazil');
	$tagNameStart = "<span itemprop=\"name\">";
	$tagNameEnd = "</span>";
	$positionTagStart = "<div class='\"component-content\">";
	$positionTagHeaderStart = "<h3>";
	$positionTagHeaderEnd = "</h3>";

	$positionStart = strrpos($pageContent, $positionTagStart);
	$positionTextStart = strpos($pageContent, $positionTagHeaderStart, $positionStart) + strlen($positionTagHeaderStart);
	$positionTextEnd = strpos($pageContent, $positionTagHeaderEnd, $positionTextStart);

	$positionText = substr($pageContent, $positionTextStart, $positionTextEnd - $positionTextStart);

	echo "<p>positionText : $positionText</p>"; //debug
//	$offset = 0;
//
//	do
//	{
//	    $positionStart = strpos($pageContent, $tagNameStart, $offset);
//	    $realPositionStart = $positionStart + strlen($tagNameStart);
//	    $offset = $realPositionStart;
//
//	    $positionEnd = strpos($pageContent, $tagNameEnd, $realPositionStart);
//
//	    $playerName =
//	}
//	while($positionStart != -1);

	echo "<p>position : $position</p>"; //debug
    }
}

?>