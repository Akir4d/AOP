<?php

namespace App\Controllers\Emergency;

use App\Controllers\AopBaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use \Ramsey\Uuid\Uuid;

abstract class Auth extends AopBaseController
{

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        // Preload any models, libraries, etc, here.
        // E.g.: $this->session = \Config\Services::session();
        $this->authBarrer();

    }

    private function authBarrer()
    {
        $test = explode(' ', $this->request->getServer("HTTP_AUTHORIZATION"));
        $uuid = "";
        if ($test[0] = "Bearer") {
            $session = \Config\Services::session();
            if ($session->uuid == null) {
                $session->uuid = Uuid::uuid4()->toString();
            }
            $uuid = $test[1];
            if ($session->uuid !== $uuid) {
                header("Content-Type: application/json");
                http_response_code(ResponseInterface::HTTP_UNAUTHORIZED);
                echo json_encode(['status' => 'forbidden'], );
                die();
            }
        }
    }

}
