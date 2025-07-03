<?php

namespace App\Http\Controllers;
// use App\Models\Option;
// use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class CMSController extends Controller
{
    use ValidatesRequests;
    const admins = [1,2];

    // -------------------- START:employee --------------------
        public function prepare_employee(){
            $object     = 'employee';
            $statuses   = [];
            $types   = [];

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
                        'var_name_parent'=>'status_attr',
                        'var_name_child'=>'label',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'select',
                            'label'=>'label',
                            'id'=>'value',
                            'options'=>$statuses,
                        ],
                    ],
                    [
                        'type'=>'link',
                        'label'=>'Nama',
                        'var_name'=>'name',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                        'style'=>'min-width:200px;'
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
                        'label'=>'Jabatan',
                        'var_name'=>'position',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Golongan',
                        'var_name'=>'rank_group',
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
                                'options'=>$statuses,
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
