<?php
session_start();

$x_start = 0;
$y_start = 0;

$x_count = 40;
$y_count = 40;

if (isset($_GET['x'])) {
    $x_start = (int) $_GET['x'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Snake</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script type="text/javascript">
            var all_cells;
            
            function draw_snake() {
                $.get('server.php?id=1<?php echo ($x_start == 0) ? "&write" : "" ; ?>', function (data) {
                    clear_board();
  
                    for (snake in data.snakes) {
                        draw_cells("head", data.snakes[snake].head);
                        draw_cells("body", data.snakes[snake].body);
                        draw_cells("goal", data.goal)
                    }
                    
                    setTimeout("draw_snake()", 50);
                }, 'json');
            }
            
            function draw_cells(class, cells) {
                if (!(cells[0] instanceof Array)) {
                    cells = [cells];
                }
                
                var opacity = 1.0;
                var opacitiy_lower = 0.25;
                
                for (cell in cells) {
                    $("#cell-" + cells[cell][0] + "x" + cells[cell][1]).addClass(class).css({"opacity": opacity});
                    
                    if (opacity > opacitiy_lower) {
                        opacity -= 0.025;
                    }
                }
            }
            
            function clear_board() {
                all_cells.removeClass('head')
                         .removeClass('body')
                         .removeClass('goal')
                         .css({"opacity": 1.0});
            }
            
            $(function () {
                all_cells = $('td.cell');
                draw_snake();
            });
        </script>
        <style typr="text/css">
        <!--
        #game td {
            height: 10px;
            width: 10px;
            
            text-align: center;
            vertical-align: middle;
            font-size: 9px;
            
            background: #eee;
            border:1px solid #ddd;
        }
        
        .body {
            background-color: grey !important;
        }
        
        .head {
            background-color: red !important;
        }
        
        .goal {
            background-color: green !important;
        }
        -->
        </style>
    </head>
    <body>
        <a href="reset.php">Reset</a>
        <table id="game">
            <?php for ($y = $y_start; $y < $y_start + $y_count; $y++): ?>
                <tr>
                    <?php for ($x = $x_start; $x < $x_start + $x_count; $x++): ?>
                        <td id="cell-<?php echo $x ?>x<?php echo $y ?>" class="row-<?php echo $y ?> col-<?php echo $x ?> cell">&nbsp;</td>
                    <? endfor ?>
                </tr>
            <?php endfor ?>
        </table>
    </body>
</html>