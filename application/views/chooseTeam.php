<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php echo $gameInfo->matchDate ?>
        <table>
            <tr>
                <td><?php echo $team1->name ?></td>
                <td><?php echo $team2->name ?></td>
            </tr>
            
            <tr>
                <td>
                    <ul>
                    <?php foreach($team1Players as $players) : ?>
                        <li><input type="checkbox" class="team1Player" id="<?php echo $players->id ?>" /><?php echo $players->name ?> ( <?php echo $players->position ?> )</li>                   
                    <?php endforeach; ?>
                    </ul>                    
                </td>
                
                <td>
                    <ul>
                    <?php foreach($team2Players as $players) : ?>
                        <li><input type="checkbox" class="team1Player" id="<?php echo $players->id ?>" /><?php echo $players->name ?> ( <?php echo $players->position ?> )</li>                   
                    <?php endforeach; ?>
                    </ul>                    
                </td>
            </tr>
        </table>
        
        <input type="button" value="update and send push" />
    </body>
</html>
