<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;
use \App\Models\HomeModel;

/**
 * Class HomeController
 *
 * @package App\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var object|View
     */
    private object $view;

    private object $model;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->view = new View();
        $this->model = new HomeModel();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $data = $this->model->getCategories();
        return $this->view->set('home', $data);
    }

    /**
     * @return mixed
     */
    public function about()
    {
        return $this->view->set('about');
    }
}
