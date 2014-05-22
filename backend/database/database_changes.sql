CREATE TABLE `admin` (
  `admin_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(250) NULL,
  `password` VARCHAR(250) NULL,
  PRIMARY KEY (`admin_id`));

CREATE TABLE `game_action` (
  `game_action_id` INT(11) NOT NULL AUTO_INCREMENT,
  `fk_games_id` INT(11) NULL,
  `fk_user_id` INT(11) NULL,
  `action_minute` INT NULL,
  `action_date` DATETIME NULL COMMENT 'datetime the action occurred - will be input by the user',
  `action_automatic_date` DATETIME NULL COMMENT 'automatic date of input of action - generated by system',
  PRIMARY KEY (`game_action_id`));

ALTER TABLE `game_action`
CHANGE COLUMN `fk_games_id` `fk_game_id` INT(11) NULL DEFAULT NULL ;


CREATE TABLE `yellow_card_action` (
  `fk_game_action_id` INT(11) NOT NULL,
  `fk_player_id` INT(11) NULL,
  PRIMARY KEY (`fk_game_action_id`));

CREATE TABLE `red_card_action` (
  `fk_game_action_id` INT(11) NOT NULL,
  `fk_player_id` INT(11) NULL,
  PRIMARY KEY (`fk_game_action_id`));

CREATE TABLE `score_action` (
  `fk_game_action_id` INT(11) NOT NULL,
  `fk_player_id` INT(11) NULL,
  PRIMARY KEY (`fk_game_action_id`));

ALTER TABLE `game_action`
ADD COLUMN `action_type` ENUM('red_card','yellow_card','player_score','team_action') NULL AFTER `action_automatic_date`;


ALTER TABLE `score_action`
RENAME TO  `player_score_action` ;

CREATE TABLE `team_action` (
  `fk_game_action_id` INT(11) NOT NULL,
  `fk_team_id` INT(11) NULL,
  `team_action_type` ENUM('win','lose','draw') NULL,
  PRIMARY KEY (`fk_game_action_id`));


ALTER TABLE `games`
ADD COLUMN `match_status` ENUM('not_started','started','finished','cancelled') NULL DEFAULT 'not_started' AFTER `matchDate`;
