<?php
namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Session;
use Core\Hash;
use Core\Redirect;

use App\Models\UserModel;
use App\Models\AboutModel;

/**
 * Class AdminController
 *
 * @package App\Controllers
 */
class AdminController extends Controller
{
    /**
     * @var object|Hash
     */
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
     * Login view
     *
     * @return mixed
     */
    public function login()
    {
        return $this->view->set('admin.login');
    }

    /**
     * User login authorization
     *
     * @param Request $request
     */
    public function auth(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');
        $user = new UserModel();
        $result = $user->validateUser($username);

        if ($this->hash->verify($password, $result['password'])) {
            Session::start();
            Session::set('loggedIn', true);
            return $request->redirect('admin/dashboard');
//            return $this->view->set('admin.dashboard');
        } else {
            echo 'logged out';
            return $request->redirect('admin/login');
        }
    }

    /**
     * Registration view
     *
     * @return string
     */
    public function register(): string
    {
        return $this->view->set('admin.register');
    }

    /**
     * Insert new user
     *
     * @param Request $request
     */
    public function registerUser(Request $request)
    {
        $user = new UserModel();

        $user->createNewUser(
            $request->post('username'),
            $request->post('email'),
            $this->hash->hashit($request->post('password'))
        );
        Session::start();
        Session::set('loggedIn', true);
        return $request->redirect('admin/dashboard');
    }

    /**
     * Dashboard view
     *
     * @return string
     */
    public function dashboard(): string
    {
        Session::start();
        return $this->view->set('admin.dashboard');
    }

    /**
     * @return string
     */
    public function about(): string
    {
        $about = new AboutModel();
        $info = $about->getAboutInfo();

        return $this->view->set('admin.about.index', $info);
    }

    /**
     * @return string
     */
    public function categories(): string
    {
        return $this->view->set('admin.categories.index');
    }

    public function exit(): string
    {
        Session::start();
        Session::close();
        return Redirect::to('/');
    }
}
