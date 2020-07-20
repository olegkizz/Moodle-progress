<?php

require_once 'send_request.php';

class block_progress extends block_base
{
  function init()
  {
	    $this->title   = get_string('progress', 'block_progress');

	    $this->version = 2004111200;
  }

  function get_content()
  {		
  		$email = $this->config->email;
  		$password = $this->config->password;
  		$name = $this->config->name;
  		$url = $this->config->url;

	    if ($this->content !== NULL) {
	      return $this->content;
	    }
	 
	    $this->content         =  new stdClass;
	    $this->content->text   = getProgress($email, $password, $name, $url);
	    $this->content->footer = 'Your email  '. $email;
	 	
	    return $this->content;
  }



}   // Конец класса
