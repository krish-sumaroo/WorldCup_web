function getRedCardAction(playerId, gameId)
{
    var params = {"player_id": playerId, "game_id": gameId};
    getSSContent("getRedCardAction", "modal_content", params);
}

function adminRedCardAction(playerId, gameId)
{
    var date = $("#txt_red_card_date").val();
    var params = {"player_id": playerId, "game_id": gameId, "date": date};
    getSSContent("adminRedCardAction", "player_action_con", params);
}

function getYellowCardAction(playerId, gameId)
{
    var params = {"player_id": playerId, "game_id": gameId};
    getSSContent("getYellowCardAction", "modal_content", params);
}

function adminYellowCardAction(playerId, gameId)
{
    var date = $("#txt_yellow_card_date").val();
    var params = {"player_id": playerId, "game_id": gameId, "date": date};
    getSSContent("adminYellowCardAction", "player_action_con", params);
}

function getPlayerScoreAction(playerId, gameId)
{
    var params = {"player_id": playerId, "game_id": gameId};
    getSSContent("getPlayerScoreAction", "modal_content", params);
}

function getPlayerSubstituteAction(playerId, gameId)
{
    var params = {"player_id": playerId, "game_id": gameId};
    getSSContent("getPlayerSubstituteAction", "modal_content", params);
}

function adminPlayerScoreAction(playerId, gameId)
{
    var date = $("#txt_player_score_date").val();
    var params = {"player_id": playerId, "game_id": gameId, "date": date};
    getSSContent("adminPlayerScoreAction", "player_action_con", params);
}

function adminPlayerSubstituteAction(playerId, gameId)
{
    var date = $("#txt_player_substitute_date").val();
    var params = {"player_id": playerId, "game_id": gameId, "date": date};
    getSSContent("adminPlayerSubstituteAction", "player_action_con", params);
}

function reloadMatchEngageDisplay(id)
{
    var params = {"game_id": id};
    getSSContent("reloadMatchEngageDisplay", "con_match_actions_list", params);
}

function validateAdminGameAction(id, gameId)
{
    var con = "validate_act_con_" + id;
    var params = {"id": id, "game_id": gameId};
    getSSContent("validateAdminGameAction", con, params);
}

function invalidateAdminGameAction(id, gameId)
{
    var con = "validate_act_con_" + id;
    var params = {"id": id, "game_id": gameId};
    getSSContent("invalidateAdminGameAction", con, params);
}

function getEndGame(id)
{
    var params = {"id": id};
    getSSContent("getEndGame", "modal_content", params);
}

function endGame(id)
{
    var date = $("#txt_game_end_date").val();
    var team1Score = $("#txt_team1_score").val();
    var team2Score = $("#txt_team2_score").val();
    var params = {"team1_score": team1Score, "team2_score": team2Score, "date": date, "game_id": id};
    getSSContent("endGame", "player_action_con", params);
}

function triggerRewards(id, gameId)
{
    var con = "validate_act_con_" + id;
    var params = {"id": id, "game_id": gameId};
    getSSContent("triggerRewards", con, params);
}

function confirmTriggerRewards(id, msg)
{
    var conf = confirm(msg);

    if (conf)
    {
	var con = "validate_act_con_" + id;
	var params = {"id": id};
	getSSContent("confirmTriggerRewards", con, params);
    }
}

function triggerMatchAward(gameActionId, gameId)
{
    var con = "game_action_general_action_con";
    var params = {"game_action_id": gameActionId, "game_id": gameId};
    getSSContent("triggerMatchAward", con, params);
}

function reloadMatchActionButtonContainer(gameId)
{
    var con = "game_action_general_action_con";
    var params = {"game_id": gameId};
    getSSContent("reloadMatchActionButtonContainer", con, params);
}

function triggerNotifications(id, player, action)
{
    var con = "trigger_action_con_" + id;
    var params = player + "/" + action;
    getSSContentMaster("push", "action", con, params);
}