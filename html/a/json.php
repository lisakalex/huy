<?php

include_once 'lib/class_updateSummary.php';

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
//$data = json_decode($json, true);
//print_r($data);
$data = [
      "Id" => 11,
      "ApplicationId" => 141,
      "ApplicationName" => "CRM",
      "VersionNumber" => "12",
      "MarvalRef" => "INC 12345",
      "GasOrPower" => "Gas",
      "ApplicationSubGroup" => "NA",
      "ReleaseType" => "Project",
      "Description" => "Test Description",
      "TimesRejected" => 0,
      "Created" => "2021-11-26T12:03:27Z",
      "EnvironmentId" => 7,
      "EnvironmentName" => "DPT1",
      "PreferredReleaseDate" => "2021-11-26T00:00:00Z",
      "ReleaseTime" => "Anytime",
      "ExpectedDuration" => "10 minutes",
      "ActualReleaseDate" => "2021-11-26T00:00:00Z",
      "TeamProvidingReleaseId" => 1,
      "TeamProvidingReleaseName" => "Application Support",
      "Status" => "Approval Pending",
      "DRStatus" => "No DR Requirement",
      "Database" => "DB Details",
      "ClientServer" => "Client Server Details",
      "DBServer" => "DB Server Details"
];

$update = new updateSummary($data, true);
