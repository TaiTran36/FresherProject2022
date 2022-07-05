<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PostsExport implements FromCollection, WithHeadings, WithStyles, WithEvents, ShouldAutoSize, WithTitle, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Post::join('users', 'posts.writer_id', '=', 'users.id')->select('posts.id', 'posts.title', 'posts.url', 'posts.content', 'posts.writer_id', 'users.name as writer', 'posts.photo_path')->get();
    }
    public function title(): string
    {
        return 'List of Posts 2022';
    }
    public function startCell(): string
    {
        return 'B2';
    }
    public function headings(): array
    {
        return [
            ['Posts list \r List of Posts'],
            ["id", "title", "url", "content", "writer_id", "writer", "photo"]
        ]; 
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B2:H2');
        $sheet->getColumnDimension('C')->setAutoSize(true);
        return [
             3   => ['font' => ['bold' => true]],
            'B'  => ['font' => ['italic' => true]]     
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->freezePane('D4'); // vùng chữ nhật bắt đầu từ B3 thì cuộn dc
                $sheet->getStyle('B2')->getAlignment()->setWrapText(true);
                $sheet->setCellValue('B2',"Posts list \rList of Posts");
                $sheet->getRowDimension('2')->setRowHeight(45);
                $sheet->getStyle('2')->getFont()->setSize(18)->setBold(true)->getColor()->setRGB('26048a');
                $sheet->getStyle('3')->getFont()->setSize(15)->setBold(true)->getColor()->setRGB('043e8a');

                // $sheet->getStyle('3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
            },
        ];
    }
}
