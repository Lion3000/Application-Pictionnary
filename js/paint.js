// les quatre tailles de pinceau possible.
var sizes=[8,20,44,90];
// la taille et la couleur du pinceau
var size, color;
// la dernière position du stylo
var x0, y0;
// le tableau de commandes de dessin à envoyer au serveur lors de la validation du dessin
var drawingCommands = [];

function setColor() {
    // on récupère la valeur du champs couleur
    color = document.getElementById('color').value;
    console.log("color:" + color);
}

function setSize() {
    size = document.getElementById('size').value;
    size = sizes[size];
    console.log("size:" + size);
}

window.onload = function() {
    var canvas = document.getElementById('myCanvas');
    canvas.width = 400;
    canvas.height= 400;
    var context = canvas.getContext('2d');

    setSize();
    setColor();
    document.getElementById('size').onchange = setSize;
    document.getElementById('color').onchange = setColor;

    var isDrawing = false;

    var startDrawing = function(e) {
        console.log("start");
        // crér un nouvel objet qui représente une commande de type "start", avec la position, la couleur
        var command = {};
        command.command="start";
        command.x=e.x;
        command.y=e.y;
        command.color=color;
        //c'est équivalent à:
        //command = {"command":"start", "x": e.x, "color":color};

        // Ce genre d'objet Javascript simple est nommé JSON. Pour apprendre ce qu'est le JSON, c.f. http://blog.xebia.fr/2008/05/29/introduction-a-json/

        // on l'ajoute à la liste des commandes
        drawingCommands.push(command);

        // ici, dessinez un cercle de la bonne couleur, de la bonne taille, et au bon endroit.
        context.beginPath();
        context.strokeStyle=color;
        context.lineWidth = 1;
        context.arc(e.x, e.y, size/2, 0, 2 * Math.PI);
        context.stroke();
        x0 = e.x;
        y0 = e.y;


        isDrawing = true;
    }

    var stopDrawing = function(e) {
      if(x0 != null && y0 != null){
        context.beginPath();
        context.moveTo(x0, y0);
        context.strokeStyle=color;
        context.lineWidth = size;
        context.lineTo(e.x, e.y);
        context.stroke();
        x0 = null;
        y0 = null;
      }
      console.log("stop");
      isDrawing = false;
    }

    var draw = function(e) {
        if(isDrawing) {
            // ici, créer un nouvel objet qui représente une commande de type "draw", avec la position, et l'ajouter à la liste des commandes.
            var command = {};
            command.command="draw";
            command.x=e.x;
            command.y=e.y;
            drawingCommands.push(command);
            // ici, dessinez un cercle de la bonne couleur, de la bonne taille, et au bon endroit.
            context.beginPath();
            context.strokeStyle=color;
            context.lineWidth = 1;
            context.arc(e.x, e.y, size/2, 0, 2 * Math.PI);
            context.stroke();
        }
    }

    canvas.onmousedown = startDrawing;
    canvas.onmouseout = stopDrawing;
    canvas.onmouseup = stopDrawing;
    canvas.onmousemove = draw;

    document.getElementById('restart').onclick = function() {
        console.log("clear");
        // ici ajouter à la liste des commandes une nouvelle commande de type "clear"
        var command = {"command":"clear"};
        // ici, effacer le context, grace à la méthode clearRect.
        context.clearRect(0, 0, canvas.width, canvas.height);
    };

    document.getElementById('validate').onclick = function() {
        // la prochaine ligne transforme la liste de commandes en une chaîne de caractères, et l'ajoute en valeur au champs "drawingCommands" pour l'envoyer au serveur.
        document.getElementById('drawingCommands').value = JSON.stringify(drawingCommands);
        // ici, exportez le contenu du canvas dans un data url, et ajoutez le en valeur au champs "picture" pour l'envoyer au serveur.
        var dataurl = canvas.toDataURL("image/png");
        document.getElementById('picture').value = dataurl;
    };
};
