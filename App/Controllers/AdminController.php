<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
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
     * Login view
     *
     * @return string
     */
    public function login(): string
    {
        return $this->view->set('admin.login');
    }

    /**
     * User login authorization
     *
     * @param Request $request
     */
    public function auth(Request $request): void
    {
        $username = $request->post('username');
        $password = $request->post('password');
        $user = new UserModel();
        $result = $user->validateUser($username);

        if ($this->hash->verify($password, $result['password'])) {
            $this->session->set('loggedIn', true);
error_log('THIS: ' . print_r($this, true));
error_log('SESSION: ' . print_r($this->session, true));
            $request->redirect('admin/dashboard');
        } else {
            echo 'logged out';
            $request->redirect('admin/login');
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
        $this->session->set('loggedIn', true);
        $request->redirect('admin/dashboard');
    }

    /**
     * Dashboard view
     *
     * @return string
     */
    public function dashboard(): string
    {
$this->session->start();
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
        $this->session->close();
        Redirect::to('/');
    }
}
