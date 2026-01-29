<?php
namespace App\HTTP\Controllers\Pages;

use App\Core\BaseController;

class PagesController{

 
    private function create()
    {
        $page = new BaseController();
        return $page;
    }


    /*
     * LANDING PAGE 
     */    
    public function landingPage(){
        $this->create()->renderView('Pages/landing'); 
    }
}