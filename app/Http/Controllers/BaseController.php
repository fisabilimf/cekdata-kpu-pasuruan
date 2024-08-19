<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $additionaldata=NULL)
    {
        $response = [
            'success' => true,
            'data'    => $result,
        ];

        if ($additionaldata) {
            foreach ($additionaldata as $key => $value) {
                $response[$key] = $value;
            }
        }

        // if ($message != '') {
        //     $response["message"] = $message;
        // }

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
