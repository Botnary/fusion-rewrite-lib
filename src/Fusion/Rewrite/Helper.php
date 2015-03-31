<?php
/**
 * Created by IntelliJ IDEA.
 * User: botnari
 * Date: 15-03-30
 * Time: 7:49 PM
 */
namespace Fusion\Rewrite;

class Helper
{
    static function link($lang = null, $idc = null)
    {
        $url = new UrlBuilder();
        $url->setLang($lang);
        $url->setIdc($idc);
        return $url->build();
    }
}