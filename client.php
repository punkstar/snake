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
        <script type="text/javascript" src="assets/snake.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/snake.css" />
        
        <script type="text/javascript">
        $(function () {
            all_cells = $('td.cell');
            draw_snake(<?php echo($x_start == 0) ? "true" : "false" ?>);
        });
        </script>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="reset.php">Reset</a></li>
            </ul>
        </nav>
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