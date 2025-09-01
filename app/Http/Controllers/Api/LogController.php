<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class LogController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class LogController extends APIController
{
    protected $model = 'Log';
    /**
     * @OA\Get(
     *     path="/api/log",
     *     tags={"Log - CRUD"},
     *     summary="Display a listing of items",
     *     operationId="logIndex",
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
    public function index(Request $request)
    {
        if(!$request->get('_dir')){
            $request->merge(['_dir' => array('id'=>'DESC')]); 
        }
        // $filter['equal']        = [];
        $filter['search']       = ['subject'];
        $filter['search_jsonb'] = ['request'=>'message','response'=>'message'];
        return $this->get_list_common($request, $this->model, $filter, []); 
    }

    /**
     * @OA\Get(
     *     path="/api/log/{id}",
     *     tags={"Log - CRUD"},
     *     summary="Display the specified item",
     *     operationId="logShow",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Identifier of item that needs to be displayed",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     */
    public function show($id)
    {
        return $this->get_single_common($id, $this->model, []);
    }
}
