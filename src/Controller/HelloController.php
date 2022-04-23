<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloController {
    public function hello(): Response {
        return new Response("Hello WOrld");
    }
}