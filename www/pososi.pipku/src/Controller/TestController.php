<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;

    class TestController
    {
        public function index(): Response
        {
            return new Response(
                '<html><body>Your new Home!</body></html>'
            );
        }
    }