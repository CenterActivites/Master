"use strict";
var domain  = "http://nrs-projects.humboldt.edu/~Alt-F4";
var rentals = "http://nrs-projects.humboldt.edu/~Alt-F4/index.php?page=rentals";

function remove_checkout_item()
{
    var checkout_index    = document.getElementById("checkout_form").selectedIndex;
    var checkout_options  = document.getElementById("checkout_form").options;
	
	var checkoutSelect = document.getElementById("checkout_select");
	checkoutSelect.remove(checkoutSelect.checkout_index);
	
    var checkoutTotal = document.getElementById("total").innerHTML;
    document.getElementById("total").innerHTML = "0.00";
}

function addCheckoutItem()
{
    var id_index      = document.getElementById("Id").selectedIndex;
    var id_options    = document.getElementById("Id").options;
    var name_index    = document.getElementById("Name").selectedIndex;
    var name_options  = document.getElementById("Name").options;
    var price_index   = document.getElementById("Price").selectedIndex;
    var price_options = document.getElementById("Price").options;

    var select   = document.getElementById("checkout_select");
    var option   = document.createElement("option");
    option.text  = name_options[name_index].text;
    option.value = id_options[id_index].text;
    select.add(option);

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("id", 'index-' + name_options[name_index].text);
    input.setAttribute("name", name_options[name_index].text);
    input.setAttribute("value", id_options[id_index].text);
    document.getElementById("checkout_form").appendChild(input);

    var checkoutTotal = document.getElementById("total").innerHTML;
    var checkoutTotal = parseInt(price_options[price_index].text) +
						parseInt(checkoutTotal);
    document.getElementById("total").innerHTML = checkoutTotal;
}

function clearSearch(elem) {
    var value = document.getElementById(elem).value;

    if ((value == "name..") || (value == "size..") || (value == "package.."))
        document.getElementById(elem).value = "";
}

function clearSearchAll(elem) {
        // similar behavior as an HTTP redirect
        window.location.replace(rentals);

        // similar behavior as clicking on a link
        window.location.href = rentals;
}

function rentalsSearchRefill(elem) {
    var value = document.getElementById(elem).value;

    if (value == "")
    {
        if (elem == "txtname")    document.getElementById(elem).value = "name..";
        if (elem == "txtsize")    document.getElementById(elem).value = "size..";
        if (elem == "txtpackage") document.getElementById(elem).value = "package..";
    }
}

function search_rentals()
{
    var ITEM_NAME = document.getElementById("txtname").value;
    var ITEM_SIZE = document.getElementById("txtsize").value;
    var PACK_ID   = document.getElementById("txtpackage").value;

    if ((ITEM_NAME == "name..") && (ITEM_SIZE == "size..") && (PACK_ID == "package.."))
    	return;

    if (ITEM_NAME == "name..") ITEM_NAME = "";
    if (ITEM_SIZE == "size..") ITEM_SIZE = "";
    if (PACK_ID   == "package..")   PACK_ID = "";

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	     document.getElementById("rentals_items_wrapper").innerHTML = this.responseText;
	  }
	}

	xmlhttp.open("GET", domain + "/rentals-item-select.php?ITEM_NAME=" + ITEM_NAME + "&ITEM_SIZE=" + ITEM_SIZE + "&PACK_ID=" + PACK_ID, true);
	xmlhttp.send();
}


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
