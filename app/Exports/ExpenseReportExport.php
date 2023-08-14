<?php
  
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Models\DailyTherapistVisitTransection;
use App\Models\CompanyExpenses;
use DB;
class ExpenseReportExport implements FromView,WithColumnFormatting
{
    protected $id;

    function __construct($sort_by,$sort_type,$month,$year,$query,$per_page) {
            $this->sort_by = $sort_by;
            $this->sort_type = $sort_type;
            $this->month = $month;
            $this->year = $year;
            $this->query = $query;
            $this->per_page = $per_page;
     }
    public function view(): View
    {
            $expense_data = CompanyExpenses::selectRaw('company_expenses.*,et.expense_type_title')
            ->leftjoin("master_expense_type as et","et.id","=","company_expenses.expense_type")
            ->whereRaw('company_expenses.month = '.$this->month.' and company_expenses.year = '.$this->year)
            ->get(); 
            
        return view('admin.reports.expense_report.export', [
            'month' => $this->month,
            'year' => $this->year,
            'expense_data'=>$expense_data
            
        ]);
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            
            
        ];
    }
}
?>