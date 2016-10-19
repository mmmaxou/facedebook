function getfile(){
    var x = document.getElementById('hiddenfile');
    var txt = "";
    
    x.click();
    
//    document.getElementById('selectedfile').value=document.getElementById('hiddenfile').value;
    
    if ('files' in x) {
        if (x.files.length == 0) {
            txt = "Select one or more files.";
        } else {
            for (var i = 0; i < x.files.length; i++) {
                
                var file = x.files[i];
                txt += "<br><strong>" + (i+1) + ". " + file.type + "</strong><br>";
                
                if ('name' in file) {
                    txt += "name: " + file.name + "<br>";
                }
                if ('size' in file) {
                    txt += "size: " + file.size + " bytes <br>";
                }
            }
        }
    }
    else {
        if (x.value == "") {
            txt += "Select one or more files.";
        } else {
            txt += "The files property is not supported by your browser!";
            txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead.
        }
    }
    document.getElementById("demo").innerHTML = txt;
}

function editer(obj) {
    console.log(obj);
    var id = obj.id;
    var titre = $('#well'+id+' h3').text();
    var texte = $('#well'+id+' .texte').text();
    
    console.log(titre + ',' + texte + ',' + id);
    $("#texte-modal input[type=text]").attr("value",titre);
    $("#texte-modal input[type=hidden]").attr("value",id);
    $("#texte-modal textarea").text(texte);   
    
    $("#texte-modal").modal();
}

$('.message').hover(function() {
    $('.message').addClass('selected');
        console.log("hijhazjd")
});
