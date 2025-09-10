<?php

namespace App\Http\Controllers\API;

use DB;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class StatisticController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class StatisticController extends APIController
{
    protected $model                        = 'Pegawai';
    protected $model_eloquent               = 'App\Models\Pegawai';
    /**
     * @OA\Get(
     *     path="/api/statistic/emp/by-count",
     *     tags={"Statistic"},
     *     summary="Display a listing of items",
     *     operationId="statisticIndex",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="_page",
     *         in="query",
     *         description="current page",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_limit",
     *         in="query",
     *         description="max item in a page",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=10
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_search",
     *         in="query",
     *         description="word to search",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_dir",
     *         in="query",
     *         description="order by direction",
     *         required=false,
     *         @OA\Schema(
     *             type="object",
     *         )
     *     ),
     * )
     */
    public function by_count_employee(Request $request, $var)
    {
        $data   = $this->model_eloquent::selectRaw($var.' as category, COUNT(*) as count')
                ->groupBy($var)
                ->orderByDesc('count')
                ->get();
                        
        return json_encode(array('status'=>true, 'message'=>'Data berhasil diambil', 'data'=>$data));
    }

}
