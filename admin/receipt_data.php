<?php

session_start();


require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT receipt FROM invpara";
    $result = $conn->query($sql);

    $row = $result->fetch();
    $no = $row['receipt'];
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
        $sql = "SELECT * from receipt where cancel ='0'   and receiptno  = '" . $_GET['receiptno'] . "'";
        $sql = $conn->query($sql);
        if ($row = $sql->fetch()) {
            exit("Duplicate Receipt No...!!!");
        }
//        $sql = "SELECT * from invoice where cancel ='0' and balance<'" . $_GET['payment'] . "' and nic  = '" . $_GET['nic'] . "'";
//        $sql = $conn->query($sql);
//        if ($row = $sql->fetch()) {
//            exit("Payment Is Gratherthan Balance Value...!!!");
//        }
        $sql = "insert into receipt(receiptno, fname,nic,note,payment,user,sdate,uniq) values
                ('" . $_GET ['receiptno'] . "','" . $_GET ['fname'] . "','" . $_GET ['nic'] . "','" . $_GET ['note'] . "','" . $_GET ['payment'] . "','" . $_SESSION["CURRENT_USER"] . "','" . date("Y-m-d H:i:s") . "','" . $_GET ['uniq'] . "' )";

        $result = $conn->query($sql);

        $sql = "update invoice set bal=bal-'" . $_GET ['payment'] . "' where nic='" . $_GET ['nic'] . "'";
        $result = $conn->query($sql);

        $sql = "update invpara set receipt=receipt+1";
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

    $sql = "SELECT * from invoice where cancel ='0'   and nic  = '" . $_GET['custno'] . "'";

    $i = 1;
    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {

        $ResponseXML .= "<fname><![CDATA[" . $row['oname'] . "]]></fname>";
        $ResponseXML .= "<nic><![CDATA[" . $row['nic'] . "]]></nic>";
        $ResponseXML .= "<address><![CDATA[" . $row['paddress'] . "]]></address>";
    }
    $content .= "<p style='font-weight: 600; padding-bottom: 10px; font-size: 17px;'>Payment Details</p>";
    $content .= "<table class='table'>";
    $content .= "<tbody>";
    $content .= "<tr>";
    $content .= "<td>Total</td> ";
    $content .= "<td style='padding-left: 10px;'>" . $row['tot'] . "</td>";
    $content .= " </tr>";
    $content .= "<tr>";
    $content .= "<td>Advance</td> ";
    $content .= "<td style='padding-left: 10px;'>" . $row['advance'] . "</td>";
    $content .= "</tr>";

    $i = 1;
    $sql1 = "SELECT * from receipt where cancel ='0'   and nic  = '" . $_GET['custno'] . "' order by id";
    foreach ($conn->query($sql1) as $row1) {
        $content .= "<tr>";
        $content .= "<td>Payments $i</td>";
        $content .= "<td style = 'padding-left: 10px;'>" . $row1['payment'] . "</td>";
        $content .= "</tr>";
        $i = $i + 1;
    }
    $content .= "<tr>";
    $content .= "<td>Balance</td> ";
    $content .= "<td style = 'padding-left: 10px;'>" . $row['bal'] . "</td>";
    $content .= "</tr>";
    $content .= "</tr>";

    $content .= "</tbody>";

    $content .= "</table>";


    $ResponseXML .= "<getdata><![CDATA[$content]]></getdata>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class = \"table table-bordered\">
                <tr>
                    <th width=\"210\">Name</th>
                    <th width=\"200\">Nic</th>
                    <th width=\"100\">Total</th>
                    <th width=\"100\">Balance</th>
                </tr>";

    $sql = "select * from invoice where cancel='0' and invoiceno <> ''";

    if ($_GET["fname"] != "") {
        $sql .= " and oname like '" . Trim($_GET["fname"]) . "%'";
    }
    if ($_GET["nic"] != "") {
        $sql .= " and nic like '" . Trim($_GET["nic"]) . "%'";
    }


    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['invoiceno'];
        $bal = $row['tot'] - $row['advance'];
        $ResponseXML .= "<tr>
                <td onclick=\"custno('" . $row['nic'] . "', '$stname');\">" . $row['oname'] . "</a></td>
                <td onclick=\"custno('" . $row['nic'] . "', '$stname');\">" . $row['nic'] . "</a></td>               
                <td onclick=\"custno('" . $row['nic'] . "', '$stname');\">" . $row['tot'] . "</a></td>               
                <td onclick=\"custno('" . $row['nic'] . "', '$stname');\">" . $bal . "</a></td>
                                  
                  </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}
?>