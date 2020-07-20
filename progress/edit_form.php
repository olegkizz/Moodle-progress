<?php
 
class block_progress_edit_form extends block_edit_form {
 
    protected function specific_definition($mform) {
 
        // Section header title according to language file.
        $mform -> addElement ( 'header' ,  'config_header' , get_string ( 'blocksettings' ,  'block' ) ) ;
 
        // Пример строковой переменной со значением по умолчанию. 
        $mform -> addElement ( 'text' ,  'config_email' , get_string ( 'Email easygenerator' ,  'block_progress' ) ) ; 
        $mform -> addElement ( 'password' ,  'config_password' , get_string ( 'Password easygenerator' ,  'block_progress' ) ) ; 
        $mform -> addElement ( 'text' ,  'config_name' , get_string ( 'name' ,  'block_progress' ) ) ; 

        $mform -> addElement ( 'url' ,  'config_url' , get_string ( 'Url of your easygenerator course' ,  'block_progress' ) ) ; 

        $mform -> setDefault ( 'config_text' ,  'значение по умолчанию' ) ; 
        $mform -> setType ( 'config_text' , PARAM_RAW ) ;      
 
    }
}