<?php
/**
 * Created by IntelliJ IDEA.
 * User: botnari
 * Date: 15-03-30
 * Time: 7:49 PM
 */
namespace Fusion\Rewrite;

function link($tpl = null, $lang = null, $idc = null, $id = null, $categoryTitle = null, $pageTitle = null)
{
    $url = new UrlBuilder();
    $url->setTpl($tpl);
    $url->setLang($lang);
    $url->setIdc($idc);
    $url->setIdc($id);
    $url->setCategoryTitle($categoryTitle);
    $url->setPageTitle($pageTitle);
    return $url->build();
}