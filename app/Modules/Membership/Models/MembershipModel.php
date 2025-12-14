<?php

namespace App\Modules\Membership\Models;

use App\Models\BaseModel;

class MembershipModel extends BaseModel
{
    protected $table          = 'member';
    protected $primaryKey     = 'member_id';
    protected $returnType     = 'object';
    protected $protectFields  = false;
    protected $useTimestamps  = true;
    protected $createdField   = 'input_date';
    protected $updatedField   = 'last_update';


    function getActiveMembers()
    {
        $now = date("Y-m-d");
        $sql = "SELECT
                    COUNT(member_id) total_member
                FROM
                    $this->table
                WHERE
                    TO_DAYS(expire_date)>TO_DAYS('{$now}')";
        $active_member = $this->db->query($sql)
            ->getRow()
            ->total_member;

        return (int) $active_member;
    }

    function getExpiredMembers()
    {
        $now = date("Y-m-d");
        $sql = "SELECT
                    COUNT(member_id) total_member
                FROM
                    $this->table
                WHERE
                    TO_DAYS('{$now}')>TO_DAYS(expire_date)";
        $expired_member = $this->db->query($sql)
            ->getRow()
            ->total_member;

        return (int) $expired_member;
    }

    function getMemberByType()
    {
        $now = date("Y-m-d");
        $sql = "SELECT
                    member_type_name as member_name,
                    COUNT(member_id) total
                FROM
                    mst_member_type AS mt
                LEFT JOIN member AS m ON
                    mt.member_type_id = m.member_type_id
                WHERE
                    TO_DAYS(expire_date)>TO_DAYS('{$now}')
                GROUP BY
                    m.member_type_id
                ORDER BY
                    COUNT(member_id) DESC";
        $member_type = $this->db->query($sql)
            ->getResult();

        return $member_type;
    }

    function getMstMemberType()
    {
        return $data['Mst_member_type']      = $this->db->table('mst_member_type')->orderBy('member_type_id', 'ASC')->get()->getResult();
    }
    function insertMember($data)
    {
        $existingMember = $this->table($this->table)->find($data['member_id']);
        if ($existingMember) {
            $data['member_id'] = generateRandomID();
        }
        $this->db->transBegin();
        try {
            $this->table($this->table)->insert($data);
            // cekerror($this);
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                $return = false;
            } else {
                $this->db->transCommit();
                $return = true;
            }
        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', $e->getMessage());
            $return = false;
        }
        return $return;
    }
    function insertMemberType($data)
    {
        $this->db->transBegin(); // Memulai transaksi
        try {
            $sql = "INSERT INTO mst_member_type (member_type_name, loan_limit, loan_periode, enable_reserve, member_periode, reserve_limit, reborrow_limit, fine_each_day, grace_periode, input_date, last_update) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Eksekusi query dengan parameter
            $this->db->query($sql, [
                $data['member_type_name'],
                $data['loan_limit'],
                $data['loan_periode'],
                $data['enable_reserve'],
                $data['member_periode'],
                $data['reserve_limit'],
                $data['reborrow_limit'],
                $data['fine_each_day'],
                $data['grace_periode'],
                date('Y-m-d H:i:s'), // input_date
                date('Y-m-d H:i:s')  // last_update
            ]);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                $return = false;
            } else {
                $this->db->transCommit();
                $return = true;
            }
        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', $e->getMessage());
            $return = false;
        }
        return $return;
    }
}
