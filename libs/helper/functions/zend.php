<?php

/**
 * Get page dom by its url.
 * The dom is built by Zend lib.
 *
 * @param string $pageUrl
 * @return Zend_Dom_Query
 */
function getPageDom($pageUrl)
{
    $pageHtml = file_get_contents($pageUrl);
    $pageDom = new Zend_Dom_Query($pageHtml);

    return $pageDom;
}

/**
 * Validate if current page exists & can be rendered or not.
 *
 * @param string $pageUrl
 * @param string $listXpath
 * @return bool
 */
function isPageValidForRendering($pageUrl, $listXpath)
{
    if (!urlExists($pageUrl)) return false;

    $pageDom = getPageDom($pageUrl);
    $content = $pageDom->queryXpath($listXpath);
    if ($content->count() === 0) return false;

    return true;
}
