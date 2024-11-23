<?php

namespace App\Traits;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

trait ApiResponses
{

    public function sendSuccess($message, $data = [])
    {
        $toReturn               = [];
        $toReturn['message']    = $message;
        $toReturn['data']       = $data;
        $toReturn['code']       = 200;

        return response()->json($toReturn, 200);
    }

    public function pagination($collection)
    {
        return [
            'current_page'      => $collection->currentPage(),
            'last_page'         => $collection->lastPage(),
            'per_page'          => $collection->perPage(),
            'has_more_pages'    => $collection->hasMorePages(),
            'next_page'         => $collection->lastPage() == $collection->currentPage() ? null : $collection->currentPage() + 1,
            'prev_page'         => $collection->currentPage() == 1 ? null : $collection->currentPage() - 1,
            'items_total'       => $collection->total(),
        ];
    }
    

}
