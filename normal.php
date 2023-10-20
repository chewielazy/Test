<?php
    $searchQuery = "";
    $begin_date_show = "";
    $end_date_show = "";
    $room = "1";
    $notfound = "9";
    $dept = "";
    if (isset($_POST['find'])) {
        $begin_date_show= $_POST["begin_date"];
        $timestamp = strtotime($begin_date_show); // แปลงวันที่ให้เป็น timestamp
        $begin_date = date("Y-m-d", $timestamp); // แปลง timestamp ใหม่เป็นรูปแบบ "yyyy-mm-dd"

        $end_date_show = $_POST["end_date"];
        $timestamp = strtotime($end_date_show); // แปลงวันที่ให้เป็น timestamp
        $new_timestamp = strtotime("+1 day", $timestamp); // เพิ่มวันลงทีละ 1 วัน
        $end_date = date("Y-m-d", $new_timestamp); // แปลง timestamp ใหม่เป็นรูปแบบ "yyyy-mm-dd"

        $room = $_POST["room"];
        $notfound = $_POST["Remark"];
        $dept = $_POST["dept"];

    }
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Check-normal</title>

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

    <script src="./theme/src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
	<script src="./theme/vendors/scripts/knob-chart-setting.js"></script>

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
                        <h2 class="text h2">Check Logbook -normal</h2>
                    </div>
                </div>
                <form>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label"><br>Date In</label>
                        <div class="col-sm-12 col-md-10">
                            <br><input class="form-control date-picker" type="text"name="begin_date" id="begin_date" placeholder="Date In" value="<?php echo $begin_date_show; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Date Out</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control date-picker" type="text"name="end_date" id="end_date" placeholder="Date Out" value="<?php echo $end_date_show; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Select Room</label>
                        <div class="col-sm-12 col-md-10" id="dropdown" name="dropdown">
                            <select class="selectpicker form-control" id="room" name="room">
                                <option value="1"<?=($room=='1')?" selected":""?> >ALL</option>  
                                <option value="(CCB2) DATA ROOM" <?=($room=='(CCB2) DATA ROOM')?" selected":""?> >(CCB2) DATA ROOM</option>
                                <option value="(CCB5) DATA ROOM" <?=($room=='(CCB5) DATA ROOM')?" selected":""?> >(CCB5) DATA ROOM</option>
                                <option value="(CCB7) DATA ROOM EM3" <?=($room=='(CCB7) DATA ROOM EM3')?" selected":""?> >(CCB7) DATA ROOM EM3</option>
                                <option value="(CCB7) DATA ROOM EM4" <?=($room=='(CCB7) DATA ROOM EM4')?" selected":""?> >(CCB7) DATA ROOM EM4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Search Dept</label>
                        <div class="col-sm-12 col-md-10" id="dropdown" name="dropdown">
                            <select class="selectpicker form-control" id="dept" name="dept">
                                <option value="00" <?=($dept=='00')?" selected":""?> >ALL</option>  
                                <option value="02" <?=($dept=='02')?" selected":""?> >02 สนับสนุนด้านเทคนิคระบบคลาวด์</option>
                                <option value="41" <?=($dept=='41')?" selected":""?> >41 วิศวกรรมเก็บเงินค่าผ่านทาง</option>  
                                <option value="43" <?=($dept=='43')?" selected":""?> >43 วิศวกรรมสิ่งอำนวยความสะดวก</option>
                                <option value="46" <?=($dept=='46')?" selected":""?> >46 วิศวกรรมระบบจราจรอัจฉริยะ</option>  
                                <option value="47" <?=($dept=='47')?" selected":""?> >47 วิศวกรรมคอมพิวเตอร์</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Search Notfound</label>
                        <div class="col-sm-12 col-md-10" id="dropdown" name="dropdown">
                            <select class="selectpicker form-control" id="Remark" name="Remark">
                                <option value="9" <?=($notfound=='9')?" selected":""?> >ALL</option>  
                                <option value="5" <?=($notfound=='5')?" selected":""?> >Not Found Log Book</option>
                            </select>
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

        <!-- <div class="col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-box height-70-p">
                <div id="chart10"></div>
            </div>
        </div> -->
        

      <div class="pd-ltr-25">
        <div class="card-box mb-30">
            <div class="pb-20">
                <div class="table-responsive text-nowrap">	
                    <table id="dtBasicExample" class="table hover multiple-select-row nowrap">
                        <thead>
                            <tr class="table-plus">
                                <th>Num</th>
                                <th>Room</th>
                                <th>Datetime</th>
                                <th>StaffId</th>
                                <th>Name_Surname</th>
                                <th>Dept</th>                               
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
                            $CountNot=0; $CountAll=0;
                            $Count_02=0; $Count_05=0; $Count_em3=0; $Count_em4=0; $Count_not02=0; $Count_not05=0; $Count_notem3=0; $Count_notem4=0;
                            $ccb2_02=0; $ccb2_41=0; $ccb2_43=0; $ccb2_46=0;$ccb2_47=0; //ccb2_not02=0; $ccb2_not41=0; $ccb2_not43=0; $ccb2_not46=0; $ccb2_not47=0;
                            $ccb5_02=0; $ccb5_41=0; $ccb5_43=0; $ccb5_46=0;$ccb5_47=0; //ccb5_not02=0; $ccb5_not41=0; $ccb5_not43=0; $ccb5_not46=0; $ccb5_not47=0;
                            $em3_02=0; $em3_41=0; $em3_43=0; $em3_46=0;$em3_47=0; //em3_not02=0; $em3_not41=0; $em3_not43=0; $em3_not46=0; $em3_not47=0;
                            $em4_02=0; $em4_41=0; $em4_43=0; $em4_46=0;$em4_47=0; //em4_not02=0; $em4_not41=0; $em4_not43=0; $em4_not46=0; $em4_not47=0;
                            // สร้างการเชื่อมต่อ
                            $conn = new mysqli($host, $username, $password, $database,$port);
                            $countByDate = array();
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                //เลือกทุกห้อง ทุกแผนกและเลือก not found 
                                if ($dept == "00" && $room == "1" && $notfound == "5") {
                                $sql = "SELECT DISTINCT	a.num,a.device as ROOM,a.nReaderIdn,a.accessdate,b.date_in,b.date_out,CAST(a.nUserID AS CHAR) as StaffId,c.sUserName_th AS Name_Surname_th,substr(c.sUserName,1,2) dept,CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) AS Remark FROM access_control.new_biostar_log a LEFT JOIN access_control.event_access_log b ON (a.nUserID = b.user_id AND ((a.device = '(CCB2) DATA ROOM OUT(172.16.99.17)' AND b.room = '540094318') OR (a.device = '(CCB5) DATA ROOM OUT (172.16.98.12)' AND b.room = '540093394') OR (a.device = '(CCB7) DATA ROOM EM3 OUT (172.16.97.21)' AND b.room = '540094146') OR (a.device = '(CCB7) DATA ROOM EM4 OUT(172.16.97.14)' AND b.room = '540094144')) AND (STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') + INTERVAL 20 MINUTE AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') < STR_TO_DATE(b.date_out, '%Y-%m-%d %H:%i:%s'))) LEFT JOIN access_control.BIOSTAR_TB_USER c ON (a.nUserID = c.sUserID) where STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') >= '$begin_date' AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') <= '$end_date' AND CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) like '%Not Found%' ";}                                
                                // เลือกทุกห้อง เลือกแผนกและเลือก not found
                                else if ($room == "1" && $notfound == "5") {
                                $sql = "SELECT DISTINCT	a.num,a.device as ROOM,a.nReaderIdn,a.accessdate,b.date_in,b.date_out,CAST(a.nUserID AS CHAR) as StaffId,c.sUserName_th AS Name_Surname_th,substr(c.sUserName,1,2) dept,CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) AS Remark FROM access_control.new_biostar_log a LEFT JOIN access_control.event_access_log b ON (a.nUserID = b.user_id AND ((a.device = '(CCB2) DATA ROOM OUT(172.16.99.17)' AND b.room = '540094318') OR (a.device = '(CCB5) DATA ROOM OUT (172.16.98.12)' AND b.room = '540093394') OR (a.device = '(CCB7) DATA ROOM EM3 OUT (172.16.97.21)' AND b.room = '540094146') OR (a.device = '(CCB7) DATA ROOM EM4 OUT(172.16.97.14)' AND b.room = '540094144')) AND (STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') + INTERVAL 20 MINUTE AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') < STR_TO_DATE(b.date_out, '%Y-%m-%d %H:%i:%s'))) LEFT JOIN access_control.BIOSTAR_TB_USER c ON (a.nUserID = c.sUserID) where c.sUserName LIKE '$dept%' AND CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) like '%Not Found%' and STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') >= '$begin_date' AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') <= '$end_date' ";}                                
                                //เลือกทุกห้อง ทุกแผนก
                                else if ($dept == "00" && $room == "1") {
                                $sql = "SELECT DISTINCT	a.num,a.device as ROOM,a.nReaderIdn,a.accessdate,b.date_in,b.date_out,CAST(a.nUserID AS CHAR) as StaffId,c.sUserName_th AS Name_Surname_th,substr(c.sUserName,1,2) dept,CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) AS Remark FROM access_control.new_biostar_log a LEFT JOIN access_control.event_access_log b ON (a.nUserID = b.user_id AND ((a.device = '(CCB2) DATA ROOM OUT(172.16.99.17)' AND b.room = '540094318') OR (a.device = '(CCB5) DATA ROOM OUT (172.16.98.12)' AND b.room = '540093394') OR (a.device = '(CCB7) DATA ROOM EM3 OUT (172.16.97.21)' AND b.room = '540094146') OR (a.device = '(CCB7) DATA ROOM EM4 OUT(172.16.97.14)' AND b.room = '540094144')) AND (STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') + INTERVAL 20 MINUTE AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') < STR_TO_DATE(b.date_out, '%Y-%m-%d %H:%i:%s'))) LEFT JOIN access_control.BIOSTAR_TB_USER c ON (a.nUserID = c.sUserID) where STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') >= '$begin_date' AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') <= '$end_date' ";}                                
                                //เลือกห้องเอง ทุกแผนกและเลือก not found
                                else if ($dept == "00" && $notfound == "5") { 
                                $sql = "SELECT DISTINCT	a.num,a.device as ROOM,a.nReaderIdn,a.accessdate,b.date_in,b.date_out,CAST(a.nUserID AS CHAR) as StaffId,c.sUserName_th AS Name_Surname_th,substr(c.sUserName,1,2) dept,CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) AS Remark FROM access_control.new_biostar_log a LEFT JOIN access_control.event_access_log b ON (a.nUserID = b.user_id AND ((a.device = '(CCB2) DATA ROOM OUT(172.16.99.17)' AND b.room = '540094318') OR (a.device = '(CCB5) DATA ROOM OUT (172.16.98.12)' AND b.room = '540093394') OR (a.device = '(CCB7) DATA ROOM EM3 OUT (172.16.97.21)' AND b.room = '540094146') OR (a.device = '(CCB7) DATA ROOM EM4 OUT(172.16.97.14)' AND b.room = '540094144')) AND (STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') + INTERVAL 20 MINUTE AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') < STR_TO_DATE(b.date_out, '%Y-%m-%d %H:%i:%s'))) LEFT JOIN access_control.BIOSTAR_TB_USER c ON (a.nUserID = c.sUserID) where a.device Like '%$room%' and STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') >= '$begin_date' AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') <= '$end_date' AND CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) like '%Not Found%' ";}                                
                                //เลือกทุกห้อง เลือกแผนก
                                else if ($room == "1") {
                                $sql = "SELECT DISTINCT	a.num,a.device as ROOM,a.nReaderIdn,a.accessdate,b.date_in,b.date_out,CAST(a.nUserID AS CHAR) as StaffId,c.sUserName_th AS Name_Surname_th,substr(c.sUserName,1,2) dept,CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) AS Remark FROM access_control.new_biostar_log a LEFT JOIN access_control.event_access_log b ON (a.nUserID = b.user_id AND ((a.device = '(CCB2) DATA ROOM OUT(172.16.99.17)' AND b.room = '540094318') OR (a.device = '(CCB5) DATA ROOM OUT (172.16.98.12)' AND b.room = '540093394') OR (a.device = '(CCB7) DATA ROOM EM3 OUT (172.16.97.21)' AND b.room = '540094146') OR (a.device = '(CCB7) DATA ROOM EM4 OUT(172.16.97.14)' AND b.room = '540094144')) AND (STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') + INTERVAL 20 MINUTE AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') < STR_TO_DATE(b.date_out, '%Y-%m-%d %H:%i:%s'))) LEFT JOIN access_control.BIOSTAR_TB_USER c ON (a.nUserID = c.sUserID) where c.sUserName LIKE '$dept%' and STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') >= '$begin_date' AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') <= '$end_date' ";}                                 
                                //เลือกห้องเอง เลือกแผนกและเลือก not
                                else if ($notfound == "5") {
                                $sql = "SELECT DISTINCT	a.num,a.device as ROOM,a.nReaderIdn,a.accessdate,b.date_in,b.date_out,CAST(a.nUserID AS CHAR) as StaffId,c.sUserName_th AS Name_Surname_th,substr(c.sUserName,1,2) dept,CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) AS Remark FROM access_control.new_biostar_log a LEFT JOIN access_control.event_access_log b ON (a.nUserID = b.user_id AND ((a.device = '(CCB2) DATA ROOM OUT(172.16.99.17)' AND b.room = '540094318') OR (a.device = '(CCB5) DATA ROOM OUT (172.16.98.12)' AND b.room = '540093394') OR (a.device = '(CCB7) DATA ROOM EM3 OUT (172.16.97.21)' AND b.room = '540094146') OR (a.device = '(CCB7) DATA ROOM EM4 OUT(172.16.97.14)' AND b.room = '540094144')) AND (STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') + INTERVAL 20 MINUTE AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') < STR_TO_DATE(b.date_out, '%Y-%m-%d %H:%i:%s'))) LEFT JOIN access_control.BIOSTAR_TB_USER c ON (a.nUserID = c.sUserID) where c.sUserName LIKE '$dept%' AND CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) like '%Not Found%' and a.device Like '%$room%' and STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') >= '$begin_date' AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') <= '$end_date' ";}                                
                                //เลือกห้องเอง ทุกแผนก
                                else if ($dept == "00"){
                                $sql = "SELECT DISTINCT	a.num,a.device as ROOM,a.nReaderIdn,a.accessdate,b.date_in,b.date_out,CAST(a.nUserID AS CHAR) as StaffId,c.sUserName_th AS Name_Surname_th,substr(c.sUserName,1,2) dept, CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) AS Remark FROM access_control.new_biostar_log a LEFT JOIN access_control.event_access_log b ON (a.nUserID = b.user_id AND ((a.device = '(CCB2) DATA ROOM OUT(172.16.99.17)' AND b.room = '540094318') OR (a.device = '(CCB5) DATA ROOM OUT (172.16.98.12)' AND b.room = '540093394') OR (a.device = '(CCB7) DATA ROOM EM3 OUT (172.16.97.21)' AND b.room = '540094146') OR (a.device = '(CCB7) DATA ROOM EM4 OUT(172.16.97.14)' AND b.room = '540094144')) AND (STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') + INTERVAL 20 MINUTE AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') < STR_TO_DATE(b.date_out, '%Y-%m-%d %H:%i:%s'))) LEFT JOIN access_control.BIOSTAR_TB_USER c ON (a.nUserID = c.sUserID) where a.device Like '%$room%' and STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') >= '$begin_date' AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') <= '$end_date' ";}                             
                                //เลือกห้องเอง เลือกแผนก
                                else {
                                $sql = "SELECT DISTINCT	a.num,a.device as ROOM,a.nReaderIdn,a.accessdate,b.date_in,b.date_out,CAST(a.nUserID AS CHAR) as StaffId,c.sUserName_th AS Name_Surname_th,substr(c.sUserName,1,2) dept,CONVERT(COALESCE(b.reason, 'Not Found Log Book') USING utf8) AS Remark FROM access_control.new_biostar_log a LEFT JOIN access_control.event_access_log b ON (a.nUserID = b.user_id AND ((a.device = '(CCB2) DATA ROOM OUT(172.16.99.17)' AND b.room = '540094318') OR (a.device = '(CCB5) DATA ROOM OUT (172.16.98.12)' AND b.room = '540093394') OR (a.device = '(CCB7) DATA ROOM EM3 OUT (172.16.97.21)' AND b.room = '540094146') OR (a.device = '(CCB7) DATA ROOM EM4 OUT(172.16.97.14)' AND b.room = '540094144')) AND (STR_TO_DATE(b.date_in, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') + INTERVAL 20 MINUTE AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') < STR_TO_DATE(b.date_out, '%Y-%m-%d %H:%i:%s'))) LEFT JOIN access_control.BIOSTAR_TB_USER c ON (a.nUserID = c.sUserID) where c.sUserName LIKE '$dept%' and a.device Like '%$room%' and STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') >= '$begin_date' AND STR_TO_DATE(a.accessdate, '%d/%m/%Y %H:%i:%s') <= '$end_date' ";}                              

                                // สำหรับ mysqli ภาษาไทย
                                mysqli_set_charset($conn, "utf8");
                                
                                $result = mysqli_query($conn, $sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $room = $row["ROOM"];
                                        if ($room == "(CCB2) DATA ROOM OUT(172.16.99.17)") {
                                            $room = "(CCB2) DATA ROOM";
                                            $Count_02++;
                                            if ($row['Remark'] === 'Not Found Log Book') {$Count_not02++;}
                                            if ($row['dept'] === '02') {$ccb2_02++;}
                                            if ($row['dept'] === '41') {$ccb2_41++;}
                                            if ($row['dept'] === '43') {$ccb2_43++;}
                                            if ($row['dept'] === '46') {$ccb2_46++;}
                                            if ($row['dept'] === '47') {$ccb2_47++;}
                                        } elseif ($room == "(CCB5) DATA ROOM OUT (172.16.98.12)") {
                                            $room = "(CCB5) DATA ROOM";
                                            $Count_05++; 
                                            if ($row['Remark'] === 'Not Found Log Book') {$Count_not05++;}
                                            if ($row['dept'] === '02') {$ccb5_02++;}
                                            if ($row['dept'] === '41') {$ccb5_41++;}
                                            if ($row['dept'] === '43') {$ccb5_43++;}
                                            if ($row['dept'] === '46') {$ccb5_46++;}
                                            if ($row['dept'] === '47') {$ccb5_47++;}
                                        } elseif ($room == "(CCB7) DATA ROOM EM3 OUT (172.16.97.21)") {
                                            $room = "(CCB7) DATA ROOM EM3";
                                            $Count_em3++; 
                                            if ($row['Remark'] === 'Not Found Log Book') {$Count_notem3++;}
                                            if ($row['dept'] === '02') {$em3_02++;}
                                            if ($row['dept'] === '41') {$em3_41++;}
                                            if ($row['dept'] === '43') {$em3_43++;}
                                            if ($row['dept'] === '46') {$em3_46++;}
                                            if ($row['dept'] === '47') {$em3_47++;} 
                                        } elseif ($room == "(CCB7) DATA ROOM EM4 OUT(172.16.97.14)") {
                                            $room = "(CCB7) DATA ROOM EM4";
                                            $Count_em4++; 
                                            if ($row['Remark'] === 'Not Found Log Book') {$Count_notem4++;} 
                                            if ($row['dept'] === '02') {$em4_02++;}
                                            if ($row['dept'] === '41') {$em4_41++;}
                                            if ($row['dept'] === '43') {$em4_43++;}
                                            if ($row['dept'] === '46') {$em4_46++;}
                                            if ($row['dept'] === '47') {$em4_47++;} 
                                        }
                                        $date_in = $row['date_in'];
                                        $date_out = $row['date_out'];
                                        $timestamp_in = strtotime($date_in);
                                        $timestamp_out = strtotime($date_out);
                                        $time_difference = abs($timestamp_out - $timestamp_in);
                                        if ($row['Remark'] === 'Not Found Log Book') {
                                            $tr0='table-danger table-plus';
                                            $CountNot++;} 
                                        else if ($time_difference > 12 * 3600){$tr0='table-warning';} 
                                        else {$tr0='';}                                      
                                        $CountAll++;
                                        echo "<tr class=$tr0><td>{$row['num']}</td>";
                                        echo "<td>{$room}</td>";
                                        echo "<td>{$row['accessdate']}</td>";
                                        echo "<td>{$row['StaffId']}</td>";
                                        echo "<td>{$row['Name_Surname_th']}</td>";
                                        echo "<td>{$row['dept']}</td>";
                                        echo "<td>{$row['Remark']}</td></tr>";
                                    }
                                }
  
                            }$conn->close();?>
                                <!-- Print csv -->
                                <script>
                                    $(function() {
                                    // Export to CSV
                                    $("#exportCSV").click(function() {
                                        const headers = ["Num", "Room",  "Date", "UserID", "user_name","dept","Remark"];
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
                                        link.setAttribute("download", "Access_Room.csv");
                                        document.body.appendChild(link);
                                        link.click();});
                                    });
                                </script>
                        </tbody>
                        <div class="row clearfix pt-20 ">
                            <dt class="col-sm-2 text-right">เข้าห้องทั้งหมด :</dt>
                            <dd class="col-sm-1 text-left"><?php echo $CountAll; ?> ครั้ง</dd>
                            <dt class="col-sm-2 text-right">ไม่ได้ลง Logbook :</dt>
                            <dd class="col-sm-1 text-left"><?php echo $CountNot; ?> ครั้ง</dd>
                            <dd class="col-sm-6 text-left"></dd>
                        </div>
                    </table>
                </div>
            </div>
        </div>
        <div class="contact-dire-info text-right view-contact">
            <button id="exportCSV" name="exportCSV" class="btn btn-success" style="font-size: 18px;">Export to CSV  <i class="icon-copy fa fa-download" aria-hidden="true"></i></button><br><br><br>
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