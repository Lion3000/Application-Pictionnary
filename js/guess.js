// la taille et la couleur du pinceau
var size, color;
// la dernière position du stylo
var x0, y0;
// le tableau de commandes de dessin à envoyer au serveur lors de la validation du dessin
var drawingCommands;

window.onload = function() {
    drawingCommands = JSON.parse( document.getElementById('drawingCommands').innerHTML);

    var canvas = document.getElementById('myCanvas');
    canvas.width = 400;
    canvas.height= 400;
    var context = canvas.getContext('2d');

    var start = function(c) {
      console.log("start");
      color = c.color;
      size = c.size;
      x0 = c.x;
      y0 = c.y;
      context.beginPath();
      console.log(y0);
      context.strokeStyle=color;
      context.lineWidth = 1;
      context.arc(x0, y0, size/2, 0, 2 * Math.PI);
      context.stroke();
    }

    var draw = function(c) {
      console.log("draw");
      context.beginPath();
      context.strokeStyle=color;
      context.lineWidth = 1;
      context.arc(c.x, c.y, size/2, 0, 2 * Math.PI);
      context.stroke();
    }

    var stop = function(c) {
      console.log("stop" + y0);
      if(x0 != null && y0 != null){
        console.log("ici");
        context.beginPath();
        context.moveTo(x0, y0);
        context.strokeStyle=color;
        context.lineWidth = size;
        context.lineTo(c.x, c.y);
        context.stroke();
        x0 = null;
        y0 = null;
      }
    }

    var clear = function() {
      console.log("clear");
      context.clearRect(0, 0, canvas.width, canvas.height);
    }

    // étudiez ce bout de code
    var i = 0;
    var iterate = function() {
        if(i>=drawingCommands.length)
            return;
        var c = drawingCommands[i];
        switch(c.command) {
            case "start":
                start(c);
                break;
            case "draw":
                draw(c);
                break;
            case "stop":
                stop(c);
                break;
            case "clear":
                clear();
                break;
            default:
                console.error("cette commande n'existe pas "+ c.command);
        }
        i++;
        setTimeout(iterate,30);
    };

    iterate();

};
