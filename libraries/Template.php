<?php
/*
 *  Template Class
 *  Creates a template/view object
 */
class Template {
	//Path to template
    protected $template;
    //Variables passed in
    protected $vars = array();
 
    /*
     * Class Constructor
     */
    public function __construct($template){
        $this->template = $template;
    }
 
    /*
     * The get function accepts one parameter, the property of the object.We set the value through the line, $this->property. So, you don't need to call this function
     */
    public function __get($key){
        return $this->vars[$key];
    }
 
    /*
     * Setter magic method accepts two parameters which are object property and value of this object
     We set the value through the line, $this->property= $value. you don't need to call this function
     */
    public function __set($key, $value){
        $this->vars[$key] = $value;
    }
    
    /*
     * Magic method that Convert Object To String
     Help to display the the template
     */
    public function __toString(){
    	extract($this->vars);
    	chdir(dirname($this->template));
    	ob_start();
    
    	include basename($this->template);
    
    	return ob_get_clean();
    }
}