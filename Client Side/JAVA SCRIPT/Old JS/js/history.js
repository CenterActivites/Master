/*document.getElementById('realtxt').onkeyup = searchSel;
//function searchSel() 
  {
      var input = document.getElementById('realtxt').value.toLowerCase();
       
          len = input.length;
          output = document.getElementById('item_selection').options;
      for(var i=0; i<output.length; i++)
          if (output[i].text.toLowerCase().indexOf(input) != -1 ){
          output[i].selected = true;
              break;
              }
      if (input == '')
        output[0].selected = true;
    }*/
	
	"use strict";
var domain  = "http://nrs-projects.humboldt.edu/~Alt-F4";
var inventory = "http://nrs-projects.humboldt.edu/~Alt-F4/index.php?page=history";

function clearSearch(elem) {
    var value = document.getElementById(elem).value;

    if ((value == "Search Name...") || (value == "Search ID...") || (value == "Search Size...") || (value == "Search Package..."))
        document.getElementById(elem).value = "";
}

function clearSearchAll(elem) {
        // similar behavior as an HTTP redirect
        window.location.replace(inventory);

        // similar behavior as clicking on a link
        window.location.href = inventory;
}

function rentalsSearchRefill(elem) {
    var value = document.getElementById(elem).value;

    if (value == "")
    {
		if (elem == "txtname")    document.getElementById(elem).value = "Search Name...";
        if (elem == "txtid")    document.getElementById(elem).value = "Search ID...";
        if (elem == "txtsize")    document.getElementById(elem).value = "Search Size...";
        if (elem == "txtpackage") document.getElementById(elem).value = "Search Package...";
		//if (elem == "txtstatus")    document.getElementById(elem).value = "status..";
    }
}

function search_rentals()
{
    var ITEM_BACK_ID = document.getElementById("txtid").value;
    var ITEM_NAME = document.getElementById("txtname").value;
    //var ITEM_SIZE   = document.getElementById("txtsize").value;
	var PACK_ID = document.getElementById("txtpackage").value;
	//var STATUS = document.getElementById("txtstatus").value;

    if ((ITEM_BACK_ID == "Search ID...") && (ITEM_NAME == "Search Name...") && /*(ITEM_SIZE == "size..") && */(PACK_ID == "Search Package...") /*&& (STATUS == "status..")*/)
    	return;

    if (ITEM_BACK_ID == "Search ID...") ITEM_BACK_ID = "";
    if (ITEM_NAME == "Search Name...") ITEM_NAME = "";
    //if (ITEM_SIZE   == "size..")   ITEM_SIZE = "";
	if (PACK_ID   == "Search Package...")   PACK_ID = "";
	//if (STATUS   == "status..")   STATUS = "";

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	     document.getElementById("just-for-history1").innerHTML = this.responseText;
	  }
	}

	xmlhttp.open("GET", domain + "/item_history.php?ITEM_NAME=" + ITEM_NAME, true);
	xmlhttp.send();
}
