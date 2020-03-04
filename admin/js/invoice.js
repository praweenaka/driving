/* global url, params, salessaveresult */

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


    document.getElementById('invoiceno').value = "";
    document.getElementById('note').value = "";
    document.getElementById('tot').value = "";
    document.getElementById('advance').value = "";
    document.getElementById('msg_box').innerHTML = "";

    document.getElementById('appli_new').checked = false;
    document.getElementById('appli_extnd').checked = false;
    document.getElementById('appli_renwl').checked = false;
    document.getElementById('appli_dup').checked = false;
    document.getElementById('appli_conv').checked = false;
    document.getElementById('appli_extnd_p').checked = false;
    document.getElementById('nomal').checked = false;
    document.getElementById('sm_day').checked = false;
    document.getElementById('nic_ty').checked = false;
    document.getElementById('sp_ty').checked = false;
    document.getElementById('fp_ty').checked = false;
    document.getElementById('dp_tp').checked = false;
    document.getElementById('sname').value = "";
    document.getElementById('oname').value = "";
    document.getElementById('nic').value = "";
    document.getElementById('namepchange').value = "";
    document.getElementById('nameocard').value = "";
    document.getElementById('male').checked = false;
    document.getElementById('female').checked = false;
    document.getElementById('country').value = "";
    document.getElementById('dob').value = "";
    document.getElementById('age').value = "";
    document.getElementById('paddress').innerHTML = "";
    document.getElementById('pos_code').value = "";
    document.getElementById('contact').value = "";
    document.getElementById('divisec').value = "";
    document.getElementById('dr_none').checked = false;
    document.getElementById('dr_colen').checked = false;
    document.getElementById('dr_artilim').checked = false;
    document.getElementById('dr_parap').checked = false;
    document.getElementById('dr_oneye').checked = false;
    document.getElementById('dr_hea_aid').checked = false;
    document.getElementById('ft').value = "";
    document.getElementById('inches').value = "";
    document.getElementById('blod_grp').value = "None";
    document.getElementById('or_yes').checked = false;
    document.getElementById('or_no').checked = false;
    document.getElementById('visano').value = "";
    document.getElementById('visaex_date').value = "";
    document.getElementById('drivi_class').value = "";
    document.getElementById('train_date').value = ""; 


    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "invoice_data.php";
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
            idno = "B/0000" + idno;
        } else if (idno.length === 2) {
            idno = "B/000" + idno;
        } else if (idno.length === 3) {
            idno = "B/00" + idno;
        } else if (idno.length === 4) {
            idno = "B/0" + idno;
        } else if (idno.length === 5) {
            idno = "B/" + idno;
        }

        document.getElementById("invoiceno").value = idno;
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

    if (document.getElementById('invoiceno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Plz Click New...</span></div>";
        return false;
    }
    if (document.getElementById('oname').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Other Name Not Entered</span></div>";
        return false;
    }
    if (document.getElementById('nic').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Nic Not Entered</span></div>";
        return false;
    }
    if (document.getElementById('tot').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Full Payment Not Entered</span></div>";
        return false;
    }
    document.getElementById('msg_box').innerHTML = "";

    var url = "invoice_data.php";
    url = url + "?Command=" + "save";

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&invoiceno=" + document.getElementById('invoiceno').value;
    url = url + "&sdate=" + document.getElementById('sdate').value;
    url = url + "&nic=" + document.getElementById('nic').value;
    url = url + "&note=" + document.getElementById('note').value;

    if (document.getElementById('appli_new').checked == true) {
        appli = "appli_new";
    } else if (document.getElementById('appli_extnd').checked == true) {
        appli = "appli_extnd";
    } else if (document.getElementById('appli_renwl').checked == true) {
        appli = "appli_renwl";
    } else if (document.getElementById('appli_dup').checked == true) {
        appli = "appli_dup";
    } else if (document.getElementById('appli_conv').checked == true) {
        appli = "appli_conv";
    } else if (document.getElementById('appli_extnd_p').checked == true) {
        appli = "appli_extnd_p";
    } else {
        appli = "";
    }
    url = url + "&appli=" + appli;

    if (document.getElementById('nomal').checked == true) {
        applitype = "nomal";
    } else if (document.getElementById('sm_day').checked == true) {
        applitype = "sm_day";
    } else {
        applitype = "";
    }
    url = url + "&applitype=" + applitype;

    if (document.getElementById('nic_ty').checked == true) {
        idtype = "nic_ty";
    } else if (document.getElementById('sp_ty').checked == true) {
        idtype = "sp_ty";
    } else if (document.getElementById('fp_ty').checked == true) {
        idtype = "fp_ty";
    } else if (document.getElementById('dp_tp').checked == true) {
        idtype = "dp_tp";
    } else {
        idtype = "";
    }
    url = url + "&idtype=" + idtype;

    url = url + "&sname=" + document.getElementById('sname').value;
    url = url + "&oname=" + document.getElementById('oname').value;
    url = url + "&namepchange=" + document.getElementById('namepchange').value;
    url = url + "&nameocard=" + document.getElementById('nameocard').value;

    if (document.getElementById('male').checked == true) {
        sex = "male";
    } else {
        sex = "female";
    }
    url = url + "&sex=" + sex;

    url = url + "&country=" + document.getElementById('country').value;
    url = url + "&dob=" + document.getElementById('dob').value;
    url = url + "&age=" + document.getElementById('age').value;
    url = url + "&paddress=" + document.getElementById('paddress').value;
    url = url + "&pos_code=" + document.getElementById('pos_code').value;
    url = url + "&contact=" + document.getElementById('contact').value;
    url = url + "&divisec=" + document.getElementById('divisec').value;

    if (document.getElementById('dr_none').checked == true) {
        driveres = "dr_none";
    } else if (document.getElementById('dr_colen').checked == true) {
        driveres = "dr_colen";
    } else if (document.getElementById('dr_artilim').checked == true) {
        driveres = "dr_artilim";
    } else if (document.getElementById('dr_parap').checked == true) {
        driveres = "dr_parap";
    } else if (document.getElementById('dr_oneye').checked == true) {
        driveres = "dr_oneye";
    } else if (document.getElementById('dr_hea_aid').checked == true) {
        driveres = "dr_hea_aid";
    } else {
        driveres = "";
    }
    url = url + "&driveres=" + driveres;

    url = url + "&ft=" + document.getElementById('ft').value;
    url = url + "&inches=" + document.getElementById('inches').value;
    url = url + "&blod_grp=" + document.getElementById('blod_grp').value;

    if (document.getElementById('or_yes').checked == true) {
        ordoner = "or_yes";
    } else if (document.getElementById('or_no').checked == true) {
        ordoner = "or_no";
    } else {
        ordoner = "";
    }
    url = url + "&ordoner=" + ordoner;

    url = url + "&visano=" + document.getElementById('visano').value;
    url = url + "&visaex_date=" + document.getElementById('visaex_date').value;
    url = url + "&drivi_class=" + document.getElementById('drivi_class').value;
    url = url + "&tot=" + document.getElementById('tot').value;
    url = url + "&advance=" + document.getElementById('advance').value;
    url = url + "&train_date=" + document.getElementById('train_date').value;
    imgup();
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
    var url = "invoice_data.php";
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

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("invoiceno");
        opener.document.form1.invoiceno.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sdate");
        opener.document.form1.sdate.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("appli");
        if (XMLAddress1[0].childNodes[0].nodeValue == "appli_new") {
            opener.document.getElementById('appli_new').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "appli_extnd") {
            opener.document.getElementById('appli_extnd').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "appli_renwl") {
            opener.document.getElementById('appli_renwl').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "appli_dup") {
            opener.document.getElementById('appli_dup').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "appli_conv") {
            opener.document.getElementById('appli_conv').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "appli_extnd_p") {
            opener.document.getElementById('appli_extnd_p').checked = true;
        } else {

        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("applitype");
        if (XMLAddress1[0].childNodes[0].nodeValue == "nomal") {
            opener.document.getElementById('nomal').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "sm_day") {
            opener.document.getElementById('sm_day').checked = true;
        } else {

        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("idtype");
        if (XMLAddress1[0].childNodes[0].nodeValue == "nic_ty") {
            opener.document.getElementById('nic_ty').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "sp_ty") {
            opener.document.getElementById('sp_ty').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "fp_ty") {
            opener.document.getElementById('fp_ty').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "dp_tp") {
            opener.document.getElementById('dp_tp').checked = true;
        } else {

        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sname");
        opener.document.form1.sname.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("oname");
        opener.document.form1.oname.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("nic");
        opener.document.form1.nic.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("namepchange");
        opener.document.form1.namepchange.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("nameocard");
        opener.document.form1.nameocard.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sex");
        if (XMLAddress1[0].childNodes[0].nodeValue == "male") {
            opener.document.getElementById('male').checked = true;
        } else {
            opener.document.getElementById('female').checked = true;
        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("country");
        opener.document.form1.country.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("dob");
        opener.document.form1.dob.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("age");
        opener.document.form1.age.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("paddress");
        opener.document.form1.paddress.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("pos_code");
        opener.document.form1.pos_code.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("contact");
        opener.document.form1.contact.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("divisec");
        opener.document.form1.divisec.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("driveres");
        if (XMLAddress1[0].childNodes[0].nodeValue == "dr_none") {
            opener.document.getElementById('dr_none').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "dr_colen") {
            opener.document.getElementById('dr_colen').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "dr_artilim") {
            opener.document.getElementById('dr_artilim').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "dr_parap") {
            opener.document.getElementById('dr_parap').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "dr_oneye") {
            opener.document.getElementById('dr_oneye').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "dr_hea_aid") {
            opener.document.getElementById('dr_hea_aid').checked = true;
        } else {

        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ft");
        opener.document.form1.ft.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("inches");
        opener.document.form1.inches.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("blod_grp");
        opener.document.form1.blod_grp.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("ordoner");
        if (XMLAddress1[0].childNodes[0].nodeValue == "or_yes") {
            opener.document.getElementById('or_yes').checked = true;
        } else if (XMLAddress1[0].childNodes[0].nodeValue == "or_no") {
            opener.document.getElementById('or_no').checked = true;
        } else {

        }
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("visano");
        opener.document.form1.visano.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("visaex_date");
        opener.document.form1.visaex_date.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tot");
        opener.document.form1.tot.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("advance");
        opener.document.form1.advance.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("drivi_class");
        opener.document.form1.drivi_class.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("note");
        opener.document.form1.note.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("train_date");
        opener.document.form1.train_date.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("img");
        opener.document.form1.blah.src = XMLAddress1[0].childNodes[0].nodeValue;
 
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


    var url = "invoice_data.php";
    url = url + "?Command=" + "search_custom";
    if (document.getElementById('cusno').value != "") {
        url = url + "&mstatus=cusno";
    } else if (document.getElementById('customername').value != "") {
        url = url + "&mstatus=customername";
    } else if (document.getElementById('nic').value != "") {
        url = url + "&mstatus=nic";
    }


    url = url + "&invoiceno=" + document.getElementById('cusno').value;
    url = url + "&fname=" + document.getElementById('customername').value;
    url = url + "&nic=" + document.getElementById('nic').value;
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

function print_inv() {

    var url = "invoice_print.php";
    url = url + "?invoiceno=" + document.getElementById('invoiceno').value;
    url = url + "&sname=" + document.getElementById('sname').value;
    url = url + "&paddress=" + document.getElementById('paddress').value;
    url = url + "&nic=" + document.getElementById('nic').value;
    url = url + "&sdate=" + document.getElementById('sdate').value;

    window.open(url, '_blank');
}

function imgup(cdata) {

    var files = $('#file-3')[0].files; //where files would be the id of your multi file input
//or use document.getElementById('files').files;

    for (var i = 0, f; f = files[i]; i++) {
        var name = document.getElementById('file-3');
        var alpha = name.files[i];
        console.log(alpha.name);
        var data = new FormData();
        var invoiceno = document.getElementById('invoiceno').value;
        data.append('Command', "imageup");
        data.append('file', alpha);
        data.append('invoiceno', invoiceno);
        $.ajax({
            url: 'invoice_data.php',
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (msg) {
                alert(msg);

            }
        });
    }
}