<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\HomeModel;

/**
 * Class HomeController
 *
 * @package App\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return string
     */
    public function index(): string
    {
        return $this->view->set('site.home');
    }

    /**
     * @return string
     */
    public function about(): string
    {
        return $this->view->set('site.about');
    }

    public function contacts(): string
    {
        // return $this->view->set('site.contacts');
        return $this->view->set('site.contacts');
    }


    public function __destruct()
    {
        $this->session->close();
    }
}
