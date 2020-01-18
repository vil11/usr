<?php

/**
 * Get list of all files & directories inside specified directory.
 * Function returns empty array if specified directory is empty.
 *
 * @param string $dirPath
 * @return array
 */
function getDirContentList($dirPath)
{
    $dirs = getDirDirsList($dirPath);
    $files = getDirFilesList($dirPath);

    return array_merge($dirs, $files);
}

/**
 * Get list of all files inside specified directory.
 * Function returns empty array if specified directory contains no files.
 *
 * @param string $dirPath
 * @return array
 * @throws Exception if input path in invalid
 */
function getDirFilesList($dirPath)
{
    if (!is_dir($dirPath)) {
        throw new Exception(msgInvalidPath($dirPath));
    }

    $files = array();
    $dirContent = scandir($dirPath);
    foreach ($dirContent as $contentElement) {
        if ($contentElement != '.' && $contentElement != '..') {
            if (is_file($dirPath . DS . $contentElement)) {
                $files[] = $contentElement;
            }
        }
    }

    return $files;
}

/**
 * Get list of all directories inside specified directory.
 * Function returns empty array if specified directory contains no directories.
 *
 * @param string $dirPath
 * @return array
 * @throws Exception if input path in invalid
 */
function getDirDirsList($dirPath)
{
    if (!is_dir($dirPath)) {
        throw new Exception(msgInvalidPath($dirPath));
    }

    $dirs = array();
    $dirContent = scandir($dirPath);
    foreach ($dirContent as $contentElement) {
        if ($contentElement != '.' && $contentElement != '..') {
            if (is_dir($dirPath . DS . $contentElement)) {
                $dirs[] = $contentElement;
            }
        }
    }

    return $dirs;
}

/**
 * Get files qty inside specified directory.
 *
 * @param string $dirPath
 * @return int
 */
function getDirFilesQty($dirPath)
{
    return count(getDirFilesList($dirPath));
}

/**
 * Get directories qty inside specified directory.
 *
 * @param string $dirPath
 * @return int
 */
function getDirDirsQty($dirPath)
{
    return count(getDirDirsList($dirPath));
}

/**
 * Get list of all files (of specified extension) inside specified directory.
 * Function returns empty array if specified directory contains no files of specified extension.
 *
 * @param string $dirPath
 * @param string $ext
 * @return array
 */
function getDirFilesListByExt($dirPath, $ext)
{
    $files = array();
    foreach (getDirFilesList($dirPath) as $fileName) {
        $fileExt = getExt($dirPath . DS . $fileName);
        if ($fileExt === $ext) {
            $files[] = $fileName;
        }
    }

    return $files;
}

/**
 * Create directory on hard disc by specified path.
 *
 * @param string $dirPath
 * @throws Exception if directory is not created
 */
function createDir($dirPath)
{
    if (!is_dir($dirPath)) {
        if (!mkdir($dirPath, 0777)) {
            throw new Exception(msgFailureCreate($dirPath));
        }
    }
}
