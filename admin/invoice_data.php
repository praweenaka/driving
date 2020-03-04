<?php

session_start();


require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT invoice FROM invpara";
    $result = $conn->query($sql);

    $row = $result->fetch();
    $no = $row['invoice'];
    $uniq = uniqid();
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";

    $ResponseXML .= "</new>";

    echo $ResponseXML;
}
if ($_GET["Command"] == "save") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $sql = "SELECT * from invoice where cancel ='0'   and invoiceno  = '" . $_GET['invoiceno'] . "'";
        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {
            exit("Duplicate Invoice No...!!!");
        }
        $bal = $_GET ['tot'] - $_GET ['advance'];
        $sql = "insert into invoice(invoiceno,nic,note,appli,applitype,idtype,sname,oname,namepchange,nameocard,sex,country,dob,age,paddress,pos_code,contact,divisec,driveres,ft,inches,blod_grp,ordoner,visano,visaex_date,drivi_class,train_date,tot,advance,bal,user,sdate,uniq) values
                ('" . $_GET ['invoiceno'] . "','" . $_GET ['nic'] . "','" . $_GET ['note'] . "','" . $_GET ['appli'] . "','" . $_GET ['applitype'] . "','" . $_GET ['idtype'] . "','" . $_GET ['sname'] . "','" . $_GET ['oname'] . "','" . $_GET ['namepchange'] . "',"
                . "'" . $_GET ['nameocard'] . "','" . $_GET ['sex'] . "','" . $_GET ['country'] . "','" . $_GET ['dob'] . "','" . $_GET ['age'] . "','" . $_GET ['paddress'] . "','" . $_GET ['pos_code'] . "','" . $_GET ['contact'] . "','" . $_GET ['divisec'] . "','" . $_GET ['driveres'] . "','" . $_GET ['ft'] . "',"
                . "'" . $_GET ['inches'] . "','" . $_GET ['blod_grp'] . "','" . $_GET ['ordoner'] . "','" . $_GET ['visano'] . "','" . $_GET ['visaex_date'] . "','" . $_GET ['drivi_class'] . "','" . $_GET ['train_date'] . "','" . $_GET ['tot'] . "','" . $_GET ['advance'] . "',$bal,'" . $_SESSION["CURRENT_USER"] . "','" . date("Y-m-d H:i:s") . "','" . $_GET ['uniq'] . "')";

        $result = $conn->query($sql);

        $sql = "update invpara set invoice=invoice+1";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Save";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "pass_quot") {

    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "SELECT * from invoice where cancel ='0'   and invoiceno  = '" . $_GET['custno'] . "'";

    $i = 1;
    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {

        $ResponseXML .= "<invoiceno><![CDATA[" . $row['invoiceno'] . "]]></invoiceno>";
        $ResponseXML .= "<sdate><![CDATA[" . $row['sdate'] . "]]></sdate>";
        $ResponseXML .= "<appli><![CDATA[" . $row['appli'] . "]]></appli>";
        $ResponseXML .= "<applitype><![CDATA[" . $row['applitype'] . "]]></applitype>";
        $ResponseXML .= "<idtype><![CDATA[" . $row['idtype'] . "]]></idtype>";
        $ResponseXML .= "<sname><![CDATA[" . $row['sname'] . "]]></sname>";
        $ResponseXML .= "<oname><![CDATA[" . $row['oname'] . "]]></oname>";
        $ResponseXML .= "<nic><![CDATA[" . $row['nic'] . "]]></nic>";
        $ResponseXML .= "<namepchange><![CDATA[" . $row['namepchange'] . "]]></namepchange>";
        $ResponseXML .= "<nameocard><![CDATA[" . $row['nameocard'] . "]]></nameocard>";
        $ResponseXML .= "<sex><![CDATA[" . $row['sex'] . "]]></sex>";
        $ResponseXML .= "<country><![CDATA[" . $row['country'] . "]]></country>";
        $ResponseXML .= "<dob><![CDATA[" . $row['dob'] . "]]></dob>";
        $ResponseXML .= "<age><![CDATA[" . $row['age'] . "]]></age>";
        $ResponseXML .= "<paddress><![CDATA[" . $row['paddress'] . "]]></paddress>";
        $ResponseXML .= "<pos_code><![CDATA[" . $row['pos_code'] . "]]></pos_code>";
        $ResponseXML .= "<contact><![CDATA[" . $row['contact'] . "]]></contact>";
        $ResponseXML .= "<divisec><![CDATA[" . $row['divisec'] . "]]></divisec>";
        $ResponseXML .= "<driveres><![CDATA[" . $row['driveres'] . "]]></driveres>";
        $ResponseXML .= "<ft><![CDATA[" . $row['ft'] . "]]></ft>";
        $ResponseXML .= "<inches><![CDATA[" . $row['inches'] . "]]></inches>";
        $ResponseXML .= "<blod_grp><![CDATA[" . $row['blod_grp'] . "]]></blod_grp>";
        $ResponseXML .= "<ordoner><![CDATA[" . $row['ordoner'] . "]]></ordoner>";
        $ResponseXML .= "<visano><![CDATA[" . $row['visano'] . "]]></visano>";
        $ResponseXML .= "<visaex_date><![CDATA[" . $row['visaex_date'] . "]]></visaex_date>";
        $ResponseXML .= "<tot><![CDATA[" . $row['tot'] . "]]></tot>";
        $ResponseXML .= "<advance><![CDATA[" . $row['advance'] . "]]></advance>";
        $ResponseXML .= "<drivi_class><![CDATA[" . $row['drivi_class'] . "]]></drivi_class>";
        $ResponseXML .= "<note><![CDATA[" . $row['note'] . "]]></note>";
        $ResponseXML .= "<train_date><![CDATA[" . $row['train_date'] . "]]></train_date>";
        $ResponseXML .= "<img><![CDATA[" . $row['img'] . "]]></img>";
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table   class=\"table table-bordered\">
                <tr>
                    <th width=\"110\">Invoice No</th>
                    <th width=\"200\">Name</th>
                    <th width=\"200\">Nic</th>
                </tr>";

    $sql = "select * from invoice where cancel='0' and invoiceno <> ''";
    if ($_GET["invoiceno"] != "") {
        $sql .= " and invoiceno like '" . Trim($_GET["invoiceno"]) . "%'";
    }
    if ($_GET["nic"] != "") {
        $sql .= " and nic like '" . Trim($_GET["nic"]) . "%'";
    }
    if ($_GET["fname"] != "") {
        $sql .= " and oname like '" . Trim($_GET["fname"]) . "%'";
    }

    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['invoiceno'];
        $ResponseXML .= "<tr>               
                <td onclick=\"custno('$cuscode', '$stname');\">" . $row['invoiceno'] . "</a></td>
                <td onclick=\"custno('$cuscode', '$stname');\">" . $row['oname'] . "</a></td>
                <td onclick=\"custno('$cuscode', '$stname');\">" . $row['nic'] . "</a></td>
                                  
                  </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}


if ($_POST["Command"] == "imageup") {
    $target_dir = "uploads/";

    $mrefno = str_replace("/", "-", "hfghf");

    $target_dir = $target_dir . "userimg" . "/";
    if (!file_exists($target_dir)) {
        if (mkdir($target_dir, 0777, true)) {
            
        }
    }

    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    $mok = "no";
    if (file_exists($target_file)) {
        $mok = "no";
    } else {
        $mok = "ok";
    }


    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    if ($mok = "ok") {

        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $sql = "update invoice set img='" . $target_file . "' where invoiceno='" . $_POST["invoiceno"] . "' ";
            
            $result = $conn->query($sql);

            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            echo $e;
        }
    } else {
        echo "Sorry, file already exists";
    }
}
?>