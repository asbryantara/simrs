<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class User extends CI_Controller
	{
		public function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->library('upload');	
		}
		
		function index(){
			$this->load->view('login');
		}

		function all(){
			$user = $this->db->get_where('user',array('id_user'=>$this->session->userdata('id_user')))->row_array();
			$akses = explode(', ',$user['hak_akses']);
			if(($user['level'] != '1')){
				$this->session->set_flashdata('warning', 'Anda tidak diberi izin untuk mengakses halaman ini !, silahkan hubungi admin !');
				redirect('home');
			}
			$this->db->not_like('nama_user', 'unknown');
			$data['rows'] = $this->db->get('user')->result();
			$this->load->view('user', $data);
		}

		function create_user(){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_user', 'NIP', 'required|trim|is_unique[user.id_user]', [
				'required' => 'NIP / NIK harus diisi',
				'is_unique' => 'NIP / NIK sudah digunakan'
			]);
			$this->form_validation->set_rules('nama_user', 'Nama_user', 'required|trim', [
				'required' => 'Nama lengkap harus diisi'
			]);
			$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
				'required' => 'sername harus diisi',
				'is_unique'=> 'username sudah digunakan'
			]);
			$this->form_validation->set_rules('password1', 'Password', 'required|min_length[3]|trim|matches[password2]', [
				'required'	=> 'password harus diisi',
				'min_length'=> 'password minimal 3 karakter',
				'matches'	=> 'password tidak sama'
			]);
			$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
			
			$hak_akses = $this->input->post('hak_akses');

			if($this->input->post('level')=='1'){
				$hak_akses = 'semua';
			}else{
				if (is_array($hak_akses)){
					$hak_akses = implode(', ', $hak_akses);
				}else{
					$hak_akses = '';
				}
			}

			if($this->form_validation->run()){
				$datauser = array (
					'id_user'	=> $this->input->post('id_user'),
					'nama_user' => ucwords($this->input->post('nama_user')),
					'username'	=> $this->input->post('username'),
					'level'		=> $this->input->post('level'),
					'hak_akses'	=> $hak_akses,
					'password'	=> md5($this->input->post('password1')),
				);
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
			    $config['encrypt_name']			= TRUE;
			    

				$this->upload->initialize($config);
	 			if(!empty($_FILES['foto']['name'])){
	 				if($this->upload->do_upload('foto')){
	 					$gbr = $this->upload->data();

	 					//compress
	 					$config['image_library']		= 'gd2';
	 					$config['source_image']			= './uploads/'.$gbr['file_name'];
	 					$config['create_thumb']			= FALSE;
					    $config['width']				= '300';
					    //$config['height']				= '300';
					    $config['maintain_ratio']		= TRUE;
					    
					    $config['new_image']			= './uploads/'.$gbr['file_name'];

					    $this->load->library('image_lib',$config);
					    $this->image_lib->resize();

					    $datauser['foto'] =$gbr['file_name'];
					    $this->db->insert('user', $datauser);

						if ($this->db->affected_rows()){
							$this->session->set_flashdata('success','User Behasil Ditambahkan');
							redirect(base_url('user/all'));
						}
	 				}
	 			}else{
	 				$datauser['foto'] = 'default.png';
					$this->db->insert('user', $datauser);
					
					if ($this->db->affected_rows()){
						$this->session->set_flashdata('success','User behasil ditambahkan tanpa foto');
						redirect(base_url('user/all'));
					}
	 			}
			}else{
				$this->load->view('input_user');
			}
		}

		function aksi_login(){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$where = array(
				'username' => $username,
				'password' => md5($password)
				);
			$cek = $this->db->get_where("user",$where)->num_rows();
			if($cek > 0){
				$this->db->select('*');
				$this->db->where('username',$username);
				$data=$this->db->get('user')->row_array();

				$data_session = array(
					'id_user'	=> $data['id_user'],
					'username'	=> $username,
					'status' 	=> "login",
					'foto' 		=> $data['foto'],
					'hak_akses' => $data['hak_akses'],
					'level' 	=> $data['level']
				);


				$this->session->set_userdata($data_session);
				$this->session->set_userdata('file_manager',true);
				redirect(base_url('home'));

			}else{
				$this->session->set_flashdata('danger','Username atau password salah !');
				redirect('user');
			}
		}

		function logout(){
			$this->session->sess_destroy();
			redirect(base_url('user'));
		}
		function edit(){
			if(empty($this->uri->segment(3))){
				$id_user = $this->session->userdata('id_user');
			}else{
				$id_user = $this->uri->segment(3);
			}

			$data['user'] = $this->db->get_where('user', array('id_user'=>$id_user))->row_array();
			$this->load->view('edit_user',$data);
		}
		function update(){
			
			$id_online	= $this->session->userdata('id_user');
			$id_edit	= $this->input->post('id_user');

			$username_lama	= $this->db->get_where('user',array('id_user'=>$id_edit))->row_array();
			$username_baru	= $this->input->post('username');

			$datauser = array();

			if($this->session->userdata('level')=='1'){
				$hak_akses = $this->input->post('hak_akses');
				if($this->input->post('level')=='1'){
					$hak_akses = 'semua';

				}else{
					if (is_array($hak_akses)){
						$hak_akses = implode(', ', $hak_akses);
					}else{
						$hak_akses = '';
					}
				}
				$datauser['level'] = $this->input->post('level');
				$datauser['hak_akses'] = $hak_akses;			
			}


			if ($username_lama['username']==$username_baru){
				//Username Tidak Dirubah
				$id = $this->input->post('id_user');
				$user = $this->db->get_where('user',array('id_user'=>$this->session->userdata('id_user')))->row_array();
				
				$datauser ['nama_user']	= ucwords($this->input->post('nama_user'));
				
				
				$this->db->where('id_user',$id);
				$this->db->update('user', $datauser);

				
				$this->session->set_flashdata('info','Data berhasil diupdate !');
				if($this->session->userdata('level')=='1'){
					redirect('user/all');
				}else{
					redirect('user/edit');
				}
			}elseif($id_edit==$id_online){
				//Username yang aktif Dirubah
				$this->form_validation->set_rules("username", "Username", "required|is_unique[user.username]");
				//jika username tersedia
				if ($this->form_validation->run()){
					$id = $this->input->post('id_user');
					$user = $this->db->get_where('user',array('id_user'=>$this->session->userdata('id_user')))->row_array();
				
					$datauser['username']	= $this->input->post('username');
					$datauser['nama_user']	= ucwords($this->input->post('nama_user'));

										
					$this->db->where('id_user',$id);
					$this->db->update('user', $datauser);
					
					$this->session->set_flashdata('success','Username berhasil dirubah, silahkan sign in kembali !');
					redirect('user');
				}else{
					$this->session->set_flashdata('warning','Username "'.$this->input->post('username').'" telah digunakan, coba dengan username yang lain !');
					if($this->session->userdata('level')=='1'){
						redirect('user/all');
					}else{
						redirect('user/edit');
					}
				}
			}
		}
		
		function update_password(){
			
			$id = $this->input->post('id_user');
			$this->form_validation->set_rules('passwordBaru', 'Password', 'required');
			$this->form_validation->set_rules('passwordBaru1', 'Password Confirmation', 'required|matches[passwordBaru]');
			if ($this->form_validation->run()){
				$datauser['password']=md5($this->input->post('passwordBaru'));
				$this->db->where('id_user',$id);
				$this->db->update('user',$datauser);

				$this->session->set_flashdata('success','Password berhasil diganti !');
				redirect('user/edit');
			}else{
				$this->session->set_flashdata('warning','Password tidak sama !');
				redirect('user/edit');
			}
		}
		function update_foto(){
			$id=$this->input->post('id_user');
			$data=$this->db->get_where('user',array('id_user'=>$id))->row_array();
			if($data['foto']=='default.png'){
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
			    $config['encrypt_name']			= TRUE;
			    

				$this->upload->initialize($config);
	 			if(!empty($_FILES['foto']['name'])){
	 				if($this->upload->do_upload('foto')){
	 					$gbr = $this->upload->data();

	 					//compress
	 					$config['image_library']		= 'gd2';
	 					$config['source_image']			= './uploads/'.$gbr['file_name'];
	 					$config['create_thumb']			= FALSE;
					    $config['width']				= '300';
					    //$config['height']				= '300';
					    $config['maintain_ratio']		= TRUE;
					    
					    $config['new_image']			= './uploads/'.$gbr['file_name'];

					    $this->load->library('image_lib',$config);
					    $this->image_lib->resize();

					    $datauser['foto'] =$gbr['file_name'];
					    $this->db->where('id_user',$id);
					    $this->db->update('user', $datauser);

						if ($this->db->affected_rows()){
							$this->session->set_flashdata('success','Foto berhasil diganti');
							redirect('user/edit/'.$id);
						}
	 				}
	 			}

			}else{
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
			    $config['encrypt_name']			= TRUE;
			    

				$this->upload->initialize($config);
	 			if(!empty($_FILES['foto']['name'])){
	 				if($this->upload->do_upload('foto')){
	 					$gbr = $this->upload->data();

	 					//compress
	 					$config['image_library']		= 'gd2';
	 					$config['source_image']			= './uploads/'.$gbr['file_name'];
	 					$config['create_thumb']			= FALSE;
					    $config['width']				= '300';
					    //$config['height']				= '300';
					    $config['maintain_ratio']		= TRUE;
					    
					    $config['new_image']			= './uploads/'.$gbr['file_name'];

					    $this->load->library('image_lib',$config);
					    $this->image_lib->resize();

					    $datauser['foto'] =$gbr['file_name'];
					    $this->db->where('id_user',$id);
					    $this->db->update('user', $datauser);
					    unlink("./uploads/".$data['foto']);
					    
						if ($this->db->affected_rows()){
							$this->session->set_flashdata('success','Foto berhasil diganti');
							redirect('user/edit');
						}
	 				}
	 			}
			}
		}
		function hapus_foto(){
			$user = $this->db->get_where('user',array('id_user'=>$this->session->userdata('id_user')))->row_array();
			$akses = explode(', ',$user['hak_akses']);
			if(($user['level'] != '1')){
				$this->session->set_flashdata('warning', 'Anda tidak diberi izin untuk mengakses halaman ini !, silahkan hubungi admin !');
				redirect('home');
			}

			$id = $this->input->post('id_user');
			$data = $this->db->get_where('user',array('id_user'=>$id))->row_array();
			$datauser['foto']='default.png';
			$this->db->where('id_user',$id);
		    $this->db->update('user', $datauser);
		    unlink("./uploads/".$data['foto']);
		    
		    redirect('user/edit');
		}

		function delete(){
			$id_user = $this->uri->segment(3);
			$row = $this->db->get_where('user', ['id_user'=>$id_user])->row_array();
			if($row['foto'] == 'default.png'){
				$this->db->delete('user', ['id_user'=>$id_user]);
				$this->session->set_flashdata('success', 'user berhasil dihapus');
				redirect('user/all');
			}else{
				unlink('./uploads/'.$row['foto']);
				$this->db->delete('user', ['id_user'=>$id_user]);
				$this->session->set_flashdata('success', 'user berhasil dihapus');
				redirect('user/all');
			}
		}
	}

?>
