function generateTable(result) {
    var div = document.getElementById("resultdiv");
    div.innerHTML = "";
    var table = document.createElement("TABLE");
    for (var i=0; i < result.length; i++) {
        var row = table.insertRow(-1);
        var cellA = row.insertCell(-1);
        cellA.innerHTML = result[i].rev_user_text;
        var cellB = row.insertCell(-1);
        cellB.innerHTML = result[i].IncidentArticlesCount;
        var cellC = row.insertCell(-1);
        cellC.innerHTML = result[i].IncidentEditsCount;
    }
    div.appendChild(table);
}
