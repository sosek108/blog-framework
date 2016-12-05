<?php
/**
 * Created by PhpStorm.
 * User: sosek108
 * Date: 20.11.16
 * Time: 16:23
 */

namespace Controller;

use Db\UserDb;
use Foundation\RedirectResponse;
use Foundation\Response;

class UserController extends AbstractController
{
    public function loginAction()
    {
        $redirectPath = $this->request->getParam('redirect');

        if (!empty($this->container->user)) {
            return new RedirectResponse('/');
        }
        if ($this->request->getMethod() == "POST") {
            $login = $this->request->getParam('login');
            $pass = $this->request->getParam('password');
            if (empty($login) or empty($pass)) {
                $response = new RedirectResponse('login');
                $response->setError('Credentials are wrong');
                return $response;
            }

            $db = new UserDb();
            $user = $db->getUser($login, $pass);
            if (empty($user)) {
                $response = new RedirectResponse('login');
                $response->setError('Credentials are wrong');
                return $response;
            } else {
                $redirectPath = !empty($redirectPath) ? $redirectPath : '/';
                $response = new RedirectResponse($redirectPath);
                $response->startSession($user);
                $response->setMessage('Successfully logged in');
                return $response;
            }
        }
        return new Response('loginpage', ['redirect' => $redirectPath ]);
    }

    public function logoutAction()
    {
        $response = new RedirectResponse('/');
        $response->deleteSession();
        $response->setMessage('Log out performed with success.');
        return $response;
    }
} 