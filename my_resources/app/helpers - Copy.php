<?php
  
function change_Datetime_Format($date,$format=''){
	if(!empty($format))
	{
		return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($format); 

	}
	else
	{
		//return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');    
		return date('d-m-Y h:i a', strtotime($date)); 	
	}
    
}
function pr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

   
    function prd($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        die;
    } 
?>