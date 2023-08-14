<!doctype html>

    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Invoice</title>
    </head>
    <body>

    <style>

      body{
        font-family: cerapro, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 11px;
            }
          .center{
            text-align: center;
          }
          .right{
            text-align: right;
          }
          .left{  
            text-align: left;
          }
          th{
            padding: 3px;
          }
        table.unit td {border: 1px soild #ccc;padding: 5px;}
        table td { text-align: left;vertical-align: top;}
    </style>
    <br>
   @include('admin.payout_to_hospital.invoice')
    <script type="text/php">
      if ( isset($pdf) ) {
          $font ='arial';
          $pdf->page_text(500, 18, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
      }
    </script>
     </body>
    </html>