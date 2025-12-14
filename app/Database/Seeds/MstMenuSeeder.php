<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MstMenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['parent_id' => NULL, 'title' => 'Pinned', 'url' => NULL, 'icon' => 'fa-thumb-tack', 'type' => 'menu', 'level' => 1, 'desc' => NULL],
            ['parent_id' => 1, 'title' => 'Update User Profile', 'url' => 'profile', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => NULL, 'title' => 'Dashboard', 'url' => 'home', 'icon' => 'fa-bar-chart-o', 'type' => 'menu', 'level' => 1, 'desc' => NULL],
            ['parent_id' => NULL, 'title' => 'Opac', 'url' => 'opac', 'icon' => 'fa-desktop', 'type' => 'menu', 'level' => 1, 'desc' => NULL],
            ['parent_id' => NULL, 'title' => 'ETD', 'url' => NULL, 'icon' => 'fa-book', 'type' => 'menu', 'level' => 1, 'desc' => NULL],
            ['parent_id' => 5, 'title' => 'Bibliography', 'url' => '#', 'icon' => NULL, 'type' => 'title', 'level' => 2, 'desc' => NULL],
            ['parent_id' => 6, 'title' => 'Etd List', 'url' => 'bibliography', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => NULL, 'title' => 'Membership', 'url' => NULL, 'icon' => 'fa-user', 'type' => 'menu', 'level' => 1, 'desc' => NULL],
            ['parent_id' => 8, 'title' => 'Membership', 'url' => NULL, 'icon' => NULL, 'type' => 'title', 'level' => 2, 'desc' => NULL],
            ['parent_id' => 9, 'title' => 'List Membership', 'url' => 'membership', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 9, 'title' => 'Member Type', 'url' => 'membership/membertype', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => NULL, 'title' => 'Master File', 'url' => NULL, 'icon' => 'fa-file', 'type' => 'menu', 'level' => 1, 'desc' => NULL],
            ['parent_id' => 12, 'title' => 'List Controlled', 'url' => NULL, 'icon' => NULL, 'type' => 'title', 'level' => 2, 'desc' => NULL],
            ['parent_id' => 13, 'title' => 'GMD', 'url' => 'master/gmd', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 13, 'title' => 'Publisher', 'url' => 'master/penerbit', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 13, 'title' => 'Writer', 'url' => 'master/pengarang', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 13, 'title' => 'Supervisor', 'url' => 'master/supervisor', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 13, 'title' => 'Examiner', 'url' => 'master/examiner', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 13, 'title' => 'Location', 'url' => 'master/location', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 12, 'title' => 'References', 'url' => NULL, 'icon' => NULL, 'type' => 'title', 'level' => 2, 'desc' => NULL],
            ['parent_id' => 20, 'title' => 'Places', 'url' => 'master/place', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 20, 'title' => 'Exemplar State', 'url' => 'master/statusitem', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 20, 'title' => 'Collection Type', 'url' => 'master/collection', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 20, 'title' => 'Language', 'url' => 'master/language', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 20, 'title' => 'Frequency', 'url' => 'master/frequency', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 12, 'title' => 'License', 'url' => 'master/license', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 12, 'title' => 'Code Ministry PDDIKTI', 'url' => 'master/codeministry', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 12, 'title' => 'Subject', 'url' => 'master/subject', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => NULL, 'title' => 'System', 'url' => NULL, 'icon' => 'fa-sitemap', 'type' => 'menu', 'level' => 1, 'desc' => NULL],
            ['parent_id' => 28, 'title' => 'System', 'url' => NULL, 'icon' => NULL, 'type' => 'title', 'level' => 2, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'System Configuration', 'url' => 'sistem/pengaturan-sistem', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'Content', 'url' => 'sistem/konten', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'Shortcut', 'url' => 'sistem/pintasan', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'Biblio Index', 'url' => 'sistem/indeks-biblio', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'Modules', 'url' => 'sistem/modul', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'Libarian System', 'url' => 'sistem/pustakawan', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'User Groups', 'url' => 'sistem/user-groups', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'Format Scan Generator', 'url' => '', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'Sys Log', 'url' => 'sistem/logs', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 29, 'title' => 'Backup Data', 'url' => 'sistem/backups', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => NULL, 'title' => 'Reporting', 'url' => NULL, 'icon' => 'fa-table', 'type' => 'menu', 'level' => 1, 'desc' => NULL],
            ['parent_id' => 40, 'title' => 'Reporting', 'url' => NULL, 'icon' => NULL, 'type' => 'title', 'level' => 2, 'desc' => NULL],
            ['parent_id' => 41, 'title' => 'Statistic Collection', 'url' => 'report/stats-collection', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 41, 'title' => 'Membership Report', 'url' => 'report/membership', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 40, 'title' => 'Other Report', 'url' => NULL, 'icon' => NULL, 'type' => 'title', 'level' => 2, 'desc' => NULL],
            ['parent_id' => 44, 'title' => 'Recapitulation', 'url' => 'report/recap', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 44, 'title' => 'List Title', 'url' => 'report/titles', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 44, 'title' => 'List Membership', 'url' => 'report/list-member', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 44, 'title' => 'Contributor List', 'url' => 'report/contributors', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 44, 'title' => 'Staff Activity', 'url' => 'report/staff-activity', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 44, 'title' => 'Visitor', 'url' => 'report/visitor', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => 44, 'title' => 'Visualize Diagram', 'url' => '#', 'icon' => NULL, 'type' => 'submenu', 'level' => 3, 'desc' => NULL],
            ['parent_id' => NULL, 'title' => 'Logout', 'url' => 'logout', 'icon' => 'fa-power-off', 'type' => 'menu', 'level' => 1, 'desc' => NULL],
        ];

        // Insert data into the database
        $this->db->table('mst_menu')->insertBatch($data);
    }
}
