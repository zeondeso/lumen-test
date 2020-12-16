<?php
namespace App\Http\Controllers;

use App\Http\Helper\JsendHelper;
use App\Models\User;
use App\Providers\AuthServiceProvider;
use Exception;
use Illuminate\Http\Request;

class SecureController extends Controller
{
	public function profile(Request $request)
	{
		$jsend = new JsendHelper();
		try {
			$token = $request->bearerToken();

			$user = User::where('token', $token)->get();

			if($user->count() > 0)
				return $jsend->jsend_success($user);
			else
				return $jsend->jsend_error('Unauthorized', null, null, 401);

		} catch (Exception $e) {
			return $jsend->jsend_error($e->getMessage());
		}

	}
}