<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminDiseasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $tableData = \DB::table('pnvev_disease_v2s')->get();
        $json = json_encode($tableData);
        return view('admin.diseases', ['user' => $user, 'json' => $json]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tableName = 'pnvev_disease_v2s';
        $getAutoIncrementValue = function() use ($tableName) {
            return \DB::select("select `AUTO_INCREMENT` from information_schema.TABLES t where TABLE_SCHEMA = '" 
                        . env('DB_DATABASE')
                        . "' and TABLE_NAME = '" 
                        . $tableName
                        . "'")[0]->AUTO_INCREMENT;
        };
        $setAutoIncrementTo = function($value) use ($tableName) {
            \DB::update("ALTER TABLE " . $tableName . " AUTO_INCREMENT = " . $value . ";");
        };

        $user = $request->user();
        $data = json_decode($request->input('data'));

        /*
        In MySQL, there are some stmts that cannot be rolled back.
        See: https://dev.mysql.com/doc/refman/5.7/en/cannot-roll-back.html

        Because we need to truncate the entire pnvev_disease_v2s before inserting every entry, 
        we have to manually implement the rollback process in case of an error. But only for the 
        AUTO_INCREMENT value, the DELETE TABLE can be included into the transaction.

        The id column in pnvev_disease_v2s MUST always start with 1 (otherwise our views will not work).
        */

        $operationResult = '';
        $preTransactionAutoIncrementValue = $getAutoIncrementValue();
        $setAutoIncrementTo(1);
        try {
            $transactionResult = \DB::transaction(function() use ($tableName, $data) {
                \DB::table($tableName)->delete();
                foreach($data as $row) {
                    $row = (array) $row;
                    $row['parent_id'] = $row['parent_id'] == '' || $row['parent_id'] == 'null'? null: $row['parent_id'];
                    \DB::table($tableName)->insert($row);
                }
            });
            $operationResult = 'Datos actualizados';

        } catch(\Exception $e) {
            $setAutoIncrementTo($preTransactionAutoIncrementValue);
            $operationResult = json_encode($e->getMessage(), true);
        }

        $tableData = \DB::table($tableName)->get();
        $json = json_encode($tableData);

        return view('admin.diseases', [
            'user' => $user, 
            'json' => $json, 
            'statusMessageText' => $operationResult
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
