<?php 

class Template {
    private static $_VIEWPATH = __DIR__."/../Views/";
    private static $_VIEWEXT  = ".html";

    private $content = null;
    private $data    = [];

    public function __construct($content, $data){
        $this->content = $content;
        $this->data = $data;
    }

    public static function render($path, $data=[]){
       return new Template(Template::loadView($path), $data);
    }

    public static function loadView($path){
        ob_start();

        $path = self::$_VIEWPATH.$path.self::$_VIEWEXT;
        if(file_exists($path)){
            require_once $path;
        }
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function injectDataInContent(){
        preg_match_all("/{{([^}}]*)}}/", $this->content, $matches);

        foreach ($matches[1] as $key => $value) {
            # code...
            $value = trim($value);
            //{{ variable}}
            if(isset($this->data[$value])){
                $this->content = str_replace($matches[0][$key],);
            }
        }
    }
}