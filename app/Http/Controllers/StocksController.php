<?php

namespace App\Http\Controllers;

use App\Models\Prices;
use App\Models\Stocks; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    private $columns = ['name', 'symbol', 'sector', 'listingDate'];

    public function stocks($page = 1) {
        $limit = 20;
        $records = Stocks::count();
        $offset = ($page - 1) * $limit;
        $data = DB::table('stocks')
                    ->select($this->columns)
                    ->offset($offset)
                    ->limit($limit)
                    ->orderBy('id', 'asc')
                    ->get();  
        return response([
            'totalRecords' => $records,
            'totalPage' => ceil($records / $limit),
            'data' => $data
        ]);
    }

    public function stock($symbol) {
        $data = Stocks::select($this->columns)->where('symbol', $symbol)->firstOrFail();
        return response($data);
    }

    public function quote(Request $request) {  
        $symbol = $request->input('symbol');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        if ( $symbol && $startDate && $endDate ) {
            $data = Prices::select(['symbol', 'open', 'close', 'date', 'high', 'low', 'volume'])
                        ->where('symbol', $symbol)
                        ->whereBetween('date', [$startDate, $endDate])
                        ->orderBy('id', 'desc')
                        ->groupBy('date')
                        ->get();  
            return response([
                "data" => $data
            ]); 
        } 
    }

    public function update(Request $request) {
        header('Access-Control-Allow-Origin: *');
        return Prices::insert($request->all());
    }

    public function dump(Request $request) {
        header('Access-Control-Allow-Origin: *');
        return Stocks::orderBy('id', 'asc')
                        ->offset($request->input('offset'))
                        ->limit($request->input('limit'))
                        ->get();
    }
}
