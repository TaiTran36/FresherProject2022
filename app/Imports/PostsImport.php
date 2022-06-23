<?php

namespace App\Imports;

use App\Models\Post;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PostsImport implements ToModel, WithStartRow, WithUpserts,WithCalculatedFormulas
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
    public function uniqueBy()
    {
        return 'url';
    }
    public function model(array $row)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        return new Post([
            'title'    => $row['1'],
            'url'    => $row['2'],
            'content'    => $row['3'],
            'writer_id'    => $row['4'],
            'photo_path'    => $row['6'],
            'created_at' => $dt->toDateTimeString()
        ]);
    }
}
