//var domain = "http://nrs-projects.humboldt.edu/~Alt-F4";
function validateForm() {
    var uname = document.forms["Adduser"]["username"].value;
	var pword = document.forms["Adduser"]["password"].value;
	var emplfname = document.forms["Adduser"]["empl_fname"].value;
	var empllname = document.forms["Adduser"]["empl_lname"].value;
    if ((uname == "" )|| (pword =="" )|| (emplfname =="") || (empllname =="")) {
        alert("All Fields must be filled out");
        return false;
    }
}

function add_vendors() {
    var venname = document.forms["addven"]["ven_name"].value;
	var venphone = document.forms["addven"]["ven_phone"].value;
	var venemail = document.forms["addven"]["ven_email"].value;
	var venloc = document.forms["addven"]["ven_location"].value;
    if ((venname == "" )|| (venphone =="" )|| (venemail =="") || (venloc =="")) {
        alert("All Fields must be filled out");
        return false;
    }
}

function add_packages() {
    var packname = document.forms["addpack"]["pack_name"].value;
    if (packname == "" ){
        alert("All Fields must be filled out");
        return false;
    }
}