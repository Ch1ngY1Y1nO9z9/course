<?php

namespace App\Http\Controllers;

use App\WhiteList;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class WhitelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = WhiteList::all();
        
        return view('admin.white_list.index',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Excel::load($request->file('upload_file'), function($reader) {
            WhiteList::truncate();

            $reader = $reader->getSheet(0);

            $data  = $reader->toArray();

            foreach($data as $student){
                if($student[1]){
                    WhiteList::create([
                        'name'=>$student[0],
                        'student_id'=>$student[1],
                        'grade'=>$student[2]
                    ]);
                }
            }
            // 刪除excel標題資料
            $first_data = WhiteList::first();
            $first_data->delete();
        });

        return redirect()->action('WhitelistController@index');
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
