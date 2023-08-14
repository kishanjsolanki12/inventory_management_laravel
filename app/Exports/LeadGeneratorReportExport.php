<?php
  
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Models\DailyTherapistVisitTransection;
use App\Models\PatientsTreatments;
use DB;
class LeadGeneratorReportExport implements FromView,WithColumnFormatting
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
        $month = $this->month;
        $year = $this->year;
            $home_visit =  DailyTherapistVisitTransection::selectRaw('(SELECT count(DISTINCT p.id) as total_patient FROM patients as p WHERE ( p.lead_from = 1 and DATE_FORMAT(p.created_at, "%m") = "'.$month.'" and DATE_FORMAT(p.created_at, "%Y") = "'.$year.'")) as physiocare_patient,(SELECT count(DISTINCT p.id) as total_patient FROM patients as p WHERE ( p.lead_from = 2 and DATE_FORMAT(p.created_at, "%m") = "'.$month.'" and DATE_FORMAT(p.created_at, "%Y") = "'.$year.'")) as hospital_patient,(SELECT count(DISTINCT p.id) as total_patient FROM patients as p WHERE ( p.lead_from = 3 and DATE_FORMAT(p.created_at, "%m") = "'.$month.'" and DATE_FORMAT(p.created_at, "%Y") = "'.$year.'")) as doctor_patient,(SELECT count(DISTINCT p.id) as doctor_patient FROM patients as p WHERE ( p.lead_from = 4 and DATE_FORMAT(p.created_at, "%m") = "'.$month.'" and DATE_FORMAT(p.created_at, "%Y") = "'.$year.'")) as social_media_patient,(SELECT count(DISTINCT p.id) as doctor_patient FROM patients as p WHERE ( p.lead_from = 5 and DATE_FORMAT(p.created_at, "%m") = "'.$month.'" and DATE_FORMAT(p.created_at, "%Y") = "'.$year.'")) as patient_ref_patient,(SELECT count(DISTINCT p.id) as doctor_patient FROM patients as p WHERE ( p.lead_from = 6 and DATE_FORMAT(p.created_at, "%m") = "'.$month.'" and DATE_FORMAT(p.created_at, "%Y") = "'.$year.'")) as family_patient,(SELECT count(DISTINCT p.id) as doctor_patient FROM patients as p WHERE ( p.lead_from = 7 and DATE_FORMAT(p.created_at, "%m") = "'.$month.'" and DATE_FORMAT(p.created_at, "%Y") = "'.$year.'")) as other_patient')
            ->leftjoin("patients as p","p.id","=","daily_therapist_visit_transection.patient_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'"')
            ->groupBy('daily_therapist_visit_transection.patient_id')
            ->groupBy('p.lead_from')
            ->get(); 
            
       $all_visit =  DailyTherapistVisitTransection::selectRaw('SUM(case when p.lead_from = 1 then 1 else 0 end) as physiocares_visit,SUM(case when p.lead_from = 2 then 1 else 0 end) as hospital_visit,SUM(case when p.lead_from = 3 then 1 else 0 end) as doctor_visit,SUM(case when p.lead_from = 4 then 1 else 0 end) as social_media_visit,SUM(case when p.lead_from = 5 then 1 else 0 end) as patient_ref_visit,SUM(case when p.lead_from = 6 then 1 else 0 end) as family_visit,SUM(case when p.lead_from = 7 then 1 else 0 end) as other_visit,SUM(case when p.lead_from = 1 then therapy_final_amount else 0 end) as physiocares_final_amount,SUM(case when p.lead_from = 2 then therapy_final_amount else 0 end) as hospital_final_amount,SUM(case when p.lead_from = 3 then therapy_final_amount else 0 end) as doctor_final_amount,SUM(case when p.lead_from = 4 then therapy_final_amount else 0 end) as social_media_final_amount,SUM(case when p.lead_from = 5 then therapy_final_amount else 0 end) as patient_ref_final_amount,SUM(case when p.lead_from = 6 then therapy_final_amount else 0 end) as family_final_amount,SUM(case when p.lead_from = 7 then therapy_final_amount else 0 end) as other_final_amount')
            ->leftjoin("patients as p","p.id","=","daily_therapist_visit_transection.patient_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'"')
            //->groupBy('daily_therapist_visit_transection.therapist_id')
           // ->groupBy('daily_therapist_visit_transection.therapy_id')
            ->first(); 
            
        return view('admin.reports.lead_generation_report.export', [
            'home_visit' => $home_visit,
            'all_visit' => $all_visit,
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