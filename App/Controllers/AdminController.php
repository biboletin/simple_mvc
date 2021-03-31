<?php
namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Session;
use Core\Hash;

use App\Models\UserModel;

/**
 * Class AdminController
 *
 * @package App\Controllers
 */
class AdminController extends Controller
{

//    private object $model;
    private object $hash;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->hash = new Hash();
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
        $username = $request->post('username');
        $password = $request->post('password');
        $user = new UserModel();
        $result = $user->validateUser($username);
error_log($this->hash->hashit($password));
error_log(print_r($result, true));
        if ($this->hash->verify($password, $result['password'])) {
            echo 'logged in';
        } else {
            echo 'logged out';
        }

    }

    public function register()
    {
        return $this->view->set('admin.register');
    }


}
