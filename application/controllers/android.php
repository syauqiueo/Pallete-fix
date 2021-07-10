<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Android extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->library('form_validation');
}

  public function index(){

    if($this->session->userdata('token') == ''){
      return redirect(base_url('android/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | Home'
        ];

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar_android');
        $this->load->view('layout/navbar');
        $this->load->view('home');
        $this->load->view('layout/footer');
      }
    }
  }

  public function login(){
    if($this->session->userdata('token')){
      return redirect(base_url('android'));
    }
    $this->load->view('login_android');
  }

  public function prosesLogin(){
    $url = base_url('/api/auth/login');

		$username = $this->input->post('username');
		$password = $this->input->post('password');

    $data = array(
            'username'      => $username,
            'password' => $password 
    );

    $data_string = json_encode($data);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

    // Send the request
    $result = curl_exec($curl);

    // Free up the resources $curl is using
    curl_close($curl);

    $cekLogin = json_decode($result,true);

    if(isset($cekLogin['status'])){
      echo ("<script LANGUAGE='JavaScript'>
          window.alert('Invalid Login');
          window.location.href='".base_url('android/login')."';
          </script>");
      return;
    }
    if(isset($cekLogin['token'])){
      if($cekLogin['role'] == 'barista' || $cekLogin['role'] == 'cashier' || $cekLogin['role'] == 'kitchen'){
        $this->session->set_userdata('token', $cekLogin['token']);
        $this->session->set_userdata('username', $username);
        $this->session->set_userdata('isLoginAdmin', true);
        return redirect(base_url('android'));
      }else{
        $this->session->set_userdata('isLoginAdmin', true);
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('You dont have access');
        window.location.href='".base_url('android/login')."';
        </script>");
        return;
      }
    }
   
  }

  public function logout(){
    if($this->session->userdata('token')){
      session_destroy();
    }
    return redirect(base_url('android/login'));
  }

  
  public function list_barang(){

    if($this->session->userdata('token') == ''){
      return redirect(base_url('android/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | User'
        ];

    $url = base_url('/api/main/barang');
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer '.$this->session->userdata('token')
      )
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    // Send the request
    $result = curl_exec($curl);
    // Free up the resources $curl is using
    curl_close($curl);

    $getBarang = json_decode($result,true);
    $barang['databarang'] = $getBarang['data'];

    $this->load->view('layout/header');
    $this->load->view('layout/sidebar_android');
    $this->load->view('layout/navbar');
    $this->load->view('barang_android',$barang);
    $this->load->view('layout/footer');
         }
      }
  }

 

  public function list_barangterima(){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('android/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | User'
        ];

    $url = base_url('/api/main/barangterima');
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer '.$this->session->userdata('token')
      )
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    // Send the request
    $result = curl_exec($curl);
    // Free up the resources $curl is using
    curl_close($curl);

  $getBarangTerima = json_decode($result,true);
  $barangterima['databarangterima'] = $getBarangTerima['data'];

    $this->load->view('layout/header');
    $this->load->view('layout/sidebar_android');
    $this->load->view('layout/navbar');
    $this->load->view('barangterima_android',$barangterima);
    $this->load->view('layout/footer');
      }
    }
  }


   public function delete_barang($id){
    $url = base_url('/api/main/barang/id/'.$id);
           $curl = curl_init($url);
           curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
       
           curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$this->session->userdata('token') 
            )
           );
           curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
           // Send the request
           $result = curl_exec($curl);
           // Free up the resources $curl is using
           curl_close($curl);
           $deleteUser = json_decode($result,true);
           if($deleteUser['status'] == 200){
             echo ("<script LANGUAGE='JavaScript'>
             window.alert('Barang deleted!');
             window.location.href='".base_url('android/list_barang')."';
             </script>");
           }else{
             echo ("<script LANGUAGE='JavaScript'>
             window.alert('Failed to delete');
             window.location.href='".base_url('android/list_barang')."';
             </script>");
           }
   }

 

   public function delete_barangterima($id){
    $url = base_url('/api/main/barangterima/id/'.$id);
           $curl = curl_init($url);
           curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
       
           curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$this->session->userdata('token') 
            )
           );
           curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
           // Send the request
           $result = curl_exec($curl);
           // Free up the resources $curl is using
           curl_close($curl);
           $deleteUser = json_decode($result,true);
           if($deleteUser['status'] == 200){
             echo ("<script LANGUAGE='JavaScript'>
             window.alert('User deleted!');
             window.location.href='".base_url('android/list_barangterima')."';
             </script>");
           }else{
             echo ("<script LANGUAGE='JavaScript'>
             window.alert('Failed to delete');
             window.location.href='".base_url('android/list_barangterima')."';
             </script>");
           }
   }

  
  //form permintaan
   public function create_barang(){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('android/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | Menu'
        ];
        $dataCreate = [
          'tanggal'=> $this->input->post('tanggal'),
          'nama_brg'=> $this->input->post('nama_brg'),
          'merk_brg'=> $this->input->post('merk_brg'),
          'jumlah_brg'=> $this->input->post('jumlah_brg'),
          'harga_brg'=> $this->input->post('harga_brg'),
          'total'=> $this->input->post('total'),
          'pencatat'=> $this->input->post('pencatat'),
          'role'=> $this->input->post('role'),
          'status'=> 'pending',
        ];

              $url = base_url('/api/main/barang');
              $curl = curl_init($url);
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
          
              curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->session->userdata('token')
                )
              );
      
              /* Set JSON data to POST */
              curl_setopt($curl, CURLOPT_POSTFIELDS, $dataCreate);
      
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
              // Send the request
              $result = curl_exec($curl);
              // Free up the resources $curl is using
              curl_close($curl);
      
              $getBarang = json_decode($result,true);
      
              
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('Berhasil di simpan');
              window.location.href='".base_url('android/list_barang')."';
              </script>");
              return;

      }
    }
  }

    public function edit_barang($id){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('android/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | Menu'
        ];
        $url = base_url('/api/main/barang/id/'.$id);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Authorization: Bearer '.$this->session->userdata('token')
          )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        // Send the request
        $result = curl_exec($curl);
        // Free up the resources $curl is using
        curl_close($curl);

        $getBarang = json_decode($result,true);
        $barang['databarang'] = $getBarang['data'];



        $this->load->view('layout/header',$data);
        $this->load->view('layout/sidebar_android');
        $this->load->view('layout/navbar',$data);
        $this->load->view('edit_barang_android',$barang);
        $this->load->view('layout/footer');
      }
    }
  }

  public function proses_edit_barang($id){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('android/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | Edit Permohonan Barang'
        ];
        $dataCreate = [
          'tanggal'=> $this->input->post('tanggal'),
          'nama_brg'=> $this->input->post('nama_brg'),
          'merk_brg'=> $this->input->post('merk_brg'),
          'jumlah_brg'=> $this->input->post('jumlah_brg'),
          'harga_brg'=> $this->input->post('harga_brg'),
          'total'=> $this->input->post('total'),
          'pencatat'=> $this->input->post('pencatat'),
          'role'=> $this->input->post('role'),
          'status'=> 'pending',
        ];

        $url = base_url('/api/main/barang/id/'.$id);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Authorization: Bearer '.$this->session->userdata('token')
          )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        // Send the request
        $result = curl_exec($curl);
        // Free up the resources $curl is using
        curl_close($curl);

        $getBarang = json_decode($result,true);
        $barang = $getBarang['data'];

              $dataPut= json_encode($dataCreate);

              // var_dump($dataCreate);die();
              $url = base_url('/api/main/barang/id/'.$id);
              $curl = curl_init($url);
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          
              curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->session->userdata('token'),
                'Content-Type:application/json'
                )
              );

              /* Set JSON data to POST */
              curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
      
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
              // Send the request
              $result = curl_exec($curl);
              // Free up the resources $curl is using
              curl_close($curl);
      
              $getBarang = json_decode($result,true);
              $barang['databarang'] = $getBarang['status'];
      
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('Berhasil di edit');
              window.location.href='".base_url('android/list_barang')."';
              </script>");
              return;
      }
    }
  }
  //form pembelian
 

  

  //form penerimaan
  public function create_barangterima(){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('android/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | Menu'
        ];
        $dataCreate = [
          'tanggal'=> $this->input->post('tanggal'),
          'nama_brg'=> $this->input->post('nama_brg'),
          'merk_brg'=> $this->input->post('merk_brg'),
          'jumlah_brg'=> $this->input->post('jumlah_brg'),
          'harga_brg'=> $this->input->post('harga_brg'),
          'total'=> $this->input->post('total'),
          'penerima'=> $this->input->post('penerima'),
          'role'=> $this->input->post('role'),
          'status'=> $this->input->post('status'),
        ];

              $url = base_url('/api/main/barangterima');
              $curl = curl_init($url);
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
          
              curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->session->userdata('token')
                )
              );
      
              /* Set JSON data to POST */
              curl_setopt($curl, CURLOPT_POSTFIELDS, $dataCreate);
      
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
              // Send the request
              $result = curl_exec($curl);
              // Free up the resources $curl is using
              curl_close($curl);
      
              $getBarang = json_decode($result,true);
      
              
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('Berhasil di simpan');
              window.location.href='".base_url('android/list_barangterima')."';
              </script>");
              return;

      }
    }
  }

    public function edit_barangterima($id){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('android/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | Menu'
        ];
        $url = base_url('/api/main/barangterima/id/'.$id);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Authorization: Bearer '.$this->session->userdata('token')
          )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        // Send the request
        $result = curl_exec($curl);
        // Free up the resources $curl is using
        curl_close($curl);

        $getBarangterima = json_decode($result,true);
        $barangterima['databarangterima'] = $getBarangterima['data'];



        $this->load->view('layout/header',$data);
        $this->load->view('layout/sidebar_android');
        $this->load->view('layout/navbar',$data);
        $this->load->view('edit_barangterima_android',$barangterima);
        $this->load->view('layout/footer');
      }
    }
  }

  public function proses_edit_barangterima($id){
    if($this->session->userdata('token') == ''){
      return redirect(base_url('android/login'));
    }else{
      if($this->session->userdata('isLoginAdmin') == true){
        $data = [
          'username' => $this->session->userdata('username'),
          'title' => 'Dashboard | Edit Penerimaan'
        ];
        $dataCreate = [
          'tanggal'=> $this->input->post('tanggal'),
          'nama_brg'=> $this->input->post('nama_brg'),
          'merk_brg'=> $this->input->post('merk_brg'),
          'jumlah_brg'=> $this->input->post('jumlah_brg'),
          'harga_brg'=> $this->input->post('harga_brg'),
          'total'=> $this->input->post('total'),
          'penerima'=> $this->input->post('penerima'),
          'role'=> $this->input->post('role'),
          'status'=> $this->input->post('status'),
        ];

        $url = base_url('/api/main/barangterima/id/'.$id);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Authorization: Bearer '.$this->session->userdata('token')
          )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        // Send the request
        $result = curl_exec($curl);
        // Free up the resources $curl is using
        curl_close($curl);

        $getBarangterima = json_decode($result,true);
        $barangterima = $getBarangterima['data'];

              $dataPut= json_encode($dataCreate);

              // var_dump($dataCreate);die();
              $url = base_url('/api/main/barangterima/id/'.$id);
              $curl = curl_init($url);
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          
              curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$this->session->userdata('token'),
                'Content-Type:application/json'
                )
              );

              /* Set JSON data to POST */
              curl_setopt($curl, CURLOPT_POSTFIELDS, $dataPut);
      
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
              // Send the request
              $result = curl_exec($curl);
              // Free up the resources $curl is using
              curl_close($curl);
      
              $getBarangterima = json_decode($result,true);
              $barangterima['databarangterima'] = $getBarangterima['status'];
      
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('Berhasil di edit');
              window.location.href='".base_url('android/list_barangterima')."';
              </script>");
              return;
      }
    }
  }
}