<?php

/**
 * This library will decide about the APP logics
 *
 *
 */

//error_reporting(-1);
//ini_set('display_errors', 'On');

class Validationlib
{

    public $obj;
    protected $country_id = "";
    /**
     * To set constructor of parent controller
     *
     * @param Object - $parent_controller -> Object of parent controller
     */

    public function __construct($parent_controller)
    {
        $this->obj = $parent_controller['controller'];
        $this->country_code = $this->obj->country_code;
    }

    public function nameValidation($name)
    {
        if (!preg_match("/^[a-zA-Z][a-zA-Z ]*$/", $name)) {
            $this->obj->response('', 404, 'fail', 'Enter a valid Name');
        }
    }

    public function emailValidation($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->obj->response('', 404, 'fail', 'Enter a valid Email');
        }
    }

}
