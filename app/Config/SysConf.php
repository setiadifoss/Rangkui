<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class SysConf extends BaseConfig
{
    // AUTHORITY TYPE
    public $authority_type = [
        'p' => 'Personal Name',
        'o' => 'Organizational Body',
        'c' => 'Conference',
    ];

    // SUPERVISOR TYPE
    public $supervisor_type = [
        'p' => 'Personal Name',
    ];

    // SUBJECT/AUTHORITY TYPE
    public $subject_type = [
        't' => 'Topic',
        'g' => 'Geographic',
        'n' => 'Name',
        'tm' => 'Temporal',
        'gr' => 'Genre',
        'oc' => 'Occupation',
    ];

    // AUTHORITY LEVEL
    public $authority_level = [
        1 => 'Pengarang',
    ];

    // SUPERVISORITY LEVEL
    public $authority_level_supervisor = [
        1 => 'Dosen Pembimbing 1',
        2 => 'Dosen Pembimbing 2',
        3 => 'Dosen Pembimbing 3',
    ];

    // EXAMINER TYPE
    public $examiner_type = [
        'p' => 'Personal Name',
    ];

    // EXAMINER LEVEL
    public $authority_level_examiner = [
        1 => 'Ketua Penguji',
        2 => 'Penguji 1',
        3 => 'Penguji 2',
    ];

    // CONTRIBUTOR TYPE
    public $contributor_type = [
        'p' => 'Personal Name',
    ];

    // CONTRIBUTOR LEVEL
    public $authority_level_contributor = [
        1 => 'Contributor',
        3 => 'Editor',
    ];

    // DEGREE
    public $degree = [
        '1'  => 'D1',
        '2'  => 'D2',
        '3'  => 'D3',
        '4'  => 'D4',
        '5'  => 'S1',
        '6'  => 'S2',
        '7'  => 'S3',
        '8'  => 'Non Formal',
        '9'  => 'Informal',
        '10' => 'Lainnya',
        '11' => 'Sp-1',
        '12' => 'Sp-2',
        '13' => 'Profesi',
        '14' => 'S2 Terapan',
        '15' => 'S3 Terapan',
    ];

    public $library = [
        'name' => 'Setiadi 4 Rangkui',
        'subname' => 'Senayan Sistem Elektronik Tesis dan Disertasi'
    ];
}
