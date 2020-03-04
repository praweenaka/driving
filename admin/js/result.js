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
    document.getElementById('resultno').value = "";
    document.getElementById('nic').value = "";
    document.getElementById('mark').value = "";
    document.getElementById('msg_box').innerHTML = "";
    document.getElementById('itemdetails').innerHTML = "";
    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "result_data.php";
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
            idno = "RU/0000" + idno;
        } else if (idno.length === 2) {
            idno = "RU/000" + idno;
        } else if (idno.length === 3) {
            idno = "RU/00" + idno;
        } else if (idno.length === 4) {
            idno = "RU/0" + idno;
        } else if (idno.length === 5) {
            idno = "RU/" + idno;
        }

        document.getElementById("resultno").value = idno;

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

    if (document.getElementById('resultno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Plz Click New...</span></div>";
        return false;
    }

    if (document.getElementById('itemdetails').innerHTML == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Result  Not Entered</span></div>";
        return false;
    }
    document.getElementById('msg_box').innerHTML = "";

    var url = "result_data.php";
    url = url + "?Command=" + "save";

    url = url + "&resultno=" + document.getElementById('resultno').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

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
    var url = "result_data.php";
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
        opener.document.getElementById('msg_box').innerHTML = "";

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("resultno");
        opener.document.getElementById("resultno").value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        opener.document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;


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


    var url = "result_data.php";
    url = url + "?Command=" + "search_custom";
    if (document.getElementById('cusno').value != "") {
        url = url + "&mstatus=cusno";
    } else if (document.getElementById('customername').value != "") {
        url = url + "&mstatus=customername";
    }

    url = url + "&nic=" + document.getElementById('cusno').value;
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
function add_item()
{

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('nic').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Plz Select Customer</span></div>";
        return false;
    }

    var url = "result_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";

    url = url + "&resultno=" + document.getElementById('resultno').value;
    url = url + "&nic=" + document.getElementById('nic').value;
    url = url + "&mark=" + document.getElementById('mark').value;
    url = url + "&action=" + document.getElementById('action').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

    document.getElementById('msg_box').innerHTML = "";

    xmlHttp.onreadystatechange = re_add_item;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function re_add_item()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        document.getElementById('nic').value = "";
        document.getElementById('mark').value = "";
        document.getElementById('nic').focus();

    }
}


function del_item(id) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "result_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "del_item";
    url = url + "&id=" + id;

    url = url + "&resultno=" + document.getElementById('resultno').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

    xmlHttp.onreadystatechange = re_add_item;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

