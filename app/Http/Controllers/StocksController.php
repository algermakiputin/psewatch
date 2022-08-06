<?php

namespace App\Http\Controllers;

use App\Models\Prices;
use App\Models\Stocks; 
use Illuminate\Support\Facades\DB;

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

    public function price($symbol, $from, $to) { 
         
        $data = Prices::where('symbol', $symbol)
                        ->whereBetween('date', [$from, $to])
                        ->orderBy('id', 'desc')
                        ->groupBy('date')
                        ->get(); 
        dd($data);
        return response($data);
    }

    public function test() { 
        $records = Prices::count();
        $limit = 10000;
        $pages = $records / $limit; 
        return response($pages);
    }
}
