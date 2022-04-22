<?php

/**
 * Prism 代码高亮
 * 
 * @package Prismjs
 * @author 若海
 * @version 1.0.0
 * @dependence 9.9.2-*
 * @link http://www.rehiy.com
 */
class Prismjs_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Prismjs_Plugin', 'parse');
        Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Prismjs_Plugin', 'parse');
        Typecho_Plugin::factory('Widget_Abstract_Comments')->contentEx = array('Prismjs_Plugin', 'parse');
        Typecho_Plugin::factory('Widget_Archive')->header = array('Prismjs_Plugin', 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('Prismjs_Plugin', 'footer');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
    }

    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 输出头部css
     * 
     * @access public
     * @param unknown $header
     * @return unknown
     */
    public static function header()
    {
        $cssUrl = Helper::options()->pluginUrl . '/Prismjs/src/prism.css';
        echo '<link rel="stylesheet" type="text/css" href="' . $cssUrl . '?v5" />';
    }

    /**
     * 输出尾部js
     * 
     * @access public
     * @param unknown $header
     * @return unknown
     */
    public static function footer()
    {
        $jsUrl = Helper::options()->pluginUrl . '/Prismjs/src/prism.js';
        echo '<script type="text/javascript" src="' . $jsUrl . '?v5"></script>';
    }

    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function parse($text, $widget, $lastResult)
    {
        $text = empty($lastResult) ? $text : $lastResult;

        if ($widget instanceof Widget_Archive || $widget instanceof Widget_Abstract_Comments) {
            $text = str_replace('<pre><code>', '<pre><code class="lang-auto">', $text);
            $text = str_replace('<pre>', '<pre class="line-numbers">', $text);
            $text = str_replace('lang-sh', 'lang-shell', $text);
        }

        return $text;
    }
}
