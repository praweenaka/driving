<?php

session_start();


require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT resultup FROM invpara";
    $result = $conn->query($sql);

    $row = $result->fetch();
    $no = $row['resultup'];
    $uniq = uniqid();
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";

    $ResponseXML .= "</new>";

    echo $ResponseXML;
}


if ($_GET["Command"] == "search_custom") {


    $ResponseXML = "";

    $ResponseXML .= "<table class = \"table table-bordered\">
                <tr> 
                    <th width=\"200\">Nic</th> 
                </tr>";

    $sql = "select * from result where cancel='0' and nic <> ''";

    if ($_GET["nic"] != "") {
        $sql .= " and nic like '" . Trim($_GET["nic"]) . "%'";
    }

    foreach ($conn->query($sql) as $row) {
        $cuscode = $row['resultno'];
        $ResponseXML .= "<tr> 
                <td onclick=\"custno('$cuscode', '$stname');\">" . $row['nic'] . "</a></td>       
                                  
                  </tr>";
    }


    $ResponseXML .= "   </table>";


    echo $ResponseXML;
}

if ($_GET["Command"] == "setitem") {

    header('Content-Type: text/xml');
    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";
    $sql = "delete from result_tmp where id='" . $_GET['id'] . "' and uniq='" . $_GET['uniq'] . "'";
    $result = $conn->query($sql);

    $sql = "select * from result_tmp where nic='" . $_GET['nic'] . "' and uniq='" . $_GET['uniq'] . "'";
    $result = $conn->query($sql);
    if ($row = $result->fetch()) {
        echo "Already Add Table";
        exit();
    }
    if ($_GET["Command1"] == "add_tmp") {

        $sql = "Insert into result_tmp (resultno,nic,mark,action,user,sdate,uniq) values
			('" . $_GET['resultno'] . "', '" . $_GET['nic_'] . "', '" . $_GET['mark_'] . "','" . $_GET['action'] . "','" . $_SESSION["CURRENT_USER"] . "','" . date("Y-m-d H:i:s") . "','" . $_GET ['uniq'] . "' )";
//        echo print_r($_GET);
        $result = $conn->query($sql);

        if (!$result) {
            echo $sql . "<br>";
            echo mysqli_error($GLOBALS['dbinv']);
        }
    }
    $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\"> ";

    $i = 1;

    $sql = "Select * from result_tmp where uniq='" . $_GET['uniq'] . "'";
    foreach ($conn->query($sql) as $row) {
        $ResponseXML .= "<tr>
                         <td style='width:100px;'> </td>
                         <td style='width:320px;'>" . $row['nic'] . "</td>
                         <td style='width:100px;'>" . $row['mark'] . "</td>
                         <td style='width:220px;'>" . $row['action'] . "</td> 
                         <td><a class=\"btn btn-danger btn-xs\" onClick=\"del_item('" . $row['id'] . "')\"> <span class='fa fa-remove'></span></a></td>
                         </tr>";

        $i = $i + 1;
    }

    $ResponseXML .= "</table>]]></sales_table>";
//    $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>"; 
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "save") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $sql = "SELECT * from result where cancel ='0'   and resultno  = '" . $_GET['resultno'] . "'";
        $result = $conn->query($sql);
        if ($row = $result->fetch()) {
            exit("Duplicate Result No...!!!");
        }

        $sql = "Select * from result_tmp where uniq='" . $_GET['uniq'] . "'";
        foreach ($conn->query($sql) as $row) {

            $sql = "Insert into result(resultno,nic,mark,action,user,sdate,uniq) values
			('" . $_GET['resultno'] . "', '" . $row['nic'] . "','" . $row['mark'] . "','" . $row['action'] . "','" . $_SESSION["CURRENT_USER"] . "','" . date("Y-m-d H:i:s") . "','" . $_GET ['uniq'] . "' )";
            $result = $conn->query($sql);
        }

        $sql = "delete from result_tmp where resultno='" . $_GET['resultno'] . "' and uniq='" . $_GET['uniq'] . "'";

        $result = $conn->query($sql);

        $sql = "update invpara set resultup=resultup+1";
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
    $ResponseXML .= "<sales_table><![CDATA[ <table class=\"table\">     
			<tr>
                         
                        </tr>";
    $sql = "SELECT * from result where cancel ='0'   and nic  = '" . $_GET['custno'] . "'";
    foreach ($conn->query($sql) as $row) {
        $ResponseXML .= "<tr>
                          <td style='width:35px;'> </td>
                         <td style='width:100px;'>" . $row['nic'] . "</td>
                         <td style='width:20px;'>" . $row['mark'] . "</td>
                         <td style='width:220px;'>" . $row['action'] . "</td> 
                         </tr>";
    }

    $ResponseXML .= "   </table>]]></sales_table>";
    $ResponseXML .= "<resultno><![CDATA[" . $row['resultno'] . "]]></resultno>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>