<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

$executionStartTime = microtime(true);

include("config.php");

header('Content-Type: application/json; charset=UTF-8');

$conn = new mysqli($cd_host, $cd_user, $cd_password, $cd_dbname, $cd_port, $cd_socket);

if (mysqli_connect_errno()) {
    $output['status']['code'] = "300";
    $output['status']['name'] = "failure";
    $output['status']['description'] = "database unavailable";
    $output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";
    $output['data'] = [];
    mysqli_close($conn);
    echo json_encode($output);
    exit;
}

// Check if there are related records in the personnel table
$checkPersonnelQuery = $conn->prepare('SELECT COUNT(*) FROM personnel WHERE departmentID = ?');
$checkPersonnelQuery->bind_param("i", $_REQUEST['id']);
$checkPersonnelQuery->execute();
$checkPersonnelQuery->bind_result($personnelCount);
$checkPersonnelQuery->fetch();
$checkPersonnelQuery->close();

if ($personnelCount > 0) {
    // If there are related records, do not delete the department
    $output['status']['code'] = "500";
    $output['status']['name'] = "error";
    $output['status']['description'] = "Cannot delete department with related personnel records. Delete related personnel first.";
    $output['data'] = [];
    mysqli_close($conn);
    echo json_encode($output);
    exit;
}

// If no related personnel records, proceed with department deletion
$query = $conn->prepare('DELETE FROM department WHERE id = ?');
$query->bind_param("i", $_REQUEST['id']);
$query->execute();

if (false === $query) {
    $output['status']['code'] = "400";
    $output['status']['name'] = "executed";
    $output['status']['description'] = "query failed";
    $output['data'] = [];
    mysqli_close($conn);
    echo json_encode($output);
    exit;
}

$output['status']['code'] = "200";
$output['status']['name'] = "ok";
$output['status']['description'] = "success";
$output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";
$output['data'] = [];

mysqli_close($conn);

echo json_encode($output);

?>
