function listeCategorie(){
    var xhr = new XMLHttpRequest();
    var method = "GET";
    var url = "http://localhost:3000/api/core/categorie/read.php";
    
    xhr.open(method, url, true);
    xhr.setRequestHeader('Access-Control-Allow-Headers', '*');
    xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.send();
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for(var el = 0; el<data.length;el++){
                var id = data[el].id_cat;
                var nom = data[el].libele_cat;
                html += '<div class="divline"></div>';
                html += '<div class="blocktxt">';
                html += '<ul class="cats">';
                    html += '<li><a href="#">'+ nom +'<span class="badge pull-right">20</span></a></li>';
                html += "</ul>";
            }
            document.getElementById("cat_disc").innerHTML = html;
        }
    }
}

function listediscussion(){
    let xhr = new XMLHttpRequest();
    let url= "http://localhost:3000/api/core/discussion/read.php";
    let method = "GET";
    xhr.open(method, url, true);
    xhr.setRequestHeader('Access-Control-Allow-Headers', '*');
    xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.send();
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            let data = JSON.parse(this.responseText);
            console.log(data);
            let html = "";
            for (let el =0; el<data.length; el++){
                let id = data[el].id_disc;
                let titre = data[el].titre_disc;
                let contenu = data[el].contenu_disc;
                let date = data[el].date_disc;

                html += '<div class="post">';
                    html += '<div class="wrap-ut pull-left">';
                    html += '<div class="userinfo pull-left">';
                        html+= ' <div class="avatar">';

            }
        }
    }


}