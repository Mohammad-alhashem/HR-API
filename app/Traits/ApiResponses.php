<?php

namespace App\Traits;

trait ApiResponses
{

    // a function to send success response
    public function sendSuccess($message, $data = [])
    {
        $toReturn               = [];
        $toReturn['message']    = $message;
        $toReturn['data']       = $data;
        $toReturn['code']       = 200;

        return response()->json($toReturn, 200);
    }

    // a function to send error response
    public function sendError($code, $message, $errors = [], $data = [] ) //on errors
    {
        return response()->json([
            'code'          => $code, 
            'message'       => $message, 
            'errors'        => $errors, 
            'data'          => $data
        ], $code);
    }

    // a function to view paginated response
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