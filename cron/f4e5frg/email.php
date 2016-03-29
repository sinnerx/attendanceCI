<?php
    class AttendanceEmailReport {
        private $db;
        
        // Constructor - open DB connection
        function __construct() {
            /*mysql_connect("localhost", "root", "bertam123@") or die(mysql_error());
            mysql_select_db("digitalgaia_iris") or die(mysql_error());
            $this->db = new mysqli('localhost', 'root', 'bertam123@', 'digitalgaia_iris');
            mysql_connect("localhost", "fulkrumn_moridh", "fulkrum123@") or die(mysql_error());
            mysql_select_db("fulkrumn_moridh") or die(mysql_error());
            $this->db = new mysqli('localhost', 'fulkrumn_moridh', 'fulkrum123@', 'fulkrumn_moridh');*/
            mysql_connect("localhost", "root", "root") or die(mysql_error());
            mysql_select_db("digitalgaia_iris") or die(mysql_error());
            $this->db = new mysqli('localhost', 'root', 'root', 'digitalgaia_iris');
            $this->db->autocommit(FALSE);
        }
        
        // Destructor - close DB connection
        function __destruct() {
            $this->db->close();
        }
        
        function getReport() {
          	// *** GET THE DATA ***
          	$query = mysql_query("SELECT DATE_ADD(NOW(), INTERVAL -1 DAY) AS dt_now");
          	//$dt_now = substr(mysql_fetch_array($query)['dt_now'], 0, 10);
          	//$dt_now = substr($dt_now, 8, 2) . '-' . substr($dt_now, 5, 2) . '-' . substr($dt_now, 0, 4);
          	$result = mysql_fetch_array($query);
          	$dt_now = $result['dt_now'];
          	$dt_now = substr($dt_now, 0, 10);
          	$dt_now = substr($dt_now, 8, 2) . '-' . substr($dt_now, 5, 2) . '-' . substr($dt_now, 0, 4);
          	//print_r($dt_now);
          	mysql_free_result(mysql_query($query));

			require('fpdf181/fpdf.php');

			$pdf = new FPDF();

          	$query = mysql_query("select * from att_attendancedetails where CONCAT(managerID, '-', activityDate)
          		in ( select distinct CONCAT(managerID, '-', activityDate) as text from att_attendancedetails where lateIn or earlyOut or anomaly)");

          	$data_list = array();
          	//print_r(mysql_fetch_assoc($query));
          	//$data_list = mysql_fetch_array($query);
          	while($row = mysql_fetch_array($query))
          	{
          		// Check if manager & date already in array, just flood the rest of the data, else insert a new item
          		$data_index = 0;
				$is_new = TRUE;
				for ($i=0; $i < count($data_list); $i++) { 
					if ($data_list[$i][0] == $row['activityDate'] && $data_list[$i][1] == $row['managerName']) {
						$is_new = FALSE;
						$data_index = $i;
						break;
					}
				}

				if ($is_new) {
	            	$data = array('','','','','','','','','','','','');
	              	$data[0] = $row['activityDate'];
	              	$data[1] = $row['managerName'];
	              	$data[2] = $row['siteName'];
	            	$data_list[] = $data;
	            	$data_index = count($data_list) - 1;
				}

				if ($row['attendanceStatus'] == 'in1') {
					$data_list[$data_index][3] = $row['activityTime'];
					if ($row['lateIn']) {
						$data_list[$data_index][7] = 'X';
					}
				}
				if ($row['attendanceStatus'] == 'out1') {
					$data_list[$data_index][4] = $row['activityTime'];
					if ($row['earlyOut']) {
						$data_list[$data_index][8] = 'X';
					}
				}
				if ($row['attendanceStatus'] == 'in2') {
					$data_list[$data_index][5] = $row['activityTime'];
					if ($row['lateIn']) {
						$data_list[$data_index][9] = 'X';
					}
				}
				if ($row['attendanceStatus'] == 'out2') {
					$data_list[$data_index][6] = $row['activityTime'];
					if ($row['earlyOut']) {
						$data_list[$data_index][10] = 'X';
					}
				}
				if ($row['anomaly']) {
					$data_list[$data_index][11] = 'X';
				}

          	}

          	$report_row = 0;
          	foreach ($data_list as $datum) {
          		if ($report_row == 0) {
					$pdf->AddPage('L');

					$pdf->SetFont('Arial','B',12);
					$pdf->Cell(0, 7, 'ATTENDANCE REPORT: VIOLATIONS & ANOMALIES', 0);
					$pdf->Ln();

					$pdf->SetFont('Arial','B',10);

          			$pdf->SetFillColor(255, 240, 240);

					$pdf->Cell(20, 14, 'Date', 1, 0 , 'L', TRUE);
					$pdf->Cell(70, 14, 'Manager Name', 1, 0 , 'L', TRUE);
					$pdf->Cell(50, 14, 'Site Name', 1, 0 , 'L', TRUE);
					$pdf->Cell(20, 14, 'Cluster', 1, 0 , 'L', TRUE);
					$pdf->Cell(0.5, 14, '', 1);
					$pdf->Cell(15, 14, 'In', 1, 0 , 'C', TRUE);
					$pdf->Cell(30, 7, 'Lunch', 1, 0 , 'C', TRUE);
					//$pdf->Cell(15, 7, 'Back', 1);
					$pdf->Cell(15, 14, 'Out', 1, 0 , 'C', TRUE);
					$pdf->Cell(0.5, 14, '', 1);
					$pdf->Cell(10, 7, 'Late', 'LTR', 0, 'C', TRUE);
					//$pdf->Cell(10, 7, 'Early', 1);
					$pdf->Cell(20, 7, 'Lunch', 1, 0 , 'C', TRUE);
					$pdf->Cell(10, 7, 'Early', 'LTR', 0 , 'C', TRUE);
					$pdf->Cell(0, 14, 'Anomaly', 1, 0 , 'C', TRUE);
					$pdf->Cell(1, 7, '', 0);
					$pdf->Ln();

					$pdf->Cell(25, 14, '', 0);
					$pdf->Cell(75, 7, '', 0);
					$pdf->Cell(60, 7, '', 0);
					$pdf->Cell(0.5, 7, '', 0);
					$pdf->Cell(15, 7, '', 0);
          			$pdf->SetFillColor(255, 220, 220);
					$pdf->Cell(15, 7, 'Out', 1, 0, 'C', TRUE);
					$pdf->Cell(15, 7, 'In', 1, 0, 'C', TRUE);
					$pdf->Cell(0.5, 7, '', 0);
					$pdf->Cell(15, 7, '', 0);
          			$pdf->SetFillColor(255, 240, 240);
					$pdf->Cell(10, 7, 'In', 'LBR', 0, 'C', TRUE);
          			$pdf->SetFillColor(255, 220, 220);
					$pdf->Cell(10, 7, 'Early', 1, 0, 'C', TRUE);
					$pdf->Cell(10, 7, 'Late', 1, 0, 'C', TRUE);
          			$pdf->SetFillColor(255, 240, 240);
					$pdf->Cell(10, 7, 'Out', 'LBR', 0, 'C', TRUE);

					$pdf->Ln();
					$pdf->Cell(0, 0.5, '', 1);

					$pdf->SetFont('Arial','',10);
          		}
          		$report_row ++;
          		if ($report_row == 20) {
          			$report_row = 0;
          		}
				$pdf->Ln();
				$pdf->Cell(20, 7, $datum[0], 1);
				$pdf->Cell(70, 7, $datum[1], 1);
				$pdf->Cell(50, 7, $datum[2], 1);
				$pdf->Cell(20, 7, '', 1);
				$pdf->Cell(0.5, 7, '', 1);
				$pdf->Cell(15, 7, $datum[3], 1, 0, 'C');
				$pdf->Cell(15, 7, $datum[4], 1, 0, 'C');
				$pdf->Cell(15, 7, $datum[5], 1, 0, 'C');
				$pdf->Cell(15, 7, $datum[6], 1, 0, 'C');
				$pdf->Cell(0.5, 7, '', 1);
				$pdf->Cell(10, 7, $datum[7], 1, 0, 'C');
				$pdf->Cell(10, 7, $datum[8], 1, 0, 'C');
				$pdf->Cell(10, 7, $datum[9], 1, 0, 'C');
				$pdf->Cell(10, 7, $datum[10], 1, 0, 'C');
				$pdf->Cell(0, 7, $datum[11], 1, 0, 'C');
          	}

          	mysql_free_result(mysql_query($query));
          	
          	//print_r($data_list);

		    $file = "Report_" . $dt_now . ".pdf";
		    //echo $file;
			$pdf->Output('F', $file);

		    /*$file_size = filesize($file);
		    $handle = fopen($file, "r");
		    $content = fread($handle, $file_size);
		    fclose($handle);
		    $content = chunk_split(base64_encode($content));
		    $uid = md5(uniqid(time()));
		    $header = "From: Ridhwan Bakir <moridh@fulkrum.net>\r\n";
		    $header .= "Reply-To: moridh@fulkrum.net\r\n";
		    $header .= "MIME-Version: 1.0\r\n";
		    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		    $header .= "This is a multi-part message in MIME format.\r\n";
		    $header .= "--".$uid."\r\n";
		    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		    $header .= "Attached: ".$file."\r\n\r\n";
		    $header .= "--".$uid."\r\n";
		    $header .= "Content-Type: application/octet-stream; name=\"".$file."\"\r\n"; // use different content types here
		    $header .= "Content-Transfer-Encoding: base64\r\n";
		    $header .= "Content-Disposition: attachment; filename=\"".$file."\"\r\n\r\n";
		    $header .= $content."\r\n\r\n";
		    $header .= "--".$uid."--";
		    if (mail('moridh77@gmail.com, moridh@fulkrum.net, ameeradnan@gmail.com', 'Attendance Report ' . $dt_now, $header)) {
		        echo "mail send ... OK"; // or use booleans here
		    } else {
		        echo "mail send ... ERROR!";
		    }*/
			//echo 'Test: ' . mail('moridh@fulkrum.net, moridh77@gmail.com, moridh@studiocaterpillar.com' , 'Test' , 'Testing Part 2');
			$file_size = filesize($file);
		    $handle = fopen($file, "r");
		    $content = fread($handle, $file_size);
		    fclose($handle);
		    $content = chunk_split(base64_encode($content));
		    $uid = md5(uniqid(time()));
		    $header = "From: "."Ridhwan Bakir"." <"."moridh@fulkrum.net".">\r\n";
		    $header .= "Reply-To: "."moridh@fulkrum.net"."\r\n";
		    $header .= "MIME-Version: 1.0\r\n";
		    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		    $header .= "This is a multi-part message in MIME format.\r\n";
		    $header .= "--".$uid."\r\n";
		    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		    $header .= "Daily Attendance Violations & Anomalies Report."."\r\n\r\n";
		    $header .= "--".$uid."\r\n";
		    $header .= "Content-Type: application/octet-stream; name=\"".$file."\"\r\n"; // use different content types here
		    $header .= "Content-Transfer-Encoding: base64\r\n";
		    $header .= "Content-Disposition: attachment; filename=\"".$file."\"\r\n\r\n";
		    $header .= $content."\r\n\r\n";
		    $header .= "--".$uid."--";
		    if (mail('izzat@fulkrum.net, moridh@fulkrum.net, amir@fulkrum.net', 'Attendance Report ' . $dt_now, "", $header)) {
		        echo "mail send ... OK"; // or use booleans here
		    } else {
		        echo "mail send ... ERROR!";
		    }

        }
    }

    $api = new AttendanceEmailReport;

	$api->getReport();
?>
