<?php
/**
 * Created by IntelliJ IDEA.
 * User: botnari
 * Date: 15-03-30
 * Time: 7:02 PM
 */

namespace Fusion\Rewrite;


use Symfony\Component\Yaml\Parser;

class RewriteManager
{
    private $_begin = '#begin_rewrite';
    private $_end = '#end_rewrite';

    function enable()
    {
        if (!$this->isEnabled()) {
            $rules = $this->getRules();
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/.htaccess', $rules, FILE_APPEND);
        }
    }

    function disable()
    {
        if ($this->isEnabled()) {
            $content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/.htaccess');
            $lines = explode("\n", $content);
            $tmp = array();
            $record = true;
            foreach ($lines as $line) {
                if (trim($line) == $this->_begin) {
                    $record = false;
                }
                if (trim($line) == $this->_end) {
                    $record = true;
                }
                if ($record && $line != $this->_end) {
                    $tmp[] = $line;
                }
            }

        }
    }

    function getRules()
    {
        $rules = array();
        $rules[] = $this->_begin;
        $rules[] = 'RewriteEngine on';
        $rules[] = 'RewriteBase /';

        $parse = new Parser();
        $staticRules = $parse->parse(file_get_contents(realpath(__FILE__) . '/rules.yml'));
        foreach ($staticRules as $rule) {
            $rules[] = $rule;
        }
        $rules[] = $this->_end;
        return implode("\r\n", $rules);
    }

    function isEnabled()
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/.htaccess')) {
            $content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/.htaccess');
            return preg_match("/(begin_rewrite)/", $content);
        }
        return false;
    }
}