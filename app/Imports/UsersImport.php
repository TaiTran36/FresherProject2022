<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        return new User([
            'username_login'    => $row['1'],
            'email'    => $row['2'],
            'password' => $row['3'],
            'name'    => $row['4'],
            'date_of_birth'    => $row['5'],
            'nickname'    => $row['6'],
            'description'    => $row['7'],
            'avatar'    => $row['8'],
            'address'    => $row['9'],
            'phone_number'    => $row['10'],
            'created_at' => $dt->toDateTimeString()
        ]);
    }
}
