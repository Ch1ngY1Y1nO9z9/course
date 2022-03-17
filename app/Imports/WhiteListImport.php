<?php

namespace App\Imports;

use App\WhiteList;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class WhiteListImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        
        if($row[1]){
            WhiteList::create([
                'name'=>$row[0],
                'student_id'=>$row[1],
                'grade'=>$row[2]
            ]);
        }
    }
}