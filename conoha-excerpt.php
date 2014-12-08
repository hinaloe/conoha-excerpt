<?php

/*
Plugin Name: ConoHa excerpt
Plugin URI: http://qiita.com/kimama1997/item/dummy_uri
Description: 記事の先頭でこのはちゃんが抜粋を読み上げてくれます。
Version: 1.0
Author: hinaloe
Author URI: http://blog.hinaloe.net/
License: MIT
*/

if(!defined("ABSPATH"))exit();
ConohaExcerpt::init();

/**
 * Class ConohaExcerpt
 */
class ConohaExcerpt {


    const ICON = "img/mafes-icons.png";
    const ANZU = '0';
    const ANZU_H = "57px";
    const CLAUDIA = '-57px';
    const CLAUDIA_H = '61px';
    const CONOHA = '-118px';
    const CONOHA_H = '60px';
    const PRONAMA = '-178px';
    const PRONAMA_H = '52px';
    const QUERY = '-230px';
    const QUERY_H = '60px';
    const UNITY = '-290px';
    const UNITY_H = '64px';
    private $icon;

    const CHARA = self::CHARA;
    const CHARA_HIGHT = self::CONOHA_H;

    /**
     * constructor
     */
    private function __construct () {
        $this->icon = plugins_url(self::ICON,__FILE__);
    }

    /**
     * initialize
     * @void
     */
    public static function init(){
        $ce = new self;
        $ce->actions();
    }

    /**
     * Register hooks
     */
    private function actions (){
        add_action("wp_head",array($this,"addCss"));
        add_filter("the_content",array($this,"addExcerpt"),5);

    }

    /**
     * Insert Plugin CSS
     */
    public function addCss(){
        $css = '.conoha-excerpt .ic-conoha {background: url(%1$s) 0 %2$s;width: 64px;height: %3$s;} .conoha-excerpt {display: table;border-bottom:  solid 1px rgba(76, 57, 59, 0.42)}.conoha-excerpt>div{display: table-cell;vertical-align:middle;}';
        $html = sprintf('<style>%1$s</style>',sprintf($css,$this->icon,self::CHARA,self::CHARA_HIGHT));
        echo $html,"\n";
    }

    /**
     * filter for add excerpt.
     *
     * @param string $content
     * @return string
     */
    public function addExcerpt ($content){
        if(!is_single() or !has_excerpt()){
            return $content;
        }
        $excerpts = sprintf('<div class="conoha-excerpt">
<div><div class="ic-conoha"></div></div>
<div><div class="conoha-excerpt-content">%1$s</div></div>
</div>
',get_the_excerpt());
        return $excerpts.$content;
    }
}
