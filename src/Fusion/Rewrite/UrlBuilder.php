<?php
/**
 * Created by IntelliJ IDEA.
 * User: botnari
 * Date: 15-03-30
 * Time: 7:01 PM
 */

namespace Fusion\Rewrite;


use SeoUrl\Service\Slug;

class UrlBuilder
{
    private $_tpl;
    private $_lang;
    private $_idc;
    private $_id;
    private $_categoryTitle;
    private $_pageTitle;

    /**
     * @return mixed
     */
    public function getTpl()
    {
        return $this->_tpl;
    }

    /**
     * @param mixed $tpl
     */
    public function setTpl($tpl)
    {
        $this->_tpl = $tpl;
    }

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getCategoryTitle()
    {
        return $this->_categoryTitle;
    }

    /**
     * @param mixed $categoryTitle
     */
    public function setCategoryTitle($categoryTitle)
    {
        $this->_categoryTitle = $categoryTitle;
    }

    /**
     * @return mixed
     */
    public function getPageTitle()
    {
        return $this->_pageTitle;
    }

    /**
     * @param mixed $pageTitle
     */
    public function setPageTitle($pageTitle)
    {
        $this->_pageTitle = $pageTitle;
    }

    function build()
    {
        $url = array('');
        if ($this->getLang()) {
            $url[] = $this->getLang();
        }
        if ($this->getTpl()) {
            $url[] = $this->getTpl();
        }
        if ($this->getIdc()) {
            $url[] = $this->getIdc();
        }
        if ($this->getId()) {
            $url[] = $this->getId();
        }
        if ($this->getCategoryTitle()) {
            $url[] = $this->toAscii($this->getCategoryTitle());
        }
        if ($this->getPageTitle()) {
            $url[] = $this->toAscii($this->getPageTitle());
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
}