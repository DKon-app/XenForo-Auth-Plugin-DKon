<?php

namespace YourNamespace\DKonAuth\View;

use XF\Mvc\View;

class Login extends View
{
    public function renderHtml()
    {
        return '
        <div class="container">
            <h1 class="logo"></h1>
            <h2 dkon-trans="auth">Login</h2>
            <form id="login-form" class="form" method="post" action="' . \XF::app()->router()->buildLink('dkon-auth/authenticate') . '">
                <input type="hidden" name="clientId" value="1302">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit" dkon-trans="enter" class="button">Login</button>
            </form>
            <div id="login-error" class="error-message"></div>
            <a href="register.html" dkon-trans="register" class="link">Register</a>
        </div>
        ';
    }
}
