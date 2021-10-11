<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {


        $records = [
            'Queen - <b>Greatest Hits</b>',
            'The Rolling Stones - Sticky Fingers',
            'The Beatles - Abbey Road'
        ];

        return view('admin.records.index', [
            'records' => $records
        ]);
    }

}

;

