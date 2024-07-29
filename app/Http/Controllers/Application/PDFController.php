<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Estimate;
use App\Models\Payment;
use App\Models\Lorry;
use App\Models\Receipt;
use App\Models\ReceiptTransporter;
use App\Services\PDFService;
use App\Services\PDFServiceRec;
use App\Services\PDFServiceRecPartial;
use App\Services\PDFServiceDo;
use App\Services\PDFServiceDoArrive;
use App\Services\PDFServiceRecTrans;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Get Invoice Pdf
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return pdf
     */
    public function invoice(Request $request)
    {
        $invoice = Invoice::findByUid($request->invoice);
        $company = $invoice->company;
        $driver = $invoice->drivers;
        $client = $invoice->clients;

        //Create a new pdf instance
        $pdf = new PDFService("A4");

        //Set your logo
        $pdf->setLogo($company->avatar, 180, 100);

        //Set theme color
        $pdf->setColor($company->getSetting('invoice_color'));

        //Set type
        $pdf->setType(__('messages.invoice_upper_case'));

        // Set Tax per Item
        $pdf->setTaxPerItem($invoice->tax_per_item);

        // Set Discount per Item
        $pdf->setDiscountPerItem($invoice->discount_per_item);

        //Set reference
        $pdf->setReference($invoice->invoice_number);

        //Set date
        $pdf->setDate($invoice->formatted_invoice_date);

        //Set  due date
        $pdf->setDue($invoice->formatted_due_date);
        
        //Set reference
        $pdf->setReference2($invoice->created_at->format('m/d/Y H:i:s'));

         //Set From
         $pdf->setFrom([
            $company->name,
            $company->address->address_1,
            $company->address->address_2,
            $company->address->city ?? '' . $company->address->state ?? '',
            $company->address->country->name ?? '',
            $company->address->phone ?? '',
        ]);

        if($invoice->client_id != NULL)
        {
        //Set to
        $pdf->setTo([
            $client->company_name,
            "Address: " .$client->address,
            "No Company: " .$client->company_no,
            "No.Phone: " .$client->phone,
            "Delivery Address: " . $client->delivery_location,
            "Driver Details: " . $driver->name." | " . $driver->ic,
            "Lorry Details: " . $invoice->platenumbers->number_plate." | ".$invoice->platenumbers->weight ." Tan "." | ". Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name
        ]);
        }else{
            
            $pdf->setTo([
                $driver->name,
                "No. IC: " .$driver->ic,
                "No.Phone: " .$driver->phone,
                "Phone: " .$driver->phone,
                "Lorry Type: " .Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name,
                "Plate Number: " . $invoice->platenumbers->number_plate,
                " " ,
            ]);
        }
        

        // Add items
        foreach ($invoice->items as $item) {
            $pdf->addItem(
                $item->product->name, 
                $item->product->description,
                $item->quantity,
                $item->getTotalPercentageOfTaxes(), 
                money($item->price, "MYR")->format(), 
                $item->discount_val, 
                money($item->total, "MYR")->format()
            );
        }

        // Set Sub Total
        $pdf->addTotal(__('messages.sub_total'), money($invoice->sub_total, "MYR")->format());

        // Set Taxes Total
        if($invoice->tax_per_item == false) {
            $pdf->addTotal(__('messages.tax'), $invoice->getTotalPercentageOfTaxes(). ' %');
        }

        // Set Discount Total
        if($invoice->discount_per_item == false) {
            $pdf->addTotal(__('messages.discount'), (int) $invoice->discount_val . ' %');
        }

        // Set Total
        $pdf->addTotal(__('messages.total'), money($invoice->total, "MYR")->format(), true);

        //Add notes
        // $pdf->addParagraph($invoice->notes);
        $pdf->addParagraph($company->getSetting('invoice_note'));

        //Set footernote
        // $pdf->setFooternote('This is computer generated invoice, our signature is not required. ');
        $pdf->setFooternote($company->getSetting('invoice_footer'));

        // Add Status Badge
        $pdf->addBadge($invoice->paid_status);

        //Render or Download
        if($request->has('download')) {
            $pdf->render($invoice->invoice_number . '.pdf', 'D');
        } else {
            $pdf->render($invoice->invoice_number . '.pdf', 'I');
        }
    }

    public function receipts(Request $request, $id, $refrence)
    {
       // dd($id);
        $invoices = Receipt::where('reference_number', $refrence)->first();
        $invoices1 = Invoice::where('id', $id)->first();
        $invoice = Invoice::where('id', $invoices->invoice_id)->first();
        $company = $invoice->company;
        $payment = $invoice->payments;
        $invoic1e = Invoice::findByUid($request->invoice);
        $driver = $invoice->drivers;
        $client = $invoice->clients;
        $receipts = Receipt::where('reference_number', $refrence)->get();
        $receipt_status = Receipt::where('invoice_id', $id)->where('reference_number', $refrence)->first();

        //dd($receipt_status->receipt_status);

        //Create a new pdf instance
        $pdf = new PDFServiceRecPartial("A4");

        //Set your logo
        $pdf->setLogo($company->avatar, 180, 100);

        //Set theme color
        $pdf->setColor($company->getSetting('invoice_color'));

        //Set type
        $pdf->setType("RECEIPT");

        // Set Tax per Item
        $pdf->setTaxPerItem($invoice->tax_per_item);

        // Set Discount per Item
        $pdf->setDiscountPerItem($invoice->discount_per_item);

        //Set reference
        $pdf->setReference($invoices->receipt_number);

        // //Set reference Invoice
        $pdf->setReference1($invoices1->invoice_number);

        //Set reference created at
        $pdf->setReferenceRec1($invoice->created_at->format('m/d/Y H:i:s'));

        //Set date
        $pdf->setDate($invoice->formatted_invoice_date);

        //Set  due date
        $pdf->setDue($invoice->formatted_due_date);

        // //Set reference
        $pdf->setReferenceRec($invoices->payment_number);

        //Remarks
        $pdf->setRemarks($invoices->payment_method->name);

        //Set From
        $pdf->setFrom([
            $company->name,
            $company->address->address_1,
            $company->address->address_2,
            $company->address->city ?? '' . $company->address->state ?? '',
            $company->address->country->name ?? '',
            $company->address->phone ?? '',
        ]);

        if($invoice->client_id != NULL)
        {
        //Set to
        $pdf->setTo([
            $client->company_name,
            "Address: " .$client->address,
            "No Company: " .$client->company_no,
            "No.Phone: " .$client->phone,
            "Delivery Address: " . $client->delivery_location,
            // "Driver Details: " . $driver->name." | " . $driver->ic,
            // "Lorry Details: " . $invoice->platenumbers->number_plate." | " . Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name
        ]);
        }else{
            
            $pdf->setTo([
                $driver->name,
                "No. IC: " .$driver->ic,
                "No.Phone: " .$driver->phone,
                "Phone: " .$driver->phone,
                "Lorry Type: " .Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name,
                "Plate Number: " . $invoice->platenumbers->number_plate,
                " " ,
            ]);
        }
        // Add items
        $total_amount = 0;
        $sum =0;
        $parrived = 0;
        $qsent = 0;
        $qarrived = 0;
        $uprice = 0;
        $psent = 0;
        $ots = 0;
        $sub_total = 0;
        foreach ($receipts as $key=>$item) {
            $parrived  +=$item->items->price*$item->invoices->accurate_remark; //Price arrived
            $qsent +=$item->items->quantity;
            $qarrived +=$item->invoices->accurate_remark;
            $uprice +=$item->items->price;
            $psent +=$item->invoices->total;
            $sub_total +=$item->total;

            if($item->receipt_status == "PAID"){
                $ots +=0;
                $pdf->addItem(
                    $item->invoices->invoice_number, //invoice num
                    number_format($item->items->price*$item->invoices->accurate_remark/100,2),//price arrived
                    number_format($item->items->quantity,3), //qty sent
                    number_format($item->invoices->accurate_remark,3), //qty arrived
                    number_format($item->items->price/100,2), //unit price
                    number_format($item->invoices->total/100,2), //price sent
                    "0", //outstanding
                    $receipts_status = $item->receipt_status, 
                    $item->invoice_id, 
                    number_format($item->balance/100,2),
                    number_format($item->total/100,2)   
                     

                );
            }else{
                $ots +=$item->balance;
                $pdf->addItem(
                    $item->invoices->invoice_number, //invoice num
                    number_format($item->items->price*$item->invoices->accurate_remark/100,2),//price arrived
                    number_format($item->items->quantity,3), //qty sent
                    number_format($item->invoices->accurate_remark,3), //qty arrived
                    number_format($item->items->price/100,2), //unit price
                    number_format($item->invoices->total/100,2), //price sent
                    number_format($item->balance/100,2), //outstanding
                    $receipts_status = $item->receipt_status, 
                    $item->invoice_id, 
                    number_format($item->balance/100,2),
                    number_format($item->total/100,2)     
                );
            }

            $total_amount +=$item->total;
        }   
        //Total SUM
        $total_amount = 0;
        $sum =0;
            $pdf->addItem1(
                "TOTAL SUM",
                number_format($parrived/100,2),
                // money($parrived, "MYR")->format(),//price arrived
                number_format($qsent,3), //qty sent
                number_format($qarrived,3), //qty arrived
                number_format($uprice/100,2), //unit price
                // money($uprice, "MYR")->format(), //unit price
                number_format($psent/100,2),
                // money($psent, "MYR")->format(), //price sent
                number_format($ots/100,2),
                // money($ots, "MYR")->format(),//outstanding
                "7",
                "8",
                "9",
                number_format($sub_total/100,2),
                // money($sub_total, "MYR")->format(),//sub_total
                "11",
                "12"
                
            );
        
        $pdf->addTotal(__('Total Amount'), money($invoices->supposed_amount, "MYR")->format(), true);
        
        // Set Discount Total
        $pdf->addTotal(__('messages.discount'), "MYR " . (int)($invoice->discount)/100);

        // $pdf->addTotalSum(__('Total Sum'), "RM 10");
        // Set Sub Total
        // $pdf->addTotal(__('messages.sub_total'), money($invoice->sub_total, "MYR")->format());
        // Set Taxes Total
        if($invoice->tax_per_item == false) {
            $pdf->addTotal(__('messages.tax'), $invoice->getTotalPercentageOfTaxes(). ' %');
        }

        

        // foreach ($receipts as $k => $data) {
        //     if($k !=0){
        //         if($data->last_paid_amount != NULL){
        //             $last_paid = explode(',', $data->last_paid_amount);
        //             foreach ($last_paid as $key => $last_amount) {
        //                 $no = $key+1;
        //                 $pdf->addTotal(__('Paid History'.' '.$no), money($last_amount, "MYR")->format(), true);
        //             }
        //         }
        //     }

        // }

        $pdf->addTotal(__('Amount Paid'), money($invoices->paid_amount, "MYR")->format(), true);

        // Set Total
        if($receipt_status->receipt_status == "PAID"){
            $pdf->addTotalBal(__('Outstanding C/F'), money(0, "MYR")->format(), true);
        }else{
            $pdf->addTotalBal(__('Outstanding C/F'), money($invoices->balance, "MYR")->format(), true);
        }
        
        
        //Add notes
        // $pdf->addParagraph($invoice->notes);
        // $pdf->addParagraph('Remarks: Paid by'. $payment->payment_number);
        //$pdf->addParagraph('Remarks: Paid by'.' '.$invoices->payment_method->name ); //PaymentMethod::findOrFail($invoice->payments->payment_method_id)->name);
        //Set footernote
        // $pdf->setFooternote($company->getSetting('invoice_footer'));
        $pdf->setFooternote('This is computer generated receipt, our signature is not required. ');

        // Add Status Badge
     
        $pdf->addBadge($receipt_status->receipt_status);

        //Render or Download
        if($request->has('download')) {
            $pdf->render($invoice->receipt_number . '.pdf', 'D');
        } else {
            $pdf->render($invoice->receipt_number . '.pdf', 'I');
        }
    }

    public function receipts_transporter(Request $request, $id)
    {   

        $transporter = ReceiptTransporter::where('reference_number', $id)->first();
        $invoice = Invoice::where('id', $transporter->invoice_id)->first();
        //dd($invoice->transporters->company_name);
        $company = $invoice->company;
        $payment = $invoice->payments;
        $driver = $invoice->drivers;
        $client = $invoice->clients;
        $transporter = ReceiptTransporter::where('reference_number', $id)->first();
        $transporters = ReceiptTransporter::with('invoices')->where('reference_number', $id)->get();

        //dd($invoice->client_id);
        //dd($transporters);


        //Create a new pdf instance
        $pdf = new PDFServiceRecTrans("A4");

        //Set your logo
        $pdf->setLogo($company->avatar, 180, 100);

        //Set theme color
        $pdf->setColor($company->getSetting('invoice_color'));

        //Set type
        $pdf->setType("RECEIPT");

        // Set Tax per Item
        $pdf->setTaxPerItem($invoice->tax_per_item);

        // Set Discount per Item
        $pdf->setDiscountPerItem($invoice->discount_per_item);

        //Set reference
        $pdf->setReference($transporter->receipt_number_transporter);

        // //Set reference Invoice
        $pdf->setReference1($transporter->reference_number_transporter);

        // //Set reference DO
        $pdf->setReferenceRec($transporter->payment_method->name);

        //Set reference created at
        $pdf->setReferenceRec1($invoice->created_at->format('d/m/Y H:i:s'));

        //Set date
        $pdf->setDate($invoice->formatted_invoice_date);

        //Set  due date
        //$pdf->setDue($invoice->formatted_due_date);

        //Remarks
        $pdf->setRemarks($invoice->transporter_paid_status);

        //Set From
        $pdf->setFrom([
            $company->name,
            $company->address->address_1,
            $company->address->address_2,
            $company->address->city ?? '' . $company->address->state ?? '',
            $company->address->country->name ?? '',
            $company->address->phone ?? '',
        ]);

        if($invoice->client_id != NULL)
        {
        //Set to
        $pdf->setTo([
            $invoice->transporters->company_name,
            "Name: " . $invoice->transporters->name,
            "Address: " .$invoice->transporters->address,
            "No.Phone: " .$invoice->transporters->phone,
            "Email: " . $invoice->transporters->email,
            // "Driver Details: " . $driver->name." | " . $driver->ic,
            // "Lorry Details: " . $invoice->platenumbers->number_plate." | " . Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name
        ]);
        }else{
            
            $pdf->setTo([
                $driver->name,
                "No. IC: " .$driver->ic,
                "No.Phone: " .$driver->phone,
                "Phone: " .$driver->phone,
                "Lorry Type: " .Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name,
                "Plate Number: " . $invoice->platenumbers->number_plate,
                " " ,
            ]);
        }
        // Add items
        // foreach($transporters as $data){
        //     dd($data->invoices->invoice_number);
        // }
        $total_amount = 0;
        $qsent = 0;
        $qarrived = 0;
        $cost_trans = 0;
        $sub_arrived = 0;
        $qty_shortage = 0;
        $shortage_cost = 0;
        $sub_total = 0;
        $total = 0;
        $total1 = 0;
        foreach ($transporters as $item) {
            $qsent += $item->items->quantity;
            $qarrived += $item->invoices->accurate_remark;
            $cost_trans += $item->invoices->transporterlocation->price;
            $sub_arrived += $item->invoices->accurate_remark*($item->invoices->transporterlocation->price/100);
            $qty_shortage += $item->items->quantity - $item->invoices->accurate_remark;
            $shortage_cost += $item->items->price - ($item->invoices->transporterlocation->price);
            $sub_total += ($item->items->quantity - $item->invoices->accurate_remark)*($item->items->price - $item->invoices->transporterlocation->price);
            $total += $sub_arrived - ($sub_total/100);
            $total1 += $item->invoices->accurate_remark*($item->invoices->transporterlocation->price/100) - (($item->items->quantity - $item->invoices->accurate_remark)*($item->items->price - $item->invoices->transporterlocation->price))/100;
            $pdf->addItem(
                $item->invoices->invoice_number, 
                number_format($item->items->quantity,3), //qty sent
                "3",
                number_format($item->invoices->accurate_remark,3), //qty arrived
                number_format($item->invoices->transporterlocation->price/100,2), //pice transporter
                // money($item->invoices->transporterlocation->price, "MYR")->format(),
                number_format($item->invoices->accurate_remark*($item->invoices->transporterlocation->price/100),2), //subtotal arrived
                // $item->invoices->accurate_remark*($item->invoices->transporterlocation->price/100), 
                number_format((($item->items->quantity - $item->invoices->accurate_remark)*($item->items->price - $item->invoices->transporterlocation->price))/100,2), //subtotal shortage
                number_format(($item->items->price - $item->invoices->transporterlocation->price)/100,2), //shortage cost
                // money($item->items->price - ($item->invoices->transporterlocation->price), "MYR")->format(), 
                number_format($item->items->quantity - $item->invoices->accurate_remark,3),  //total shortage
                "7",
                "8",
                number_format($item->invoices->accurate_remark*($item->invoices->transporterlocation->price/100) - (($item->items->quantity - $item->invoices->accurate_remark)*($item->items->price - $item->invoices->transporterlocation->price))/100,2)  //total
                // "MYR ".($transporter->amount_arrived)/100
            );
           $total_amount +=$item->total;
       }
       //$total1 = ($item->invoices->accurate_remark*($item->invoices->transporterlocation->price/100)) - ((($item->items->quantity - $item->invoices->accurate_remark)*($item->items->price - $item->invoices->transporterlocation->price))/100),
        // Add items for total sum
        // foreach($transporters as $data){
        //     dd($data->invoices->invoice_number);
        // }
            $pdf->addItem1(
                "TOTAL SUM", 
                number_format($qsent,3), 
                "3",
                number_format(($transporter->quantity_arrived)/100,3),
                number_format($item->invoices->transporterlocation->price/100,2),
                number_format($sub_arrived,2), //subtotal arrived
                number_format($sub_total/100,2), //subtotall shortage
                number_format($shortage_cost/100,2), //shortage cost
                // money($shortage_cost, "MYR")->format(), 
                number_format($qty_shortage,3),  //total shortage
                "7",
                "8",
                number_format($total1,2)  //total
                // "MYR ".($transporter->amount_arrived)/100
            );
        // Set Sub Total
        // $pdf->addTotal(__('messages.sub_total'), money($invoice->sub_total, "MYR")->format());
        // Set Taxes Total
        // if($invoice->tax_per_item == false) {
        //     $pdf->addTotal(__('messages.tax'), $invoice->getTotalPercentageOfTaxes(). ' %');
        // }

        // Set Discount Total
        $pdf->addTotal(__('Total Sent'),'MYR '. ($transporter->amount_start)/100);

        $pdf->addTotal(__('Total Arrived'),'MYR '.($sub_arrived));

        $pdf->addTotal(__('Total Shortage'),'MYR '.round(($sub_total/100), 2));

        $pdf->addTotal(__('Discount'),'0 %');

        //$pdf->addTotal(__('Total Amount'), money($total_amount, "MYR")->format(), true);

        // foreach ($receipts as $k => $data) {
        //     if($k !=0){
        //         if($data->last_paid_amount != NULL){
        //             $last_paid = explode(',', $data->last_paid_amount);
        //             foreach ($last_paid as $key => $last_amount) {
        //                 $no = $key+1;
        //                 $pdf->addTotal(__('Paid History'.' '.$no), money($last_amount, "MYR")->format(), true);
        //             }
        //         }
        //     }

        // }

       //$pdf->addTotal(__('Qty Shortage'),($transporters->invoices));

        // Set Total
        $pdf->addTotalBal(__('Nett'), money($transporter->net_pay_amount, "MYR")->format(), true);
        
        //Set footernote
        // $pdf->setFooternote($company->getSetting('invoice_footer'));
        $pdf->setFooternote('This is computer generated receipt, our signature is not required. ');

        // Add Status Badge
        $pdf->addBadge($invoice->transporter_paid_status);

        //Render or Download
        if($request->has('download')) {
            $pdf->render($transporter->receipt_number_transporter . '.pdf', 'D');
        } else {
            $pdf->render($transporter->receipt_number_transporter . '.pdf', 'I');
        }
    }

    /**
     * Get Estimate Pdf
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return pdf
     */
    public function estimate(Request $request)
    {
        $estimate = Estimate::findByUid($request->estimate);
        $company = $estimate->company;
        $customer = $estimate->customer;

        //Create a new pdf instance
        $pdf = new PDFService("A4");

        //Set your logo
        $pdf->setLogo($company->avatar, 180, 100);

        //Set theme color
        $pdf->setColor($company->getSetting('estimate_color'));

        //Set type
        $pdf->setType(__('messages.estimate_upper_case'));

        // Set Tax per Item
        $pdf->setTaxPerItem($estimate->tax_per_item);

        // Set Discount per Item
        $pdf->setDiscountPerItem($estimate->discount_per_item);

        //Set reference
        $pdf->setReference($estimate->estimate_number);

        //Set date
        $pdf->setDate($estimate->formatted_estimate_date);

        //Set  due date
        $pdf->setDue($estimate->formatted_expiry_date);

        //Set From
        $pdf->setFrom([
            $company->name,
            $company->address->address_1,
            $company->address->address_2,
            $company->address->city ?? '' . $company->address->state ?? '',
            $company->address->country->name ?? '',
            $company->address->phone ?? '',
        ]);

        if($invoice->client_id != NULL)
        {
        //Set to
        $pdf->setTo([
            $client->company_name,
            "Address:" .$client->address,
            "No Company:" .$client->company_no,
            "No.Phone:" .$client->phone,
            "Email:" .$client->email,
            "Delivery Address:" . $client->delivery_location,
        ]);
        }else{
            
            $pdf->setTo([
                $driver->name,
                "No. IC: " .$driver->ic,
                "No.Phone: " .$driver->phone,
                "Phone: " .$driver->phone,
                "Lorry Type: " .Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name,
                "Plate Number: " . $invoice->platenumbers->number_plate,
                " " ,
                " " ,
            ]);
        }

        // Add items
        foreach ($estimate->items as $item) {
            $pdf->addItem(
                $item->product->name, 
                $item->product->description,
                $item->quantity,
                $item->getTotalPercentageOfTaxes(), 
                money($item->price, $estimate->currency_code)->format(), 
                $item->discount_val, 
                money($item->total, $estimate->currency_code)->format()
            );
        }

        // Set Sub Total
        $pdf->addTotal(__('messages.sub_total'), money($estimate->sub_total, $estimate->currency_code)->format());

        // Set Taxes Total
        if($estimate->tax_per_item == false) {
            $pdf->addTotal(__('messages.tax'), $estimate->getTotalPercentageOfTaxes(). ' %');
        }

        // Set Discount Total
        if($estimate->discount_per_item == false) {
            $pdf->addTotal(__('messages.discount'), (int) $estimate->discount_val . ' %');
        }

        // Set Total
        $pdf->addTotal(__('messages.total'), money($estimate->total, $estimate->currency_code)->format(), true);

        //Add notes
        $pdf->addParagraph('$estimate->notes');

        //Set footernote
        // $pdf->setFooternote($company->getSetting('estimate_footer'));
        $pdf->setFooternote($company->getSetting('estimate_footer'));

        // Add Status Badge
        $pdf->addBadge($estimate->status);

        //Render or Download
        if($request->has('download')) {
            $pdf->render($estimate->estimate_number . '.pdf', 'D');
        } else {
            $pdf->render($estimate->estimate_number . '.pdf', 'I');
        }
    }

    /**
     * Get Payment Pdf
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return pdf
     */
    public function payment(Request $request)
    {
        $payment = Payment::findByUid($request->payment);
        $company = $payment->company;
        $customer = $payment->customer;

        //Create a new pdf instance
        $pdf = new PDFService("A4");

        //Set your logo
        $pdf->setLogo($company->avatar, 180, 100);

        //Set theme color
        $pdf->setColor($company->getSetting('payment_color'));

        //Set type
        $pdf->setType(__('messages.payment_receipt_upper_case'));

        // Hide headers
        $pdf->setHideHeader(true);

        // Set Sub Total
        $pdf->addTotal(__('messages.payment_date'), $payment->formatted_payment_date);
        $pdf->addTotal(__('messages.payment_#'), $payment->payment_number);
        $pdf->addTotal(__('messages.invoice_#'), $payment->invoice->invoice_number);
        $pdf->addTotal(__('messages.payment_mode'), $payment->payment_method->name ?? '');

        // Set Total
        $pdf->addTotal(__('messages.amount'), money($payment->amount, $payment->invoice->currency_code)->format(), true);

        //Add notes
        $pdf->addParagraph($payment->notes);

        //Set footernote
        $pdf->setFooternote($company->getSetting('payment_footer'));

        //Render or Download
        if($request->has('download')) {
            $pdf->render($payment->payment_number . '.pdf', 'D');
        } else {
            $pdf->render($payment->payment_number . '.pdf', 'I');
        }
    }

    public function invoice1(Request $request)
    {
        //dd($request->invoice);
        $invoice = Invoice::findByUid($request->invoice);
        $company = $invoice->company;
        $driver = $invoice->drivers;
        $client = $invoice->clients;

        //dd($invoice->client_id);

        //Create a new pdf instance
        $pdf = new PDFServiceDo("A4");

        //Set your logo
        $pdf->setLogo($company->avatar, 180, 100);

        //Set theme color
        $pdf->setColor($company->getSetting('invoice_color'));

        //Set type
        $pdf->setType("DELIVERY ORDER");

        // Set Tax per Item
        $pdf->setTaxPerItem($invoice->tax_per_item);

        // Set Discount per Item
        $pdf->setDiscountPerItem($invoice->discount_per_item);

        //Set reference DO
        $pdf->setReference3($invoice->do_number);

        //Set reference Invoice
        $pdf->setReference($invoice->invoice_number);

        //Set  created date
        $pdf->setReference2($invoice->created_at->format('m/d/Y H:i:s'));

        //Set date
        $pdf->setDate($invoice->formatted_invoice_date);

        //Set  due date
        $pdf->setDue($invoice->formatted_due_date);

        


        //Set From
        $pdf->setFrom([
            $company->name,
            $company->address->address_1,
            $company->address->address_2,
            $company->address->city ?? '' . $company->address->state ?? '',
            $company->address->country->name ?? '',
            $company->address->phone ?? '',
        ]);

        if($invoice->client_id != NULL)
        {
        //Set to
        $pdf->setTo([
            $client->company_name,
            "Address: " .$client->address,
            "No Company: " .$client->company_no,
            "No.Phone: " .$client->phone,
            "Delivery Address: " . $client->delivery_location,
            "Driver Details: " . $driver->name." | " . $driver->ic,
            "Lorry Details: " . $invoice->platenumbers->number_plate." | ".$invoice->platenumbers->weight ." Tan "." | ". Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name
        ]);
        }else{
            
            $pdf->setTo([
                $driver->name,
                "No. IC: " .$driver->ic,
                "No.Phone: " .$driver->phone,
                "Phone: " .$driver->phone,
                "Lorry Type: " .Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name,
                "Plate Number: " . $invoice->platenumbers->number_plate,
                " " ,
            ]);
        }
        // Add items
        foreach ($invoice->items as $item) {
            $pdf->addItem(
                $item->product->name, 
                $item->product->description,
                $item->quantity,
                $item->getTotalPercentageOfTaxes(), 
                money($item->price, "MYR")->format(), 
                $item->discount_val, 
                "Tan"
                // money($item->total, "MYR")->format()
            );
        }

        // Set Sub Total
        $pdf->addTotal(__('messages.sub_total'), money($invoice->sub_total, "MYR")->format());

        // Set Taxes Total
        if($invoice->tax_per_item == false) {
            $pdf->addTotal(__('messages.tax'), $invoice->getTotalPercentageOfTaxes(). ' %');
        }

        // Set Discount Total
        if($invoice->discount_per_item == false) {
            $pdf->addTotal(__('messages.discount'), (int) $invoice->discount_val . ' %');
        }

        // Set Total
        $pdf->addTotal(__('messages.total'), money($invoice->total, "MYR")->format(), true);

        //Add notes
        $pdf->addParagraph2(' ');
        // $pdf->addParagraph($invoice->notes);
        $pdf->addParagraph('Customer Signature,');
        if(empty($client->project_manager_name)){
            $pdf->addParagraph1('...................................'."\n". "(".$driver->name.")");
        }
        else
            $pdf->addParagraph1('...................................'."\n". "(".$client->company_name.")");
        //Set footernote
        // $pdf->setFooternote($company->getSetting('invoice_footer'));
        $pdf->setFooternote('This is computer generated delivery order, our signature is not required. ');


        // Add Status Badge
        // $pdf->addBadge(" ");

        //Render or Download
        if($request->has('download')) {
            $pdf->render($invoice->do_number . '.pdf', 'D');
        } else {
            $pdf->render($invoice->do_number . '.pdf', 'I');
        }
    }
    public function do(Request $request)
    {
        //dd($request->invoice);
        $invoice = Invoice::findByUid($request->invoice);
        $company = $invoice->company;
        $driver = $invoice->drivers;
        $client = $invoice->clients;

        //dd($invoice->client_id);

        //Create a new pdf instance
        $pdf = new PDFServiceDoArrive("A4");

        //Set your logo
        $pdf->setLogo($company->avatar, 180, 100);

        //Set theme color
        $pdf->setColor($company->getSetting('invoice_color'));

        //Set type
        $pdf->setType("DELIVERY ORDER");

        // Set Tax per Item
        $pdf->setTaxPerItem($invoice->tax_per_item);

        // Set Discount per Item
        $pdf->setDiscountPerItem($invoice->discount_per_item);

        //Set reference DO
        $pdf->setReference3($invoice->do_number);

        //Set reference Invoice
        $pdf->setReference($invoice->invoice_number);

        //Set  created date
        $pdf->setReference2($invoice->created_at->format('m/d/Y H:i:s'));

        //Set date
        $pdf->setDate($invoice->formatted_invoice_date);

        //Set  due date
        $pdf->setDue($invoice->formatted_due_date);

        


        //Set From
        $pdf->setFrom([
            $company->name,
            $company->address->address_1,
            $company->address->address_2,
            $company->address->city ?? '' . $company->address->state ?? '',
            $company->address->country->name ?? '',
            $company->address->phone ?? '',
        ]);

        if($invoice->client_id != NULL)
        {
        //Set to
        $pdf->setTo([
            $client->company_name,
            "Address: " .$client->address,
            "No Company: " .$client->company_no,
            "No.Phone: " .$client->phone,
            "Delivery Address: " . $client->delivery_location,
            "Driver Details: " . $driver->name." | " . $driver->ic,
            "Lorry Details: " . $invoice->platenumbers->number_plate." | ".$invoice->platenumbers->weight ." Tan "." | ". Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name
        ]);
        }else{
            
            $pdf->setTo([
                $driver->name,
                "No. IC: " .$driver->ic,
                "No.Phone: " .$driver->phone,
                "Phone: " .$driver->phone,
                "Lorry Type: " .Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name,
                "Plate Number: " . $invoice->platenumbers->number_plate,
                " " ,
            ]);
        }
        // Add items
        foreach ($invoice->items as $item) {
            $pdf->addItem(
                $item->product->name, 
                $item->product->description,
                "Sent",
                $item->getTotalPercentageOfTaxes(), 
                money($item->price, "MYR")->format(), 
                $item->discount_val, 
                $item->quantity . " Tan"
                // money($item->total, "MYR")->format()
            );
        }

        // Set Supposed
        // $pdf->addTotal(__('Supposed'), $item->quantity. ' Tan');

        // Set Arrived
        if(!empty($invoice->accurate_remark)) {
            $pdf->addTotal(__('Arrived'), $invoice->accurate_remark. ' Tan');
        }
        else{
            foreach ($invoice->items as $item) {
                $pdf->addTotal(__('Arrived'), $item->quantity. ' Tan');
            }
        }

        // Set Discount Total
        if(empty($invoice->accurate_remark)) {
            $pdf->addTotal(__('Shortage'), '0'. ' Tan');
        }
        else{
            foreach ($invoice->items as $item) {
            $pdf->addTotal(__('Shortage'), $item->quantity - $invoice->accurate_remark. ' Tan');
            }
        }

        // Set Total
        // $pdf->addTotal(__('messages.total'), money($invoice->total, "MYR")->format(), true);

        //Add notes
        // $pdf->addParagraph2(' ');
        // $pdf->addParagraph($invoice->notes);
        $pdf->addParagraph('Customer Signature,');
        if(empty($client->project_manager_name)){
            $pdf->addParagraph1('...................................'."\n". "(".$driver->name.")");
        }
        else
            $pdf->addParagraph1('...................................'."\n". "(".$client->company_name.")");
        //Set footernote
        // $pdf->setFooternote($company->getSetting('invoice_footer'));
        $pdf->setFooternote('This is computer generated delivery order, our signature is not required. ');


        // Add Status Badge
        if ($invoice->accurate == "Inaccurate Quantity"){
            $pdf->addBadge("Inaccurate Quantity");
        }
        else{
            $pdf->addBadge("Accurate Quantity");
        }

        //Render or Download
        if($request->has('download')) {
            $pdf->render($invoice->do_number . '.pdf', 'D');
        } else {
            $pdf->render($invoice->do_number . '.pdf', 'I');
        }
    }
    public function invoice2(Request $request)
    {
        //dd($request->invoice);
        $invoice = Invoice::findByUid($request->invoice);
        
        $company = $invoice->company;
        $payment = $invoice->payments;
        $driver = $invoice->drivers;
        $client = $invoice->clients;

        //dd($invoice->client_id);

        //Create a new pdf instance
        $pdf = new PDFServiceRec("A4");

        //Set your logo
        $pdf->setLogo($company->avatar, 180, 100);

        //Set theme color
        $pdf->setColor($company->getSetting('invoice_color'));

        //Set type
        $pdf->setType("RECEIPT");

        // Set Tax per Item
        $pdf->setTaxPerItem($invoice->tax_per_item);

        // Set Discount per Item
        $pdf->setDiscountPerItem($invoice->discount_per_item);

        //Set reference
        $pdf->setReference($invoice->receipt_number);

        //Set reference Invoice
        $pdf->setReference1($invoice->invoice_number);

        //Set reference DO
        $pdf->setReferenceRec($invoice->do_number);

        //Set reference created at
        $pdf->setReferenceRec1($invoice->created_at->format('m/d/Y H:i:s'));

        //Set date
        $pdf->setDate($invoice->formatted_invoice_date);

        //Set  due date
        $pdf->setDue($invoice->formatted_due_date);

        //Set From
        $pdf->setFrom([
            $company->name,
            $company->address->address_1,
            $company->address->address_2,
            $company->address->city ?? '' . $company->address->state ?? '',
            $company->address->country->name ?? '',
            $company->address->phone ?? '',
        ]);

        if($invoice->client_id != NULL)
        {
        //Set to
        $pdf->setTo([
            $client->company_name,
            "Address: " .$client->address,
            "No Company: " .$client->company_no,
            "No.Phone: " .$client->phone,
            "Delivery Address: " . $client->delivery_location,
            "Driver Details: " . $driver->name." | " . $driver->ic,
            "Lorry Details: " . $invoice->platenumbers->number_plate." | " . Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name
        ]);
        }else{
            
            $pdf->setTo([
                $driver->name,
                "No. IC: " .$driver->ic,
                "No.Phone: " .$driver->phone,
                "Phone: " .$driver->phone,
                "Lorry Type: " .Lorry::findOrFail($invoice->platenumbers->lorry_type_id)->name,
                "Lorry Details: " . $invoice->platenumbers->number_plate." | ".$invoice->platenumbers->weight ." Tan ",
                " " ,
            ]);
        }
        // Add items
        foreach ($invoice->items as $item) {
            $pdf->addItem(
                $item->product->name, 
                "",
                $item->quantity. ' Tan',
                $item->getTotalPercentageOfTaxes(), 
                money($item->price, "MYR")->format(), 
                $item->discount_val, 
                money($item->total, "MYR")->format()
            );
        }

        // Set Sub Total
        // $pdf->addTotal(__('messages.sub_total'), money($invoice->sub_total, "MYR")->format());
       if(empty($invoice->client_id)){

       }
       elseif($invoice->accurate == "Inaccurate Quantity"){
        $pdf->addTotal(__('Arrived Qty'), $invoice->accurate_remark. ' Tan');
       }
       elseif($invoice->accurate == "Accurate Quantity"){
        $pdf->addTotal(__('Arrived Qty'), $item->quantity. ' Tan');
       }
        // Set Taxes Total
        if($invoice->tax_per_item == false) {
            $pdf->addTotal(__('messages.tax'), $invoice->getTotalPercentageOfTaxes(). ' %');
        }

        // Set Discount Total
        // if($invoice->discount_per_item == false) {
        if($invoice->accurate != "Inaccurate Quantity") {
            $pdf->addTotal(__('messages.discount'), (int) $invoice->discount_val . ' %');
        }
        else{
            $pdf->addTotal(__('messages.discount'), "MYR " . (int)($invoice->discount)/100);
        }

        // Set Total
        if($invoice->accurate != "Inaccurate Quantity") {
            $pdf->addTotal(__('messages.total'), money($invoice->total, "MYR")->format(), true);
        }
        else{
            $pdf->addTotal(__('messages.total'), money($invoice->total, "MYR")->format(), true);
        }
        //Add notes
        // $pdf->addParagraph($invoice->notes);
        // $pdf->addParagraph('Remarks: Paid by'. $payment->payment_number);
        // $pdf->addParagraph('Remarks: Paid by Cheque' ); //PaymentMethod::findOrFail($invoice->payments->payment_method_id)->name);
        //Set footernote
        // $pdf->setFooternote($company->getSetting('invoice_footer'));
        $pdf->setFooternote('This is computer generated receipt, our signature is not required. ');

        // Add Status Badge
        $pdf->addBadge($invoice->paid_status);

        //Render or Download
        if($request->has('download')) {
            $pdf->render($invoice->receipt_number . '.pdf', 'D');
        } else {
            $pdf->render($invoice->receipt_number . '.pdf', 'I');
        }
    }
}
