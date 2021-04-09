<?php


namespace App\Controllers;

use Core\Controller;
use Core\Request;

use App\Models\AboutModel;
use Core\View;

/**
 * Class AboutController
 *
 * @package App\Controllers
 */
class AboutController extends Controller
{
    /**
     * AboutController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function addEditInfo(Request $request): string
    {
        $model = new AboutModel();
        $about = $request->post('about');

        if ($model->insertUpdateAbout($about)) {
            return $request->redirect('admin/about');
        }
    }
}
