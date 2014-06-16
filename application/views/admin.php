<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
         <script src="<?php echo base_url(); ?>public/js/jquery.js"></script>   
        <script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.js"></script>
        <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            .con{
                margin-top: 10px;
            }
            
            .start{
                display: none;
            }
            
            #offset{
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>

  <div class="container-fluid">    
     <div class="row con">
        <div class="col-xs-4 col-md-3">
            <button type="button" id ="GS" class="btn btn-primary btn-lg btn-block">
                GS
            </button>
        </div>
        <div class="col-xs-4 col-md-3">
            <button type="button" id ="f2" class="btn btn-primary btn-lg btn-block">
                F2
            </button>
        </div>
        <div class="col-xs-4 col-md-3">
            <button type="button" id ="end" class="btn btn-primary btn-lg btn-block">
                E
            </button>
        </div>        
     </div>
        
     <div class="row con">
        <div class="col-xs-6 col-md-4">
            <button type="button" id ="t1" class="btn btn-primary btn-lg btn-block btn-success">
                <?php echo $teams[0]['flag'] ?>
            </button>
        </div>
        <div class="col-xs-6 col-md-4">
            <button type="button" id ="t2" class="btn btn-primary btn-lg btn-block btn-info">
                <?php echo $teams[1]['flag'] ?>
            </button>
        </div>
     </div>

    <div class="row con">
        <div class="col-xs-12 col-md-8" id="t1p">
            <ul class="list-group">
                <?php foreach ($team1 as $player) : ?>
                    <li class="list-group-item pl" id="<?php echo $player['id'] ?>"><?php echo $player['number'] ?> : <?php echo $player['name'] ?></li>
                <?php endforeach; ?>    
            </ul>
        </div>
        
        <div class="col-xs-12 col-md-8 start" id="t2p">
            <ul class="list-group">
                <?php foreach ($team2 as $player) : ?>
                    <li class="list-group-item pl" id="<?php echo $player['id'] ?>"><?php echo $player['number'] ?> : <?php echo $player['name'] ?></li>
                <?php endforeach; ?>  
            </ul>
        </div>
     </div>
</div>
        
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="actionTitle"></h4>
      </div>
      <div class="modal-body">
        <select id="offset" class="col-xs-3">
              <option value="0">0</option>
              <option value="5" seleted="selected">5</option>
              <option value="10">10</option>
              <option value="15">15</option>              
          </select>  
          
        <button type="button"  class="btn btn-primary btn-lg btn-block btn-default btnAction" data-action="goal" data-type="1">
             Scored
        </button>
        <button type="button" class="btn btn-primary btn-lg btn-block btn-warning btnAction" data-action="card" data-type="2">
             Card
        </button>
        <button type="button"  class="btn btn-primary btn-lg btn-block btn-info btnAction" data-action="sub" data-type="3">
             Subbed
        </button>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->        
<script>
var action;    
    $( document ).ready(function() {
        $('#t1').click( function (){
            $('#t2p').hide();
            $('#t1p').show(); 
        });
        
        $('#t2').click( function (){
            $('#t1p').hide();
            $('#t2p').show(); 
        });
        
        $('.pl').click( function (){
            $('#myModal').modal('show');
        })
        
        $('#myModal').on('hidden.bs.modal', function (e) {
            action = false;
             $('#actionTitle').html('');
          })
        
        $('.btnAction').click(function (){
           $('#actionTitle').html($(this).data('action'));
           action = $(this).data('type');
           console.log(action);
        });
    });
</script>
    
    </body>
</html>
