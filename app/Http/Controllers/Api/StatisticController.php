<?php

namespace App\Http\Controllers\API;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
    protected $meta_act_eloquent            = 'App\Models\MetaActivity';
    protected $job_chart_eloquent           = 'App\Models\JobChart';
    protected $job_chart_dtl_eloquent       = 'App\Models\JobChartDetail';
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
        $data           = $this->model_eloquent::selectRaw($var.' as category, COUNT(*) as count')
                            ->groupBy($var)
                            ->orderByDesc('count')
                            ->get();
        $target         = $this->model_eloquent::count(); // supertotal 
        $last_activity  = $this->meta_act_eloquent::getLastActivity($this->model);
                        
        return json_encode(array('status'=>true, 'message'=>'Data berhasil diambil', 'data'=>$data, 'target'=> $target, 'last_activity'=>$last_activity));
    }

    private function org_chart_flatten_node($node, Collection $out): void
    {
        // Map details ke rows
        $rows = $node->details->map(function ($d) {
            return [
                'jabatan' => $d->jabatan,
                'kls'     => (int) $d->kls,
                'b'       => (int) $d->b,
                'k'       => (int) $d->k,
                'delta'   => (int) $d->delta,
            ];
        })->values();

        // Dorong satu item seperti contohmu
        $item = [
            'id'        => $node->id,
            'title'     => $node->title,
            'subtitle'  => $node->subtitle,
            'rows'      => $rows,
        ];
        if (!is_null($node->parent_id)) {
            $item['parentId'] = $node->parent_id; // camelCase seperti contoh
        }

        $out->push($item);

        // Lanjut ke anak-anak (urut pakai relasi children())
        foreach ($node->children as $child) {
            $this->org_chart_flatten_node($child, $out);
        }
    }

    public function org_chart(Request $request)
    {
        $last_activity  = $this->meta_act_eloquent::getLastActivity($this->job_chart_eloquent);
        $roots = $this->job_chart_eloquent::with([
                'details',
                'children.details',
                // 'children.children.details', // kalau perlu lebih dari 2 level, tambah lagi atau buat recursive eager
            ])
            ->whereNull('parent_id')
            ->orderBy('position') // ->orderBy('id')
            ->get();
        // echo "\n-------- 1 ---------\n";
        // echo "<pre>";
        // print_r($roots->values()->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        // echo "</pre>";
        // Flatten: DFS dari root → anak → cucu, setiap node menjadi satu object
        $out = collect();
        foreach ($roots as $root) {
            $this->org_chart_flatten_node($root, $out);
        }
                        
        return json_encode(array('status'=>true, 'message'=>'Data berhasil diambil', 'data'=>$out->values(), 'last_activity'=>$last_activity));
    }

}
