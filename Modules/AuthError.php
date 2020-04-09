<?php 

    namespace Modules;

    class AuthError {
        public function sendResponse($result, $message)
        {

            $response = [
                'success' => true,
                'data'    => $result,
                'message' => $message,
            ];

            return json_encode($response);
        }

        public function sendError($error, $errorMessages = [], $code = 404)
        {
            $response = [
                'success' => false,
                'message' => $error,
                'code'    => $code
            ];
            
            if(!empty($errorMessages)){
                $response['data'] = $errorMessages;
            }

            return json_encode($response);
        }
    }

?>