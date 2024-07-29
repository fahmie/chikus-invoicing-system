<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">  body{
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  }
  table{
    table-layout: auto;
    width: 100%;  
    border-collapse: collapse;
  }
    th {
    background: #404853;
    background: linear-gradient(#687587, #404853);
    border-left: 1px solid rgba(0, 0, 0, 0.2);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    color: #fff;
    padding: 8px;
    text-align: left;
    text-transform: uppercase;
    }
    th:first-child {
    border-top-left-radius: 4px;
    border-left: 0;
    }
    th:last-child {
    border-top-right-radius: 4px;
    border-right: 0;
    }
    td {
    border-right: 1px solid #c6c9cc;
    border-bottom: 1px solid #c6c9cc;
    padding: 8px;
    }
    td:first-child {
    border-left: 1px solid #c6c9cc;
    }
    tr:first-child td {
    border-top: 0;
    }
    tr:nth-child(even) td {
    background: #e8eae9;
    }
    tr:last-child td:first-child {
    border-bottom-left-radius: 4px;
    }
    tr:last-child td:last-child {
    border-bottom-right-radius: 4px;
    }
    th, td {
    font-size: 10px;
  }
    img {
    	width: 40px;
    	height: 40px;
    	border-radius: 100%;
    }
    .center {
    	text-align: center;
    }
    .page-break {
    page-break-after: always;
    }
	</style>
  <link rel="stylesheet" href="">
	<title>Statement of account</title>
</head>
<body>

<table style="border: hidden; margin-bottom: 20px;">
  <tr>
    <td style="background: none;border: hidden;width: 50%;">
      <img src="{{ $companys->avatar }}" alt="avatar" class="avatar-img rounded" style="width: 25%; height: 70px; margin-bottom: 10px;">
    </td>
    <td style="background: none;border: hidden;width: 50%;">
      <h2 class="center">STATEMENT OF ACCOUNT</h2>
    </td>
  </tr>
  <tr>
    <td style="background: none;border: hidden;width: 50%;">
        <p style="font-weight: 700;">BILLING FROM
          <br>
          {{$companys->name}}
          <br>
          {{$companys->address->address_1}}
          <br>
          {{$companys->address->city ?? '' . $companys->address->state ?? ''}}
          <br>
          {{$companys->address->country->name ?? ''}}
          <br>
          T : {{$companys->address->phone ?? ''}} / 011 - 24230062 | F : +603 - 8800 7711
        </p>
        
        
    </td>
    <td style="background: none;border: hidden;width: 50%;">
      <p style="font-weight: 700; padding: 0, margin: 0">BILLING TO
        <br>
        {{$client->company_name}}
        <br>
        {{$client->address}}
        <br>
        {{$client->company_no}}
        <br>
        {{$client->phone}}
        <br> 
        Date: @php echo date('d-m-Y') @endphp
      </p>
    </td>
  </tr>
</table>

  
  @foreach($data as $key => $datas)
 <table>    
      <thead>
        <tr>
            <td style="width: 12%;font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000;background:#ddd">
                Date
              </td>
              <td width="12%" style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;background:#ddd">
                Plate No
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;background:#ddd">
                Tyre
              </td>
              <td width="20%" style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;background:#ddd">
                Driver
              </td>
              {{-- <td style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;">
                Weight In
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;">
                Weight Out
              </td> --}}
              <td style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;background:#ddd">
                Net Weight
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;background:#ddd">
                Price
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;background:#ddd">
                Sand Type
              </td>
              <td width="15%" style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;background:#ddd">
                Invoice No
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000;border-bottom: 2px solid #000;background:#ddd">
                Paid Status
              </td>
        </tr>
      </thead>
      <tbody>
        @php
          $all_weight = 0;
          $all_total = 0;
          $total_amount = 0;
        @endphp
        @foreach($datas as $databydate)
        <tr>
          <td style="background: #fafafa;">
            {{$databydate->invoice_date->format('d-m-Y')}}
          </td>
          <td style="background: #fafafa;">
            {{$databydate->plate_number}}
          </td>
          <td style="background: #fafafa;">
            @if(!empty($databydate->platenumbers->lorrys))
            {{$databydate->platenumbers->lorrys->name}}
            @else
            @endif
          </td>
          <td style="background: #fafafa;">
            @if(!empty($databydate->drivers->name))
            {{$databydate->drivers->name}}
            @else
            @endif
          </td>
          {{-- <td style="background: #fafafa;">
            {{$databydate->platenumbers->weight}}
          </td>
          <td style="background: #fafafa;">
            {{-- @php
            foreach ($databydate->items as $dat) {
            echo sprintf('%0.3f', $dat->quantity+$databydate->platenumbers->weight);
            }

            @endphp --}}
          </td> --}}
          <td style="background: #fafafa;">
            @php
            foreach ($databydate->items as $dat) {
            echo sprintf('%0.3f', $dat->quantity);
            $all_weight += sprintf('%0.3f', $dat->quantity);
            }

            @endphp
          </td>
          <td style="background: #fafafa;">
            @php
            foreach ($databydate->items as $dat) {
            echo $dat->total/100;
            $all_total += $dat->total/100;
            }
            @endphp
          </td>
          <td style="background: #fafafa;">
            @php
            foreach ($databydate->items as $dat) {
            //echo $dat->product->name;
            if(preg_match_all('/\b(\w)/',strtoupper($dat->product->name),$m)) {
               echo $v = implode('',$m[1]); // $v is now SOQTU
            }
            }
            @endphp
          </td>
          <td style="background: #fafafa;">
            {{$databydate->invoice_number}}
          </td>
          <td style="background: #fafafa;">
            {{$databydate->paid_status}}
          </td>
        </tr>
        @endforeach
        <tr>
          <td style="border-top: 2px solid #000;background: #f8b1a5;" colspan="4">
              TOTAL
          </td>
          <td style="border-top: 2px solid #000;-align:right;background: #f8b1a5;">
            @php
              echo sprintf('%0.3f', $all_weight);
            @endphp
          </td>
          <td style="border-top: 2px solid #000;background: #f8b1a5;" colspan="4">
            RM {{$all_total}}
          </td>
        </tr>
      </tbody>
    </table>
    @endforeach
    <br>
    <table>
      <tbody style="border: 1px solid #98C9FF;">
      <tr  class="table-primary" style="height: 18px;">
      <td style="font-weight: 700;width: 25%; height: 18px;">        
        @foreach($product as $dat2) 
        Unit Price ({{$dat2->name}})
        <br>
        @endforeach</td>
      <td style="width: 25%; height: 18px;background: #fafafa;">
        @foreach($product as $dat2) 
        RM {{$dat2->price/100}} 
        <br>
        @endforeach
      </td>
      <td style="font-weight: 700;width: 25%; height: 18px;">
        
        @foreach($total_by_product as $dat3) 
        Total Out/Sent {{$dat3->name}} (MT)
        <br>
        @endforeach
      </td>
      <td style="width: 25%; height: 18px;background: #fafafa;">
        @foreach($total_by_product as $dat3) 
        {{$dat3->total_mt}}
        <br>
        @endforeach
      </td>
      </tr>
      <tr class="table-primary" style="height: 18px;">
      <td style="font-weight: 700;width: 25%; height: 18px;">Total Amount (RM)</td>
      </td>
      <td style="width: 25%; height: 18px;background: #fafafa;">RM {{$total_price}}</td>
      <td style="font-weight: 700;width: 25%; height: 18px;">Total (MT)</td>
      <td style="width: 25%; height: 18px;background: #fafafa;">@php echo sprintf('%0.3f', $total_mt) @endphp</td>
      </tr>
      <tr class="table-primary" style="height: 18px;">
      <td style="font-weight: 700;width: 25%; height: 18px;">Paid Amount(RM)</td>
      <td style="width: 25%; height: 18px;background: #fafafa; border-right: hidden;">RM {{$paid_amount/100}}</td>
      <td style="width: 25%; height: 18px;background: #fafafa; border-right: hidden;">&nbsp;</td>
      <td style="width: 25%; height: 18px;background: #fafafa;">&nbsp;</td>
      </tr>
      <tr class="table-primary" style="height: 18px;">
      <td style="font-weight: 700;width: 25%; height: 18px;">Balance Outstanding (RM)</td>
      <td style="width: 25%; height: 18px;background: #fafafa; border-right: hidden;">RM {{($outstanding/100)}}</td>
      <td style="width: 25%; height: 18px;background: #fafafa; border-right: hidden;">&nbsp;</td>
      <td style="width: 25%; height: 18px;background: #fafafa;">&nbsp;</td>
      </tr>
      </tbody>
      <br>
      </table>
      <table>
        <tbody style="border: hidden;">
        <tr style="height: 18px;">
        <td style="font-weight: 700;width: 100%; height: 18px;background: #ffff;border: hidden;">        
          {{$currentCompany->getSetting('invoice_note')}}
        </td>
        {{-- <td style="font-weight: 700;width: 75%; height: 18px;background: #ffff;border: hidden;">        
        </td> --}}
        </tbody>
        <br>
        </table>
    <script type="text/php">
      if (isset($pdf)) {
          $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
          $font = null;
          $size = 8;
          $color = array(0,0,0);
          $word_space = 0.0;  //  default
          $char_space = 0.0;  //  default
          $angle = 0.0;   //  default
          
          // Compute text width to center correctly
          $textWidth = $fontMetrics->getTextWidth($text, $font, $size);

          $x = ($pdf->get_width() - $textWidth)/1.8;
          $y = $pdf->get_height() - 35;

          $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
      }
  </script>
</body>
</html>