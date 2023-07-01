<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminImporterController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$user = $request->user();
        $editorInitialContent = \App\KeyValueStorage::find(['key' => 'importQuery'])[0]['value'];

        return view('admin.importer', [
            'user' => $user, 
            'editorInitialContent' => $editorInitialContent]);
	}

	public function editor(Request $request)
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user = $request->user();
        $newImportQuery = $request['_editorValue'];

        $newImportQuery = str_replace('`', '', $newImportQuery);

        \App\KeyValueStorage::updateOrCreate(['key' => 'importQuery'], ['value' => $newImportQuery]);
        
        $instance = new \App\Caso();
        $tableName = $instance->getTable();
        \DB::table($tableName)->truncate();

        $editorInitialContent = \App\KeyValueStorage::find(['key' => 'importQuery'])[0]['value'];

        $message = 'Datos antiguos eliminados. Importación finalizada.';
        try{
            \DB::statement($editorInitialContent);
        }catch(\Illuminate\Database\QueryException $ex){
            $message = 'Datos antiguos eliminados. Error en la consulta (' . $ex->getMessage() . ').';
        }

		return view('admin.importer', [
            'user' => $user, 
            'editorInitialContent' => $editorInitialContent, 
            'statusMessageText' => $message]);
	}
}
