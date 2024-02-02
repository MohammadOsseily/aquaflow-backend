<?php

namespace App\Services;


class Response
{

    public function ok()
    {
        return response()->json(["message" => "The request succeeded"])->setStatusCode(200);
    }
    public function badRequest()
    {

        return response()
            ->json(["message" => "The server cannot or will not process the request due to something that is perceived to be a client error "])
            ->setStatusCode(400);
    }
    public function notFound()
    {
        return response()->json(["message" => "The server cannot find the requested resource"])->setStatusCode(404);
    }
    public function internalServerError()
    {
        return response()
            ->json(["message" => "The server has encountered a situation it does not know how to handle. "])
            ->setStatusCode(500);
    }
}
