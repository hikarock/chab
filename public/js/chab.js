/*
 * chab.js v1.0.1
 *
 * https://hika69.com/
 * MIT License https://hika69.mit-license.org/
 */
var Chab;
(function(){
  Chab = function() {
    this.db = openDatabase("chabdb", "1.0");
    this.sql = "";
    var self = this;
    window.addEventListener("message", this.message(self), true);
  };
  Chab.prototype = {
    select: function(sql) {
      var work = sql;
      this.sql = sql;
      work = work.toLowerCase();
      work = work.replace(/\s/g, " ");
      var url = work.match(/(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$%#]+)/g);
      for (var i in url) (function(url) {
        var hash = url.split("#")[1] + "";
        var body = document.getElementsByTagName("body")[0];
        var iframe = document.createElement("iframe");
        iframe.src = url;
        iframe.style.display = "none";
        body.appendChild(iframe);
        iframe.addEventListener("load", function(){
            this.contentWindow.postMessage(hash, url);
        });
      })(url[i])
    },
    message: function(self) {
      return function(ev) {
        try {
          var json = JSON.parse(ev.data);
          var insert = [];
          for(var table in json) {
            var row = json[table];
            for(var j in row) {
              col = row[j];
              var work = "INSERT INTO " + table;
              var names = "";
              var values = "";
              for(var k in col) {
                names += k + ",";
                values += "'" + col[k] + "',";
              }
              names = self.deleteTrailingChar(names, 1);
              values = self.deleteTrailingChar(values, 1);
              work += " (" + names + ") " +  "VALUES (" + values + ");";
              insert.push(work);
            }
            var create = "CREATE TABLE IF NOT EXISTS " + table + " (" + names + ");"
            var drop = "DROP TABLE " + table;
            self.sql = self.sql.replace(/(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$%#]+\/*html#)(\W?)/g, "$3");
            self.db.transaction(
              function(tx) {
                tx.executeSql(drop, [], function(){
                  tx.executeSql(create);
                }, function(){
                  tx.executeSql(create);
                });
              },
              function(e) {
                alert(e.message);
              },
              function() {
                self.db.transaction(
                  function(tx) {
                    for (var i = 0; i < insert.length; i++) {
                      tx.executeSql(insert[i]);
                    }
                  },
                  function(e) {
                    alert(e.message);
                  },
                  function() {
                    self.db.transaction(
                      function(tx) {
                        tx.executeSql(
                          self.sql, [], 
                          function(tx, rs) {
                            var table = document.createElement("table");
                            for(var i = 0; i < rs.rows.length; i++) {
                              var tr = document.createElement("tr");
                              var row = rs.rows.item(i);
                              if (i == 0) {
                                for(j in row) {
                                  var th = document.createElement("th");
                                  th.appendChild(document.createTextNode(j));
                                  tr.appendChild(th);
                                }
                                table.appendChild(tr)
                                tr = document.createElement("tr");
                              }
                              for(k in row) {
                                var td = document.createElement("td");
                                td.appendChild(document.createTextNode(row[k]));
                                tr.appendChild(td);
                              }
                              table.appendChild(tr);
                            }
                            var chab = document.getElementById("chab");
                            if (!chab.lastChild) {
                              chab.appendChild(document.createElement("span"));
                            }
                            chab.replaceChild(table, chab.lastChild);
                          }
                        );
                      },
                      function(e){
                        alert(e.message);
                      },{}
                    );
                  }
                );
              }
            );
          }
        } catch(e) {
          alert(e.message);
        }
      };
    },
    deleteTrailingChar: function(str, num) {
      return str.slice(0, str.length - num);
    }
  }
})();
var chab = new Chab();
