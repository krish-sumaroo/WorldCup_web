<?php


class GamesEntity extends BaseGamesEntity
{

    public function getVsDisplay()
    {
	$team1 = $this->getTeam1Entity()->getName();
	$team2 = $this->getTeam2Entity()->getName();

	return "$team1 v/s $team2";
    }
}

?>
