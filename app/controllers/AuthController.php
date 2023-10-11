<?php

namespace app\controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use app\models\User;

class AuthController extends Controller
{
    public function showLoginForm(Request $request, Response $response)
    {
        return $this->view->render($response, 'auth/login.twig', ['title' => 'Accesso']);
    }

    public function login(Request $request, Response $response)
    {
        $params = $request->getParsedBody();
        $username = $params['username'];
        $password = $params['password'];

        $user = User::where('username', $username)->first();

        if ($user && password_verify($password, $user->password)) {
            $this->flash->addMessage('success', 'Accesso riuscito');
            return $response->withRedirect('/dashboard');
        } else {
            $this->flash->addMessage('error', 'Nome utente o password errati');
            return $response->withRedirect('/login');
        }
    }

    public function showRegistrationForm(Request $request, Response $response)
    {
        return $this->view->render($response, 'auth/registration.twig', ['title' => 'Registrazione']);
    }

    public function register(Request $request, Response $response)
    {
        $params = $request->getParsedBody();
        $username = $params['username'];
        $password = $params['password'];

        $existingUser = User::where('username', $username)->first();

        if ($existingUser) {
            $this->flash->addMessage('error', 'Nome utente già in uso');
            return $response->withRedirect('/register');
        }

        $user = new User();
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();

        $this->flash->addMessage('success', 'Registrazione completata');
        return $response->withRedirect('/login');
    }
}