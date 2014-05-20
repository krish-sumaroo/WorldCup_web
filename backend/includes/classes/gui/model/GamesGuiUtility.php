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

	}
	else
	{
	    $output .= ResultUpdateGuiUtility::getBootstrapInfoDisplay("There are no games present in the system");
	}

	return $output;
    }
}

?>
