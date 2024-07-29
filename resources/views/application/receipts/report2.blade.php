<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <style>
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
    .center {
    	text-align: center;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">Laravel HTML to PDF Example</h2>
        <table>    
          <thead>
            <tr class="table-primary">
                <td>
                    Date
                  </td>
                  <td>
                    Invoice No
                  </td>
                  <td>
                    Plate No
                  </td>
                  <td>
                    Tyre
                  </td>
                  <td>
                    Driver
                  </td>
                  <td>
                    Weight In
                  </td>
                  <td>
                    Weight Out
                  </td>
                  <td>
                    Net Weight
                  </td>
                  <td>
                    Price
                  </td>
                  <td>
                    Sand Type
                  </td>
            </tr>
          </thead>
          <tbody>
          @foreach($data as $data)
            <tr>
              <td>
                {{$data->invoice_date->format('d-m-Y')}}
              </td>
              <td>
                {{$data->invoice_number}}
              </td>
              <td>
                {{$data->plate_number}}
              </td>
              <td>
                {{$data->platenumbers->lorrys->name}}
              </td>
              <td>
                {{$data->drivers->name}}
              </td>
              <td>
                {{$data->platenumbers->weight}}
              </td>
              <td>
                @php
                foreach ($data->items as $dat) {
                echo sprintf('%0.3f', $dat->quantity+$data->platenumbers->weight);
                }
    
                @endphp
              </td>
              <td>
                @php
                foreach ($data->items as $dat) {
                echo sprintf('%0.3f', $dat->quantity);
                }
    
                @endphp
              </td>
              <td>
                @php
                foreach ($data->items as $dat) {
                echo $dat->total/100;
                }
    
                @endphp
              </td>
              <td>
                PCK
              </td>
              
            </tr>
          @endforeach
          </tbody>
        </table>

    </div>

    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>