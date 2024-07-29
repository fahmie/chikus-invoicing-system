<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
  body{
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  }
  table{
    table-layout: auto;
    width: 100%;  
    border-collapse: collapse;
  }
  table.header{
    border: hidden;
    border-right: hidden;
  }
  tr:nth-child(even) td.header {
    background: #ffff;
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
	<title>Stock Sales Analysis Report</title>
</head>
<body>
{{-- <h2 class="center">Stock Sales Analysis Report</h2> --}}
<table class="header">
  <tbody>
  <tr class="header" style="height: 18px;border: hidden;">
  <td class="header" style="border: hidden;">                    
    @if(!empty($companys->avatar))
    <img src="{{ $companys->avatar }}" alt="avatar" class="avatar-img rounded" style="width: 15%; height: 70px; margin-bottom: 10px;">
    @elseif(empty($companys->avatar))
    <img class="navbar-brand-icon" src="<?php echo asset("storage/logo/ModkhaGroup.png")?>" style="width: 15%; height: 70px; margin-bottom: 10px;">
    @endif</td>
  <td class="header" style="width: 10%; height: 18px;border: hidden;"></td>
  <td class="header" style="width: 10%; height: 18px;border: hidden;"></td>
  <td class="header" style="width: 65%; height: 18px;border: hidden;"><h2>Stock Sales Analysis Report</h2></td>
  </tr>
  </tr>
  <tr class="header" style="height: 18px;border: hidden;">
  <td class="header" style="font-weight: 700;width: 25%; height: 18px;border: hidden;">
    {{$companys->name}}
    <br>
    {{$companys->address->address_1}}
    <br>
    {{$companys->address->city ?? '' . $companys->address->state ?? ''}}
    <br>
    {{$companys->address->country->name ?? ''}}
    <br>
    {{$companys->address->phone ?? ''}}
  </td>
  </td>
  <td class="header" style="width: 25%; height: 18px;border: hidden;">
  <td class="header" style="font-weight: 700;width: 25%; height: 18px;border: hidden;">Date Generated</td>
  <td class="header" style="font-weight: 700;width: 25%; height: 18px;border: hidden;">@php echo date('d-m-Y') @endphp</td>
  </tbody>
  </table>
  <br>
  @foreach($data as $key => $datas)
 <table>    
      <thead>
        <tr>
            <td width="12%" style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000; background:#ddd">
                Date
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000; background:#ddd">
                Plate No
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000; background:#ddd">
                Tyre
              </td>
              <td width="15%" style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000; background:#ddd">
                Driver
              </td>
              <td width="15%" style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000; background:#ddd">
                Contract Name
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000;background:#ddd">
                Net Weight
              </td>
              {{-- <td style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000;">
                Shortage (MT)
              </td> --}}
              <td style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000;background:#ddd">
                Unit Price
              </td>
              {{-- <td style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000;">
                Discount
              </td> --}}
              <td style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000;background:#ddd">
                Total Price
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000;background:#ddd">
                Sand Type
              </td>
              <td style="font-weight: 700;border-top: 1px solid #000; border-bottom: 2px solid #000;background:#ddd" width="15%">
                Invoice No
              </td>
        </tr>
      </thead>
      <tbody>
        @php
          $all_weight = 0;
          $all_total = 0;
          $total_mt =0.000;
        @endphp
        @foreach($datas as $databydate)
        <tr>
          <td style="background: #fff;">
            {{$databydate->invoice_date->format('d-m-Y')}}
          </td>
          <td style="background: #fff;">
            {{$databydate->plate_number}}
          </td>
          <td style="background: #fff;">
            @if(!empty($databydate->platenumbers->lorrys))
            {{$databydate->platenumbers->lorrys->name}}
            @else
            @endif
          </td>
          <td style="background: #fff;">
            @if(!empty($databydate->drivers->name))
            {{$databydate->drivers->name}}
            @else
            @endif
          </td>
          <td style="background: #fff;">
            @if($databydate->type ==1)
            @if(!empty($databydate->clients))
            {{$databydate->clients->company_name}}
            @endif
            @else
            
            @endif
          </td>
          <td style="background: #fff;">
            @php
            foreach ($databydate->items as $dat) {
            echo sprintf('%0.3f', $dat->quantity);
            $all_weight += sprintf('%0.3f', $dat->quantity);
            }

            @endphp
          </td>
          {{-- <td style="background: #fff;"> 
            @php
            // foreach ($databydate->items as $dat) {
            // $shortage = sprintf('%0.3f', $dat->quantity) - sprintf('%0.3f', $databydate->accurate_remark);
            // $total_shortage = sprintf('%0.3f',$shortage) - sprintf('%0.3f', $dat->quantity);
            // $all_shortage += $total_shortage;            
            // }
            // echo sprintf('%0.3f', $total_shortage);
            @endphp
          </td> --}}
          <td style="background: #fff;">
            @php
            foreach ($databydate->items as $dat) {
            echo  $dat->price/100;
            }
            @endphp
          </td>
          {{-- <td style="background: #fff;">
            @php
            if($databydate->discount == null){
              $databydate->discount = 0.00;
            }
              echo $databydate->discount;
             $total_dis += $databydate->discount;
            @endphp
          </td> --}}
          <td style="background: #fff;">
            @php
            foreach ($databydate->items as $dat) {
            echo $dat->total/100;
            $all_total += $dat->total/100;
            }
            @endphp
          </td>
          <td style="background: #fff;">
            @php
            foreach ($databydate->items as $dat) {
            //echo $dat->product->name;
            if(preg_match_all('/\b(\w)/',strtoupper($dat->product->name),$m)) {
               echo $v = implode('',$m[1]); // $v is now SOQTU
            }
            }
            @endphp
          </td>
          <td style="background: #fff;">
            {{$databydate->invoice_number}}
          </td>
        </tr>
        @endforeach
        <tr>
          <td style="border-top: 2px solid #000;background: #f8b1a5;" colspan="5">
              TOTAL
          </td>
          <td style="border-top: 2px solid #000;background: #f8b1a5;" colspan="2">
            @php
            echo sprintf('%0.3f', $all_weight);
            $total_mt +=$all_weight;
          @endphp
        </td>
          {{-- <td style="border-top: 2px solid #000;background: #f8b1a5;" colspan="2">
            @php
            echo sprintf('%0.3f', $all_shortage);
          @endphp
        </td>  --}}
          {{-- <td style="border-top: 2px solid #000;background: #f8b1a5;">
            @php
              echo $total_dis;
            @endphp
          </td> --}}
          <td style="border-top: 2px solid #000;background: #f8b1a5;" colspan="3">
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
      <td style="font-weight: 700;width: 25%; height: 18px;">Total Sales (RM)</td>
      <td style="width: 25%; height: 18px;background: #fafafa;">{{$total_sales_rm/100}}</td>
      <td style="font-weight: 700;width: 25%; height: 18px;">Total Sales (MT)</td>
      <td style="width: 25%; height: 18px;background: #fafafa;">            
      @php
        echo sprintf('%0.3f', $total_sales_mt->total_mt);
      @endphp
      </td>
      </tr>
      </tr>
      <tr class="table-primary" style="height: 18px;">
      <td style="font-weight: 700;width: 25%; height: 18px;">Total Contract (RM)</td>
      <td style="width: 25%; height: 18px;background: #fafafa;">{{$total_sales_contract_rm/100}}</td>
      <td style="font-weight: 700;width: 25%; height: 18px;">Total Contract (MT)</td>
      <td style="width: 25%; height: 18px;background: #fafafa;">      
      @php
        echo sprintf('%0.3f', $total_sales_contract_mt->total_mt);
      @endphp
      </td>
      </tr>
      <tr class="table-primary" style="height: 18px;">
      <td style="font-weight: 700;width: 25%; height: 18px;">Total Cash (RM)</td>
      <td style="width: 25%; height: 18px;background: #fafafa; border-right: hidden;">{{$total_sales_cash_rm/100}}</td>
      <td style="font-weight: 700;width: 25%; height: 18px;">Sales Cash (MT)</td>
      <td style="width: 25%; height: 18px;background: #fafafa;">{{sprintf('%0.3f',$total_sales_cash_mt->total_mt)}}</td>
      </tr>
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