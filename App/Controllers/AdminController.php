<?php
namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Session;

//use \App\Models\AdminModel;

/**
 * Class AdminController
 *
 * @package App\Controllers
 */
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

    /**
     * @return mixed
     */
    public function login()
    {
        return $this->view->set('admin.login');
    }

    public function auth(Request $request)
    {
        $data = $request->post('username');
//error_log($data);
error_log(print_r($request, true));
    }


}
