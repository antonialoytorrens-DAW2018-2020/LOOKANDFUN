window.onload = function () {
    var dadesOrganitzador = JSON.parse(perfilOrganitzador());
    //console.log(dadesOrganitzador[0].nomEmp);
    //console.log(Object.keys(dadesOrganitzador[0])[0]);
    var len = Object.keys(dadesOrganitzador[0]).length;
    var f02 = document.getElementById("f02");

    for (j = 0; j < len; j++) {
        // DOM
        var label = document.createElement("label");
        var input = document.createElement("input");
        input.setAttribute("class", "form-control");
        input.setAttribute("type", "text");

        // NomEMP
        var text = document.createTextNode(Object.keys(dadesOrganitzador[0])[j]);
        label.setAttribute("for", "nomEmp");
        f02.appendChild(label);
        label.appendChild(text);

        input.setAttribute("name", Object.keys(dadesOrganitzador[0])[j]);
        input.setAttribute("id", Object.keys(dadesOrganitzador[0])[j]);
        input.setAttribute("value", Object.values(dadesOrganitzador[0])[j]);
        f02.appendChild(input);
    }
}