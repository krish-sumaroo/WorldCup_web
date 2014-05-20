<?php


class GamesGuiUtility extends BaseGamesGuiUtility
{

    public static function getGamesListDisplay()
    {
	$output = "";

	$sortQuery = new SortQuery();
	$sortQuery->addSort(GamesLogicUtility::$MATCHDATE_FIELD, SortQuery::$DESCENDING);

	$gamesEntityList = GamesLogicUtility::getGamesList($sortQuery, GamesLogicUtility::$NOT_STARTED_STATUS);

	if(count($gamesEntityList) > 0)
	{
	    $output .= "<table class='table'>";

	    $output .= "<thead>";
	    $output .= "<tr>";
	    $output .= "<th>Match Date</th>";
	    $output .= "<th>Match</th>";
	    $output .= "<th>Action</th>";
	    $output .= "</tr>";
	    $output .= "</thead>";

	    $output .= "<tbody>";

	    for($i = 0; $i < count($gamesEntityList); $i++)
	    {
		$output .= "<tr>";
		$output .= "<td>".$gamesEntityList[$i]->getMatchDate()."</td>";
		$output .= "<td>".$gamesEntityList[$i]->getVsDisplay()."</td>";
		$output .= "<td>";
		$output .= "<a class='btn btn-primary' href=''>Engage</a>";
		$output .= "</td>";
		$output .= "</tr>";
	    }

	    $output .= "</tbody>";

	    $output .= "</table>";
	}
	else
	{
	    $output .= ResultUpdateGuiUtility::getBootstrapInfoDisplay("There are no games present in the system");
	}

	return $output;
    }
}

?>
