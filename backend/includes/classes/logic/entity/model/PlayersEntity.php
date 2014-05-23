<?php


class PlayersEntity extends BasePlayersEntity
{

    public function getFormattedName()
    {
	return utf8_encode($this->getName());
    }
}

?>
