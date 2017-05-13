<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'id' => 1,
            'name' => 'Ban Thanh Tra',
            'alias' => 'BTT',
            'address' => 'Phòng 1, Khu Nhà A, Đại học Công Nghệ-ĐHQGHN'
        ]);

        DB::table('departments')->insert([
            'id' => 2,
            'name' => 'Phòng Tổ chức Cán bộ',
            'alias' => 'PTCCB',
            'address' => 'Phòng 2, Khu Nhà A, Đại học Công Nghệ-ĐHQGHN'
        ]);

        DB::table('departments')->insert([
            'id' => 3,
            'name' => 'Phòng Hành chính - Quản trị',
            'alias' => 'PHCQT',
            'address' => 'Phòng 3, Khu Nhà A, Đại học Công Nghệ-ĐHQGHN'
        ]);

        DB::table('departments')->insert([
            'id' => 4,
            'name' => 'Phòng Đào tạo',
            'alias' => 'PĐT',
            'address' => 'Phòng 4, Khu Nhà A, Đại học Công Nghệ-ĐHQGHN'
        ]);

        DB::table('departments')->insert([
            'id' => 5,
            'name' => 'Phòng KHCN & HTPT',
            'alias' => 'KHCN&HTPT',
            'address' => 'Phòng 5, Khu Nhà A, Đại học Công Nghệ-ĐHQGHN'
        ]);

        DB::table('departments')->insert([
            'id' => 6,
            'name' => 'Phòng Kế hoạch Tài chính',
            'alias' => 'PKHTC',
            'address' => 'Phòng 6, Khu Nhà A, Đại học Công Nghệ-ĐHQGHN'
        ]);

        DB::table('departments')->insert([
            'id' => 7,
            'name' => 'Phòng Công tác sinh viên ',
            'alias' => 'PCTSV',
            'address' => 'Phòng 7, Khu Nhà A, Đại học Công Nghệ-ĐHQGHN'
        ]);
    }
}
