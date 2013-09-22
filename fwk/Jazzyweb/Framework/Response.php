<?php

namespace Jazzyweb\Framework;

class Response {

    private $headers;
    private $content;

    public function __construct($content=null){
        $this->headers = array();
        $this->content = $content;
    }

    public function addHeader($header){

        $this->headers[] = $header;
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