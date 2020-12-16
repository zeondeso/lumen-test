<?php
namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Helper\JsendHelper;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $jsend = new JsendHelper();

        try {
            $params = $request->input('with');
            
            if(!isset($params))
            {
                $users = User::get();
            }
            else
            {
                $users = User::with($params)
                        ->get();
            }

            if($users->count()>0)
                //return $this->jsend_success($users);
                return $jsend->jsend_success($users);
            else
            {
                return $jsend->jsend_fail(['There is no users.']);
            }
        } catch (Exception $e) {
            return $jsend->jsend_error('Unable to get data : '.$e->getMessage());
        }

        
    }

    public function view(Request $request, string $user)
    {
        $jsend = new JsendHelper();
        
        try {
            $users = User::where('fullname', $user)
                    ->get();

            if($users->count()>0)
                return $jsend->jsend_success($users);
            else
            {
                return $jsend->jsend_fail(['user not found']);
            }
        } catch (Exception $e) {
            return $jsend->jsend_error('Unable to get data : '.$e->getMessage());
        }
    }
}
