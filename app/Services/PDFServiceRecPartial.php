<?php

namespace App\Services;

use App\Helpers\PDF\PDF_ImageAlpha;

class PDFServiceRecPartial extends PDF_ImageAlpha
{
    var $font = 'DejaVu';
    var $columnOpacity = 0.06;
    var $columnSpacing = 0.3;
    var $referenceformat = array('.', ',');
    var $taxformat = '%';
    var $discountFormat = '%';
    var $margins = array('l' => 7.5, 't' => 20, 'r' => 7.5);
    var $hide_header = false;
    var $angle = 0;

    var $l;
    var $document;
    var $type;
    var $reference;
    var $reference1;
    var $reference2;
    var $reference3;
    var $logo;
    var $color;
    var $discount_per_item;
    var $tax_per_item;
    var $date;
    var $due;
    var $from;
    var $to;
    var $items;
    var $items1;
    var $totals;
    var $badge;
    var $addText;
    var $footernote;
    var $dimensions;
    var $extraNotes;
    var $sigName;
    var $sigDesig;

    function __construct($size = 'A4', $language = 'en')
    {
        $this->columns = 5;
        $this->items = array();
        $this->totals = array();
        $this->addText = array();
        $this->extraNotes = false;
        $this->firstColumnWidth = 70;
        $this->firstColumn = 58;
        $this->maxImageDimensions = array(230, 130);

        $this->setLanguage($language);
        $this->setDocumentSize($size);
        $this->setColor('#222222');

        $this->FPDF('P', 'mm', array($this->document['w'], $this->document['h']));
        $this->AliasNbPages();
        $this->SetMargins($this->margins['l'], $this->margins['t'], $this->margins['r']);
        $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $this->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
    }

    function setType($title)
    {
        $this->title = $title;
    }

    function setHideHeader($hide_header)
    {
        $this->hide_header = $hide_header;
    }

    function setTaxPerItem($tax_per_item)
    {
        $this->tax_per_item = $tax_per_item;
    }

    function setDiscountPerItem($discount_per_item)
    {
        $this->discount_per_item = $discount_per_item;
    }

    function setColor($rgbcolor)
    {
        $this->color = $this->hex2rgb($rgbcolor);
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function setDue($date)
    {
        $this->due = $date;
    }

    function setLogo($logo = 0, $maxWidth = 0, $maxHeight = 0)
    {
        if ($maxWidth and $maxHeight) {
            $this->maxImageDimensions = array($maxWidth, $maxHeight);
        }
        $this->logo = $logo;
        $this->dimensions = $this->resizeToFit($logo);
    }

    function setFrom($data)
    {
        $this->from = $data;
    }

    function setTo($data)
    {
        $this->to = $data;
    }
    function setRemarks($remarks) 
    {
        $this->remarks = $remarks;
    }
    function setReference($reference)
    {
        $this->reference = $reference;
    }
    function setReference1($reference1)
    {
        $this->reference1 = $reference1;
    }
    function setReferenceRec($reference2)
    {
        $this->reference2 = $reference2;
    }
    function setReferenceRec1($reference3)
    {
        $this->reference3 = $reference3;
    }
    function setNumberFormat($decimals, $thousands_sep)
    {
        $this->referenceformat = array($decimals, $thousands_sep);
    }

    function setTaxFormat($value)
    {
        $this->taxformat = $value;
    }

    function setSigName($value)
    {
        $this->sigName = $value;
    }

    function setSigDesig($value)
    {
        $this->sigDesig = $value;
    }

    function setDiscountFormat($value)
    {
        $this->discountFormat = $value;
    }

    function flipflop()
    {
        $this->flipflop = true;
    }

    function saveFile($filename)
    {
        return $this->Output($filename, 'F');
    }

    function addItem($item, $quantity, $sent, $sent2, $arrived, $pricearr, $price, $description, $vat = 0, $discount = 0, $total)
    {
        $p['item']             = $item;

        if ($this->tax_per_item !== false) {
            $this->firstColumnWidth = 58;
            $p['vat'] = $vat . " %";
            $this->taxField = true;
            $this->columns = 6;
        } else {
            $this->firstColumn = 80.4;
        }

        $p['price'] = $price;
        $p['arrived'] = $arrived;
        $p['pricearr'] = $pricearr;
        $p['quantity'] = $quantity;
        $p['sent'] = $sent;
        $p['sent2'] = $sent2;
        $p['total'] = $total;

        if ($this->discount_per_item !== false) {
            $this->firstColumnWidth = 58;
            $p['discount'] = $discount . " %";
            $this->discountField = true;
            $this->columns = 6;
        } else {
            $this->firstColumn = 80.4;
        }

        if ($this->discount_per_item === false && $this->tax_per_item === false) {
            $this->firstColumn = 95;
        }

        $this->items[] = $p;
    }
    function addItem1($item1, $quantity1, $sent1, $sent2, $arrived1, $pricearr1, $price1, $description1, $va1t = 0, $discount1 = 0, $total1)
    {
        $p['item1']             = $item1;

        if ($this->tax_per_item !== false) {
            $this->firstColumnWidth = 58;
            $p['vat1'] = $vat1 . " %";
            $this->taxField = true;
            $this->columns = 6;
        } else {
            $this->firstColumn = 80.4;
        }

        $p['price1'] = $price1;
        $p['arrived1'] = $arrived1;
        $p['pricearr1'] = $pricearr1;
        $p['quantity1'] = $quantity1;
        $p['sent1'] = $sent1;
        $p['sent2'] = $sent2;
        $p['total1'] = $total1;

        if ($this->discount_per_item !== false) {
            $this->firstColumnWidth = 58;
            $p['discount1'] = $discount . " %";
            $this->discountField = true;
            $this->columns = 6;
        } else {
            $this->firstColumn = 80.4;
        }

        if ($this->discount_per_item === false && $this->tax_per_item === false) {
            $this->firstColumn = 95;
        }

        $this->items1[] = $p;
    }

    function addTotal($name, $value, $colored = 0)
    {
        $t['name']            = $name;
        $t['value']            = $value;
        if (is_numeric($value)) {
            $t['value']            = $value;
        }
        $t['colored']        = $colored;
        $this->totals[]        = $t;
    }
    function addTotalBal($name, $value, $colored = 0)
    {
        $t['name']            = $name;
        $t['value']            = $value;
        if (is_numeric($value)) {
            $t['value']            = $value;
        }
        $t['colored']        = $colored;
        $this->totalsbal[]        = $t;
    }

    function addTitle($title)
    {
        if ($title != '') {
            $this->addText[] = array('title', $title);
            $this->extraNotes = true;
        }
    }

    function addParagraph($paragraph)
    {
        if ($paragraph != '') {

            $paragraph = $this->br2nl($paragraph);
            $this->addText[] = array('paragraph', $paragraph);
            $this->extraNotes = true;
        }
    }

    function addBadge($badge)
    {
        $this->badge = $badge;
    }

    function setFooternote($note)
    {
        $this->footernote = $note;
    }

    function render($name = '', $destination = '')
    {
        $this->AddPage();
        $this->Body();
        $this->AliasNbPages();
        $this->Output($name, $destination);
    }

    function Header()
    {
        //First page
        if ($this->PageNo() == 1) {

            if (isset($this->logo)) {
                $this->Image($this->logo, $this->margins['l'], $this->margins['t'], $this->dimensions[0], $this->dimensions[1]);
            }

            if ($this->title) {
                //Title
                $this->SetTextColor(0, 0, 0);
                $this->SetFont($this->font, 'B', 20);
                $this->Cell(0, 5, strtoupper($this->title), 0, 1, 'R');
                $this->SetFont($this->font, '', 9);
                $this->Ln(5);
            }

            $lineheight = 5;

            //Calculate position of strings
            $this->SetFont($this->font, 'B', 9);
            $positionX = $this->document['w'] - $this->margins['l'] - $this->margins['r'] - max(strtoupper($this->GetStringWidth($this->l['rec'])), strtoupper($this->GetStringWidth($this->l['date'])), strtoupper($this->GetStringWidth($this->l['due']))) - 50;

            //Number
            if ($this->reference) {
                $this->Cell($positionX, $lineheight);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['rec']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 9);
                $this->Cell(0, $lineheight, $this->reference, 0, 1, 'R');
            }
            //Number1
            if ($this->reference1) {
                $this->Cell($positionX, $lineheight);
                $this->SetFont($this->font, 'B', 9);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['inv']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, 'B', 9);
                $this->Cell(0, $lineheight, $this->reference1, 0, 1, 'R');
            }
            
            
            //Date
            if ($this->date) {
                $this->Cell($positionX, $lineheight);
                $this->SetFont($this->font, 'B', 9);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['date']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 9);
                $this->Cell(0, $lineheight, $this->date, 0, 1, 'R');
            }

            //Due date
            if ($this->due) {
                $this->Cell($positionX, $lineheight);
                $this->SetFont($this->font, 'B', 9);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['due']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 9);
                $this->Cell(0, $lineheight, $this->due, 0, 1, 'R');
            }
            //payment method
            if ($this->remarks) {
                $this->Cell($positionX, $lineheight);
                $this->SetFont($this->font, 'B', 9);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['remarks']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 9);
                $this->Cell(0, $lineheight, $this->remarks, 0, 1, 'R');
            }
            //reference payment
            if ($this->reference2) {
                $this->Cell($positionX, $lineheight);
                $this->SetFont($this->font, 'B', 9);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['do']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 9);
                $this->Cell(0, $lineheight, $this->reference2, 0, 1, 'R');
            }
            //Number DO
            if ($this->reference3) {
                $this->Cell($positionX, $lineheight);
                $this->SetFont($this->font, 'B', 9);
                $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
                $this->Cell(32, $lineheight, strtoupper($this->l['created']) . ':', 0, 0, 'L');
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 9);
                $this->Cell(0, $lineheight, $this->reference3, 0, 1, 'R');
            }

            if (($this->margins['t'] + $this->dimensions[1]) > $this->GetY()) {
                $this->SetY($this->margins['t'] + $this->dimensions[1] + 10);
            } else {
                $this->SetY($this->GetY() + 10);
            }

            $this->Ln(5);
            $this->SetTextColor($this->color[0], $this->color[1], $this->color[2]);
            $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);

            $this->SetFont($this->font, 'B', 10);
            $width = ($this->document['w'] - $this->margins['l'] - $this->margins['r']) / 2;
            if (isset($this->flipflop)) {
                $to = $this->l['to'];
                $from = $this->l['from'];
                $this->l['to'] = $from;
                $this->l['from'] = $to;
                $to = $this->to;
                $from = $this->from;
                $this->to = $from;
                $this->from = $to;
            }

            if(!$this->hide_header) {
                $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                $this->SetTextColor(255, 255, 255);

                $this->Cell(1, 6, '', 0, 0, 'L', 1);
                $this->Cell($width - 3, 6, strtoupper($this->l['from']), 0, 0, 'L', 1);
                $this->SetFillColor(255, 255, 255);
                $this->Cell(2, 10, '', 0, 0, 'L', 1);
                $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                $this->SetTextColor(255, 255, 255);
                $this->Cell(1, 6, '', 0, 0, 'L', 1);

                $this->Cell(0, 6, strtoupper($this->l['to']), 0, 0, 'L', 1);
                $this->Ln(7);

                //Information
                
                $this->Ln(3);
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, 'B', 10);

                $y = $this->GetY();
                $this->MultiCell($width, $lineheight, $this->from[0], 0, 'L', 0);
                $x = $this->GetX();
                $this->SetXY($x + $width, $y);
                $this->MultiCell($width, $lineheight, $this->to[0], 0, 'L', 0);

                $this->SetFont($this->font, '', 8);
                $this->SetTextColor(100, 100, 100);
                $this->Ln(0);

                // Add empty line if the names are too long
                if(strlen($this->from[0]) > 45 || strlen($this->from[0]) > 45) {
                    $this->MultiCell($width, $lineheight, '', 0, 'L', 0);
                }

                //Address Line 1
                $y = $this->GetY();
                $this->MultiCell($width, $lineheight, $this->from[1], 0, 'L', 0);
                $x = $this->GetX();
                $this->SetXY($x + $width, $y);
                $this->MultiCell($width, $lineheight, $this->to[1], 0, 'L', 0);
                $this->Ln(0);

                //Address Line 2
                if($this->from[2] != '') {
                    $y = $this->GetY();
                    $this->MultiCell($width, $lineheight, $this->from[2], 0, 'L', 0);
                    $x = $this->GetX();
                    $this->SetXY($x + $width, $y);
                    $this->MultiCell($width, $lineheight, $this->to[2], 0, 'L', 0);
                    $this->Ln(0);
                }

                //Phone
                $y = $this->GetY();
                $this->MultiCell($width, $lineheight, $this->from[3], 0, 'L', 0);
                $x = $this->GetX();
                $this->SetXY($x + $width, $y);
                $this->MultiCell($width, $lineheight, $this->to[3], 0, 'L', 0);
                $this->Ln(0);

                //Email
                $y = $this->GetY();
                $this->MultiCell($width, $lineheight, $this->from[4], 0, 'L', 0);
                $x = $this->GetX();
                $this->SetXY($x + $width, $y);
                $this->MultiCell($width, $lineheight, $this->to[4], 0, 'L', 0);
                $this->Ln(0);

                //Additional Info
                // $y = $this->GetY();
                // $this->MultiCell($width, $lineheight, $this->from[5], 0, 'L', 0);
                // $x = $this->GetX();
                // $this->SetXY($x + $width, $y);
                // $this->MultiCell($width, $lineheight, $this->to[5], 0, 'L', 0);

                //Additional Info
                // $y = $this->GetY();
                // $x = $this->GetX();
                // $this->SetXY($x + $width, $y);
                // $this->MultiCell($width, $lineheight, $this->to[6], 0, 'L', 0);
                //Table header
                if (!isset($this->productsEnded)) {

                    $width_other = ($this->document['w'] - $this->margins['l'] - $this->margins['r'] - $this->firstColumnWidth - ($this->columns * $this->columnSpacing)) / ($this->columns - 1);

                    $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                    $this->SetTextColor(255, 255, 255);

                    $this->Ln(12);
                    $this->SetFont($this->font, 'B', 7);
                    $this->Cell(1, 4.5, '', 0, 0, 'L', 1);

                    $this->Cell(34.9, 4.5, "", 0, 0, 'L', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(19, 4.5, "(a)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(22.4, 4.5, "(b)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(18, 4.5, "(c)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(23, 4.5, "(a) x (c) = (d)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(23, 4.5, "(b) x (c) = (e)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(32, 4.5, "", 0, 0, 'C', 1);

                    

                    if (isset($this->taxField)) {
                        $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                        $this->Cell($width_other, 10, strtoupper($this->l['vat']), 0, 0, 'C', 1);
                    }

                    if (isset($this->discountField)) {
                        $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                        $this->Cell($width_other, 10, strtoupper($this->l['discount']), 0, 0, 'C', 1);
                    }

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(19, 4.5, "", 0, 0, 'C', 1);
                    $this->Ln();
                } else {
                    $this->Ln(12);
                }

                //Table header
                if (!isset($this->productsEnded)) {

                    $width_other = ($this->document['w'] - $this->margins['l'] - $this->margins['r'] - $this->firstColumnWidth - ($this->columns * $this->columnSpacing)) / ($this->columns - 1);

                    $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                    $this->SetTextColor(255, 255, 255);

                    $this->Ln(0);
                    $this->SetFont($this->font, 'B', 7);
                    $this->Cell(1, 4.5, '', 0, 0, 'L', 1);

                    $this->Cell(34.9, 5, strtoupper($this->l['product']), 0, 0, 'L', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(19, 4.5, "QUANTITY", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(22.4, 4.5, "QUANTITY", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(18, 4.5, strtoupper($this->l['unit']), 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(23, 4.5, "PRICE", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(23, 4.5, "PRICE", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(32, 4.5, "OUTSTANDING", 0, 0, 'C', 1);

                    

                    if (isset($this->taxField)) {
                        $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                        $this->Cell($width_other, 10, strtoupper($this->l['vat']), 0, 0, 'C', 1);
                    }

                    if (isset($this->discountField)) {
                        $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                        $this->Cell($width_other, 10, strtoupper($this->l['discount']), 0, 0, 'C', 1);
                    }

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(19, 4.5, strtoupper($this->l['total']), 0, 0, 'C', 1);
                    $this->Ln();
                } else {
                    $this->Ln(12);
                }

                if (!isset($this->productsEnded)) {

                    $width_other = ($this->document['w'] - $this->margins['l'] - $this->margins['r'] - $this->firstColumnWidth - ($this->columns * $this->columnSpacing)) / ($this->columns - 1);

                    $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                    $this->SetTextColor(255, 255, 255);

                    $this->Ln(0);
                    $this->SetFont($this->font, 'B', 7);
                    $this->Cell(1, 4.5, '', 0, 0, 'L', 1);

                    // $this->Cell(119.8, 10, strtoupper($this->l['product']), 0, 0, 'L', 1);
                    $this->Cell(34.9, 4.5, "", 0, 0, 'L', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(19, 4.5, "SENT (TAN)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(22.4, 4.5, "ARRIVED (TAN)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(18, 4.5, "PRICE (RM)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(23, 4.5, "SENT (RM)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(23, 4.5, "ARRIVED (RM)", 0, 0, 'C', 1);

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(32, 4.5, "CARRY FORWARD (RM)", 0, 0, 'C', 1);

                    

                    if (isset($this->taxField)) {
                        $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                        $this->Cell($width_other, 10, strtoupper($this->l['vat']), 0, 0, 'C', 1);
                    }

                    if (isset($this->discountField)) {
                        $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                        $this->Cell($width_other, 10, strtoupper($this->l['discount']), 0, 0, 'C', 1);
                    }

                    $this->Cell($this->columnSpacing, 10, '', 0, 0, 'L', 0);
                    $this->Cell(19, 4.5, "(RM)", 0, 0, 'C', 1);
                    $this->Ln();
                } else {
                    $this->Ln(12);
                }


            }
        }
    }

    function Body()
    {

        $width_other = ($this->document['w'] - $this->margins['l'] - $this->margins['r'] - $this->firstColumnWidth - ($this->columns * $this->columnSpacing)) / ($this->columns - 1);
        $cellHeight = 9;
        $bgcolor = (1 - $this->columnOpacity) * 255;

        if ($this->items) {
            foreach ($this->items as $key=> $item) {
                $cHeight = $cellHeight;
                $this->SetFont($this->font, 'b', 7);
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(1, $cHeight, '', 0, 0, 'L', 1);
                $x = $this->GetX();
                $this->Cell(34.9, $cHeight, $item['item'], 0, 0, 'L', 1);
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, '', 7);

                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell(19, $cHeight, $item['sent'], 0, 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell(22.4, $cHeight, $item['sent2'], 0, 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell(18, $cHeight, $item['arrived'], 0, 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell(23, $cHeight, $item['pricearr'], 0, 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell(23, $cHeight, $item['quantity'], 0, 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->Cell(32, $cHeight, $item['price'], 0, 0, 'C', 1);

                

                if (isset($this->taxField)) {
                    $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                    if (isset($item['vat'])) {
                        $this->Cell($width_other, $cHeight, $item['vat'], 0, 0, 'C', 1);
                    } else {
                        $this->Cell($width_other, $cHeight, '', 0, 0, 'C', 1);
                    }
                }

                if (isset($this->discountField)) {
                    $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0); 
                    if (isset($item['discount'])) {
                        $this->Cell($width_other, $cHeight, $item['discount'], 0, 0, 'C', 1);
                    } else {
                        $this->Cell($width_other, $cHeight, '', 0, 0, 'C', 1);
                    }
                }
                $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(19, $cHeight, $item['total'], 0, 0, 'C', 1);
                $this->Ln();
                $this->Ln($this->columnSpacing);
            }
            if ($key > 8) {
                $this->AddPage();
            }
        } 
        if ($this->items1) {
            foreach ($this->items1 as $item1) {
                $cHeight = $cellHeight;
                $this->SetFont($this->font, 'b', 7);
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(1, $cHeight, '', 'T,B', 0, 'L', 1);
                $x = $this->GetX();
                $this->Cell(34.9, $cHeight, $item1['item1'], 'T,B', 0, 'L', 1);
                $this->SetTextColor(50, 50, 50);
                $this->SetFont($this->font, 'b', 7);

                $this->Cell($this->columnSpacing, $cHeight, '', 'T,B', 0, 'L', 0);
                $this->Cell(19, $cHeight, $item1['sent1'], 'T,B', 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 'T,B', 0, 'L', 0);
                $this->Cell(22.4, $cHeight, $item1['sent2'], 'T,B', 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 'T,B', 0, 'L', 0);
                $this->Cell(18, $cHeight, $item1['arrived1'], 'T,B', 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 'T,B', 0, 'L', 0);
                $this->Cell(23, $cHeight, $item1['pricearr1'], 'T,B', 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 'T,B', 0, 'L', 0);
                $this->Cell(23, $cHeight, $item1['quantity1'], 'T,B', 0, 'C', 1);

                $this->Cell($this->columnSpacing, $cHeight, '', 'T,B', 0, 'L', 0);
                $this->Cell(32, $cHeight, $item1['price1'], 'T,B', 0, 'C', 1);

                

                if (isset($this->taxField)) {
                    $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0);
                    if (isset($item['vat'])) {
                        $this->Cell($width_other, $cHeight, $item1['vat1'], 0, 0, 'C', 1);
                    } else {
                        $this->Cell($width_other, $cHeight, '', 'T', 0, 'C', 1);
                    }
                }

                if (isset($this->discountField)) {
                    $this->Cell($this->columnSpacing, $cHeight, '', 0, 0, 'L', 0); 
                    if (isset($item['discount'])) {
                        $this->Cell($width_other, $cHeight, $item1['discount1'], 0, 0, 'C', 1);
                    } else {
                        $this->Cell($width_other, $cHeight, '', 'T,B', 0, 'C', 1);
                    }
                }
                $this->Cell($this->columnSpacing, $cHeight, '', 'T,B', 0, 'L', 0);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(19, $cHeight, $item1['total1'], 'T,B', 0, 'C', 1);
                $this->Ln();
                $this->Ln($this->columnSpacing);
            }
        } 
        $badgeX = $this->getX();

        $badgeY = $this->getY();
        
        //Add totals
        if ($this->totals) {
            foreach ($this->totals as $total) {
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(1 + $this->firstColumnWidth, $cellHeight, '', 0, 0, 'L', 0);
                for ($i = 0; $i < $this->columns - 3; $i++) {
                    $this->Cell(12.3, $cellHeight, '', 0, 0, 'L', 0);
                    $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                }
                $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                if ($total['colored']) {
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                }
                $this->SetFont($this->font, 'b', 7);
                $this->Cell(1, $cellHeight, '', 0, 0, 'L', 1);
                $this->Cell(46.3 - 1, $cellHeight, $total['name'], 0, 0, 'L', 1);
                $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                $this->SetFont($this->font, 'b', 7);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                if ($total['colored']) {
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                // $this->SetTextColor(255, 255, 255);
                    // $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                }
                $this->Cell(51.3, $cellHeight, $total['value'], 0, 0, 'C', 1);
                $this->Ln();
                $this->Ln($this->columnSpacing);
            }
        }
        
        //Add totals
        if ($this->totalsbal) {
            foreach ($this->totalsbal as $totalbal) {
                $this->SetTextColor(50, 50, 50);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->Cell(1 + $this->firstColumnWidth, $cellHeight, '', 0, 0, 'L', 0);
                for ($i = 0; $i < $this->columns - 3; $i++) {
                    $this->Cell(12.3, $cellHeight, '', 0, 0, 'L', 0);
                    $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                }
                $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                if ($totalbal['colored']) {
                // $this->SetTextColor(50, 50, 50);
                $this->SetTextColor(255, 255, 255);
                // $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                }
                $this->SetFont($this->font, 'b', 8);
                $this->Cell(1, $cellHeight, '', 0, 0, 'L', 1);
                $this->Cell(46.3 - 1, $cellHeight, $totalbal['name'], 0, 0, 'L', 1);
                $this->Cell($this->columnSpacing, $cellHeight, '', 0, 0, 'L', 0);
                $this->SetFont($this->font, 'b', 8);
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                if ($total['colored']) {
                $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                // $this->SetTextColor(50, 50, 50);
                // $this->SetFillColor($bgcolor, $bgcolor, $bgcolor);
                    $this->SetTextColor(255, 255, 255);
                    $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                }
                $this->Cell(51.3, $cellHeight, $totalbal['value'], 0, 0, 'C', 1);
                $this->Ln();
                $this->Ln($this->columnSpacing);
            }
        }

        //Badge
        if ($this->badge) {

            $badge = ' ' . strtoupper($this->badge) . ' ';
            $resetX = $this->getX();
            $resetY = $this->getY();
            $this->SetLineWidth(0.4);
            // $this->SetDrawColor($this->color[0], $this->color[1], $this->color[2]);
            $this->SetDrawColor(255, 0, 0);
            // $this->setTextColor($this->color[0], $this->color[1], $this->color[2]);
            $this->setTextColor(255, 0, 0);
            $this->SetFont($this->font, 'b', 15);
            $this->Rotate(10, $this->getX(), $this->getY());
            $this->Rect($this->GetX(), $this->GetY(), $this->GetStringWidth($badge) + 2, 10);
            $this->Write(10, $badge);
            $this->Rotate(0);

            if ($resetY > $this->getY() + 20) {
                $this->setXY($resetX, $resetY);
            } else {
                $this->Ln(18);
            }

            $this->Ln(15);

            //Add signature
            if ($this->sigName != '' || $this->sigDesig != '') {
                $this->SetTextColor(50, 50, 50);
                $this->SetDrawColor(50, 50, 50);
                if ($this->sigName != '' || $this->sigDesig != '') {
                    $this->Line(146, $this->GetY(), $this->margins['r'] + 170, $this->GetY());
                }

                if ($this->sigName != '') {
                    $this->SetFont($this->font, 'b', 10);
                    $this->Cell($this->firstColumnWidth + 240, $cellHeight, $this->sigName, 0, 0, 'C', 0);
                    $this->Ln(4.4);
                }
                if ($this->sigDesig != '') {
                    $this->SetFont($this->font, '', 8);
                    $this->Cell($this->firstColumnWidth + 240, $cellHeight, $this->sigDesig, 0, 0, 'C', 0);
                    $this->Ln(5);
                }
                $this->Ln(20);
            }
        }

        //Add information
        if ($this->extraNotes == true) {
            foreach ($this->addText as $text) {
                if ($text[0] == 'title') {
                    $this->SetFont($this->font, 'b', 9);
                    $this->SetFillColor($this->color[0], $this->color[1], $this->color[2]);
                    $this->SetTextColor(255, 255, 255);
                    $this->Cell(1, 6, '', 0, 0, 'L', 1);
                    $this->Cell(0, 6, strtoupper($text[1]), 0, 0, 'L', 1);
                    $this->Ln();
                }
                if ($text[0] == 'paragraph') {
                    $this->Ln(1);
                    $this->SetTextColor(80, 80, 80);
                    $this->SetFont($this->font, 'B', 7);
                    $this->MultiCell(0, 4, $text[1], 0, 'L', 0);
                    $this->Ln(0);
                }
            }
        }
    }
    

    function Footer()
    {
        $this->SetY(-$this->margins['t']);
        $this->SetFont($this->font, '', 8);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(0, 10, $this->footernote, 0, 0, 'L');
        $this->Cell(0, 10, $this->l['page'] . ' ' . $this->PageNo() . ' ' . $this->l['page_of'] . ' {nb}', 0, 0, 'R');
    }

    private function setLanguage($language)
    {
        $this->language = $language;
        $l = [];
        $l['inv'] = __('messages.invoice_id');
        $l['remarks'] = __('Payment Method');
        $l['do'] = __('Reference');
        $l['sent'] = nl2br('Q.\nSent.');
        // $l['sent'] = __('Q.\nSent');
        $l['pricearr'] = __('P.Sent');
        $l['arrived'] = __('Q.Arrived');
        $l['unit'] = __('Unit');
        $l['created'] = __('messages.created_at');
        $l['rec'] = __('messages.receipt_id');
        $l['date'] = __('messages.billing_date');
        $l['due'] = __('messages.due_date');
        $l['amount'] = __('P.Arrived');
        $l['to'] = __('messages.billing_to');
        $l['price'] = __('Outst.(c/f)');
        $l['from'] = __('messages.billing_from');
        $l['product'] = 'Invoice Number';
        $l['discount'] = __('messages.discount');
        $l['vat'] = __('messages.tax');
        $l['total'] = __('messages.total');
        $l['page'] = __('messages.page');
        $l['page_of'] = __('messages.of');
        $this->l = $l;
    }

    private function setDocumentSize($dsize)
    {
        switch ($dsize) {
            case 'A4':
                $document['w'] = 210;
                $document['h'] = 297;
                break;
            case 'letter':
                $document['w'] = 215.9;
                $document['h'] = 279.4;
                break;
            case 'legal':
                $document['w'] = 215.9;
                $document['h'] = 355.6;
                break;
            default:
                $document['w'] = 210;
                $document['h'] = 297;
                break;
        }
        $this->document = $document;
    }

    private function resizeToFit($image)
    {
        list($width, $height) = getimagesize($image);
        $newWidth = $this->maxImageDimensions[0] / $width;
        $newHeight = $this->maxImageDimensions[1] / $height;
        $scale = min($newWidth, $newHeight);
        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }

    private function pixelsToMM($val)
    {
        $mm_inch = 25.4;
        $dpi = 96;
        return $val * $mm_inch / $dpi;
    }

    private function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }

    function Rotate($angle, $x = -1, $y = -1)
    {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function _endpage()
    {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

    private function br2nl($string)
    {
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    }
}
