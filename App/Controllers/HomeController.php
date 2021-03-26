<?php
namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Session;
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
        Session::start();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $data = $this->model->getCategories();
        $user = Session::set('user', 'admin');
        return $this->view->set('site.home', [$data, $user]);
    }

    /**
     * @return mixed
     */
    public function about()
    {

        return $this->view->set('site.about');
    }

    public function ajax(Request $request)
    {

        $data = $request->post('name');
        echo $data;
//        return $this->view->set('site.home', $data);
    }

    public function __destruct()
    {
        Session::close();
    }
}
