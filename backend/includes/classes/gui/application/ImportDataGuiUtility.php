<?php


class ImportDataGuiUtility
{

    public static function importPlayers()
    {
	$output = "";

	ImportPlayersManager::importPlayers();

	return $output;
    }
}

?>