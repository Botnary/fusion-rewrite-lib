<?php
/**
 * Created by IntelliJ IDEA.
 * User: botnari
 * Date: 15-03-30
 * Time: 7:01 PM
 */

namespace Fusion\Rewrite;

class UrlBuilder
{
    private $_lang;
    private $_idc;

    /**
     * @return mixed
     */
    public function getLang()
    {
        return $this->_lang;
    }

    /**
     * @param mixed $lang
     */
    public function setLang($lang)
    {
        $this->_lang = $lang;
    }

    /**
     * @return mixed
     */
    public function getIdc()
    {
        return $this->_idc;
    }

    /**
     * @param mixed $idc
     */
    public function setIdc($idc)
    {
        $this->_idc = $idc;
    }

    function build()
    {
        $url = array('');
        if ($this->getLang()) {
            $url[] = $this->getLang();
        }
        if ($this->getIdc()) {
            $url[] = $this->getIdc();
            $menu = new Menu($this->getIdc(), $this->getLang());
            $url[] = $this->getTpl($menu->getCurrent()->FILE);
            foreach($menu->getParentsTitle() as $title){
                $url[] = $this->toAscii($title);
            }
        }
        return implode("/", $url);
    }

    function toAscii($str, $replace = array(), $delimiter = '-')
    {
        if (!empty($replace)) {
            $str = str_replace((array)$replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }

    function getTpl($file)
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        return trim(str_replace('.' . $ext, '', $file));
    }
}