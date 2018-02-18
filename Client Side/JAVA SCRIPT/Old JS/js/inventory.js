//functions to add/hide the add/edit item popup forms
function add_item() {
	document.getElementById('popformA').submit();
	alert("Item added to inventory.");
}

function add_div_show() {
	document.getElementById('popA').style.display = "block";
	document.getElementById('inventory-buttons').style.display = "none";
}

function add_div_hide(){
	document.getElementById('popA').style.display = "none";
	document.getElementById('inventory-buttons').style.display = "block";
}

function edit_item() {
	document.getElementById('popformE').submit();
	alert("Item details have been updated.");
}

function edit_div_show() {
	document.getElementById('popE').style.display = "block";
	document.getElementById('inventory-buttons').style.display = "none";
}

function edit_div_hide(){
	document.getElementById('popE').style.display = "none";
	document.getElementById('inventory-buttons').style.display = "block";
}

"use strict";
var domain  = "http://nrs-projects.humboldt.edu/~Alt-F4";
var inventory = "http://nrs-projects.humboldt.edu/~Alt-F4/index.php?page=inventory";

//clears the search results in inventory
function clearSearch(elem) {
    var value = document.getElementById(elem).value;

    if ((value == "ID..") || (value == "name..") || (value == "size..") || (value == "package..") || (value == "status.."))
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
		if (elem == "txtid")    document.getElementById(elem).value = "ID..";
        if (elem == "txtname")    document.getElementById(elem).value = "name..";
        //if (elem == "txtsize")    document.getElementById(elem).value = "size.."; -- could not get this working
        if (elem == "txtpackage") document.getElementById(elem).value = "package..";
		//if (elem == "txtstatus")    document.getElementById(elem).value = "status.."; -- could not get this working
    }
}

//taken from the rentals search (should rename it)
//searches the inventory based on the given criteria
function search_rentals()
{
    var ITEM_BACK_ID = document.getElementById("txtid").value;
    var ITEM_NAME = document.getElementById("txtname").value;
    //var ITEM_SIZE   = document.getElementById("txtsize").value;
	var PACK_ID = document.getElementById("txtpackage").value;
	//var STATUS = document.getElementById("txtstatus").value;

    if ((ITEM_BACK_ID == "ID..") && (ITEM_NAME == "name..") && /*(ITEM_SIZE == "size..") && */(PACK_ID == "package..") /*&& (STATUS == "status..")*/)
    	return;

    if (ITEM_BACK_ID == "ID..") ITEM_BACK_ID = "";
    if (ITEM_NAME == "name..") ITEM_NAME = "";
    //if (ITEM_SIZE   == "size..")   ITEM_SIZE = "";
	if (PACK_ID   == "package..")   PACK_ID = "";
	//if (STATUS   == "status..")   STATUS = "";

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	     document.getElementById("inventory_items_wrapper").innerHTML = this.responseText;
	  }
	}

	xmlhttp.open("GET", domain + "/inventory.php?ITEM_BACK_ID=" + ITEM_BACK_ID + "&ITEM_NAME=" + ITEM_NAME + "&PACK_ID=" + PACK_ID, true);
	xmlhttp.send();
}

//functions to handle the scroll boxes
function scroll_select(elem)
{
    var elmnt = document.getElementById(elem);
    var y = elmnt.selectedIndex;
    document.getElementById("Id").selectedIndex = y;
    document.getElementById("Name").selectedIndex = y;
    document.getElementById("Size").selectedIndex = y;
    document.getElementById("Type").selectedIndex = y;
    document.getElementById("Attribute").selectedIndex = y;
    document.getElementById("Price").selectedIndex = y;
    document.getElementById("PID").selectedIndex = y;
    document.getElementById("Location").selectedIndex = y;
}

function scroll_together()
{
    var elmnt = document.getElementById("Location");
    var y = elmnt.scrollTop;
    document.getElementById("Id").scrollTop = y;
    document.getElementById("Name").scrollTop = y;
    document.getElementById("Size").scrollTop = y;
    document.getElementById("Type").scrollTop = y;
    document.getElementById("Attribute").scrollTop = y;
    document.getElementById("Price").scrollTop = y;
    document.getElementById("PID").scrollTop = y;
}

// not working in firefox? :S...
function sizefixloc()
{
    alert(y); // test
    var elmnt = document.getElementById("Id");
    var y = elmnt.height;
    document.getElementById("Location").height = y;
}
