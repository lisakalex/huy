<?php
//
//include_once 'dashboard/config.php';
//$dsn = sprintf("mysql:host=%s;dbname=%s;port=%s;charset=%s",
//    DB_HOSTNAME, DB_DATABASE, DB_PORT, DB_CHARSET);
//try {
//    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
//
//} catch (PDOException $e) {
//    echo "Database connection failed. ";
//    print_r($e);
//    exit;
//}
//
//$environmentId = 21;
//$compName = 'zge-mktred-das4:dpAMR'; // Escape wildcards if necessary
//$appVersion = '1.0.1';
//$appId = 56;
//$startDate = '2024-09-01';  // Replace with actual start date
//$endDate = '2024-09-24';    // Replace with actual end date
//
//$sql = 'SELECT DISTINCT AppName,CompName,AppVersion,EnvName,Type,DeployDate FROM tbl_Component,tbl_AppDeployment,tbl_Environment,tbl_CompDeployment,tbl_Application WHERE tbl_Environment.ID = tbl_AppDeployment.EnvID and tbl_Component.ID = tbl_CompDeployment.CompID and tbl_AppDeployment.ID = tbl_CompDeployment.AppDeploymentID and tbl_AppDeployment.AppID = tbl_Application.ID AND tbl_Environment.ID = ? AND CompName like ? AND AppVersion like ? AND AppID= ? AND DeployDate > ? AND DeployDate < ? ORDER BY DeployDate DESC, CompName';
//
//$stmt = dbc->prepare($sql);
//// Bind the parameters with appropriate type
//$stmt->bindParam(1, $environmentId, PDO::PARAM_INT);
//$stmt->bindParam(2, "%".$compName."%", PDO::PARAM_STR);  // Escape wildcards with % if necessary
//$stmt->bindParam(3, "%".$appVersion."%", PDO::PARAM_STR);  // Escape wildcards with %
//$stmt->bindParam(4, $appId, PDO::PARAM_INT);
//$stmt->bindParam(5, $startDate, PDO::PARAM_STR);
//$stmt->bindParam(6, $endDate, PDO::PARAM_STR);
////$stmt = $pdo->query("select * from tbl_AppDeployment;");
//$stmt->execute();
//
//// Fetch the results
//$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//$ra = [];
//foreach ($result as $row) {
//    print_r($row);
//    $ra[] = $row;
//}
////try {
////    $dsn = 'mysql:host=localhost;dbname=dashboard';
////    $user = 'jenkins';
////    $password = 'Zaichik1.&';
////
////    $pdo = new PDO($dsn, $user, $password);
////    echo "Connected to the database successfully!";
////} catch (PDOException $e) {
////    echo 'Connection failed: ' . $e->getMessage();
////}
//
//$huy = null;
