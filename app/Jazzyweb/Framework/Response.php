<?php
/**
 * Created by JetBrains PhpStorm.
 * User: juandalibaba
 * Date: 14/09/13
 * Time: 14:38
 * To change this template use File | Settings | File Templates.
 */

namespace Jazzyweb\Framework;


class Response {

    private $headers;
    private $content;

    public function __construct(){
        $this->headers = array();
        $this->content = null;
    }

    public function addHeader($header){

        $this->headers[] = $header;
    }

    public function removeHeader($header){

    }

    public function setContent($content){
        $this->content = $content;
    }

    public function send(){

        foreach($this->headers as $header){
            header($header);
        }
        echo $this->content;
    }
}