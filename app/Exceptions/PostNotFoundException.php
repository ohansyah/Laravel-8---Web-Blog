<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class PostNotFoundException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        Log::info('this is error message');
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        // return view('posts.edit')->with('post', $post);
        // return back()->withError($exception->getMessage())->withInput();
    }
}
