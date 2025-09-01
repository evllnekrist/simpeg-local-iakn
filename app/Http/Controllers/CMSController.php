<?php

namespace App\Http\Controllers;
use App\Models\Option;
// use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class CMSController extends Controller
{
    use ValidatesRequests;
    const admins = [1,2];

    // -------------------- START:employee --------------------
        public function prepare_employee(){
            $object                     = 'employee';
            $status_list                = Option::where('type','STATUS_PEGAWAI')->get();
            $jenis_list                 = Option::where('type','JENIS_PEGAWAI')->get();
            $status_kepegawaian_list    = Option::where('type','STATUS_KEPEGAWAIAN')->get();
            $jenis_kelamin_list         = Option::where('type','JENIS_KELAMIN')->get();
            $status_perkawinan_list     = Option::where('type','STATUS_PERKAWINAN')->get();
            $agama_list                 = Option::where('type','AGAMA')->get();
            $pangkat_golongan_list      = app('App\Models\PangkatGolongan')->get();
            $jenis_jabatan_list         = app('App\Models\JenisJabatan')->get();
            $jabatan_list               = app('App\Models\Jabatan')->get();

            $conf       =
            [
                'object'=>$object,
                'pk'=>app('App\Models\Pegawai')->getKeyName(),
                'breadcrumbs'=>[
                    ['label'=>'Pegawai (TTE)','url'=>route($object)],
                ],
                'btn_add'=>[
                    'label'=>'Tambah Pegawai (TTE)',
                    'link'=>url($object.'/add'),
                ],
                'columns'=>[
                    [
                        'type'=>'seq_number',
                        'label'=>'No',
                        'var_name'=>'id',
                        'is_order'=>true,
                    ],
                    [
                        'label'=>'Status',
                        'var_name'=>'status',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'select',
                            'label'=>'label',
                            'id'=>'value',
                            'options'=>$status_list,
                        ],
                    ],
                    [
                        'type'=>'link',
                        'label'=>'Nama',
                        'var_name'=>'nama',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                        'style'=>'min-width:200px;',
                        'class'=>'text-sky-500'
                    ],
                    [
                        'label'=>'NIK',
                        'var_name'=>'nik',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'NIP',
                        'var_name'=>'nip',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Jenis Pegawai',
                        'var_name'=>'jenis_pegawai',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'select',
                            'label'=>'label',
                            'id'=>'value',
                            'options'=>$jenis_list,
                        ],
                    ],
                    [
                        'label'=>'Status Kepegawaian',
                        'var_name'=>'status_kepegawaian',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'select',
                            'label'=>'label',
                            'id'=>'value',
                            'options'=>$status_kepegawaian_list,
                        ],
                    ],
                    [
                        'label'=>'Pangkat/ Golongan',
                        'var_name'=>'golongan_ruang',
                        'var_name_parent'=>'pangkat_golongan',
                        'var_name_child'=>'combined',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'select',
                            'label'=>'combined',
                            'id'=>'combined',
                            'options'=>$pangkat_golongan_list,
                        ],
                    ],
                    [
                        'label'=>'Kelas Jabatan',
                        'var_name'=>'kelas_jabatan',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'number'
                        ],
                    ],
                    [
                        'label'=>'Jenis Jabatan',
                        'var_name'=>'jenis_jabatan',
                        'var_name_parent'=>'jenis_jabatan',
                        'var_name_child'=>'nama',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'select',
                            'label'=>'nama',
                            'sublabel'=>'keterangan',
                            'id'=>'kode',
                            'options'=>$jenis_jabatan_list,
                        ],
                    ],
                    [
                        'label'=>'Jabatan',
                        'var_name'=>'jabatan',
                        'var_name_parent'=>'jabatan',
                        'var_name_child'=>'nama',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'select',
                            'label'=>'nama',
                            'sublabel'=>'kategori',
                            'id'=>'kode',
                            'options'=>$jabatan_list,
                        ],
                    ],
                    [
                        'label'=>'Jabatan Terakhir',
                        'var_name'=>'jabatan_terakhir',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                ],
                'inputs'=> [
                    [
                        [
                            'label'=>'Status Jabatan',
                            'var_name'=>'status',
                            'type'=>'select',
                            'select_attr'=>[
                                'label'=>'label',
                                'id'=>'value',
                                'options'=>$status_list,
                            ],
                        ],
                        // [
                        //     'label'=>'Tipe Surat',
                        //     'var_name'=>'letter_type',
                        //     'type'=>'select',
                        //     'select_attr'=>[
                        //         'label'=>'label',
                        //         'id'=>'value',
                        //         'options'=>$types,
                        //     ],
                        // ],
                        [
                            'label'=>'Nama',
                            'sublabel'=>'Dengan gelar, sesuai format penandatanganan pada umumnya',
                            'var_name'=>'name',
                            'type'=>'text',
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'NIK',
                            'var_name'=>'nik',
                            'type'=>'text',
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'NIP',
                            'var_name'=>'nip',
                            'type'=>'text',
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'Jabatan',
                            'var_name'=>'position',
                            'type'=>'text',
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'Golongan',
                            'var_name'=>'rank_group',
                            'type'=>'text',
                            'is_required'=>true,
                        ],
                    ],
                    [
                        [
                            'label'=>'Spesimen TTE',
                            'var_name'=>'img_specimen',
                            'type'=>'file',
                            'file_attr'=>[
                                'accept'=>'img'
                            ],
                            'is_required'=>true,
                        ],
                    ],
                ],
            ];
            // var_dump(Auth::user());die();
            if(Auth::check() && in_array(Auth::user()->role_id, self::admins)){
                array_push($conf['columns'],
                [
                    'type'=>'action',
                    'label'=>'Action',
                    'var_name'=>'id',
                    'is_deletable'=>true
                ]);
            }
            return $conf;
        }

        public function index_employee(){
            $data = $this->prepare_employee();
            $data['breadcrumbs'][1] = ['label'=>'Daftar Data'];
            return view('pages.default.index',['page_conf'=>$data]);
        }

        public function form_add_employee(){
            $data = $this->prepare_employee();
            $data['breadcrumbs'][1] = ['label'=>'Tambah'];
            return view('pages.default.add',['page_conf'=>$data]);
        }

        public function form_edit_employee($id){
            $data = $this->prepare_employee();
            $data['breadcrumbs'][1] = ['label'=>'Edit'];
            $data['selected'] = ('App\Models\Employee')::find($id);
            $data['id'] = $id;
            return view('pages.default.edit',['page_conf'=>$data]);
        }
    // ---------------------- END:employee --------------------
}
