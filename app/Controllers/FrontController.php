<?php

namespace App\Controllers;


class FrontController extends Controller {

    // view display methods
    public function home()
    {
        return $this->view('front.home_view');
    }

    public function about()
    {
        return $this->view('front.about_view');
    }

    public function process()
    {
        return $this->view('front.process_view');
    }

    public function legalNotice()
    {
        return $this->view('front.legal_notice_view');
    }


}