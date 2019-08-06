<?php

namespace app\lib;

class Route extends ApplicationComponent
{

    public function setRoute($url)
    {
        header('Location: ' . $url);
        exit();
    }

}