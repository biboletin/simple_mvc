<?php

namespace App\Controllers;

use App\Models\AboutModel;
use Core\Controller;
use Core\Request;

/**
 * Class AboutController
 *
 * @package App\Controllers
 */
class AboutController extends Controller
{
    public function addEditInfo(Request $request): string
    {
        $model = new AboutModel();
        $about = $request->post('about');

        if ($model->insertUpdateAbout($about)) {
            return $request->redirect('admin/about');
        }
    }
}
