<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Display</title>

    <!-- Refresh-->
    <meta http-equiv="refresh" content="300">

    <!-- icon -->
    <link rel="icon" href="./mornitoring.png" >

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
    <div class="header"></div>
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
		<div class="pd-ltr-20 xs-pd-20-10">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h2 class="text h2">Display</h2>
                </div>
                <div class="pb-20">
                    <table class="table hover multiple-select-row nowrap">
                        <thead>
                            <tr>                                                               
                                <th scope="col">room</th>
                                <th scope="col">date_in</th>
                                <th scope="col">date_out</th>
                                <th scope="col">User_ID</th>
                                <th scope="col">CO_ID</th>
                                <th scope="col">User_name</th>                                
                                <th scope="col">reason</th>
                                <th scope="col">dept</th>                                                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Database connection
                            $host = "10.250.1.35";
                            $username = "app";
                            $password = "app123";
                            $database = "access_control";
                            $port = 3306;
                            
                            // สร้างการเชื่อมต่อ
                            $conn = new mysqli($host, $username, $password, $database,$port);
                            
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Query data from database
                            $query = "SELECT * FROM access_control.event_access_log WHERE DATE(date_in) = (SELECT MAX(DATE(date_in)) 
                            FROM access_control.event_access_log WHERE DATE(date_in) <= CURDATE()) ORDER BY date_in DESC";
                            mysqli_set_charset($conn, "utf8");
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $building = $row["building"];
                                    if ($building == "CCB7") {
                                        $building = "CCB7 EM3";
                                    } elseif ($building == "ccb7") {
                                        $building = "CCB7 EM4";
                                    }
                                    if ($row['date_out'] === null) {
                                    echo "<tr class='table-danger '>";
                                    } else {
                                    echo "<tr>";
                                    }                                    
                                    echo "<td>" . $building. "</td>";
                                    echo "<td>" . $row["date_in"] . "</td>";
                                    echo "<td>" . $row["date_out"] . "</td>";
                                    echo "<td>" . $row["user_id"] . "</td>";
                                    echo "<td>" . $row["Coordinator_id"] . "</td>";
                                    echo "<td>" . $row["user_name"] . "</td>";                                 
                                    echo "<td>" . $row["reason"] . "</td>";                                     
                                    echo "<td>" . $row["user_company"] . "</td>";                                                                     
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No data available</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>	
	</div>

</body>