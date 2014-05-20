<?php

require_once 'autoload.php';

$compressor = new compressor(array('page, javascript, css'));

session_start();


if(isset($_REQUEST['action']))
{
    switch($_REQUEST['action'])
    {
    /////////////////////////Connections///////////////////////
    case "getAddConnections":
        echo ConnectionsGuiUtility::getAddConnections();
    break;

    case "addConnections":
        echo ConnectionsGuiUtility::addConnections(RequestHelper::getRequestValue("user1"), RequestHelper::getRequestValue("user2"), RequestHelper::getRequestValue("status"), SessionHelper::getUserId());
    break;

    case "getEditConnections":
        echo ConnectionsGuiUtility::getEditConnections(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editConnections":
        echo ConnectionsGuiUtility::editConnections(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("user1"), RequestHelper::getRequestValue("user2"), RequestHelper::getRequestValue("status"), SessionHelper::getUserId());
    break;

    case "getDeleteConnections":
        echo ConnectionsGuiUtility::getDeleteConnections(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deleteConnections":
        echo ConnectionsGuiUtility::deleteConnections(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddConnections":
        echo ConnectionsGuiUtility::clearAddConnections();
    break;
    /////////////////////////end of Connections///////////////////////

    /////////////////////////Country///////////////////////
    case "getAddCountry":
        echo CountryGuiUtility::getAddCountry();
    break;

    case "addCountry":
        echo CountryGuiUtility::addCountry(RequestHelper::getRequestValue("name"), SessionHelper::getUserId());
    break;

    case "getEditCountry":
        echo CountryGuiUtility::getEditCountry(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editCountry":
        echo CountryGuiUtility::editCountry(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("name"), SessionHelper::getUserId());
    break;

    case "getDeleteCountry":
        echo CountryGuiUtility::getDeleteCountry(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deleteCountry":
        echo CountryGuiUtility::deleteCountry(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddCountry":
        echo CountryGuiUtility::clearAddCountry();
    break;
    /////////////////////////end of Country///////////////////////

    /////////////////////////Gameplayers///////////////////////
    case "getAddGameplayers":
        echo GameplayersGuiUtility::getAddGameplayers();
    break;

    case "addGameplayers":
        echo GameplayersGuiUtility::addGameplayers(RequestHelper::getRequestValue("gameId"), RequestHelper::getRequestValue("playerId"), RequestHelper::getRequestValue("teamId"), SessionHelper::getUserId());
    break;

    case "getEditGameplayers":
        echo GameplayersGuiUtility::getEditGameplayers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editGameplayers":
        echo GameplayersGuiUtility::editGameplayers(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("gameId"), RequestHelper::getRequestValue("playerId"), RequestHelper::getRequestValue("teamId"), SessionHelper::getUserId());
    break;

    case "getDeleteGameplayers":
        echo GameplayersGuiUtility::getDeleteGameplayers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deleteGameplayers":
        echo GameplayersGuiUtility::deleteGameplayers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddGameplayers":
        echo GameplayersGuiUtility::clearAddGameplayers();
    break;
    /////////////////////////end of Gameplayers///////////////////////

    /////////////////////////Games///////////////////////
    case "getAddGames":
        echo GamesGuiUtility::getAddGames();
    break;

    case "addGames":
        echo GamesGuiUtility::addGames(RequestHelper::getRequestValue("stage"), RequestHelper::getRequestValue("team1"), RequestHelper::getRequestValue("team2"), RequestHelper::getRequestValue("venue"), RequestHelper::getRequestValue("t1Score"), RequestHelper::getRequestValue("t2Score"), RequestHelper::getRequestValue("extraScore"), RequestHelper::getRequestValue("timeStarted"), RequestHelper::getRequestValue("startedF"), RequestHelper::getRequestValue("playerInfo"), RequestHelper::getRequestValue("matchDate"), SessionHelper::getUserId());
    break;

    case "getEditGames":
        echo GamesGuiUtility::getEditGames(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editGames":
        echo GamesGuiUtility::editGames(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("stage"), RequestHelper::getRequestValue("team1"), RequestHelper::getRequestValue("team2"), RequestHelper::getRequestValue("venue"), RequestHelper::getRequestValue("t1Score"), RequestHelper::getRequestValue("t2Score"), RequestHelper::getRequestValue("extraScore"), RequestHelper::getRequestValue("timeStarted"), RequestHelper::getRequestValue("startedF"), RequestHelper::getRequestValue("playerInfo"), RequestHelper::getRequestValue("matchDate"), SessionHelper::getUserId());
    break;

    case "getDeleteGames":
        echo GamesGuiUtility::getDeleteGames(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deleteGames":
        echo GamesGuiUtility::deleteGames(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddGames":
        echo GamesGuiUtility::clearAddGames();
    break;
    /////////////////////////end of Games///////////////////////

    /////////////////////////GamesPlayers///////////////////////
    case "getAddGamesPlayers":
        echo GamesPlayersGuiUtility::getAddGamesPlayers();
    break;

    case "addGamesPlayers":
        echo GamesPlayersGuiUtility::addGamesPlayers(RequestHelper::getRequestValue("gameId"), RequestHelper::getRequestValue("playerId"), RequestHelper::getRequestValue("teamId"), SessionHelper::getUserId());
    break;

    case "getEditGamesPlayers":
        echo GamesPlayersGuiUtility::getEditGamesPlayers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editGamesPlayers":
        echo GamesPlayersGuiUtility::editGamesPlayers(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("gameId"), RequestHelper::getRequestValue("playerId"), RequestHelper::getRequestValue("teamId"), SessionHelper::getUserId());
    break;

    case "getDeleteGamesPlayers":
        echo GamesPlayersGuiUtility::getDeleteGamesPlayers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deleteGamesPlayers":
        echo GamesPlayersGuiUtility::deleteGamesPlayers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddGamesPlayers":
        echo GamesPlayersGuiUtility::clearAddGamesPlayers();
    break;
    /////////////////////////end of GamesPlayers///////////////////////

    /////////////////////////Gamesdates///////////////////////
    case "getAddGamesdates":
        echo GamesdatesGuiUtility::getAddGamesdates();
    break;

    case "addGamesdates":
        echo GamesdatesGuiUtility::addGamesdates(RequestHelper::getRequestValue("gameDate"), SessionHelper::getUserId());
    break;

    case "getEditGamesdates":
        echo GamesdatesGuiUtility::getEditGamesdates(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editGamesdates":
        echo GamesdatesGuiUtility::editGamesdates(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("gameDate"), SessionHelper::getUserId());
    break;

    case "getDeleteGamesdates":
        echo GamesdatesGuiUtility::getDeleteGamesdates(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deleteGamesdates":
        echo GamesdatesGuiUtility::deleteGamesdates(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddGamesdates":
        echo GamesdatesGuiUtility::clearAddGamesdates();
    break;
    /////////////////////////end of Gamesdates///////////////////////

    /////////////////////////Players///////////////////////
    case "getAddPlayers":
        echo PlayersGuiUtility::getAddPlayers();
    break;

    case "addPlayers":
        echo PlayersGuiUtility::addPlayers(RequestHelper::getRequestValue("teamId"), RequestHelper::getRequestValue("name"), RequestHelper::getRequestValue("position"), RequestHelper::getRequestValue("number"), SessionHelper::getUserId());
    break;

    case "getEditPlayers":
        echo PlayersGuiUtility::getEditPlayers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editPlayers":
        echo PlayersGuiUtility::editPlayers(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("teamId"), RequestHelper::getRequestValue("name"), RequestHelper::getRequestValue("position"), RequestHelper::getRequestValue("number"), SessionHelper::getUserId());
    break;

    case "getDeletePlayers":
        echo PlayersGuiUtility::getDeletePlayers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deletePlayers":
        echo PlayersGuiUtility::deletePlayers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddPlayers":
        echo PlayersGuiUtility::clearAddPlayers();
    break;
    /////////////////////////end of Players///////////////////////

    /////////////////////////Stadium///////////////////////
    case "getAddStadium":
        echo StadiumGuiUtility::getAddStadium();
    break;

    case "addStadium":
        echo StadiumGuiUtility::addStadium(RequestHelper::getRequestValue("name"), RequestHelper::getRequestValue("image"), SessionHelper::getUserId());
    break;

    case "getEditStadium":
        echo StadiumGuiUtility::getEditStadium(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editStadium":
        echo StadiumGuiUtility::editStadium(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("name"), RequestHelper::getRequestValue("image"), SessionHelper::getUserId());
    break;

    case "getDeleteStadium":
        echo StadiumGuiUtility::getDeleteStadium(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deleteStadium":
        echo StadiumGuiUtility::deleteStadium(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddStadium":
        echo StadiumGuiUtility::clearAddStadium();
    break;
    /////////////////////////end of Stadium///////////////////////

    /////////////////////////Teams///////////////////////
    case "getAddTeams":
        echo TeamsGuiUtility::getAddTeams();
    break;

    case "addTeams":
        echo TeamsGuiUtility::addTeams(RequestHelper::getRequestValue("name"), RequestHelper::getRequestValue("flag"), RequestHelper::getRequestValue("group"), SessionHelper::getUserId());
    break;

    case "getEditTeams":
        echo TeamsGuiUtility::getEditTeams(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editTeams":
        echo TeamsGuiUtility::editTeams(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("name"), RequestHelper::getRequestValue("flag"), RequestHelper::getRequestValue("group"), SessionHelper::getUserId());
    break;

    case "getDeleteTeams":
        echo TeamsGuiUtility::getDeleteTeams(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deleteTeams":
        echo TeamsGuiUtility::deleteTeams(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddTeams":
        echo TeamsGuiUtility::clearAddTeams();
    break;
    /////////////////////////end of Teams///////////////////////

    /////////////////////////Users///////////////////////
    case "getAddUsers":
        echo UsersGuiUtility::getAddUsers();
    break;

    case "addUsers":
        echo UsersGuiUtility::addUsers(RequestHelper::getRequestValue("uid"), RequestHelper::getRequestValue("username"), RequestHelper::getRequestValue("nickname"), RequestHelper::getRequestValue("status"), RequestHelper::getRequestValue("teamId"), RequestHelper::getRequestValue("country"), RequestHelper::getRequestValue("password"), SessionHelper::getUserId());
    break;

    case "getEditUsers":
        echo UsersGuiUtility::getEditUsers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId());
    break;

    case "editUsers":
        echo UsersGuiUtility::editUsers(RequestHelper::getRequestValue("id"), RequestHelper::getRequestValue("uid"), RequestHelper::getRequestValue("username"), RequestHelper::getRequestValue("nickname"), RequestHelper::getRequestValue("status"), RequestHelper::getRequestValue("teamId"), RequestHelper::getRequestValue("country"), RequestHelper::getRequestValue("password"), SessionHelper::getUserId());
    break;

    case "getDeleteUsers":
        echo UsersGuiUtility::getDeleteUsers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "deleteUsers":
        echo UsersGuiUtility::deleteUsers(RequestHelper::getRequestValue("id"), SessionHelper::getUserId() ,SessionHelper::getUserId());
    break;

    case "clearAddUsers":
        echo UsersGuiUtility::clearAddUsers();
    break;
    /////////////////////////end of Users///////////////////////



	default:
	    echo "An error occurred. Please try again. If the problem persists, please contact the site administrator.";
    }
}
else
{
    echo "Action not defined.";
}

$compressor->finish();

?>
