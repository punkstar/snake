var all_cells;

function draw_snake(write) {
    var url = 'server.php?id=1';
    
    if (!!write) {
        url = url + "&write";
    }
    
    $.get(url, function (data) {
        clear_board();

        for (snake in data.snakes) {
            draw_cells("head", data.snakes[snake].head);
            draw_cells("body", data.snakes[snake].body);
            draw_cells("goal", data.goal)
        }
        
        setTimeout("draw_snake(" + write + ")", 50);
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
