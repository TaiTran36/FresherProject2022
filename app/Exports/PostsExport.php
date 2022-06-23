<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.id','posts.title','posts.url','posts.content','posts.writer_id', 'users.name as writer','posts.photo_path')->get();
    }
    public function headings(): array
    {
        return ["id", "title", "url", "content","writer_id", "writer", "photo"];
    }
}
