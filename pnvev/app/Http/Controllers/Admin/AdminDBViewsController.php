<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminDBViewsController extends Controller {

	public function getListOfViewsAndDefinitions()
	{
		return \DB::select("SELECT TABLE_NAME, VIEW_DEFINITION  FROM information_schema.VIEWS WHERE TABLE_SCHEMA LIKE '" 
			. env('DB_DATABASE') 
			. "';");
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$user = $request->user();

		$views = $this->getListOfViewsAndDefinitions();

        return view('admin.dbviewsSelector', ['user' => $user, 'viewsAndDefinitions' => $views]);
	}

	public function editor(Request $request)
	{
		$user = $request->user();

		$viewName = $request['viewName'];

		// Validate viewName
		Session::put('viewName', $viewName);

		$views = $this->getListOfViewsAndDefinitions();
		$viewToDisplay = array_values(
			array_filter($views, 
				function ($view) use ($viewName) { return $view->TABLE_NAME == $viewName; }
			))[0];

		return view('admin.dbviewsEditor', ['user' => $user, 'viewToDisplay' => $viewToDisplay]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user = $request->user();
		$viewName = Session::get('viewName');
		$views = $this->getListOfViewsAndDefinitions();
		error_log(json_encode($views));
		error_log($viewName);

		$viewToDisplay = array_values(
			array_filter($views, 
				function ($view) use ($viewName) { return $view->TABLE_NAME == $viewName; }
			))[0];
		error_log(json_encode($viewToDisplay));

		error_log('Saving...');
		return view('admin.dbviewsEditor', ['user' => $user, 'viewToDisplay' => $viewToDisplay]);
	}
}
