function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
// Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

function keyset(key, e) {

    if (e.keyCode == 13) {
        document.getElementById(key).focus();
    }
}

function got_focus(key) {
    document.getElementById(key).style.backgroundColor = "#000066";
}

function lost_focus(key) {
    document.getElementById(key).style.backgroundColor = "#000000";
}

function newent() {


    document.getElementById('receiptno').value = "";
    document.getElementById('fname').value = "";
    document.getElementById('nic').value = "";
    document.getElementById('address').value = "";
    document.getElementById('payment').value = "";
    document.getElementById('note').value = ""; 
    document.getElementById('lpaytable').innerHTML = "";
    document.getElementById('msg_box').innerHTML = "";
    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "receipt_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";
    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}



function assign_dt() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
        var idno = XMLAddress1[0].childNodes[0].nodeValue;
        if (idno.length === 1) {
            idno = "R/0000" + idno;
        } else if (idno.length === 2) {
            idno = "R/000" + idno;
        } else if (idno.length === 3) {
            idno = "R/00" + idno;
        } else if (idno.length === 4) {
            idno = "R/0" + idno;
        } else if (idno.length === 5) {
            idno = "R/" + idno;
        }

        document.getElementById("receiptno").value = idno;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
        document.getElementById("uniq").value = XMLAddress1[0].childNodes[0].nodeValue;
    }
}



function save_inv() {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('receiptno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Plz Click New...</span></div>";
        return false;
    }
    if (document.getElementById('nic').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Plz Select Customer..</span></div>";
        return false;
    }
     
    if (document.getElementById('payment').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Payment Not Entered</span></div>";
        return false;
    }
    document.getElementById('msg_box').innerHTML = "";

    var url = "receipt_data.php";
    url = url + "?Command=" + "save";

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&receiptno=" + document.getElementById('receiptno').value;
    url = url + "&fname=" + document.getElementById('fname').value;
    url = url + "&nic=" + document.getElementById('nic').value;
    url = url + "&address=" + document.getElementById('address').value;
    url = url + "&payment=" + document.getElementById('payment').value;
    url = url + "&note=" + document.getElementById('note').value;
    
     
    xmlHttp.onreadystatechange = re_save;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function re_save() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Save") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Save</span></div>";
            setTimeout("location.reload(true);", 500);
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }

}

function custno(code)
{
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "receipt_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + code;


    xmlHttp.onreadystatechange = passcusresult_quot;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}



function passcusresult_quot()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("fname");
        opener.document.form1.fname.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("nic");
        opener.document.form1.nic.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("address");
        opener.document.form1.address.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("getdata");
        opener.document.getElementById('lpaytable').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


        self.close();
    }
}

function update_cust_list(stname)
{


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }


    var url = "receipt_data.php";
    url = url + "?Command=" + "search_custom";
    if (document.getElementById('cusno').value != "") {
        url = url + "&mstatus=cusno";
    } else if (document.getElementById('customername').value != "") {
        url = url + "&mstatus=customername";
    }


    url = url + "&fname=" + document.getElementById('cusno').value;
    url = url + "&nic=" + document.getElementById('customername').value;
    url = url + "&stname=" + stname;

    xmlHttp.onreadystatechange = showcustresult;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function showcustresult()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {


        document.getElementById('filt_table').innerHTML = xmlHttp.responseText;



    }
}
