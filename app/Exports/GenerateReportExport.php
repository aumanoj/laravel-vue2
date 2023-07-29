<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class GenerateReportExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents,WithColumnFormatting,WithMapping
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    private $data;

    public function __construct(array $data)
    {
    	$this->data = $data;
    }

    public function collection()
    {
    	$tblOrder = \App\helpers\GenerateReportQuery::getGenerateReportQuery($this->data['manu_id'],$this->data['model_id'],$this->data['country_id'],$this->data['network_id'],$this->data['user_country_id'],$this->data['order_status'],$this->data['payment_status'],$this->data['pay_status'],$this->data['order_reference_status'],$this->data['chk_brand'],$this->data['chk_model'],$this->data['chk_country'],$this->data['chk_network'],$this->data['start_date'],$this->data['end_date']);

    	return collect($tblOrder['tblOrder']);    
    }

    public function headings(): array
    {
    	if ($this->data['chk_brand'] == 1 || 
            $this->data['chk_model'] == 1 ||
            $this->data['chk_country'] == 1 ||
            $this->data['chk_network'] == 1)
    	{
    		return [
    			["Order Details Report"],
                [''],
    			['as on '.date('d-m-Y',strtotime(now()))],
    			['Brand',
    			'Model',
    			'Country',
    			'Network',
    			'Total Qty',
    			'Total Paid',
                'Total Refund',
    			]
    		];
    	}
    	else
    	{
    		return [
    			["Order Details Report"],
                [''],
    			['as on '.date('d-m-Y',strtotime(now()))],
    			['Order ID',
    			'Brand',
    			'Model',
    			'Country',
    			'Network',
    			'Paid Amount','',
    			'Date']
    		];	
    	}
    	
    }

    public function registerEvents(): array
    {   
        if ($this->data['chk_brand'] == 1 || 
            $this->data['chk_model'] == 1 ||
            $this->data['chk_country'] == 1 ||
            $this->data['chk_network'] == 1)
        {
            return [
              AfterSheet::class => function(Aftersheet $event) {
                $event->sheet->getDelegate()->mergeCells('A1:G1');
                $event->sheet->getDelegate()->mergecells('A2:G2');
                $event->sheet->getDelegate()->mergeCells('A3:G3');
                $event->sheet->getDelegate()->freezePane('A5');
                $event->sheet->getDelegate()->getStyle('A1:G4')
                    ->getAlignment()->setHOrizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:G1')->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('A1:G4')->getFont()->setBold(true);
                if (!empty($this->data['start_date']) && !empty($this->data['end_date']))
                {
                    $event->sheet->setCellValue('A2','From '.date('d-m-Y',strtotime($this->data['start_date'])).' To '.date('d-m-Y',strtotime($this->data['end_date'])));
                }
            }];
        }
        else
        {
            return [
    		  AfterSheet::class => function(Aftersheet $event) {
                $event->sheet->getColumnDimension('G')->setVisible(false);
                $event->sheet->getDelegate()->mergeCells('A1:H1');
                $event->sheet->getDelegate()->mergecells('A2:H2');
                $event->sheet->getDelegate()->mergeCells('A3:H3');
                $event->sheet->getDelegate()->freezePane('A5');
                $event->sheet->getDelegate()->getStyle('A1:H4')
                    ->getAlignment()->setHOrizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:H1')->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('A1:H4')->getFont()->setBold(true);
                if (!empty($this->data['start_date']) && !empty($this->data['end_date']))
                {
                    $event->sheet->setCellValue('A2','From '.date('d-m-Y',strtotime($this->data['start_date'])).' To '.date('d-m-Y',strtotime($this->data['end_date'])));
                }
    		}];
        }
    }

    public function map($data): array
    {
        if ($this->data['chk_brand'] == 1 || 
            $this->data['chk_model'] == 1 ||
            $this->data['chk_country'] == 1 ||
            $this->data['chk_network'] == 1)
        {
            return [
                $data->manu_name,
                $data->model_num,
                $data->country_name,
                $data->network_name,
                $data->qty,
                $data->paid,
                $data->refund
            ];
        }
        else
        {
            return [
                $data->order_id,
                $data->manu_name,
                $data->model_num,
                $data->country_name,
                $data->network_name,
                $data->paid_amount,
                $data->order_id,
                \PhpOffice\PhpSpreadsheet\Shared\Date::stringToExcel($data->insert_time)
            ];
        }
    }

    public function columnFormats(): array
    {
        if ($this->data['chk_brand'] == 1 || 
            $this->data['chk_model'] == 1 ||
            $this->data['chk_country'] == 1 ||
            $this->data['chk_network'] == 1)
        {
            return [
                'A' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'B' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'C' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'D' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'E' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER,
                'F' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_00,
                'G' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_00,
            ];
        }
        else
        {
            return [
                'A' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'B' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'C' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'D' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'E' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'F' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_00,
                'G' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT,
                'H' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY
            ];
        }
    }
}
