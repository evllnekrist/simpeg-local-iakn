<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class EmployeeController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class EmployeeController extends APIController
{
    protected $model = 'Employee';
    /**
     * @OA\Get(
     *     path="/api/employee",
     *     tags={"Pegawai - CRUD"},
     *     summary="Display a listing of items",
     *     operationId="employeeIndex",
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
        $filter['equal']  = ['jenis_kelamin','agama','status_perkawinan','jenis_pegawai','status_kepegawaian','jenis_jabatan','jabatan','pendidikan_terakhir','penempatan'];
        $filter['search'] = ['nip','nik','nama','tempat_lahir','tanggal_lahir','hp','email','alamat','kelurahan','kecamatan','kabupaten','provinsi','kode_pos','jabatan_terakhir','nip_atasan','tmpt_nip','tmt','karpeg','karis','kpe','taspen','npwp','nuptk','nidn','no_rekening','bank_rekening'];
        $filter['multi_search'] = ['golongan_ruang'];
        return $this->get_list_common($request, $this->model, $filter, ['pangkat_golongan', 'jenis_jabatan', 'jabatan', 'penempatan']); 
    }

    /**
     * @OA\Employee(
     *     path="/api/employee",
     *     tags={"Pegawai - CRUD"},
     *     summary="Store a newly created item",
     *     operationId="employeeStore",
     *     @OA\MediaType(mediaType="multipart/form-data"),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example=""
     *                 ),
     *                 required={}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function store(Request $request)
    {
        $rules = [
            // 'title' => 'required'
        ];
        return $this->post_common($request, $this->model, $rules, ['img_specimen']);
    }

    /**
     * @OA\Get(
     *     path="/api/employee/{id}",
     *     tags={"Pegawai - CRUD"},
     *     summary="Display the specified item",
     *     operationId="employeeShow",
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

    /**
     * @OA\Employee(
     *     path="/api/employee/{id}",
     *     tags={"Pegawai - CRUD"},
     *     summary="Update the specified item",
     *     operationId="employeeUpdate",
     *     @OA\MediaType(mediaType="multipart/form-data"),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Identifier of item that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="clean-eating"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example=""
     *                 ),
     *                 required={}
     *             )
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $rules = [];
        return $this->put_common($request, $id, $this->model, $rules, ['img_specimen']);

    }
    
    /**
     * @OA\Delete(
     *     path="/api/employee/{id}",
     *     tags={"Pegawai - CRUD"},
     *     summary="Remove the specified item",
     *     operationId="employeeDestroy",
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
     *         description="Identifier of item that needs to be removed",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     security={{"passport_token_ready":{},"passport":{}}}
     * )
     */
    public function destroy($id)
    {
        return $this->delete_common($id, $this->model, []);
    }
}
