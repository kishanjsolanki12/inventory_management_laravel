<?php
  
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Models\DailyTherapistVisitTransection;
use App\Models\PatientsTreatments;
use DB;
class DnReportExport implements FromView,WithColumnFormatting
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
            $dn_visit =  DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,tt.treatment_type_title,mt.type_name,pt.visit_type,pt.starting_date,pt.visit_time,group_concat(distinct mt.type_name) as thearpy_list,group_concat(distinct daily_therapist_visit_transection.therapy_id) as thearpy_ids,concat(COALESCE(p.first_name,''),' ',COALESCE(p.last_name,'')) as patient_name,mv.visit_type_title")
            ->leftjoin("therapists as u1","u1.id","=","daily_therapist_visit_transection.therapist_id")
            ->leftjoin("master_therapy_type as mt","mt.id","=","daily_therapist_visit_transection.therapy_id")

            ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
            ->leftjoin("master_treatment_type as tt","tt.id","=","pt.treatment_type")
            ->leftjoin("master_visit_type as mv","mv.id","=","pt.visit_type")
            ->leftjoin("patients as p","p.id","=","daily_therapist_visit_transection.patient_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$this->month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$this->year.'"')
            ->groupBy('daily_therapist_visit_transection.patients_treatments_id')
            ->groupBy('daily_therapist_visit_transection.patient_id')
            //->groupBy('daily_therapist_visit_transection.therapy_id')
            ->get(); 
            
        return view('admin.reports.dn_report.export', [
            'dn_visit' => $dn_visit,
            'month' => $this->month,
            'year' => $this->year,
            
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