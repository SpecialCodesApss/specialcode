<?php

namespace App\Exceptions;
use App\Models\System_error;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $exception) {
            //
            return $this->sendEmail($exception);
//            sendEmail($exception);
        });
    }



    /**
     * Sends an email to the developer about the exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function sendEmail(Throwable $exception)
    {
        //add system error to database and send email to developer
        $input['error_title'] = $exception->getMessage();
        $input['error_text'] = $exception;
        System_error::create($input);

//        try {
//            //Send Email
//            //get message text / send messasge if not in localhost only
//            if(strpos(url()->full(), "localhost") === false)
//            {
//                $message_subj="New Error Found - Saudi-app.com";
//                Mail::raw('Hi, welcome developer! Error Code - website', function ($message) use ($message_subj) {
//                    $message->to("eng.tahaalaa@gmail.com")
//                        ->subject($message_subj);
//                });
//            }
//
//        } catch (Throwable $e) {
//
//            //add error to databse only without send mail
//            $input['error_title'] = $e->getMessage();
//            $input['error_text'] = $e;
//            System_error::create($input);
//
//            return false;
//        }


    }


}
