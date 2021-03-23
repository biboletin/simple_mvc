<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    private $view;
    public function __construct()
    {
        $this->view = new View();
    }

    public function index()
    {
        return $this->view->set('home');
    }
}
