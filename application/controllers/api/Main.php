<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model('Crud');
    }
	
	public function test_post()
	{
       
        $theCredential = $this->user_data;
        $this->response($theCredential, 200); // OK (200) being the HTTP response code
        
	}

    public function users_get()
    {
        $id = $this->get('id');

        if ($id == NULL)
        {
            $getUser = $this->Crud->readData('id,nama,username,role','table_user')->result();
            if ($getUser)
            {
                // setting response dan exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get user',
                    'data' => $getUser
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }
            else
            {
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No users were found',
                    'data' => []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND);
            }
        }

        if($id){
            $where = [
                'id'=>$id
            ];
            $getUserById = $this->Crud->readData('id,nama,username,role','table_user',$where)->result();

            if($getUserById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get user',
                    'data' => $getUserById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get User or Not Found',
                    'data' => []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND);
            }
        }

    }

    public function users_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_user',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "nama"      => $this->put('nama'),
                    "username"  => $this->put('username'),
                    "password"  => sha1($this->put('password')),
                    "role"      => $this->put('role')
                ];

                $updateData = $this->Crud->updateData('table_user',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit user',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit user',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete user or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function users_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_user',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('table_user',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete user',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete user or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }

    public function barang_post(){
        $tanggal = $this->post('tanggal');
        $nama_brg = $this->post('nama_brg');
        $merk_brg = $this->post('merk_brg');
        $jumlah_brg = $this->post('jumlah_brg');
        $harga_brg = $this->post('harga_brg');
        $total = $this->post('total');
        $pencatat =$this->post('pencatat');
        $role = $this->post('role');
        $status = $this->post('status');
    
        $data = [
            "tanggal"=>$tanggal,
            "nama_brg"=>$nama_brg,
            "merk_brg"=>$merk_brg,
            "jumlah_brg"=>$jumlah_brg,
            "harga_brg"=>$harga_brg,
            "total"=>$total,
            "pencatat"=>$pencatat,
            "role"=>$role,
            "status"=>$status,
        ];

        $createBarang = $this->Crud->createData('table_barang',$data);

        if($createBarang){
            $output = [
                'status' => 200,
                'error' => false,
                'message' => 'Success create barang',
                'data' => $data
            ];
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output = [
                'status' => 400,
                'error' => false,
                'message' => 'Failed create barang',
                'data' => []
            ];
            $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);

        }
    
    }
    public function barang_get(){
        $id = $this->get('id');

        if ($id == NULL)
        {
            $getBarang = $this->Crud->readData('id,tanggal,nama_brg,merk_brg,jumlah_brg,harga_brg,total,pencatat,role,status','table_barang')->result();
            if ($getBarang)
            {
                // setting response dan exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get barang',
                    'data' => $getBarang
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }
            else
            {
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No barang found',
                    'data' => []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND);
            }
        }

        if($id){
            $where = [
                'id'=>$id
            ];
            $getBarangById = $this->Crud->readData('id,tanggal,nama_brg,merk_brg,jumlah_brg,harga_brg,total,pencatat,role,status','table_barang',$where)->result();

            if($getBarangById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get barang',
                    'data' => $getBarangById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get barang or not found',
                    'data' => []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND);
            }
        }

    }

    public function barang_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_barang',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "tanggal"      => $this->put('tanggal'),
                    "nama_brg"      => $this->put('nama_brg'),
                    "merk_brg"      => $this->put('merk_brg'),
                    "jumlah_brg"      => $this->put('jumlah_brg'),
                    "harga_brg"      => $this->put('harga_brg'),
                    "total"      => $this->put('total'),
                    "pencatat"  => $this->put('pencatat'),
                    "role"      => $this->put('role'),
                    "status"      => $this->put('status')
                ];

                $updateData = $this->Crud->updateData('table_barang',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit barang',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit barang',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete barang or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function barang_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_barang',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('table_barang',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete barang',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete barang or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }

    public function barangbeli_post(){
        $tanggal = $this->post('tanggal');
        $nama_brg = $this->post('nama_brg');
        $merk_brg = $this->post('merk_brg');
        $jumlah_brg = $this->post('jumlah_brg');
        $harga_brg = $this->post('harga_brg');
        $total = $this->post('total');
        $owner =$this->post('owner');
        $status = $this->post('status');
    
        $data = [
            "tanggal"=>$tanggal,
            "nama_brg"=>$nama_brg,
            "merk_brg"=>$merk_brg,
            "jumlah_brg"=>$jumlah_brg,
            "harga_brg"=>$harga_brg,
            "total"=>$total,
            "owner"=>$owner,
            "status"=>$status,
        ];

        $createBarangBeli = $this->Crud->createData('table_barangbeli',$data);

        if($createBarangBeli){
            $output = [
                'status' => 200,
                'error' => false,
                'message' => 'Success create barang beli',
                'data' => $data
            ];
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output = [
                'status' => 400,
                'error' => false,
                'message' => 'Failed create barang beli',
                'data' => []
            ];
            $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);

        }
    
    }
    public function barangbeli_get(){
        $id = $this->get('id');

        if ($id == NULL)
        {
            $getBarangBeli = $this->Crud->readData('id,tanggal,nama_brg,merk_brg,jumlah_brg,harga_brg,total,owner,status','table_barangbeli')->result();
            if ($getBarangBeli)
            {
                // setting response dan exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get barang beli',
                    'data' => $getBarangBeli
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }
            else
            {
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No barang beli found',
                    'data' => []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND);
            }
        }

        if($id){
            $where = [
                'id'=>$id
            ];
            $getBarangBeliById = $this->Crud->readData('id,tanggal,nama_brg,merk_brg,jumlah_brg,harga_brg,total,owner,status','table_barangbeli',$where)->result();

            if($getBarangBeliById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get barang beli',
                    'data' => $getBarangBeliById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get barang beli or not found',
                    'data' => []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND);
            }
        }

    }

    public function barangbeli_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_barangbeli',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "tanggal"      => $this->put('tanggal'),
                    "nama_brg"      => $this->put('nama_brg'),
                    "merk_brg"      => $this->put('merk_brg'),
                    "jumlah_brg"      => $this->put('jumlah_brg'),
                    "harga_brg"      => $this->put('harga_brg'),
                    "total"      => $this->put('total'),
                    "owner"  => $this->put('owner'),
                    "status"      => $this->put('status')
                ];

                $updateData = $this->Crud->updateData('table_barangbeli',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit barang beli',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit barang beli',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete barang beli or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function barangbeli_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_barangbeli',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('table_barangbeli',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete barang beli',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete barang beli or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }

    public function barangterima_post(){
        $tanggal = $this->post('tanggal');
        $nama_brg = $this->post('nama_brg');
        $merk_brg = $this->post('merk_brg');
        $jumlah_brg = $this->post('jumlah_brg');
        $harga_brg = $this->post('harga_brg');
        $total = $this->post('total');
        $penerima =$this->post('penerima');
        $status = $this->post('status');
    
        $data = [
            "tanggal"=>$tanggal,
            "nama_brg"=>$nama_brg,
            "merk_brg"=>$merk_brg,
            "jumlah_brg"=>$jumlah_brg,
            "harga_brg"=>$harga_brg,
            "total"=>$total,
            "penerima"=>$penerima,
            "status"=>$status,
        ];

        $createBarangTerima = $this->Crud->createData('table_barangterima',$data);

        if($createBarangTerima){
            $output = [
                'status' => 200,
                'error' => false,
                'message' => 'Success create barang terima',
                'data' => $data
            ];
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output = [
                'status' => 400,
                'error' => false,
                'message' => 'Failed create barang terima',
                'data' => []
            ];
            $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);

        }
    
    }
    public function barangterima_get(){
        $id = $this->get('id');

        if ($id == NULL)
        {
            $getBarangTerima = $this->Crud->readData('id,tanggal,nama_brg,merk_brg,jumlah_brg,harga_brg,total,penerima,status','table_barangterima')->result();
            if ($getBarangTerima)
            {
                // setting response dan exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get barang terima',
                    'data' => $getBarangTerima
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }
            else
            {
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No barang terima found',
                    'data' => []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND);
            }
        }

        if($id){
            $where = [
                'id'=>$id
            ];
            $getBarangTerimaById = $this->Crud->readData('id,tanggal,nama_brg,merk_brg,jumlah_brg,harga_brg,total,penerima,status','table_barangterima',$where)->result();

            if($getBarangTerimaById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get barang terima',
                    'data' => $getBarangTerimaById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get barang terima or not found',
                    'data' => []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND);
            }
        }

    }

    public function barangterima_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_barangterima',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "tanggal"      => $this->put('tanggal'),
                    "nama_brg"      => $this->put('nama_brg'),
                    "merk_brg"      => $this->put('merk_brg'),
                    "jumlah_brg"      => $this->put('jumlah_brg'),
                    "harga_brg"      => $this->put('harga_brg'),
                    "total"      => $this->put('total'),
                    "penerima"  => $this->put('penerima'),
                    "status"      => $this->put('status')
                ];

                $updateData = $this->Crud->updateData('table_barangterima',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit barang terima',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit barang terima',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete barang terima or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function barangterima_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_barangterima',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('table_barangterima',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete barang terima',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete barang terima or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }


    public function accept_post(){
        $id = (int) $this->get('id');
        $where = [
            'id'=>$id
        ];
        $getdetailpermohonan = $this->Crud->readData('*','table_barang',$where)->result_array();

        if($getdetailpermohonan){

        $data = [
            "tanggal"=>$getdetailpermohonan[0]['tanggal'],
            "nama_brg"=>$getdetailpermohonan[0]['nama_brg'],
            "merk_brg"=>$getdetailpermohonan[0]['merk_brg'],
            "jumlah_brg"=>$getdetailpermohonan[0]['jumlah_brg'],
            "harga_brg"=>$getdetailpermohonan[0]['harga_brg'],
            "total"=>$getdetailpermohonan[0]['total'],
            "status"=>'Accepted',
        ];
            $createBarang = $this->Crud->createData('table_barangbeli',$data);

                    if($createBarang){
                        $this->Crud->deleteData('table_barang',$where);

                        $output = [
                            'status' => 200,
                            'error' => false,
                            'message' => 'Success accept permohonan barang',
                            'data' => $data
                        ];
                        $this->set_response($output, REST_Controller::HTTP_OK);
                    }else{
                        $output = [
                            'status' => 400,
                            'error' => false,
                            'message' => 'Failed accept permohonan barang',
                            'data' => []
                        ];
                        $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);

                    }

        } 
        else{
            $output = [
                'status' => 404,
                'error' => false,
                'message' => 'Failed id not found',
            ];
            $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
        }


    
    }
    public function decline_post(){
        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','table_barang',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('table_barang',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success decline permohonan',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed decline permohonan',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    
    }
}
