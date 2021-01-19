<?php

namespace App\Traits;

trait ResponseAPI
{
    /**
     * Core of response
     * 
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode  
     * @param   boolean         $isSuccess
     */
    public function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        // Check the params
        if (!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if ($isSuccess) {
            return [
                'message' => $message,
                'status' => 'success',
                'code' => $statusCode,
                'result' => $data
            ];
        } else {
            return [
                'message' => $message,
                'error' => true,
                'status' => 'error',
                'code' => $statusCode,
            ];
        }
    }

    /**
     * Send any success response
     * 
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode
     */
    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    /**
     * Send any error response
     * 
     * @param   string          $message
     * @param   integer         $statusCode    
     */
    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }
}

    // return response()->json([
    //             'message' => $message,
    //             'status' => 'success',
    //             'code' => $statusCode,
    //             'result' => $data
    //         ], $statusCode);
