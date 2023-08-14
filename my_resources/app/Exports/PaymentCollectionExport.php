<?php
  
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Models\DailyTherapistVisitTransection;
use App\Models\PatientsTreatments;
use DB;
class PaymentCollectionExport implements FromView,WithColumnFormatting
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
            $patient_invoices = DailyTherapistVisitTransection::selectRaw('pi.id,pi.hand_over_account,pi.payment_collected,daily_therapist_visit_transection.patient_id,
              (SELECT count(*) FROM daily_therapist_visit_transection as o1 WHERE (o1.is_attend = 1 and DATE_FORMAT(o1.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(o1.treatment_date, "%Y") = "'.$year.'") and o1.patient_id = daily_therapist_visit_transection.patient_id) AS total_visit,pi.final_amount,concat(COALESCE(p.first_name,"")," ",COALESCE(p.last_name,"")) as patient_name,p.mobilenumber')
            ->leftjoin("therapists as u1","u1.id","=","daily_therapist_visit_transection.therapist_id")
            ->leftjoin("patients as p","p.id","=","daily_therapist_visit_transection.patient_id")
            ->leftjoin("patient_invoices as pi","pi.patient_id","=","daily_therapist_visit_transection.patient_id")
            ->leftjoin("master_therapy_type as mt","mt.id","=","daily_therapist_visit_transection.therapy_id")
           // ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('daily_therapist_visit_transection.is_attend = 1  and pi.month = '.$month.' and pi.year = '.$year)
            
            //->groupBy('daily_therapist_visit_transection.therapy_id')
            ->groupBy('daily_therapist_visit_transection.patient_id')
            ->get(); 
            
        return view('admin.reports.lead_report.export', [
            'home_visit' => $home_visit,
            'hospital_visit' => $hospital_visit,
            'clinic_visit' => $clinic_visit,
            'month' => $this->month,
            'year' => $this->year,
            'patient_invoices'=>$patient_invoices
            
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