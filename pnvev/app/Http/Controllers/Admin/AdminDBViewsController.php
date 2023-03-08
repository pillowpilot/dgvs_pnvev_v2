<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminDBViewsController extends Controller {

	public function getListOfViewsAndDefinitions()
	{
		$results = \DB::select(
			"SELECT TABLE_NAME, VIEW_DEFINITION 
			 FROM information_schema.VIEWS 
			 WHERE TABLE_SCHEMA 
			 LIKE '" . env('DB_DATABASE') . "';");

		return $results;
	}

	public function modifyViewDefinition($viewName, $newDefinition)
	{
		// Use CREATE OR REPLACE VIEW instead of ALTER VIEW
		// See: https://stackoverflow.com/q/47207029
		\DB::statement("CREATE OR REPLACE VIEW " . $viewName . " AS (" . $newDefinition . ")");
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
		$viewName = Session::get('viewName');
		$newViewDefinition = $request['_editorValue'];
		error_log($viewName);
		error_log($newViewDefinition);

		$this->modifyViewDefinition($viewName, $newViewDefinition);

		$user = $request->user();
		$views = $this->getListOfViewsAndDefinitions();

		$viewToDisplay = array_values(
			array_filter($views, 
				function ($view) use ($viewName) { return $view->TABLE_NAME == $viewName; }
			))[0];

		error_log('Saving...');
		return view('admin.dbviewsEditor', ['user' => $user, 'viewToDisplay' => $viewToDisplay]);
	}
}
