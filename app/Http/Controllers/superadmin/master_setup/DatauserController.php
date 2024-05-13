<?php

namespace App\Http\Controllers\superadmin\master_setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Traits\notif_sidebar;

class DatauserController extends Controller
{

    use notif_sidebar;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->User = new User();
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        
        $data = [
            'users' => $this->User->getPaginateUser($keyword),
        ];

        return view('superadmin.master_setup.data_user', $data, $this->approval_pending());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_user' => 'required',
                'username_user' => 'required|unique:users,username',
                'password' =>'required',
                'role'  => 'required',
                'id_karyawan'  => 'required',
                'status_user'  => 'required',
            ],
            [
                'nama_user.required'        => 'Nama tidak boleh kosong!',
                'username_user.required'    => 'Username tidak boleh kosong!',
                'username_user.unique'    => 'Username sudah ada!',
                'password.required'         => 'Password tidak boleh kosong!',
                'role.required'             => 'Role tidak boleh kosong!',
                'status_user.required'      => 'Status user tidak boleh kosong!',
            ]
        );

        $data = [
            'name' => $request->input('nama_user'),
            'id_karyawan' => $request->input('id_karyawan'),
            'username' => $request->input('username_user'),
            'password' => Hash::make($request->input('password')),
            'aktif' => $request->input('status_user'),
            'level' => $request->input('role'),
            'created_at' => \Carbon\Carbon::now(),
        ];

        if ($this->User->insert_datauser($data)) {
            return redirect('/master_setup/data_user')->with('toast_success', 'Berhasil Tambah User');
        } else {
            return redirect('/master_setup/data_user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];
            if($request->input('username_user_edit') != $request->input('old_username_edit')){
                $this->validate($request, 
                    [
                        'nama_user_edit' => 'required',
                        'username_user_edit' => 'required|unique:users,username',
                        'role_user_edit'  => 'required',
                        'status_user_edit'  => 'required',
                        'kuota_cuti_edit'  => 'required',
                    ],
                    [
                        'nama_user_edit.required' => 'Nama tidak boleh kosong',
                        'username_user_edit.required' => 'Username tidak boleh kosong',
                        'username_user_edit.unique' => 'Username sudah ada!',
                        'password_edit.required' => 'Password tidak boleh kosong',
                        'role_user_edit.required' => 'Role tidak boleh kosong',
                        'status_user_edit.required' => 'Status user tidak boleh kosong',
                        'kuota_cuti_edit.required' => 'Status user tidak boleh kosong',
                    ]
                );

                $data = [
                    'name' => $request->input('nama_user_edit'),
                    'username' => $request->input('username_user_edit'),
                    'aktif' => $request->input('status_user_edit'),
                    'level' => $request->input('role_user_edit'),
                    'kuota_cuti' => $request->input('kuota_cuti_edit'),
                ];

            } else {
                $this->validate($request, 
                    [
                        'nama_user_edit' => 'required',
                        'role_user_edit'  => 'required',
                        'status_user_edit'  => 'required',
                        'kuota_cuti_edit'  => 'required',
                    ],
                    [
                        'nama_user_edit.required' => 'Nama tidak boleh kosong',
                        'username_user_edit.required' => 'Username tidak boleh kosong',
                        'username_user_edit.unique' => 'Username sudah ada!',
                        'password_edit.required' => 'Password tidak boleh kosong',
                        'role_user_edit.required' => 'Role tidak boleh kosong',
                        'status_user_edit.required' => 'Status user tidak boleh kosong',
                        'kuota_cuti_edit.required' => 'Status user tidak boleh kosong',
                    ]
                );

                $data = [
                    'name' => $request->input('nama_user_edit'),
                    'aktif' => $request->input('status_user_edit'),
                    'level' => $request->input('role_user_edit'),
                    'kuota_cuti' => $request->input('kuota_cuti_edit'),
                ];
            }
        if ($this->User->update_user($data, $id)) {
            return redirect('/master_setup/data_user')->with('toast_success', 'Berhasil Edit User');
        } else {
            return redirect('/master_setup/data_user');
        }
    }

    public function update_password(Request $request, $id)
    {
        $this->validate( $request,
            [
                'new_password'   => 'required|confirmed'
            ],
            [
                'new_password.required'     => 'password tidak boleh kosong',
                'new_password.confirmed'    => 'konfirmasi password harus sesuai dengan password baru'
            ]
        );

        $data = [
            'password'      => Hash::make($request->input('new_password')),
        ];

        if ($this->User->update_user($data, $id)) {
            return redirect('/master_setup/data_user')->with('toast_success', 'Berhasil Password User');
        } else {
            return redirect('/master_setup/data_user');
        }
    }

    public function destroy($id)
    {
        $this->User->delete_datauser($id);
        return redirect('/master_setup/data_user')->with('toast_success', 'Berhasil Hapus Pengguna');
    }
}
