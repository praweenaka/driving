<?php

session_start();


require_once ("./admin/connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');



if ($_GET["Command"] == "getresult") {

    $_SESSION["custno"] = $_GET['nic'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";
    $content = "";
    $sql = "Select * from result where nic='" . $_GET['nic'] . "'";
    $result = $conn->query($sql);
    if ($row = $result->fetch()) {
        $content = "<div class='col-sm-10 col-md-12 m-lr-auto p-b-30'>
                   
                    <div class='block-3 bo2 flex-w'> 
                        <div class='wrap-text-b3 w-size7 p-l-35 p-r-27 p-t-26 p-b-25 w-full-md'>
                           
                            <h4 class='p-b-15'>
                              
                                <a href='#' class='m-txt8 hov-color-main trans-04'>";
        if ($row['action'] == 'Pass') {
            $content .= "   Sucessfully You Passed The Exam...!!";
        } else if ($row['action'] == 'Fail') {
            $content .= "  You Fail The Exam.... Please Contact Your Tainer...!!!";
        }
        $content .= "  </a>
                            </h4>
                            <p class='s-txt2 h-size8 of-hidden m-b-2 respon3'>
                                Your Mark Is " . $row['mark'] . "....!!
                            </p>
                             
                        </div>
                    </div>
                </div>";
        $ResponseXML .= "<getdata><![CDATA[$content]]></getdata>";
    } else {
        $content .= "<div class='col-sm-10 col-md-12 m-lr-auto p-b-30'>
                   
                    <div class='block-3 bo2 flex-w'>
                        <div class='wrap-text-b3 w-size7 p-l-35 p-r-27 p-t-26 p-b-25 w-full-md'>
                            <h4 class='p-b-15'>
                                <a href='#' class='m-txt8 hov-color-main trans-04'>
                                   Please Check Your Nic Number Correct....!!!
                                </a>
                            </h4>
                            
                             
                        </div>
                    </div>
                </div>";
        $ResponseXML .= "<getdata><![CDATA[$content]]></getdata>";
    }
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "getdates") {

    $_SESSION["custno"] = $_GET['nic'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";
    $content = "";
    $sql = "Select * from invoice where nic='" . $_GET['nic'] . "'";
    $result = $conn->query($sql);
    if ($row = $result->fetch()) {
        $content .= "<div class='col-sm-10 col-md-12 m-lr-auto p-b-30'>
                   
                    <div class='block-3 bo2 flex-w'> 
                        <div class='wrap-text-b3 w-size7 p-l-35 p-r-27 p-t-26 p-b-25 w-full-md'>
                           
                            <h4 class='p-b-15'>
                              
             <a href='#' class='m-txt8 hov-color-main trans-04'>";
        if ($row['train_date'] != null) {
            if ($row['exam_date'] != null) {
                $content .= "  You Training Date Is " . $row['train_date'] . "....!!</br>";
                $content .= "  You Exam Date Is " . $row['exam_date'] . "....!!";
            } else {
                $content .= "  You Training Date Is " . $row['train_date'] . "....!!";
            }
        } else if ($row['exam_date'] != null) {
            $content .= "  You Exam Date Is " . $row['exam_date'] . "....!!";
        }else{
            $content .= "  Please Contact Your Trainer  ....!!";
        }
        $content .= " </a>
                </h4>
                <p class = 's-txt2 h-size8 of-hidden m-b-2 respon3'>
                Your Mark Is " . $row['mark'] . "....!!
                </p>

                </div>
                </div>
                </div>";
        $ResponseXML .= "<getdata><![CDATA[$content]]></getdata>";
    } else {
        $content .= "<div class = 'col-sm-10 col-md-12 m-lr-auto p-b-30'>

                <div class = 'block-3 bo2 flex-w'>
                <div class = 'wrap-text-b3 w-size7 p-l-35 p-r-27 p-t-26 p-b-25 w-full-md'>
                <h4 class = 'p-b-15'>
                <a href = '#' class = 'm-txt8 hov-color-main trans-04'>
                Please Check Your Nic Number Correct....!!!
                </a>
                </h4>


                </div>
                </div>
                </div>";
        $ResponseXML .= "<getdata><![CDATA[$content]]></getdata>";
    }
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


// if ($_GET["Command"] == "search_custom") {
//     $ResponseXML = "";
//     $ResponseXML .= "<table class = \"table table-bordered\">
//                 <tr>
//                     <th width=\"210\">Name</th>
//                     <th width=\"200\">Nic</th>
//                     <th width=\"100\">Total</th>
//                     <th width=\"100\">Balance</th>
//                 </tr>";
//     $sql = "select * from invoice where cancel='0' and invoiceno <> ''";
//     if ($_GET["fname"] != "") {
//         $sql .= " and fname like '" . Trim($_GET["fname"]) . "%'";
//     }
//     if ($_GET["nic"] != "") {
//         $sql .= " and nic like '" . Trim($_GET["nic"]) . "%'";
//     }
//     foreach ($conn->query($sql) as $row) {
//         $cuscode = $row['invoiceno'];
//         $bal = $row['tot'] - $row['advance'];
//         $ResponseXML .= "<tr>
//                 <td onclick=\"custno('$cuscode', '$stname');\">" . $row['fname'] . "</a></td>
//                 <td onclick=\"custno('$cuscode', '$stname');\">" . $row['nic'] . "</a></td>               
//                 <td onclick=\"custno('$cuscode', '$stname');\">" . $row['tot'] . "</a></td>               
//                 <td onclick=\"custno('$cuscode', '$stname');\">" . $bal . "</a></td>
//                   </tr>";
//     }
//     $ResponseXML .= "   </table>";
//     echo $ResponseXML;
// }
?>