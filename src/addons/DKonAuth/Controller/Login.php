<?php

namespace YourNamespace\DKonAuth\Controller;

use XF\Mvc\ParameterBag;
use XF\Mvc\Reply\View;
use XF\Mvc\FormAction;
use XF\Http\Request;

class Login extends \XF\Pub\Controller\AbstractController
{
    public function actionIndex()
    {
        // Render the login view
        return $this->view('YourNamespace\DKonAuth:Login', 'dkon_login');
    }

    public function actionAuthenticate(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        // Perform the API request for authentication
        $clientId = '1302'; // Your client ID
        $apiUrl = 'https://api.dkon.app/api/v3/method/account.signIn';

        $response = $this->makeApiRequest($apiUrl, $clientId, $username, $password);

        if ($response['error_code'] === 0) {
            // Handle successful login
            return $this->redirect(__('/')); // Redirect to the homepage or any other page
        } else {
            // Handle login failure
            return $this->error('Login failed. Please check your credentials.');
        }
    }

    private function makeApiRequest($url, $clientId, $username, $password)
    {
        $data = json_encode([
            'clientId' => $clientId,
            'username' => $username,
            'password' => $password
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
