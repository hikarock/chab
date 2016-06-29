/*
 * table.js v1.0.1
 *
 * https://hika69.com/
 * MIT License https://hika69.mit-license.org/
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
