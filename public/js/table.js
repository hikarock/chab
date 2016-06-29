/*
 * table.js v1.0.0
 * http://rockf.es/
 *
 * Copyright 2010, hikari@rockf.es
 * Date: Sat Apr 03 2010 01:25:26 GMT+0900
 */
var message = function(ev) {
    try {
        var table = document.getElementById(ev.data);
        var tr = table.getElementsByTagName("tr");
        var th = tr[0].getElementsByTagName("th");
        var json = {};
        var rows = [];
        for (var i = 1; i < tr.length; i++) {
            var row = {};
            var td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
                row[th[j].innerHTML] = td[j].innerHTML;
            }
            rows.push(row);
        }
        json[ev.data] = rows;
        var message = JSON.stringify(json);
        ev.source.postMessage(message, ev.origin);
    } catch(e) {
        alert(e.message);
    }
};
window.addEventListener("message", message, false);