<?php

/**
 * Check if file is valid for further using.
 *
 * @param string $filePath
 * @return bool
 */
function isFileValid($filePath)
{
    return (file_exists($filePath) && is_file($filePath) && is_readable($filePath) && filesize($filePath) > 0);
}

/**
 * Get file extension in ".ext" format.
 *
 * @param string $filePath
 * @return string
 */
function getExt($filePath)
{
    return '.' . pathinfo($filePath, PATHINFO_EXTENSION);
}

/**
 * Check if 2 not broken images are the same or not.
 * Images can be called by path on hard disc or by url (now at least 1 of them should be called by path on hard disc).
 * TODO: specify supported image formats.
 * TODO: investigate if not image files can be compared in the same way.
 * TODO: specify compared values.
 * TODO: get image file size by url to compare online image with another online image.
 *
 * @param string $firstImgPath
 * @param string $secondImgPath
 * @return bool
 * @throws Exception if it is impossible to render image file properties
 */
function imgsAreEqual($firstImgPath, $secondImgPath)
{
    if (!($firstImgProperties = getimagesize($firstImgPath))) {
        throw new Exception(msgInvalidPath($firstImgPath));
    }
    if (!($secondImgProperties = getimagesize($secondImgPath))) {
        throw new Exception(msgInvalidPath($secondImgPath));
    }

    if ($firstImgProperties !== $secondImgProperties) return false;
    foreach ($firstImgProperties as $key => $value) {
        if ($firstImgProperties[$key] !== $secondImgProperties[$key]) return false;
    }
    return true;
}

/**
 * Download file by url.
 * TODO: specify supported file formats.
 * TODO: specify file size limit.
 *
 * @param string $fileUrl
 * @param string $saveFilePath
 */
function downloadFile($fileUrl, $saveFilePath)
{
    $ch = curl_init($fileUrl);
    $fp = fopen($saveFilePath, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}

/**
 * Parse list from txt file.
 * Function returns null if specified file is empty.
 * TODO: investigate possibility not to return mix variables types.
 * TODO: verify behaviour in case of different empty data types (null, '', other empties).
 *
 * @param string $filePath
 * @return array|null
 */
function parseList($filePath)
{
    $_breakDelimiter = "\r\n";

    $content = explode($_breakDelimiter, file_get_contents($filePath));
    if (!$content) return null;

    foreach ($content as $key => $record) {
        if ($record == '') {
            unset($content[$key]);
        }
    }

    return array_values($content);
}

/**
 * Parse csv file & convert pulled data to array of arrays.
 * Function returns empty array if input file is empty.
 *
 * @param string $filePath
 * @return array
 * @throws Exception if input path is invalid
 */
function parseCsvTable($filePath)
{
    if (!isFileValid($filePath)) {
        throw new Exception(msgInvalidPath($filePath));
    }

    $_cellDelimiter = ";";

    $header = null;
    $data = array();
    $handle = fopen($filePath, 'r');
    while ($row = fgetcsv($handle, 1000, $_cellDelimiter)) {
        if (!$header) {
            $header = $row;
        } else {
            $data[] = array_combine($header, $row);
        }
    }
    fclose($handle);

    return $data;
}

/**
 * Check if log record is already present in appropriate log file or not.
 *
 * @param string $logRecord
 * @param string $logFilePath
 * @return bool
 */
function isLogged($logRecord, $logFilePath)
{
    return in_array($logRecord, parseList($logFilePath));
}

/**
 * Add log record to appropriate log file.
 *
 * @param string $logRecord
 * @param string $logFilePath
 */
function addLog($logRecord, $logFilePath)
{
    $_breakDelimiter = "\r\n";

    $file = fopen($logFilePath, 'a');
    fwrite($file, $logRecord . $_breakDelimiter);
    fclose($file);
}
