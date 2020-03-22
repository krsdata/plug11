<?php

namespace App\Exceptions;

use Exception;
use ErrorException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException; 
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Redirect;
use Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use URL;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\Debug\Exception\FatalErrorException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        NotFoundHttpException::class,
        MethodNotAllowedHttpException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
 
    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {   
        $path_info_url = $request->getpathInfo();
        $api_url = null;
        if (strpos($path_info_url, 'api/v2') !== false) {
            $api_url = $path_info_url;
        }
         
         if ($exception instanceof AuthenticationException) {

            $data['url']        = url($path_info_url);
            $data['message']    = $exception->getMessage();
            $data['error_type'] = 'Authentication Exception';
            
             $this->errorLog($data, $exception);

            if ($api_url) {
                echo  json_encode(
                    [
                        'status'        => false,
                        'code'          => 500,
                        'message'       => $exception->getMessage(),
                        'response'      => $data,
                    ]
                );
            } 
            exit();
            
         }

          if ($exception instanceof ErrorException) {

            $data['url']        = url($path_info_url);
            $data['message']    = $exception->getMessage() .' , line_number :'.$exception->getline();
            $data['error_type'] = 'ErrorException';
            

             $this->errorLog($data, $exception);

            if ($api_url) {
                echo json_encode(
                    [
                        'status'        => false,
                        'code'          => 500,
                        'message'       => $exception->getMessage(),
                        'line_number'   => $exception->getline(),
                        'response'      => $data,
                    ]
                );
            } 
            exit();
            
         }

          if ($exception instanceof FatalErrorException) {
           
            $data['url']        = url($path_info_url);
            $data['message']    = $exception->getMessage();
            $data['error_type'] = 'FatalErrorException';
                 
             $this->errorLog($data, $exception);

            if ($api_url) {
                echo json_encode(
                    [
                        'status'        => false,
                        'code'          => 500,
                        'message'       => $exception->getMessage(),
                        'response'      => $data,
                    ]
                );
            } 
            exit();
         }

          if ($exception instanceof FatalThrowableError) { 
                 $data['url']        = url($path_info_url);
                $data['message']    = $exception->getMessage();
                $data['error_type'] = 'FatalThrowableError';
                
                 $this->errorLog($data, $exception);

                if ($api_url) {
                    echo  json_encode(
                        [
                            'status'        => false,
                            'code'          => 500,
                            'message'       => $exception->getMessage(),
                            'response'      => $data,
                        ]
                    );
                } 
                 exit();
          }

           if ($exception instanceof QueryException) {

            $data['url']        = url($path_info_url);
            $data['message']    = $exception->getMessage();
            $data['error_type'] = 'QueryException';
            
             $this->errorLog($data, $exception);

            if ($api_url) {
                echo json_encode(
                    [
                        'status'        => false,
                        'code'          => 500,
                        'message'       => $exception->getMessage(),
                        'response'      => $data,
                    ]
                );
            } 
            exit();
         }

        return parent::render($request, $exception);
    }

    public function errorLog($data, $e)
    {
   
        $data['log']        = 'line number : '.$e->getline()??null;
        $data['message']    = $e->getMessage();
        $data['file']       = $e->getFile();
        $data['statusCode'] = 500;
       
        \DB::table('error_logs')->insert($data);
    }
}
