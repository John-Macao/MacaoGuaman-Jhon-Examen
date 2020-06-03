function buscarCliente() {
    var cedula = document.getElementById("cedula").value;
    if (cedula == "") {
        document.getElementById("informacion").innerHTML = "";
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //alert(cedula);
            document.getElementById("informacion").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","../controlador/buscar_C.php?cedula="+cedula+"",true);
    xmlhttp.send();
    }
    
    return false;
}