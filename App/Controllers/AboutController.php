<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use App\Models\AboutModel;

/**
 * Class AboutController
 *
 * @package App\Controllers
 */
class AboutController extends Controller
{

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
