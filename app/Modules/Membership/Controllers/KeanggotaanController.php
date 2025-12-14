<?php

namespace App\Modules\Membership\Controllers;

use App\Modules\Membership\Models\MembershipModel;
use App\Controllers\BaseController;
use datetime;

class KeanggotaanController extends BaseController
{

    public $viewPath = "Keanggotaan/";
    private $datetime;
    public $options = [];
    public function __construct()
    {
        $this->datetime = date('YmdHis');
        $this->options = [
            'cost' => 12,
        ];
    }

    public function index()
    {
        $db       = \Config\Database::connect();
        $view     =  $this->viewPath . "v_index";
        $title    = "Membership";
        $subquery = $db->table('mst_member_type')->select('member_type_id, member_type_name')->getCompiledSelect();
        $builder  = $db->table('member as m');
        $builder->select('m.*, mt.member_type_name');
        $builder->join("($subquery) as mt", 'mt.member_type_id = m.member_type_id');
        $builder->where('m.expire_date >=', date('Y-m-d'));

        $content['data'] = $builder->get()->getResult();
        _render($view, $title, $content);
    }


    public function add()
    {
        $membership = new MembershipModel();
        $view       = $this->viewPath . "v_add";
        $title      = 'Membership';
        $content    = ['mst_member_type' => $membership->getMstMemberType()];
        $js         = [
            'assets/custom/js/modules/membership/membership',
        ];

        _render($view, $title, $content, $js);
    }
    public function edit()
    {
        $membership = new MembershipModel();
        $db         = \Config\Database::connect();
        $subquery   = $db->table('mst_member_type')->select('member_type_id, member_type_name')->getCompiledSelect();
        $builder    = $db->table('member as m');
        $view       = $this->viewPath . "v_edit";
        $title      = 'Membership';
        $builder->select('m.*, mt.member_type_name');
        $builder->join("($subquery) as mt", 'mt.member_type_id = m.member_type_id');
        $builder->where('m.member_id =', $this->input->getGet('mi'));

        $content['mst_data'] = $membership->getMstMemberType();
        $content['data']     = $builder->get()->getRow();

        if ($content['data']) {
            unset($content['data']->mpasswd);
        }

        $js               = [
            'assets/custom/js/modules/membership/membership',
        ];

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        extract($this->input->getPost());
        $currentDate = new DateTime();
        $currentDate->modify('+1 year');
        $rules = [
            'image' => [
                'label' => 'Image File',
                'rules' => 'if_exist|is_image[image]'
                    . '|is_image[image]'
                    . '|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]'
                    . '|max_size[image,1024]'
                    . '|max_dims[image,4000,4000]',
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        } else {
            if (isset($extend)) {

                $expire_date = $currentDate->format('Y-m-d');
            }
            $user        = 'var';
            if (!is_null($expire_date) || $expire_date = '') {
                $expire_date = $currentDate->format('Y-m-d');
            }
            $filename    = (string) $_FILES['member_image']['name'];
            $configImage = $this->_configBerkas($filename, $user);
            $imageFile   = $this->request->getFile('member_image');
            $image = '';
            if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                if (!is_dir($configImage['upload_path'])) {
                    mkdir($configImage['upload_path'], 0755, true);
                }
                $image = $configImage['file_name'];
                $imageFile->move($configImage['upload_path'], $image);
                $msg = 'sukses';
            } else {
                $msg = 'gagal';
                if (!empty($filename)) {
                    slim_alert('Simpan gambar gagal, silahkan upload ulang.', 'error');
                }
            }
        }

        $encryptedPassword = password_hash($mPasswd, PASSWORD_BCRYPT, $this->options);
        $data = [
            'member_id'           => $member_id, // Using member_id from form input
            'member_name'         => $member_name,
            'birth_date'          => $birth_date,
            'inst_name'           => $inst_name,
            'member_since_date'   => $member_since_date,
            'member_type_id'      => $member_type_id,
            'register_date'       => $register_date,
            'pin'                 => $pin,
            'is_pending'          => isset($is_pending[0]) ?? 0,
            'expire_date'         => $expire_date,
            'postal_code'         => $postal_code,
            'gender'              => $gender,
            'member_address'      => $member_address,
            'member_mail_address' => $member_mail_address,
            'member_phone'        => $member_phone,
            'member_fax'          => $member_fax,
            'member_notes'        => $member_notes,
            'mpasswd'             => $encryptedPassword,
            'member_email'        => $member_email,
        ];
        if (!empty($image)) {
            $data['member_image'] = $image;
        }
        $db       = \Config\Database::connect();
        $member = new MembershipModel();
        $member->insertMember($data);


        if ($member->transStatus() === false) {
            $member->transRollback();
            slim_alert('error', "Gagal Menambah Membership");
        } else {
            $member->transCommit();
            slim_alert('success', "Berhasil Menambah Membership");
        }

        return redirect()->to('membership/');
    }

    public function update()
    {
        extract($this->input->getPost());

        $memberM        = new membershipModel();
        $original_member_id = $this->request->getPost('original_member_id');
        $member         = $memberM->find($original_member_id);
        if (!empty($member)) {
            $this->db->transBegin();
            $data = [
                'member_id'           => $member_id, // Allow updating member_id if changed
                'member_name'         => $member_name,
                'birth_date'          => $birth_date,
                'inst_name'           => $inst_name,
                'member_since_date'   => $member_since_date,
                'member_type_id'      => $member_type_id,
                'register_date'       => $register_date,
                'pin'                 => $pin,
                'expire_date'         => $expire_date,
                'is_pending'          => isset($is_pending[0]) ?? 0,
                'postal_code'         => $postal_code,
                'gender'              => $gender,
                'member_address'      => $member_address,
                'member_mail_address' => $member_mail_address,
                'member_phone'        => $member_phone,
                'member_fax'          => $member_fax,
                'member_notes'        => $member_notes,
                'member_email'        => $member_email,
            ];
            if (!empty($mPasswd)) {
                $encryptedPassword = password_hash($mPasswd, PASSWORD_BCRYPT, $this->options);
                $data['mpasswd'] = $encryptedPassword;
            }

            $rules = [
                'member_name'       => 'required',
                'member_type_id'    => 'required',
                'pin'               => 'required',
                'member_email'      => 'required',
                'image'             =>
                [
                    'label' => 'Image File',
                    'rules' => 'if_exist|is_image[image]'
                        . '|is_image[image]'
                        . '|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]'
                        . '|max_size[image,500]'
                        . '|max_dims[image,4000,4000]',
                ],
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            } else {

                $image        = '';
                $user         = "var";
                $filename     = (string) $_FILES['member_image']['name'];
                $configImage  = $this->_configBerkas($filename, $user);
                $imageFile    = $this->request->getFile('member_image');

                if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                    if (!is_dir($configImage['upload_path'])) {
                        mkdir($configImage['upload_path'], 0755, true);
                    }
                    $image = $configImage['file_name'];
                    $imageFile->move($configImage['upload_path'], $image);
                }

                if (!empty($image)) {
                    $data['member_image'] = $image;
                }
                $memberM->set($data);
                $memberM->where('member_id', $original_member_id);
                $result       =  $memberM->update();
                if ($result) {
                    slim_alert('Berhasil Ubah Dokumen', 'Success');
                } else {
                    $error = $memberM->errors();
                    log_message('error', reset($error));
                    slim_alert('Gagal Ubah Dokumen', 'Error');
                }
            }
        }
        return redirect()->to('/membership/');
    }

    public function expMember()
    {
        $db       = \Config\Database::connect();
        $view     =  $this->viewPath . "v_expMember";
        $title    = "Anggota Kadarluwarsa";
        $subquery = $db->table('mst_member_type')->select('member_type_id, member_type_name')->getCompiledSelect();
        $builder  = $db->table('member as m');
        $builder->select('m.*, mt.member_type_name');
        $builder->join("($subquery) as mt", 'mt.member_type_id = m.member_type_id');
        $builder->where('m.expire_date <=', date('Y-m-d'));
        $content['data'] = $builder->get()->getResult();
        $js = [
            'assets/custom/js/modules/membership/membership',
        ];
        _render($view, $title, $content, $js);
    }

    public function updateExp()
    {
        extract($this->input->getPost());
        $currentDate    = new \DateTime();
        $expirationDate = \DateTime::createFromFormat('Y-m-d', $exp_date);
        $memberM        = new membershipModel();
        $member         = $memberM->find($member_id);
        $now            = date("Y-m-d H:i:s");

        // Cek apakah tanggal expired lebih kecil dari tanggal sekarang
        if ($expirationDate < $currentDate) {
            // Redirect kembali dengan membawa data untuk menampilkan modal
            slim_alert('error', "Tanggal tidak valid.");
            return redirect()->to('membership/xmember')->with('showModal', 'myModal');
        }

        if (!empty($member)) {
            $this->db->transBegin();
            $data = [
                'expire_date' => $exp_date,
                'last_update' => $now,
            ];
            $memberM->set($data);
            $memberM->where('member_id', $member_id);
            $memberM->update();

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                slim_alert('error', "Gagal Mengubah {$member_name}");
            } else {
                $this->db->transCommit();
                slim_alert('success', "Berhasil Mengubah {$member_name}");
            }
        }


        return redirect()->to("membership/xmember");
    }

    public function delete()
    {
        $member_id = $this->request->getPost('mi');
        $memberM = new membershipModel();
        $member = $memberM->find($member_id);
        
        if (!empty($member)) {
            $this->db->transBegin();
            $result = $memberM->delete($member_id);
            
            if ($result) {
                $this->db->transCommit();
                slim_alert('success', "Berhasil Menghapus Anggota");
            } else {
                $this->db->transRollback();
                slim_alert('error', "Gagal Menghapus Anggota");
            }
        } else {
            slim_alert('error', "Anggota Tidak Ditemukan");
        }
        
        return redirect()->to('membership/');
    }
    private function _configBerkas($file, $user, $ket = null, $i = null)
    {
        if (!is_dir('./uploads/images/persons/' . $user)) {
            mkdir('./uploads/images/persons/' . $user, 0777, TRUE);
        }
        if (!is_null($ket)) {
            if (!is_dir('./uploads/images/persons/')) {
                mkdir('./uploads/images/persons/', 0777, TRUE);
            }
        }

        $index = '';
        if (!is_null($i)) {
            if ($i > 0) {
                $index = $i;
            }
        }

        $config = array();
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if (!is_null($ket)) {
            $save = 'member_' . $user . '_' . $ket . '-' . $this->datetime . $index . '.' . $ext;
            $config['upload_path']   = './uploads/images/persons/'  . $ket;
        } else {
            $save = 'member_' . $user . '-' . $this->datetime . $index . '.' . $ext;
            $config['upload_path']   = './uploads/images/persons/';
        }
        $config['allowed_types'] = 'png|jpg|jpeg|pdf';
        $config['file_name']     = $save;
        $config['max_size']      = '800';

        return $config;
    }
}
