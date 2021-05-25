<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\UserModel;
use Core\Controller;
use Core\Request;

/**
 * Class AdminController
 *
 * @package App\Controllers
 */
class AdminController extends Controller
{
    /**
     * Login page
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
        $result = $user->checkUsername($username);
        $userPass = ! empty($result) ? $result['password'] : '';

        if ($this->hash->verify($password, $userPass)) {
            $this->session->set('loggedIn', true);
            $request->redirect('admin/dashboard');
        }
        if (! $this->hash->verify($password, $userPass)) {
            echo 'logged out';

            $this->redirectToLogin();
        }
    }

    /**
     * Registration view
     * @return string
     */
    public function register(): string
    {
        return $this->view->set('admin.register');
    }

    /**
     * Insert new user
     * @param Request $request
     */
    public function registerUser(Request $request): void
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
        if (! $this->session->get('loggedIn')) {
            $this->redirectToLogin();
        }
        return $this->view->set('admin.dashboard');
    }

    /**
     * About page
     *
     * @return string
     */
    public function about(): string
    {
        $about = new AboutModel();
        $info = $about->getAboutInfo();

        return $this->view->set('admin.about.index', $info);
    }

    /**
     * Categories page
     *
     * @return string
     */
    public function categories(): string
    {
        return $this->view->set('admin.categories.index');
    }

    public function users(Request $request): string
    {
        $user = [
            'id' => $request->post('id'),
            'name' => 'Mihail',
        ];
//error_log(print_r($request, true));
var_dump($request);
        return $this->view->set('admin.users', $user);
    }

    public function listUsers($id): string
    {
        $user = [
            'id' => $id,
            'name' => 'Mihail',
        ];
        return $this->view->set('admin.users', $user);
    }

    public function logout(): void
    {
        $this->session->close();
        $this->redirectToLogin();
    }
}
