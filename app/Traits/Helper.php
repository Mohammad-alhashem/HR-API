<?php

namespace App\Traits;


trait Helper
{

    public function checkPageNumber($request_per_page)
    {
        $per_page       = $request_per_page ? $request_per_page : 2;
        $per_page       = is_numeric($per_page) && $per_page < 50 && $per_page > 0 ? $per_page : 10;

        return $per_page;
    }

}