<?php

require_once('bootstrap.php');


// 1. RENDER CSV & DISPLAY LEGION TABLE

//$legionList = parseCsvTable(PROJECT_PATH . DS . 'legion.csv');
//foreach ($legionList as $unitData) {
//    $unit = new model_unit($unitData);
//
//    var_dump($unit);
//}

// 2. VERIFY REGS

// launch testing
echo 'testing legion: starts... ';
$commandChangeDir = 'cd ' . PROJECT_PATH . '/qa/';
$logFilePath = PROJECT_PATH . '/qa/logs.txt';
$commandStartTesting = 'phpunit --configuration C:/xampp/htdocs/legion/qa/phpunit.xml --log-tap ' . $logFilePath;
exec($commandChangeDir);
exec($commandStartTesting);

// get report
$logFileContent = file_get_contents($logFilePath);
if (!$logFileContent) exit('testing results report reading failed!');

// find fails in report
preg_match_all('|(message:).+|', $logFileContent, $fails);
$fails = $fails[0];

// if there are any fails: put them into result txt report file & copy it to desktop
if ($fails) {
    $resultContent = '';
    foreach ($fails as $fail) {
        $resultContent .= substr($fail, 9);
    }

    $destinationReportPath = model_singleton_config::getInstance()->get('paths/qa_result_destination');
    $destinationTickPath = model_singleton_config::getInstance()->get('paths/qa_tick_destination');
    $resultFilePath = PROJECT_PATH . model_singleton_config::getInstance()->get('paths/qa_result');

    if (!file_put_contents($resultFilePath, $resultContent)) exit('writing results to report file failed!');
    if (!copy($resultFilePath, $destinationReportPath)) exit('copying report to desktop failed');

    if (!copy(PROJECT_PATH . '/qa/reports/tick_failed.png', $destinationTickPath)) {
        exit('copying tick_failed to desktop failed!');
    }
} else {
    if (!copy(PROJECT_PATH . '/qa/reports/tick_passed.png', $destinationTickPath)) {
        exit('copying tick_passed to desktop failed!');
    }
}

// finish
echo 'done';


