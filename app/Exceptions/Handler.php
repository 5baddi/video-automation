<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
        // Handle the API json response
        if($this->isHttpException($exception) && $request->is("api/*")){
            $message = "";

            switch($exception->getStatusCode()){
                case 400:
                    $message = "Bad request.";
                break;
                case 404:
                    $message = "Not found!";
                break;
                default:
                    $message = "Internal server error!";
                break;
            }

            return response()->json(['message' => $message], $exception->getStatusCode());
        }

        return parent::render($request, $exception);
    }
}
