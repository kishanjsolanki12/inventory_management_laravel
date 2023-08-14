<?php
  
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Models\CompanyPayout;
use App\Models\PayoutTherapist;
use App\Models\PayoutLeadProvider;

use DB;
class CompanyPayoutExport implements FromView,WithColumnFormatting
{
    protected $id;

    function __construct($sort_by,$sort_type,$month,$year,$query,$per_page,$lead_provider_id,$payout_to) {
            $this->sort_by = $sort_by;
            $this->sort_type = $sort_type;
            $this->month = $month;
            $this->year = $year;
            $this->query = $query;
            $this->lead_provider_id = $lead_provider_id;
            $this->payout_to = $payout_to;
            $this->per_page = $per_page;
     }
    public function view(): View
    {
        $sort_by = $this->sort_by;
        $sort_type = $this->sort_type;
        $month = $this->month;
        $year = $this->year;
        $query = $this->query;
        $lead_provider_id = $this->lead_provider_id;
        $payout_to = $this->payout_to;
        $per_page = $this->per_page;
        $query_str = '';
        $query = str_replace(" ", "%", $this->query);
        $query_str_therapist ='';
        if(!empty($query))
            {
                $query_str = ' and (lp.name like "%'.$query.'%")';
                $query_str_therapist = ' and (concat(t.first_name," ",t.last_name) like "%'.$query.'%" or t.first_name like "%'.$query.'%" or t.last_name like "%'.$query.'%")';
            }
            $lead_provider_str= '';
            if($lead_provider_id != '')
            {
                $lead_provider_str = ' and payout_to_lead_provider.lead_provider_id = '.$lead_provider_id;
            }
            $payout_to_str= '';
            if($payout_to != '')
            {
                $payout_to_str = ' and payout_to_lead_provider.payout_type = '.$payout_to;
            }
            $company_payout = PayoutLeadProvider::selectRaw('payout_to_lead_provider.month,payout_to_lead_provider.year,mp.payout_to_title,lp.name as name,payout_to_lead_provider.amount as amount')
                ->leftjoin("master_payout_to as mp","mp.id","=","payout_to_lead_provider.payout_type")
                ->leftjoin("lead_provider as lp","lp.id","=","payout_to_lead_provider.lead_provider_id")
            ->whereRaw(' payout_to_lead_provider.month = '.$month.' and payout_to_lead_provider.year = '.$year.$payout_to_str.$query_str.$lead_provider_str)
           
            ->get(); 
            //prd($company_payout); 
           /* $payout_to_therapist = array();    
            if(empty($payout_to))
            {
                $payout_to_therapist = PayoutTherapist::selectRaw("payout_to_therapist.month,payout_to_therapist.year,'yes' as payout_to_title,concat(t.first_name,' ',t.last_name) as name,sum(amount) as amount")
                ->leftjoin("patients as p","p.id","=","payout_to_therapist.patient_id")
                ->leftjoin("therapists as t","t.id","=","payout_to_therapist.therapist_id")
                ->whereRaw('payout_to_therapist.payout_done = 1 and payout_to_therapist.month = '.$this->month.' and payout_to_therapist.year = '.$this->year.$therapist_str.$query_str_therapist)
                
                ->groupBy('payout_to_therapist.therapist_id')
                ->orderBy('payout_to_therapist.id','DESC')
                ->get();
            } */
        return view('admin.reports.company_payout.export', [
            'company_payout' => $company_payout,
            //'payout_to_therapist' => $payout_to_therapist,
            'month' => $this->month,
            'year' => $this->year            
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