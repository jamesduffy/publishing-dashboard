<?php

class UsersController extends BaseController {

	public function getIndex()
	{
		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');
		
		$data['users'] = DB::table('users')
					->orderBy('last_name')
					->paginate($pagination_count);
		
		return View::make('users.list', $data);
	}

	public function getEdit()
	{
		$data['user'] = \User::findOrFail( Request::segment(3) );

		return View::make('users.edit', $data);
	}

	public function postEdit()
	{
		$rules = array(
				'id' => 'required|exists:users',
				'email' => 'required',
				'first_name' => 'required',
				'last_name' => 'required',
				'role' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('users/edit/'.Input::get('id'))->withErrors($validator);
		}

		$user = \User::findOrFail( Input::get('id') );
		$user->email = Input::get('email');
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->role = Input::get('role');
		$user->save();

		return Redirect::to('users')->with('message', $user->username.' has been updated!');
	}

	public function getPermissions()
	{
		if(! Auth::user()->can('edit_other_staff'))
			return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action!');

		$data['user'] = User::findOrFail( Request::segment(3) );
		$data['roles'] = Role::all(); 

		return View::make('users.permissions', $data);
	}

	public function postPermissions()
	{
		if(! Auth::user()->can('edit_other_staff'))
			return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action!');

		$roles = Role::all();

		$rules = array(
				'id' => 'required|exists:users'
			);

		foreach ($roles as $role) {
			if(Input::has($role->id))
			{
				DB::table('users_roles')->insert(
					array('user_id' => Input::get('id'), 'role_id' => $role->id)
				);
			}
			else {
				DB::table('users_roles')
					->where('user_id', '=', Input::get('id'))
					->where('role_id', '=', $role->id)
					->delete();
			}
		}

		return Redirect::to('users')->with('message', 'User\'s permissions have been updated.');
	}

	public function getPasswordUpdate()
	{
		$data['user'] = \User::findOrFail( Request::segment(3) );

		return View::make('users.updatepassword', $data);
	}

	public function postPasswordUpdate()
	{
		$rules = array(
				'id' => 'required|exists:users',
				'password' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('users/edit/'.Input::get('id'))->withErrors($validator);
		}

		$user = \User::findOrFail( Input::get('id') );
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		return Redirect::to('users')->with('message', $user->username.' password has been updated!');
	}

	public function getCreate()
	{
		return View::make('users.create');
	}

	public function postCreate()
	{
		$rules = array(
				'username' => 'required|unique:users,username',
				'email' => 'required|unique:users,email',
				'first_name' => 'required',
				'last_name' => 'required',
				'password' => 'required',
				'role' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('users/create')->withErrors($validator);
		}

		$user = new \User;
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');		
		$user->password = Hash::make(Input::get('password'));
		$user->role = Input::get('role');
		$user->save();

		return Redirect::to('users');
	}

	public function getDelete()
	{

	}

	public function postDelete()
	{

	}

	public function getTrash()
	{
		$data['users'] = \User::onlyTrashed()->get();

		return View::make('users.list', $data);
	}

	public function getRestore()
	{

	}

	public function getLogin()
	{
		return View::make('users.login');
	}

	public function postLogin() {
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {
			return Redirect::intended('/');
		} else {
			return Redirect::to('login')
				->with('message', 'Your username or password was incorrect')
				->withInput();
		}
	}

	public function getLogout() {
		Auth::logout();

		return Redirect::action('UsersController@getLogin');
	}

}
