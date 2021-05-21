<?php

namespace App\Controllers;

use Core\Controller;

/**
 * Class HomeController
 *
 * @package App\Controllers
 */
class HomeController extends Controller
{
    public function __destruct()
    {
        $this->session->close();
    }
    public function index(): string
    {
        return $this->view->set('site.home');
    }

    public function about(): string
    {
        return $this->view->set('site.about');
    }

    public function contacts(): string
    {
        return $this->view->set('site.contacts');
    }
}
