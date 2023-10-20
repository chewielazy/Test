<?php
    $begin_date_show = "";
    $end_date_show = "";
    if (isset($_POST['find'])) {
        $begin_date_show= $_POST["begin_date"];
        $timestamp = strtotime($begin_date_show);
        $begin_date = date("Y-m-d", $timestamp);

        $end_date_show = $_POST["end_date"];
        $timestamp = strtotime($end_date_show);
        $new_timestamp = strtotime("+1 day", $timestamp);
        $end_date = date("Y-m-d", $new_timestamp);
    }
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Check-AcessControl</title>

    <!-- icon -->
    <link rel="icon" href="./mornitoring.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="./theme/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="./theme/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="./theme/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="./theme/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="./theme/vendors/styles/style.css">


	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="./theme/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="./theme/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="./theme/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="./theme/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="./theme/vendors/styles/style.css">

	<!-- js -->
	<script src="./theme/vendors/scripts/core.js"></script>
	<script src="./theme/vendors/scripts/script.min.js"></script>
	<script src="./theme/vendors/scripts/process.js"></script>
	<script src="./theme/vendors/scripts/layout-settings.js"></script>
	<script src="./theme/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="./theme/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="./theme/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="./theme/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="./theme/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="./theme/vendors/scripts/dashboard.js"></script>


</head>

<body>
    <!-- <div class="header"></div> -->
    <div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
                <img src="./moniter.png" alt="" class="dark-logo">
				<img src="./moniter.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
        <div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li><a href="index.php" class="dropdown-toggle no-arrow">
                        <span class="micon icon-copy fi-monitor"></span><span class="mtext">Display</span>
                    </a></li>
                    <li><a href="saac.php" class="dropdown-toggle no-arrow">
                        <span class="micon icon-copy fa fa-address-book-o"></span><span class="mtext">SAAC</span>
                    </a></li>                    
                    <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit2"></span><span class="mtext">Check Logbook</span>
						</a>
						<ul class="submenu">
							<li><a href="normal.php">Normol</a></li>
                            <li><a href="notaccesss.php">Not accesss</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
    </div>
        
    <div class="main-container">
        
        <div class="alert alert-warning " role="alert">
			พบการลง logbook แต่ไม่ได้แสกนเข้าห้อง
		</div>
        
        <form method="post">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2 class="text h2">Check Logbook -Not AcessControl</h2>
                    </div>
                </div>
                <form>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label"><br>Date In</label>
                        <div class="col-sm-12 col-md-10">
                            <br><input class="form-control date-picker" type="text"name="begin_date" id="begin_date" placeholder="Date In"value="<?php echo $begin_date_show; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Date Out</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control date-picker" type="text"name="end_date" id="end_date" placeholder="Date Out"value="<?php echo $end_date_show; ?>">
                        </div>
                    </div>
                    <div class="contact-dire-info text-right view-contact">
                        <button type="submit" name="find" class="btn btn-info" style="font-size: 18px;">Search <i class="icon-copy fa fa-search" aria-hidden="true"></i></button> 
                    </div>
                    <form>
                </form> 
            </div>
        </form> 
        <div class="row">
            <div class="col-md-3">
                <div class="pd-20 card-box mb-30">
                    <h5 class="mb-10 text-center">DataRoom CCB2</h5>
                    <div id="chart1"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pd-20 card-box mb-30">
                    <h5 class="mb-10 text-center">DataRoom CCB5</h5>
                    <div id="chart2"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pd-20 card-box mb-30">
                    <h5 class="mb-10 text-center">DataRoom CCB7 EM3</h5>
                    <div id="chart3"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pd-20 card-box mb-30">
                    <h5 class="mb-10 text-center">DataRoom CCB2 EM4</h5>
                    <div id="chart4"></div>
                </div>
            </div>
        </div>
        <div class="pd-ltr-25">
            <div class="pb-20 card-box mb-30">
                <div class="table-responsive text-nowrap">	
                    <table id="dtBasicExample" class="table hover multiple-select-row nowrap"><br>
                        <thead>
                            <tr>
                                <th>Num</th>
                                <th>Room</th>
                                <th>date_in</th>
                                <th>date_out</th>
                                <th>StaffId</th>
                                <th>Name_Surname</th>                                
                                <th>dept</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $host = "10.250.1.35";
                            $username = "app";
                            $password = "app123";
                            $database = "access_control";
                            $port = 3306;                       
                            $conn = new mysqli($host, $username, $password, $database,$port);
                            $CountAll=0;$Count_02=0; $Count_05=0; $Count_em3=0; $Count_em4=0;               
                            if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
                            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                $sql = "SELECT DISTINCT	b.id,b.building as ROOM,b.date_in,b.date_out,b.user_id as StaffId,b.user_name AS Name_Surname_th,user_company as dept, b.reason AS Remark FROM access_control.new_biostar_log a RIGHT JOIN access_control.event_access_log b ON (a.nUserID = b.user_id AND ((a.device = '(CCB2) DATA ROOM OUT(172.16.99.17)' AND b.room = '540094318') OR (a.device = '(CCB5) DATA ROOM OUT (172.16.98.12)' AND b.room = '540093394') OR (a.device = '(CCB7) DATA ROOM EM3 OUT (172.16.97.21)' AND b.room = '540094146')OR (a.device = '(CCB7) DATA ROOM EM4 OUT(172.16.97.14)' AND b.room = '540094144')) AND (STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') + INTERVAL 1 Hour AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') < STR_TO_DATE(b.date_out, '%Y-%m-%d %H:%i:%s'))) LEFT JOIN access_control.BIOSTAR_TB_USER c ON (a.nUserID = c.sUserID) where a.accessdate is null and b.Coordinator_id is null and b.date_out is not null and STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') >= '$begin_date' AND STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= '$end_date'";
                                mysqli_set_charset($conn, "utf8");                
                                $result = mysqli_query($conn, $sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                    $building = $row["ROOM"];
                                    if ($building == "CCB7") {
                                        $building = "CCB7 EM3";
                                        $Count_em3++;
                                    } elseif ($building == "ccb7") {
                                        $building = "CCB7 EM4";
                                        $Count_em4++; 
                                    } elseif ($building == "CCB2") {
                                        $Count_02++;
                                    } elseif ($building == "CCB5") {
                                        $Count_05++;
                                    }
                                    $CountAll++;
                                    echo "<tr><td>{$row['id']}</td>";
                                    echo "<td>{$building}</td>";
                                    echo "<td>{$row['date_in']}</td>";
                                    echo "<td>{$row['date_out']}</td>";
                                    echo "<td>{$row['StaffId']}</td>";
                                    echo "<td>{$row['Name_Surname_th']}</td>";
                                    echo "<td>{$row['dept']}</td>";
                                    echo "<td>{$row['Remark']}</td></tr>";}}
                                $conn->close();}?>
                        </tbody>
                    </table>
                </div>
            </div>           
		</div>
    </div>
    
	<!-- pagination -->
	<script>
		$(document).ready(function () {
		$('#dtBasicExample').DataTable();
		$('.dataTables_length').addClass('bs-select');
		});
	</script>

    <!-- AV -->
    <?php
        $Count_02 = ( $Count_02 / $CountAll) * 100;$Count_02 = intval($Count_02);
        $Count_05 = ( $Count_05 / $CountAll) * 100;$Count_05 = intval($Count_05);
        $Count_em3 = ( $Count_em3 / $CountAll) * 100;$Count_em3 = intval($Count_em3);
        $Count_em4 = ( $Count_em4 / $CountAll) * 100;$Count_em4 = intval($Count_em4);
    ?>

    <!--Graph 01 -->
    <script>
        var Count_02 = <?php echo $Count_02; ?>;
        var options1 = {
        chart: {
            type: 'radialBar',
            height: 200,
            zoom: {
            enabled: false
            },
            offsetY: 0
        },
        colors: ['#01A6BA'],
        plotOptions: {
            radialBar: {
            dataLabels: {
                name: {
                show: false
                },
                value: {
                offsetY: 0
                }
            }
            }
        },
        series: [Count_02],
        theme: {
            monochrome: {
            enabled: false
            }
        },
        legend: {
            show: false
        },
        }
        var chart = new ApexCharts(document.querySelector("#chart1"), options1);
        chart.render();
    </script>

    <!--Graph 02 -->
    <script>
        var Count_05 = <?php echo $Count_05; ?>;
        var options2 = {
        chart: {
            type: 'radialBar',
            height: 200,
            zoom: {
            enabled: false
            },
            offsetY: 0
        },
        colors: ['#F1DD6A'],
        plotOptions: {
            radialBar: {
            dataLabels: {
                name: {
                show: false
                },
                value: {
                offsetY: 0
                }
            }
            }
        },
        series: [Count_05],
        theme: {
            monochrome: {
            enabled: false
            }
        },
        legend: {
            show: false
        },
        }
        var chart = new ApexCharts(document.querySelector("#chart2"), options2);
        chart.render();
    </script>

    <!--Graph 03 -->
    <script>
        var Count_em3 = <?php echo $Count_em3; ?>;
        var options3 = {
        chart: {
            type: 'radialBar',
            height: 200,
            zoom: {
            enabled: false
            },
            offsetY: 0
        },
        colors: ['#75C095'],
        plotOptions: {
            radialBar: {
            dataLabels: {
                name: {
                show: false
                },
                value: {
                offsetY: 0
                }
            }
            }
        },
        series: [Count_em3],
        theme: {
            monochrome: {
            enabled: false
            }
        },
        legend: {
            show: false
        },
        }
        var chart = new ApexCharts(document.querySelector("#chart3"), options3);
        chart.render();
    </script>

    <!--Graph 04 -->
    <script>
        var Count_em4 = <?php echo $Count_em4; ?>;
        var options4 = {
        chart: {
            type: 'radialBar',
            height: 200,
            zoom: {
            enabled: false
            },
            offsetY: 0
        },
        colors: ['#FF8F7F'],
        plotOptions: {
            radialBar: {
            dataLabels: {
                name: {
                show: false
                },
                value: {
                offsetY: 0
                }
            }
            }
        },
        series: [Count_em4],
        theme: {
            monochrome: {
            enabled: false
            }
        },
        legend: {
            show: false
        },
        }
        var chart = new ApexCharts(document.querySelector("#chart4"), options4);
        chart.render();
    </script>


</body>
