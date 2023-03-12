<?php

namespace App\Exports;

use App\Models\Usaha;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsahaExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithDrawings,
    WithCustomStartCell,
    WithEvents,
    ShouldAutoSize
{
    use Exportable;

    protected $usaha;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet
                    ->getDelegate()
                    ->getRowDimension('1')
                    ->setRowHeight(47);
                $event->sheet
                    ->getDelegate()
                    ->getRowDimension('2')
                    ->setRowHeight(30);

                $event->sheet
                    ->getDelegate()
                    ->getStyle('1')
                    ->getFont()
                    ->setSize(14);
                $event->sheet
                    ->getDelegate()
                    ->getStyle('2')
                    ->getFont()
                    ->setSize(14);

                $event->sheet
                    ->getDelegate()
                    ->getColumnDimension('A')
                    ->setWidth(7);
                $event->sheet
                    ->getDelegate()
                    ->getColumnDimension('D')
                    ->setWidth(50);

                $event->sheet->setCellValue(
                    'B1',
                    'Forum Alumni SMK KESEHATAN HUSADA PRATAMA'
                );
                $event->sheet->setCellValue('B2', 'Data User :');

                $event->sheet
                    ->getDelegate()
                    ->getStyle('B')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT
                    )
                    ->setVertical(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    );

                $event->sheet
                    ->getDelegate()
                    ->getStyle('C:L')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT
                    )
                    ->setVertical(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    );

                $event->sheet
                    ->getDelegate()
                    ->getStyle('B1')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    )
                    ->setVertical(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    );

                $event->sheet
                    ->getDelegate()
                    ->getStyle('B2')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    )
                    ->setVertical(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    );

                $event->sheet
                    ->getDelegate()
                    ->getStyle('4')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    )
                    ->setVertical(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    );

                $event->sheet
                    ->getDelegate()
                    ->getStyle('B4:L4')
                    ->getFill()
                    ->setFillType(
                        \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
                    )
                    ->getStartColor()
                    ->setARGB('ffcc00');

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'ff949494'],
                        ],
                    ],

                    'font' => [
                        'bold' => true,
                    ],
                ];

                $event->sheet
                    ->getDelegate()
                    ->getStyle('B4:L4')
                    ->applyFromArray($styleArray);
            },
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Forum Alumni SMK KESEHATAN HUSADA PRATAMA');
        $drawing->setDescription('Forum Alumni SMK KESEHATAN HUSADA PRATAMA');
        $drawing->setPath(public_path('/assets/gallery/logo-husada.png'));
        $drawing->setHeight(50);
        $drawing->setWidth(55);
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(6);
        $drawing->setOffsetY(4);

        return $drawing;
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Slug',
            'Name',
            'Jenis Kelamin',
            'Jenis Usaha',
            'Alamat Usaha',
            'Tahun Usaha',
            'Url Gambar',
            'Di Buat',
            'Created_At',
        ];
    }

    public function map($usaha): array
    {
        return collect([
            $usaha->id,
            $usaha->user_id,
            $usaha->slug,
            $usaha->name,
            $usaha->jenis_kelamin,
            $usaha->jenis_usaha,
            $usaha->alamat_usaha,
            $usaha->tahun_usaha,
            $usaha->gambar,
            $usaha->dibuat,
            $usaha->created_at,
        ])->toArray();
    }

    public function __construct($usaha)
    {
        $this->usaha = $usaha;
    }

    public function query()
    {
        return Usaha::query()
            ->select(
                'id',
                'user_id',
                'slug',
                'name',
                'jenis_kelamin',
                'jenis_usaha',
                'alamat_usaha',
                'tahun_usaha',
                'gambar',
                'dibuat',
                'created_at'
            )
            ->whereKey($this->usaha);
    }

    public function startCell(): string
    {
        return 'B4';
    }
}
