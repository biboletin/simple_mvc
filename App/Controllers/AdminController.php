<?php
namespace App\Controllers;

use Core\Controller;
//use \App\Models\AdminModel;

class AdminController extends Controller
{

//    private object $model;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        return $this->view->set('login');
    }
}