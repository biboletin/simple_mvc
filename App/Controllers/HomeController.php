<?php
namespace App\Controllers;

use Core\Controller;
use \App\Models\HomeModel;

/**
 * Class HomeController
 *
 * @package App\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var object|HomeModel
     */
    private object $model;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new HomeModel();
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $data = $this->model->getUsers();
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

    /**
     *
     */
    public function error(): void
    {
        //
    }
    public function __destruct()
    {
        $this->session->close();
    }
}
