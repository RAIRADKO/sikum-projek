<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromView, ShouldAutoSize, WithStyles, WithMultipleSheets
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('cetak.laporan_excel', $this->data);
    }

    public function sheets(): array
    {
        $sheets = [];
        
        if (!empty($this->data['nomor_sk'])) {
            $sheets[] = new LaporanSkExport($this->data['nomor_sk'], $this->data['tahun']);
        }
        
        if (!empty($this->data['nomor_perbup'])) {
            $sheets[] = new LaporanPerbupExport($this->data['nomor_perbup'], $this->data['tahun']);
        }
        
        if (!empty($this->data['sk_lainnya'])) {
            $sheets[] = new LaporanSkLainnyaExport($this->data['sk_lainnya'], $this->data['tahun']);
        }

        // Jika tidak ada sheet, buat sheet kosong
        if (empty($sheets)) {
            $sheets[] = new EmptySheetExport();
        }

        return $sheets;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:Z1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFCCCCCC'],
                ],
            ],
        ];
    }
}

class LaporanSkExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $tahun;

    public function __construct($data, $tahun)
    {
        $this->data = $data;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        return view('cetak.excel.sk_sheet', [
            'nomor_sk' => $this->data,
            'tahun' => $this->tahun
        ]);
    }

    public function title(): string
    {
        return 'Nomor SK';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:J1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFCCCCCC'],
                ],
            ],
        ];
    }
}

class LaporanPerbupExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $tahun;

    public function __construct($data, $tahun)
    {
        $this->data = $data;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        return view('cetak.excel.perbup_sheet', [
            'nomor_perbup' => $this->data,
            'tahun' => $this->tahun
        ]);
    }

    public function title(): string
    {
        return 'Nomor Perbup';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:M1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFCCCCCC'],
                ],
            ],
        ];
    }
}

class LaporanSkLainnyaExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $tahun;

    public function __construct($data, $tahun)
    {
        $this->data = $data;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        return view('cetak.excel.sk_lainnya_sheet', [
            'sk_lainnya' => $this->data,
            'tahun' => $this->tahun
        ]);
    }

    public function title(): string
    {
        return 'SK Lainnya';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:L1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFCCCCCC'],
                ],
            ],
        ];
    }
}

class EmptySheetExport implements FromView
{
    public function view(): View
    {
        return view('cetak.excel.empty_sheet');
    }

    public function title(): string
    {
        return 'No Data';
    }
}