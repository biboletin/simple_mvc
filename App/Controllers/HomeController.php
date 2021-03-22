<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;

class HomeController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return View::set('home');
    }
}
