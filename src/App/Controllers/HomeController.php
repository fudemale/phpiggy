<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;


class HomeController
{

    // private  TemplateEngine $view;

    public function __construct(private  TemplateEngine $view)
    {

        // $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function home()
    {

        // $secret = "Hussain";
        echo $this->view->render("/index.php", [
            'title' => 'Home Page'
        ]);
        // $data array as a variable is used as a parameter from the render method
        // the included files has access to the parameters data which not in case of $secret as it's function scoped
    }
}
