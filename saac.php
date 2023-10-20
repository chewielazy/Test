<?php
    $case = "";
	$begin_date_show = "";
    $end_date_show = "";
	$notfound = "";
    if (isset($_POST['find'])) {
        $case = $_POST["case"];
		$notfound = $_POST["Remark"];
		$begin_date_show= $_POST["begin_date"];
        $timestamp = strtotime($begin_date_show); // แปลงวันที่ให้เป็น timestamp
        $begin_date = date("Y-m-d", $timestamp); // แปลง timestamp ใหม่เป็นรูปแบบ "yyyy-mm-dd"
        $end_date_show = $_POST["end_date"];
        $timestamp = strtotime($end_date_show); // แปลงวันที่ให้เป็น timestamp
        $new_timestamp = strtotime("+1 day", $timestamp); // เพิ่มวันลงทีละ 1 วัน
        $end_date = date("Y-m-d", $new_timestamp); // แปลง timestamp ใหม่เป็นรูปแบบ "yyyy-mm-dd"
    }
?>


<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>SAAC</title>

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

	<!-- dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

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
		<form method="post">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2 class="text h2">Check SAAC && Logbook <br><br></h2>
                    </div>
                </div>
                <form>
				<div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Date In</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control date-picker" type="text"name="begin_date" id="begin_date" placeholder="Date In" value="<?php echo $begin_date_show; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Date Out</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control date-picker" type="text"name="end_date" id="end_date" placeholder="Date Out" value="<?php echo $end_date_show; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Search Notfound</label>
                        <div class="col-sm-12 col-md-8" id="dropdown" name="dropdown">
							<select class="selectpicker form-control" id="Remark" name="Remark">
								<option value="" <?=($notfound=='')?" selected":""?> >ALL</option>  
								<option value="Not" <?=($notfound=='Not')?" selected":""?> >Not Found</option>
							</select>
						</div>
					</div>	
					<div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Search Case</label>
                        <div class="col-sm-12 col-md-8" id="dropdown" name="dropdown">
                            <select class="selectpicker form-control" id="case" name="case">
                                <option value="1" <?=($case=='1')?" selected":""?> >ไม่ได้ขอ SAAC</option>  
                                <option value="2" <?=($case=='2')?" selected":""?> >ไม่ได้ลง Logbook</option>
                                <option value="3" <?=($case=='3')?" selected":""?> >สถานะ ไม่ปิดงาน</option>  
                            </select>
                        </div>	
						<div class="col-sm-12 col-md-2">
							<button type="submit" name="find" class="btn btn-info" style="font-size: 18px;">Search   <i class="icon-copy fa fa-search" aria-hidden="true"></i></button> 
						</div>
					</div>
                </form>                 
            </div>
		
		<div class="row">
			<div class="col-md-8 col-sm-12 mb-30">
				<div class="pd-20 card-box height-70-p">
					<h5 class="text-center">DataRoom</h5>
					<div id="chart"></div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 mb-35">
				<div class="row">
					<div class="col-md-6">
						<div class="card-box mb-30"><br>
							<h6 class="text-center">DataCen CCB2</h6>
							<div id="chart1"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card-box mb-30"><br>
							<h6 class="text-center">DataCen CCB5</h6>
							<div id="chart2"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="card-box mb-30"><br>
						<h6 class="text-center">DataCen CCB7 EM3</h6>
						<div id="chart3"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card-box mb-30"><br>
						<h6 class="text-center">DataCen CCB7 EM4</h6>
						<div id="chart4"></div>
						</div>
					</div>
				</div> 
			</div> 
        </div>
		
		<div class="alert alert-info text-center " role="alert">
			02 (CSD)> สนับสนุนด้านเทคนิคระบบคลาวด์ , 41 (TCE)> วิศวกรรมเก็บเงินค่าผ่านทาง <br>
			43 (FED)> วิศวกรรมสิ่งอำนวยความสะดวก , 46 (ITS)> วิศวกรรมระบบจราจรอัจฉริยะ , 47 (CEN)> วิศวกรรมคอมพิวเตอร์
		</div>
		<div class="alert alert-danger text-center " role="alert">
			<a class="alert-link">Warning!</a> Not Found อาจจะเป็นที่ชื่อเขียนผิดบางตัวอักษร หรือ เขียนชื่อไทยกับอังกฤษไม่ตรงกัน ต้องมีการไปเช็คที่ SAAC อีกที
		</div>
        </form>
			<div class=" card-box mb-30">	
				<div class="table-responsive text-nowrap">	
                    <table id="dtBasicExample" class="table hover multiple-select-row nowrap">
						<thead>
							<tr>
								<th scope="col">num</th>                                                               
								<th scope="col">room</th>
								<th scope="col">date_in</th>
								<th scope="col">date_out</th>
								<th scope="col">User_ID</th>
								<th scope="col">Bem_name</th>
								<th scope="col">Bem_dept</th>                                
								<th scope="col">CO_name</th>
								<th scope="col">CO_company</th>
								<th scope="col">reason</th>                                                                
							</tr>
						</thead>
						<tbody id="myTable">
							<?php
							$host = "10.250.1.35";
							$username = "app";
							$password = "app123";
							$database = "access_control";
							$port = 3306;
							$conn = new mysqli($host, $username, $password, $database,$port);
							$Count_userNot=0;$Count_user=0;
							$Count_02=0; $Count_05=0; $Count_em3=0; $Count_em4=0; $Count_not02=0; $Count_not05=0; $Count_notem3=0; $Count_notem4=0;
                            $ccb2_02=0; $ccb2_41=0; $ccb2_43=0; $ccb2_46=0;$ccb2_47=0; //ccb2_not02=0; $ccb2_not41=0; $ccb2_not43=0; $ccb2_not46=0; $ccb2_not47=0;
                            $ccb5_02=0; $ccb5_41=0; $ccb5_43=0; $ccb5_46=0;$ccb5_47=0; //ccb5_not02=0; $ccb5_not41=0; $ccb5_not43=0; $ccb5_not46=0; $ccb5_not47=0;
                            $em3_02=0; $em3_41=0; $em3_43=0; $em3_46=0;$em3_47=0; //em3_not02=0; $em3_not41=0; $em3_not43=0; $em3_not46=0; $em3_not47=0;
                            $em4_02=0; $em4_41=0; $em4_43=0; $em4_46=0;$em4_47=0; //em4_not02=0; $em4_not41=0; $em4_not43=0; $em4_not46=0; $em4_not47=0;
 
							if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
							if ($_SERVER["REQUEST_METHOD"] === "POST"){
								if($case == '1'){
									$query = "SELECT DISTINCT a.id,d.sName as ROOM,a.date_in,a.date_out,a.Coordinator_id, c.sUserName_th,substr(c.sUserName,1,2) dept,a.user_name,a.user_company,CONVERT (COALESCE (b.reason, 'Not Found SAAC') USING utf8) as Remark from access_control.event_access_log a left join access_control.list_saac b on (FIND_IN_SET(a.Coordinator_id , b.bem_id) > 0 and STR_TO_DATE(b.date_in - INTERVAL 2 HOUR, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.date_in, '%Y-%m-%d %H:%i:%s') and STR_TO_DATE(a.date_out, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(b.date_out + INTERVAL 2 HOUR, '%Y-%m-%d %H:%i:%s') and (b.outsider_name LIKE CONCAT('%', REPLACE(a.user_name, ' ', '%'), '%') OR a.user_name LIKE CONCAT('%', REPLACE(b.outsider_name, ' ', '%'), '%')) and ((a.room = '540094318' AND b.room = 'Datacenter Room CCB2') OR (a.room = '540093394' AND b.room = 'Datacenter Room CCB5') OR (a.room = '540094146' AND b.room = 'EM3 Datacenter Room CCB7') OR (a.room = '540094144' AND b.room = 'EM4 Datacenter Room CCB7'))) left join  access_control.BIOSTAR_TB_USER c on (a.Coordinator_id = c.sUserID) inner join BIOSTAR_TB_DOOR d on (a.room = d.nIOReaderIdn) where a.Coordinator_id is not null and STR_TO_DATE(a.date_in, '%Y-%m-%d %H:%i:%s') >= '$begin_date' and STR_TO_DATE(a.date_in, '%Y-%m-%d %H:%i:%s') <= '$end_date' and CONVERT (COALESCE (b.reason, 'Not Found SAAC') USING utf8) like '%$notfound%' order by a.id";
									mysqli_set_charset($conn, "utf8");
									$result = $conn->query($query);	
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											$room = $row["ROOM"];
											if ($room == "(CCB2) DATA ROOM") {
												$Count_02++;
												if ($row['Remark'] === 'Not Found SAAC') {$Count_not02++;}
												if ($row['dept'] === '02') {$ccb2_02++;}
												if ($row['dept'] === '41') {$ccb2_41++;}
												if ($row['dept'] === '43') {$ccb2_43++;}
												if ($row['dept'] === '46') {$ccb2_46++;}
												if ($row['dept'] === '47') {$ccb2_47++;}
											} elseif ($room == "(CCB5) DATA ROOM") {
												$Count_05++; 
												if ($row['Remark'] === 'Not Found SAAC') {$Count_not05++;}
												if ($row['dept'] === '02') {$ccb5_02++;}
												if ($row['dept'] === '41') {$ccb5_41++;}
												if ($row['dept'] === '43') {$ccb5_43++;}
												if ($row['dept'] === '46') {$ccb5_46++;}
												if ($row['dept'] === '47') {$ccb5_47++;}
											} elseif ($room == "(CCB7) DATA ROOM EM3") {
												$Count_em3++; 
												if ($row['Remark'] === 'Not Found SAAC') {$Count_notem3++;}
												if ($row['dept'] === '02') {$em3_02++;}
												if ($row['dept'] === '41') {$em3_41++;}
												if ($row['dept'] === '43') {$em3_43++;}
												if ($row['dept'] === '46') {$em3_46++;}
												if ($row['dept'] === '47') {$em3_47++;} 
											} elseif ($room == "(CCB7) DATA ROOM EM4") {
												$Count_em4++; 
												if ($row['Remark'] === 'Not Found SAAC') {$Count_notem4++;} 
												if ($row['dept'] === '02') {$em4_02++;}
												if ($row['dept'] === '41') {$em4_41++;}
												if ($row['dept'] === '43') {$em4_43++;}
												if ($row['dept'] === '46') {$em4_46++;}
												if ($row['dept'] === '47') {$em4_47++;} 
											}


											if ($row['date_out'] === null) {
												echo "<tr class='table-warning'>";
												$Count_userNot++;
											}else if ($row['Remark'] === 'Not Found SAAC') {
												echo "<tr class='table-danger'>";
												$Count_userNot++;
											} else {echo "<tr>";}    
											$Count_user++;     
											echo "<td>" . $row["id"] . "</td>";                           
											echo "<td>" . $row["ROOM"] . "</td>";         
											echo "<td>" . $row["date_in"] . "</td>";
											echo "<td>" . $row["date_out"] . "</td>";
											echo "<td>" . $row["Coordinator_id"] . "</td>";
											echo "<td>" . $row["sUserName_th"] . "</td>";
											echo "<td>" . $row["dept"] . "</td>";
											echo "<td>" . $row["user_name"] . "</td>";                                     
											echo "<td>" . $row["user_company"] . "</td>";
											echo "<td>" . $row["Remark"] . "</td>";                                                                   
											echo "</tr>";	
										}
									} else {echo "<tr><td colspan='3'>No data available</td></tr>";}						
								}else if ($case == '2'){
									$query = "SELECT DISTINCT b.id,b.room,b.date_in,b.date_out,b.bem_id,b.bem_name,b.login_dept,b.outsider_name,b.outsider_dept,CONVERT (COALESCE (a.reason, 'Not Found Logbook') USING utf8) as Remark from access_control.event_access_log a right join access_control.list_saac b on (FIND_IN_SET(a.Coordinator_id, b.bem_id) > 0 and STR_TO_DATE(b.date_in - INTERVAL 2 HOUR, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.date_in, '%Y-%m-%d %H:%i:%s') and STR_TO_DATE(a.date_out, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(b.date_out + INTERVAL 2 HOUR, '%Y-%m-%d %H:%i:%s') and (b.outsider_name LIKE CONCAT('%', REPLACE(a.user_name, ' ', '%'), '%') OR a.user_name LIKE CONCAT('%', REPLACE(b.outsider_name, ' ', '%'), '%')) and ((a.room = '540094318' AND b.room = 'Datacenter Room CCB2') OR (a.room = '540093394' AND b.room = 'Datacenter Room CCB5') OR (a.room = '540094146' AND b.room = 'EM3 Datacenter Room CCB7') OR (a.room = '540094144' AND b.room = 'EM4 Datacenter Room CCB7'))) where b.room in ('Datacenter Room CCB2','Datacenter Room CCB5','EM3 Datacenter Room CCB7','EM4 Datacenter Room CCB7') and b.date_in BETWEEN '$begin_date' AND '$end_date' and CONVERT (COALESCE (a.reason, 'Not Found Logbook') USING utf8) like '%$notfound%' order by b.date_in";							
									mysqli_set_charset($conn, "utf8");
									$result = $conn->query($query);	
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											$room = $row["room"];
											if ($room == "Datacenter Room CCB2") {
												$Count_02++;
												if ($row['Remark'] === 'Not Found Logbook') {$Count_not02++;}
												if ($row['login_dept'] === 'สนับสนุนด้านเทคนิคระบบคลาวด์') {$ccb2_02++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบเก็บเงินค่าผ่านทาง') {$ccb2_41++;}
												if ($row['login_dept'] === 'วิศวกรรมสิ่งอำนวยความสะดวก') {$ccb2_43++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบจราจรอัจฉริยะ') {$ccb2_46++;}
												if ($row['login_dept'] === 'วิศวกรรมคอมพิวเตอร์') {$ccb2_47++;}
											} elseif ($room == "Datacenter Room CCB5") {
												$Count_05++; 
												if ($row['Remark'] === 'Not Found Logbook') {$Count_not05++;}
												if ($row['login_dept'] === 'สนับสนุนด้านเทคนิคระบบคลาวด์') {$ccb5_02++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบเก็บเงินค่าผ่านทาง') {$ccb5_41++;}
												if ($row['login_dept'] === 'วิศวกรรมสิ่งอำนวยความสะดวก') {$ccb5_43++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบจราจรอัจฉริยะ') {$ccb5_46++;}
												if ($row['login_dept'] === 'วิศวกรรมคอมพิวเตอร์') {$ccb5_47++;}
											} elseif ($room == "EM3 Datacenter Room CCB7") {
												$Count_em3++; 
												if ($row['Remark'] === 'Not Found Logbook') {$Count_notem3++;}
												if ($row['login_dept'] === 'สนับสนุนด้านเทคนิคระบบคลาวด์') {$em3_02++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบเก็บเงินค่าผ่านทาง') {$em3_41++;}
												if ($row['login_dept'] === 'วิศวกรรมสิ่งอำนวยความสะดวก') {$em3_43++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบจราจรอัจฉริยะ') {$em3_46++;}
												if ($row['login_dept'] === 'วิศวกรรมคอมพิวเตอร์') {$em3_47++;} 
											} elseif ($room == "EM4 Datacenter Room CCB7") {
												$Count_em4++; 
												if ($row['Remark'] === 'Not Found Logbook') {$Count_notem4++;} 
												if ($row['login_dept'] === 'สนับสนุนด้านเทคนิคระบบคลาวด์') {$em4_02++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบเก็บเงินค่าผ่านทาง') {$em4_41++;}
												if ($row['login_dept'] === 'วิศวกรรมสิ่งอำนวยความสะดวก') {$em4_43++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบจราจรอัจฉริยะ') {$em4_46++;}
												if ($row['login_dept'] === 'วิศวกรรมคอมพิวเตอร์') {$em4_47++;} 
											}
											
											if ($row['date_out'] === null) {
												echo "<tr class='table-warning'>";
												$Count_userNot++;
											}else if ($row['Remark'] === 'Not Found Logbook') {
												echo "<tr class='table-danger'>";
												$Count_userNot++;
											}else {echo "<tr>";} 
											$Count_user++;
											echo "<td>" . $row["id"] . "</td>";                                 
											echo "<td>" . $row["room"] . "</td>";         
											echo "<td>" . $row["date_in"] . "</td>";
											echo "<td>" . $row["date_out"] . "</td>";
											echo "<td>" . $row["bem_id"] . "</td>";
											echo "<td>" . $row["bem_name"] . "</td>";
											echo "<td>" . $row["login_dept"] . "</td>";
											echo "<td>" . $row["outsider_name"] . "</td>";                                     
											echo "<td>" . $row["outsider_dept"] . "</td>";
											echo "<td>" . $row["Remark"] . "</td>";                                                                   
											echo "</tr>";									
										}
									} else {echo "<tr><td colspan='3'>No data available</td></tr>";}
								}else if($case == '3'){
									$query = "SELECT * FROM access_control.list_saac where status_sheet like '%อนุมัติให้เข้าพื้นที่%' and date_in >= '$begin_date' and date_in <= '$end_date' and room in ('Datacenter Room CCB2', 'Datacenter Room CCB5', 'EM3 Datacenter Room CCB7', 'EM4 Datacenter Room CCB7') ";
									mysqli_set_charset($conn, "utf8");
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											$room = $row["room"];
											if ($room == "Datacenter Room CCB2") {
												$Count_02++;
												if ($row['login_dept'] === 'สนับสนุนด้านเทคนิคระบบคลาวด์') {$ccb2_02++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบเก็บเงินค่าผ่านทาง') {$ccb2_41++;}
												if ($row['login_dept'] === 'วิศวกรรมสิ่งอำนวยความสะดวก') {$ccb2_43++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบจราจรอัจฉริยะ') {$ccb2_46++;}
												if ($row['login_dept'] === 'วิศวกรรมคอมพิวเตอร์') {$ccb2_47++;}
											} elseif ($room == "Datacenter Room CCB5") {
												$Count_05++; 
												if ($row['login_dept'] === 'สนับสนุนด้านเทคนิคระบบคลาวด์') {$ccb5_02++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบเก็บเงินค่าผ่านทาง') {$ccb5_41++;}
												if ($row['login_dept'] === 'วิศวกรรมสิ่งอำนวยความสะดวก') {$ccb5_43++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบจราจรอัจฉริยะ') {$ccb5_46++;}
												if ($row['login_dept'] === 'วิศวกรรมคอมพิวเตอร์') {$ccb5_47++;}
											} elseif ($room == "EM3 Datacenter Room CCB7") {
												$Count_em3++; 
												if ($row['login_dept'] === 'สนับสนุนด้านเทคนิคระบบคลาวด์') {$em3_02++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบเก็บเงินค่าผ่านทาง') {$em3_41++;}
												if ($row['login_dept'] === 'วิศวกรรมสิ่งอำนวยความสะดวก') {$em3_43++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบจราจรอัจฉริยะ') {$em3_46++;}
												if ($row['login_dept'] === 'วิศวกรรมคอมพิวเตอร์') {$em3_47++;} 
											} elseif ($room == "EM4 Datacenter Room CCB7") {
												$Count_em4++; 
												if ($row['login_dept'] === 'สนับสนุนด้านเทคนิคระบบคลาวด์') {$em4_02++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบเก็บเงินค่าผ่านทาง') {$em4_41++;}
												if ($row['login_dept'] === 'วิศวกรรมสิ่งอำนวยความสะดวก') {$em4_43++;}
												if ($row['login_dept'] === 'วิศวกรรมระบบจราจรอัจฉริยะ') {$em4_46++;}
												if ($row['login_dept'] === 'วิศวกรรมคอมพิวเตอร์') {$em4_47++;} 
											}
											$Count_user++;
											$Count_userNot++;
											echo "<tr>";    
											echo "<td>" . $row["id"] . "</td>";                                
											echo "<td>" . $row["room"] . "</td>";         
											echo "<td>" . $row["date_in"] . "</td>";
											echo "<td>" . $row["date_out"] . "</td>";
											echo "<td>" . $row["login_id"] . "</td>";
											echo "<td>" . $row["login_name"] . "</td>";
											echo "<td>" . $row["login_dept"] . "</td>";
											echo "<td>" . $row["outsider_name"] . "</td>";                                     
											echo "<td>" . $row["outsider_dept"] . "</td>";
											echo "<td>" . $row["status_sheet"] . "</td>";                                                                   
											echo "</tr>";	
										}
									}
								}else {echo "<tr><td colspan='3'>No data available</td></tr>";}
								$conn->close();
							}
							?>
							<!-- Print csv -->
							<script>
								$(function() {
								// Export to CSV
								$("#exportCSV").click(function() {
									const headers = ["Room",  "date_in","date_out", "User_ID", "User_name", "Ousider_name", "dept", "Remark"];
									const rows = [];
				
									// Collect data from the table rows
									$("table tbody tr").each(function() {
									const row = [];
									$(this).find("td").each(function() {
										row.push($(this).text());});
									rows.push(row);});
				
									// Create and download the CSV file
									let csvContent = "data:text/csv;charset=utf-8," + headers.join(",") + "\n";
									rows.forEach(function(rowArray) {
									const row = rowArray.join(",");
									csvContent += row + "\n";});
				
									const encodedUri = encodeURI(csvContent);
									const link = document.createElement("a");
									link.setAttribute("href", encodedUri);
									link.setAttribute("download", "SAAC_Room.csv");
									document.body.appendChild(link);
									link.click();});
								});
							</script>

							<div class="row clearfix pt-20">
								<dt class="col-sm-2 text-right">Total :</dt>
								<dd class="col-sm-1 text-left"><?php echo $Count_user; ?> ครั้ง</dd>
								<dt class="col-sm-2 text-right">Not Found :</dt>
								<dd class="col-sm-1 text-left"><?php echo $Count_userNot; ?> ครั้ง</dd>
								<dd class="col-sm-6 text-left"></dd>
							</div> 
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="contact-dire-info text-right view-contact">
            <button id="exportCSV" name="exportCSV" class="btn btn-success" style="font-size: 18px;">Export to CSV  <i class="icon-copy fa fa-download" aria-hidden="true"></i></button><br><br><br>
        </div>	
	</div>

	<!-- pagination -->
	<script>
		$(document).ready(function () {
		$('#dtBasicExample').DataTable();
		$('.dataTables_length').addClass('bs-select');
		});
	</script>

	<!-- Chart -->
	<script>
		var ccb2_02 = <?php echo $ccb2_02; ?>; var ccb2_41 = <?php echo $ccb2_41; ?>; var ccb2_43 = <?php echo $ccb2_43; ?>; var ccb2_46 = <?php echo $ccb2_46; ?>; var ccb2_47 = <?php echo $ccb2_47; ?>;
		var ccb5_02 = <?php echo $ccb5_02; ?>; var ccb5_41 = <?php echo $ccb5_41; ?>; var ccb5_43 = <?php echo $ccb5_43; ?>; var ccb5_46 = <?php echo $ccb5_46; ?>; var ccb5_47 = <?php echo $ccb5_47; ?>;
		var em3_02 = <?php echo $em3_02; ?>; var em3_41 = <?php echo $em3_41; ?>; var em3_43 = <?php echo $em3_43; ?>; var em3_46 = <?php echo $em3_46; ?>; var em3_47 = <?php echo $em3_47; ?>;
		var em4_02 = <?php echo $em4_02; ?>; var em4_41 = <?php echo $em4_41; ?>; var em4_43 = <?php echo $em4_43; ?>; var em4_46 = <?php echo $em4_46; ?>; var em4_47 = <?php echo $em4_47; ?>;
		var options = {
		series: [{
			name: 'Dept 02 (CSD)',
			type: 'column',
			data: [ccb2_02, ccb5_02, em3_02, em4_02]
			},{
			name: 'Dept 41 (TCE)',
			type: 'column',
			data: [ccb2_41, ccb5_41, em3_41, em4_41]
			},{
			name: 'Dept 43 (FED)',
			type: 'column',
			data: [ccb2_43, ccb5_43, em3_43, em4_43]
			}, {
			name: 'Dept 46 (ITS)',
			type: 'column',
			data: [ccb2_46, ccb5_46, em3_46, em4_46]
			}, {
			name: 'Dept 47 (CEN)',
			type: 'column',
			data: [ccb2_47, ccb5_47, em3_47, em4_47]
			},{
		}],
		chart: {
		height: 350,
		type: 'bar',
		stacked: false,
		},
		plotOptions: {
		bar: {
			horizontal: false,
			columnWidth: '65%',
		},
		},
		stroke: {
		width: [1,1,1,1,1],
		colors: ['transparent']
		},
		dataLabels: {
		enabled: true,
		enabledOnSeries: [0,1,2,3,4],
		style: {
			fontSize: '12px',
			colors: ["#304758"]
		}
		},
		xaxis: {
			categories: ['CCB2', 'CCB5', 'CCB7 EM3', 'CCB7 EM4'],
		},
		};

		var chart = new ApexCharts(document.querySelector("#chart"), options);
		chart.render();
	</script>
	<!--Graph 01 -->
	<script>
		<?php $Count_02=$Count_02-$Count_not02; ?>
		var Count_02 = <?php echo $Count_02; ?>;
		var Count_not02 = <?php echo $Count_not02; ?>;
		var options1 = {
		series: [Count_02, Count_not02],
		chart: {
			width: '100%',
			type: 'pie',
			},
		labels: ["Correct", "Not Found"],
		colors: ['#01A6BA','#E83845'],
		legend: {
			show: false
		},
		dataLabels: {
			formatter(val, opts) {
			const name = opts.w.globals.labels[opts.seriesIndex]
			return [name, val.toFixed(1) + '%']
			}
		},
		};
		var chart = new ApexCharts(document.querySelector("#chart1"), options1);
		chart.render();
	</script>
	<!--Graph 02 -->
	<script>
		<?php $Count_05=$Count_05-$Count_not05; ?>
		var Count_05 = <?php echo $Count_05; ?>;
		var Count_not05 = <?php echo $Count_not05; ?>;
		var options2 = {
		series: [Count_05, Count_not05],
		chart: {
			width: '100%',
			type: 'pie',
			},
		labels: ["Correct", "Not Found"],
		colors: ['#FFCE30','#E83845'],
		legend: {
			show: false
		},
		dataLabels: {
			formatter(val, opts) {
			const name = opts.w.globals.labels[opts.seriesIndex]
			return [name, val.toFixed(1) + '%']
			}
		},
		};
		var chart = new ApexCharts(document.querySelector("#chart2"), options2);
		chart.render();
	</script>
	<!--Graph 03 -->
	<script>
		<?php $Count_em3=$Count_em3-$Count_notem3; ?>
		var Count_em3 = <?php echo $Count_em3; ?>;
		var Count_notem3 = <?php echo $Count_notem3; ?>;
		var options3 = {
		series: [Count_em3, Count_notem3],
		chart: {
			width: '100%',
			type: 'pie',
			},
		labels: ["Correct", "Not Found"],
		colors: ['#746AB0','#E83845'],
		legend: {
		show: false
		},
		dataLabels: {
		formatter(val, opts) {
			const name = opts.w.globals.labels[opts.seriesIndex]
			return [name, val.toFixed(1) + '%']
		}
		},
		responsive: [{
		breakpoint: 480,
		options: {
			chart: {
			width: 200
			},
		}
		}]
		};
		var chart = new ApexCharts(document.querySelector("#chart3"), options3);
		chart.render();
	</script>
	<!--Graph 04 -->
	<script>
		<?php $Count_em4=$Count_em4-$Count_notem4; ?>
		var Count_em4 = <?php echo $Count_em4; ?>;
		var Count_notem4 = <?php echo $Count_notem4; ?>;
		var options4 = {
		series: [Count_em4, Count_notem4],
		chart: {
			width: '100%',
			type: 'pie',
			},
		labels: ["Correct", "Not Found"],
		colors: ['#E389B9','#E83845'],
		legend: {
		show: false
		},
		dataLabels: {
		formatter(val, opts) {
			const name = opts.w.globals.labels[opts.seriesIndex]
			return [name, val.toFixed(1) + '%']
		}
		},
		responsive: [{
		breakpoint: 480,
		options: {
			chart: {
			width: 200
			},
		}
		}]
		};
		var chart = new ApexCharts(document.querySelector("#chart4"), options4);
		chart.render();
	</script>
</body>