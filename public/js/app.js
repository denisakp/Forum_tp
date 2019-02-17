function listeCategorie(){
    var xhr = new XMLHttpRequest();
    var method = "GET";
    var url = "http://localhost:3000/api/core/categorie/read.php";
    
    xhr.open(method, url, true);
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            for(var el = 0; el<data.length;el++){
                var id = data[el].id_cat;
                var nom = data[el].libelle_cat;
                var divline = document.createElement("div");
                divline.classList.add('divline');
                var blocktxt = document.createElement("div");
                blocktxt.classList.add("blocktxt");
                var cats = document.createElement("ul");
                cats.classList.add('cats');
                var li = document.createElement("li");
                li.innerHTML = '<a href="#">'+nom+'<span class="badge pull-right">20</span></a>';
                cats.appendChild(li);
                blocktxt.appendChild(cats);
            }
            document.getElementById("cat_disc").innerHTML = html;
        }
    };
    xhr.send(false);
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
                    html += '<div class="wrap-ut pull-left"><div class="userinfo pull-left">';
                        html+= '<div class="avatar">';
                        html+= '<img src="public/images/avatar.jpg" alt="" />';
                        html+= '<div class="status green">&nbsp;</div>';
                    html+= '</div>';
                    html+= '<div class="icons"><img src="public/images/icon1.jpg" alt="" /><img src="public/images/icon4.jpg" alt="" /></div>'
                    html+= '</div>';
            }
        }
    }


}