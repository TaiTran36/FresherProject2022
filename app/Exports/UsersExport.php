<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select("id","username_login", "email","password","name","date_of_birth","nickname","description","avatar","address","phone_number")->get();
    }
    public function headings(): array
    {
        return ["id","username_login", "email","password","name","date_of_birth","nickname","description","avatar","address","phone_number"];
    }
    public function map($user): array {
        return [
            $user->id,
            $user->username_login,
            $user->email,
            $user->password,
            $user->name,
            date('d-m-Y' ,strtotime($user->date_of_birth)),
            $user->nickname,
            $user->description,
            $user->avatar,
            $user->address,
            $user->phone_number
        ];
    }
}
