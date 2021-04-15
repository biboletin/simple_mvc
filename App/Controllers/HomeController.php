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
        $model = new HomeModel();
        $data = $model->getUsers();
        $user = $this->session->set('user', 'admin');
        return $this->view->set('site.home', [$data, $user]);
    }

    /**
     * @return string
     */
    public function about(): string
    {
        return $this->view->set('site.about');
    }

    public function __destruct()
    {
        $this->session->close();
    }
}
