<?php
namespace App\Controllers;

use App\Constant\SqlOperatorConst;
use App\Helpers\Request;
use App\Controllers\Controller;
use App\Helpers\Router;
use App\Helpers\Sanitizer;
use App\Models\User;

class AuthController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    /**
     * Return the login page
     * 
     * @return ViewFile
     */
    public function loginPage()
    {
        return include($this->BASE_PATH.'/views/auth/login.php');
    }

    /**
     * Authenticate
     */

    public function authenticateLogin() {
        $credentials = Sanitizer::sanitize(Request::getData());

        $user = User::where('email', SqlOperatorConst::$OPT_EQUALS, $credentials['email'])->first();

        if ($user) {
            if (password_verify($credentials['password'], $user->password)) {
                // set pass session here
                Router::redirect('app.index');
                return;
            }
        }

        // set error session here
        Router::redirect('auth.loginpage');
        return;
    }

    /**
     * Return register page
     * 
     * @return ViewFile 
     */
    public function registerPage()
    {
        return include($this->BASE_PATH.'/views/auth/register.php');
    }
}