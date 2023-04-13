<?php 
use App\User;
use Illuminate\Support\Facades\Auth;


	function Check($params)
	{
		// dd($params);
		$array = auth::user()->permissions;
		$permission = explode(",", $array);


		if (in_array("All", $permission) OR in_array($params, $permission)){}
		else
		{
			abort(redirect()->back()->with('flash_message_error', 'You don`t have permission to access this route...'));
			die();
		}
	}



	function CheckAuthUser($id, $params)
	{

		$array = auth::user()->permissions;
		$permission = explode(",", $array);

	
		if (auth::user()->id == $id) {}
		else if (in_array("All", $permission) OR in_array($params, $permission)){}
		else
		{
			abort(redirect()->back()->with('flash_message_error', 'You don`t have permission to access this route...'));
			die();
		}
	}


?>