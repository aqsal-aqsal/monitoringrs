<?php
namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): void
    {
        $this->render('home/index', [
            'title' => 'Monitoring Inventaris RS',
            'fullWidth' => true
        ]);
    }
}
