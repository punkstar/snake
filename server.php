<?php
session_start();

require_once "lib/coord.php";
require_once "lib/queue.php";

require_once "lib/game.php";
require_once "lib/grid.php";
require_once "lib/snake.php";

$connect = mysql_connect("localhost", "root", "root");
mysql_select_db("snake", $connect);

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
} else {
    throw new Exception("No game ID provided");
}

$query = mysql_query("SELECT game FROM game WHERE id = $id", $connect) or die(mysql_error());

if (mysql_num_rows($query) == 1) {
    $row = mysql_fetch_assoc($query);
    
    $game = unserialize(base64_decode($row['game']));
    
    $game->step();
    
    $s_game = base64_encode(serialize($game));
    $sql = "UPDATE game SET game = '$s_game' WHERE id = $id";
} else {
    // Set the game up!
    
    $grid = new Grid(40, 40);
    $game = new Game($grid);
    $snake = new Snake(1);

    $game->addSnake($snake);

    $s_game = base64_encode(serialize($game));
    $sql = "INSERT INTO game (id, game) VALUES ($id, '$s_game')";
}

// Only allow a process that's asked for write to write
if (isset($_GET['write'])) {
    mysql_query($sql, $connect) or die(mysql_error());
}

echo json_encode($game->toArray());
