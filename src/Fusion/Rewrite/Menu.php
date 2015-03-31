<?php
/**
 * Created by IntelliJ IDEA.
 * User: botnari
 * Date: 15-03-31
 * Time: 4:40 PM
 */

namespace Fusion\Rewrite;


class Menu
{
    private $_idc;
    private $_lang;
    private $_current;

    /**
     * Menu constructor.
     * @param $idc
     */
    public function __construct($idc, $lang)
    {
        $this->_idc = $idc;
        $this->_lang = $lang;
        $sth = Database::getPdo()->prepare("SELECT * FROM menu WHERE ID = :id");
        $sth->execute(array(':id', $this->_idc));
        $menu = $sth->fetch(\PDO::FETCH_OBJ);
        $this->_current = $menu;
    }

    function getParentsTitle()
    {
        $menu = $this->_current;
        if ($menu->ID_PARENT == 0) {
            return array($menu->{sprintf('NAME_%s', strtoupper($this->_lang))});
        } else {
            $titles = array($menu->{sprintf('NAME_%s', strtoupper($this->_lang))});
            while ($menu->ID_PARENT > 0) {
                $sth = Database::getPdo()->prepare("SELECT * FROM menu WHERE ID = :id");
                $sth->execute(array(':id', $this->ID_PARENT));
                $menu = $sth->fetch(\PDO::FETCH_OBJ);
                $titles[] = $menu->{sprintf('NAME_%s', strtoupper($this->_lang))};
            }
        }
        return array_reverse($titles);
    }

    /**
     * @return mixed
     */
    public function getCurrent()
    {
        return $this->_current;
    }
}