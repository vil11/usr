<?php

$_isoEncoding = 'ISO-8859-1';


/**
 * Check if file has allowed extension.
 *
 * @param string $fileName
 * @param string $configFilePath
 * @return bool
 */
function hasAllowedExtension($fileName, $configFilePath)
{
    $ext = getExt($fileName);
    $allowedExtList = parseList($configFilePath);

    return (in_array($ext, $allowedExtList));
}

/**
 * Adjust string so it can be used as title inside Windows OS.
 * TODO: remove restricted characters list to config.
 *
 * @param string $title
 * @return string
 */
function windowsTitleAdjust($title)
{
    $restricted = array(
        '/',
        '|',
        '\\',
        '+',
        'é',
        '?',
        '"',
        ':',
        '  ',
        '  ',
        '  '
    );
    foreach ($restricted as $value) {
        $title = clearStringFrom($title, $value);
    }

    return trim($title);
}

/**
 * Clear string from specified substring via replacing it by empty gap.
 * Function can be useful for clearing files/directories titles from unsupported and/or restricted characters.
 *
 * @param string $string
 * @param string $substring
 * @return string
 */
function clearStringFrom($string, $substring)
{
    return (strstr($string, $substring)) ? str_replace($substring, ' ', $string) : $string;
}

/**
 * Check if string contains no upper case characters.
 *
 * @param string $string
 * @return bool
 */
function containsNoUpperCase($string)
{
    return strtolower($string) == $string;
}

/**
 * Replace backslash with slash in specified path.
 *
 * @param string $path
 * @return string
 */
function fixDirSeparators($path)
{
    return str_replace("\\", "/", $path);
}

/**
 * Fix encoding while reading.
 * TODO: specify type of reading.
 * TODO: remove encodings names to config.
 * Is relevant for Cyrillic & Latin characters.
 *
 * @param string $string
 * @return string
 */
function fixEncodingWhileReading($string)
{
    $_winEncoding = 'Windows-1251';
    $_utfEncoding = 'UTF-8';

    return changeEncoding($string, $_winEncoding, $_utfEncoding);
}

/**
 * Fix encoding while writing.
 * TODO: specify type of writing.
 * TODO: remove encodings names to config.
 * Is relevant for Cyrillic & Latin characters.
 *
 * @param string $string
 * @return string
 */
function fixEncodingWhileWriting($string)
{
    $_utfEncoding = 'UTF-8';
    $_winEncoding = 'Windows-1251';

    return changeEncoding($string, $_utfEncoding, $_winEncoding);
}

/**
 * Change string encoding.
 * TODO: investigate "$currentEncoding == $_utfEncoding" case.
 * TODO: remove encodings names to config.
 * 'UTF-8'
 * 'Windows-1251'
 * 'ISO-8859-1'
 * 'ISO-8859-2'
 * 'KOI8-U'
 * 'KOI8-R'
 *
 * @param string $string
 * @param string $inputEncoding
 * @param string $outputEncoding
 * @return string
 */
function changeEncoding($string, $inputEncoding, $outputEncoding)
{
    $_utfEncoding = 'UTF-8';

    $currentEncoding = iconv_get_encoding('input_encoding');
    if ($currentEncoding != $_utfEncoding) {
        $string = iconv($inputEncoding, $outputEncoding, $string);
    }

    return $string;
}

/**
 * Wrap object name into brackets for further message output.
 *
 * @param string $string
 * @return string
 */
function msgWrap($string)
{
    return '[' . $string . ']';
}

/**
 * Compile message about invalid path using.
 *
 * @param string $path
 * @return string
 */
function msgInvalidPath($path)
{
    return 'Path to ' . msgWrap($path) . ' is invalid.';
}

/**
 * Compile message about unsuccessful object (file or directory) creating.
 *
 * @param string $path
 * @return string
 */
function msgFailureCreate($path)
{
    return 'Object ' . msgWrap($path) . ' is not created.';
}

/**
 * Compile message about incomplete downloads.
 *
 * @param string $path
 * @return string
 */
function msgIncompleteDownloads($path)
{
    return 'Not all files are downloaded to ' . msgWrap($path) . '.';
}
