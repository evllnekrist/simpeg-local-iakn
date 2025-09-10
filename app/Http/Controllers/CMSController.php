<?php

namespace App\Http\Controllers;
use App\Models\Option;
// use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class CMSController extends Controller
{

    /* TEMPORARY CHEAT SHEET
    
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
                        [
                            'label'=>'Tipe Surat',
                            'var_name'=>'letter_type',
                            'type'=>'select',
                            'select_attr'=>[
                                'label'=>'label',
                                'id'=>'value',
                                'options'=>$types,
                            ],
                        ],
                        [
                            'label'=>'Nama',
                            'sublabel'=>'Dengan gelar, sesuai format penandatanganan pada umumnya',
                            'var_name'=>'name',
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
    
    */
    use ValidatesRequests;
    const admins = [1,2];

    // -------------------- START:employee --------------------
        public function prepare_employee(){
            $object                     = 'employee';
            $model                      = 'Pegawai';
            $status_list                = Option::where('type','STATUS_PEGAWAI')->get();
            $jenis_list                 = Option::where('type','JENIS_PEGAWAI')->get();
            $status_kepegawaian_list    = Option::where('type','STATUS_KEPEGAWAIAN')->get();
            $jenis_kelamin_list         = Option::where('type','JENIS_KELAMIN')->get();
            $status_perkawinan_list     = Option::where('type','STATUS_PERKAWINAN')->get();
            $agama_list                 = Option::where('type','AGAMA')->get();
            $pendidikan_list            = Option::where('type','TINGKAT_PENDIDIKAN')->get();
            $pangkat_golongan_list      = app('App\Models\PangkatGolongan')->get();
            $jenis_jabatan_list         = app('App\Models\JenisJabatan')->get();
            $jabatan_list               = app('App\Models\Jabatan')->get();
            $penempatan_list            = app('App\Models\Penempatan')->get();
            $provinsi_list              = app('App\Models\IndonesianProvince')->get();
            // $kabupaten_list              = app('App\Models\IndonesianCity')->get();
            // $kecamatan_list              = app('App\Models\IndonesianDistrict')->get();
            // $kelurahan_list              = app('App\Models\IndonesianVillage')->get();

            $conf       =
            [
                'object'=>$object,
                'model'=>$model,
                'pk'=>app('App\Models\\'.$model)->getKeyName(),
                'breadcrumbs'=>[
                    ['label'=>'Pegawai','url'=>route($object)],
                ],
                'btn_add'=>[
                    'label'=>'Tambah Pegawai',
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
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'color',
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
                        'class'=>'font-light text-sky-500 hover:text-yellow-500'
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
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'color',
                            'label'=>'label',
                            'id'=>'value',
                            'options'=>$jenis_list,
                        ],
                    ],
                    [
                        'label'=>'Status Kepegawaian',
                        'var_name'=>'status_kepegawaian',
                        'is_order'=>true,
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'color',
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
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'warna',
                            'label'=>'combined',
                            'id'=>'combined',
                            'options'=>$pangkat_golongan_list,
                        ],
                    ],
                    [
                        'label'=>'Kelas Jabatan',
                        'var_name'=>'kelas_jabatan',
                        'is_order'=>true,
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'number',
                            'color'=>'#00a8f4',
                            'max'=>15,
                            'dir'=>'DESC' // lebih besar angka, tingkatan lebih tinggi
                        ],
                    ],
                    [
                        'label'=>'Jenis Jabatan',
                        'var_name'=>'jenis_jabatan',
                        'var_name_parent'=>'jenis_jabatan',
                        'var_name_child'=>'nama',
                        'is_order'=>true,
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'warna',
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
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'warna',
                            'label'=>'nama',
                            'sublabel'=>'kategori',
                            'id'=>'kode',
                            'options'=>$jabatan_list,
                        ],
                    ],
                    [
                        'label'=>'Penempatan',
                        'var_name'=>'penempatan',
                        'var_name_parent'=>'penempatan',
                        'var_name_child'=>'nama',
                        'is_order'=>true,
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'warna',
                            'label'=>'nama',
                            'id'=>'id',
                            'options'=>$penempatan_list,
                        ],
                    ],
                    [
                        'label'=>'Tugas Tambahan',
                        'var_name'=>'tugas_tambahan',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
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
                    [
                        'label'=>'Tempat Lahir',
                        'var_name'=>'tempat_lahir',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Tanggal Lahir',
                        'var_name'=>'tanggal_lahir',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Jenis Kelamin',
                        'var_name'=>'jenis_kelamin',
                        'is_order'=>true,
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'color',
                            'label'=>'label',
                            'id'=>'value',
                            'options'=>$jenis_kelamin_list,
                        ],
                    ],
                    [
                        'label'=>'Agama',
                        'var_name'=>'agama',
                        'is_order'=>true,
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'color',
                            'label'=>'label',
                            'id'=>'value',
                            'options'=>$agama_list,
                        ],
                    ],
                    [
                        'label'=>'Status Perkawinan',
                        'var_name'=>'status_perkawinan',
                        'is_order'=>true,
                        'is_categorial'=>true,
                        'search'=>[
                            'type'=>'select',
                            'color'=>'color',
                            'label'=>'label',
                            'id'=>'value',
                            'options'=>$status_perkawinan_list,
                        ],
                    ],
                    [
                        'label'=>'HP',
                        'var_name'=>'hp',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Email',
                        'var_name'=>'email',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Alamat',
                        'var_name'=>'alamat',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                ],
                'inputs' => [
                    [
                        'label' => 'Identitas Dasar',
                        'elements' =>
                        [
                            // -- Identitas dasar
                            [
                                'label'     => 'Status',
                                'var_name'  => 'status',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'label'   => 'label',
                                    'id'      => 'value',
                                    'options' => $status_list, 
                                ],
                            ],
                            [
                                'label'     => 'NIP',
                                'var_name'  => 'nip',
                                'type'      => 'text',
                                'class'     => 'numeric nospace',
                                'min'       => 18,
                                'max'       => 20,
                            ],
                            [
                                'label'     => 'NIK',
                                'var_name'  => 'nik',
                                'type'      => 'text',
                                'class'     => 'numeric nospace',
                                'min'       => 16,
                                'max'       => 20,
                            ],
                            [
                                'label'     => 'Nama',
                                'var_name'  => 'nama',
                                'type'      => 'text',
                            ],
                            [
                                'label'     => 'Tempat Lahir',
                                'var_name'  => 'tempat_lahir',
                                'type'      => 'text',
                                'max'       => 255,
                            ],
                            [
                                'label'     => 'Tanggal Lahir',
                                'var_name'  => 'tanggal_lahir',
                                'type'      => 'date',
                            ],
                            [
                                'label'     => 'Jenis Kelamin',
                                'var_name'  => 'jenis_kelamin',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'label'   => 'label',
                                    'id'      => 'value',
                                    'options' => $jenis_kelamin_list,
                                ],
                            ],
                            [
                                'label'     => 'Agama',
                                'var_name'  => 'agama',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'label'   => 'label',
                                    'id'      => 'value',
                                    'options' => $agama_list,
                                ],
                            ],
                            [
                                'label'     => 'Status Perkawinan',
                                'var_name'  => 'status_perkawinan',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'label'   => 'label',
                                    'id'      => 'value',
                                    'options' => $status_perkawinan_list,
                                ],
                            ],
                            [
                                'label'     => 'HP',
                                'var_name'  => 'hp',
                                'type'      => 'text',
                                'class'     => 'numeric nospace',
                                'min'       => 9,
                                'max'       => 15,
                            ],
                            [
                                'label'     => 'Email',
                                'var_name'  => 'email',
                                'type'      => 'email',
                            ],
                            [
                                'label'     => 'Alamat',
                                'var_name'  => 'alamat',
                                'type'      => 'textarea',
                            ],
                            [
                                'label'     => 'Provinsi',
                                'var_name'  => 'provinsi',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'label'   => 'name',
                                    'id'      => 'code',
                                    'options' => $provinsi_list,
                                ],
                            ],
                            [
                                'label'     => 'Kabupaten/Kota',
                                'var_name'  => 'kabupaten',
                                'type'      => 'select_by_parent',
                                'var_name_parent' => 'provinsi',
                                // 'select_attr'=>[
                                //     'label'   => 'nama',
                                //     'id'      => 'id',
                                //     'options' => $kabupaten_list,
                                // ],
                            ],
                            [
                                'label'     => 'Kecamatan',
                                'var_name'  => 'kecamatan',
                                'type'      => 'select_by_parent',
                                'var_name_parent' => 'kabupaten',
                                // 'select_attr'=>[
                                //     'label'   => 'nama',
                                //     'id'      => 'id',
                                //     'options' => $kecamatan_list,
                                // ],
                            ],
                            [
                                'label'     => 'Kelurahan',
                                'var_name'  => 'kelurahan',
                                'type'      => 'select_by_parent',
                                'var_name_parent' => 'kecamatan',
                                // 'select_attr'=>[
                                //     'label'   => 'nama',
                                //     'id'      => 'id',
                                //     'options' => $kelurahan_list,
                                // ],
                            ],
                            [
                                'label'     => 'Kode Pos',
                                'var_name'  => 'kode_pos',
                                'type'      => 'text',
                                'class'     => 'numeric nospace',
                                'max'       => 10,
                            ],
                        ],
                    ],
                    [
                        'label' => 'Kepegawaian',
                        'elements' =>
                        [
                            // -- Kepegawaian
                            [
                                'label'     => 'Jenis Pegawai',
                                'var_name'  => 'jenis_pegawai',
                                'type'      => 'select',
                                'select_attr'=>[
                                'label'   => 'label',
                                'id'      => 'value',
                                'options' => $jenis_list,
                                ],
                            ],
                            [
                                'label'     => 'Status Kepegawaian',
                                'var_name'  => 'status_kepegawaian',
                                'type'      => 'select',
                                'select_attr'=>[
                                'label'   => 'label',
                                'id'      => 'value',
                                'options' => $status_kepegawaian_list,
                                ],
                            ],
                            [
                                'label'     => 'Golongan Ruang',
                                'var_name'  => 'golongan_ruang',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'label'      => 'combined',
                                    'id'      => 'combined',
                                    'options' => $pangkat_golongan_list,
                                ],
                            ],
                            [
                                'label'     => 'Kelas Jabatan',
                                'var_name'  => 'kelas_jabatan',
                                'type'      => 'text',
                                'class'     => 'numeric nospace',
                                'max'       => 15,
                            ],
                            [
                                'label'     => 'Jenis Jabatan',
                                'var_name'  => 'jenis_jabatan',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'id'        => 'kode',
                                    'label'     => 'nama',
                                    'options'   => $jenis_jabatan_list,
                                ],
                            ],
                            [
                                'label'     => 'Jabatan',
                                'var_name'  => 'jabatan',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'id'        => 'kode',
                                    'label'     => 'nama',
                                    'options'   => $jabatan_list,
                                ],
                            ],
                            [
                                'label'     => 'Pendidikan Terakhir',
                                'var_name'  => 'pendidikan_terakhir',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'label'   => 'label',
                                    'id'      => 'value',
                                    'options' => $pendidikan_list,
                                ],
                            ],
                            [
                                'label'     => 'Jabatan Terakhir',
                                'var_name'  => 'jabatan_terakhir',
                                'type'      => 'textarea',
                            ],
                            [
                                'label'     => 'Penempatan',
                                'var_name'  => 'penempatan',
                                'type'      => 'select',
                                'select_attr'=>[
                                    'label'   => 'nama',
                                    'id'      => 'id',
                                    'options' => $penempatan_list,
                                ],
                            ],
                            [
                                'label'     => 'NIP Atasan',
                                'var_name'  => 'nip_atasan',
                                'type'      => 'text',
                                'class'     => 'numeric nospace',
                                'min'       => 18,
                                'max'       => 20,
                            ],
                            [
                                'label'     => 'TMT NIP',
                                'var_name'  => 'tmt_nip',
                                'type'      => 'date',
                            ],
                            [
                                'label'     => 'TMT Jabatan',
                                'var_name'  => 'tmt',
                                'type'      => 'date',
                            ],
                            // -- Dokumen / Nomor Identitas Lain
                            [
                                'label'     => 'Kartu Pegawai (Karpeg)',
                                'var_name'  => 'karpeg',
                                'type'      => 'text',
                                'class'     => 'nospace',
                                'max'       => 20,
                            ],
                            [
                                'label'     => 'Karis/Karsu',
                                'var_name'  => 'karis',
                                'type'      => 'text',
                                'class'     => 'nospace',
                                'max'       => 20,
                            ],
                            [
                                'label'     => 'KPE',
                                'var_name'  => 'kpe',
                                'type'      => 'text',
                                'class'     => 'nospace',
                                'max'       => 20,
                            ],
                            [
                                'label'     => 'Taspen',
                                'var_name'  => 'taspen',
                                'type'      => 'text',
                                'class'     => 'nospace',
                                'max'       => 20,
                            ],
                            [
                                'label'     => 'NPWP',
                                'var_name'  => 'npwp',
                                'type'      => 'text',
                                'class'     => 'nospace',
                                'max'       => 20,
                            ],
                            [
                                'label'     => 'NUPTK',
                                'var_name'  => 'nuptk',
                                'type'      => 'text',
                                'class'     => 'nospace',
                                'max'       => 20,
                            ],
                            [
                                'label'     => 'NIDN',
                                'var_name'  => 'nidn',
                                'type'      => 'text',
                                'class'     => 'nospace',
                                'max'       => 20,
                            ],
                            // -- Rekening
                            [
                                'label'     => 'No. Rekening',
                                'var_name'  => 'no_rekening',
                                'type'      => 'text',
                                'class'     => 'numeric nospace',
                                'max'       => 50,
                            ],
                            [
                                'label'     => 'Bank Rekening',
                                'var_name'  => 'bank_rekening',
                                'type'      => 'text',
                            ],
                        ]
                    ]
                ],
            ];
            // var_dump(Auth::user());die();
            if(Auth::check() && in_array(Auth::user()->role_id, self::admins)){
                array_push($conf['columns'],
                [
                    'type'=>'action',
                    'label'=>'Action',
                    'var_name'=>'id',
                    'visibility_edit'=>false
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
            $data['selected'] = ('App\Models\\'.$data['model'])::find($id);
            $data['id'] = $id;
            return view('pages.default.edit',['page_conf'=>$data]);
        }
    // ---------------------- END:employee --------------------
    // -------------------- START:statistic -------------------
        public function index_statistic()
        {
            $emp = $this->prepare_employee();
            return view('pages.statistic.index',['emp'=>$emp]);
        }
    // ---------------------- END:statistic -------------------
}
