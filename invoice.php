<?php
ob_start();

// include_once('jackus.php');
require_once('tcpdf/examples/tcpdf_include.php');

$id = '45';

class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {

        //config values from itinerary plan for language


        $arrival_location = "dszgrsuy";
        $departure_location =
            "dszgrsuy";
        $no_of_days
            = "dszgrsuy";
        $total_adult =
            "dszgrsuy";
        $total_children =
            "dszgrsuy";
        $total_infants =
            "dszgrsuy";
        $trip_start_date_and_time =
            "dszgrsuy";
        $trip_end_date_and_time =
            "dszgrsuy";


        // Logo
        $logoPath = 'http://localhost/rubafashion_ui/assets/img/logo/logo-ruba.png';
        $logoWidth = 40; // Set the desired width for your logo
        $this->Image($logoPath, 30, 8, $logoWidth, '', '', '', 'C');
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        $x_size = $this->GetX();
        $y_size = $this->GetY();
        $this->setX($x_size);
        $this->setY($y_size);
        $this->cell(80, 42, '', 1, 0, 'C');
        $this->cell(120, 42, '', 1, 1, 'C');
        $this->setX($x_size);
        $this->setY($y_size + 32);
        $this->SetTextColor(0, 0, 0); // Reset text color to black after the cell
        $this->SetFont('helvetica', '', 8);

        // Arrival (Bold)
        $this->writeHTMLCell(115, 5, $x_size + 80, $y_size + 5, '<p><span style="font-weight:bold;">Arrival:</span> ' . $arrival_location . '</p>', 0, 1, false, true, 'R', true);
        // Departure (Bold)
        $this->writeHTMLCell(115, 5, $x_size + 80, $y_size + 12, '<p><span style="font-weight:bold;">Departure:</span> ' . $departure_location . '</span>&nbsp;&nbsp;&nbsp;&nbsp;</p>', 0, 1, false, true, 'R', true);
        // Days and Nights
        $this->writeHTMLCell(115, 5, $x_size + 80, $y_size + 19, '<p><span style="font-weight:bold;">Days:</span> ' . $no_of_days . '</span> | <span style="font-weight:bold;">Nights:</span> 2</span>&nbsp;&nbsp;&nbsp;&nbsp;</p>', 0, 1, false, true, 'R', true);
        // Infant
        $this->writeHTMLCell(115, 5, $x_size + 80, $y_size + 26, '<p><span style="font-weight:bold;">Total Person Count : </span><span>' . $total_adult . '</span>&nbsp;&nbsp;&nbsp;&nbsp;</p>', 0, 1, false, true, 'R', true);
        // Adult + Children + Infant
        $this->writeHTMLCell(115, 5, $x_size + 80, $y_size + 33, '<p><span style="font-weight:bold;">Adult: </span>'  . $total_adult . '<span style="font-weight:bold;"> Children: </span>  ' . $total_children . '<span style="font-weight:bold;"> Infant :  ' . $total_infants . '</span>&nbsp;&nbsp;&nbsp;&nbsp;</p>', 0, 1, false, true, 'R', true);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Travel Itinerary');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins('5', '10', '5');
$pdf->SetHeaderMargin('5');
$pdf->SetFooterMargin('5');

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// $pdf->SetFont('helvetica', 'B', 10);

// // add a page
$pdf->AddPage();

$x_value = $pdf->getX();
$y_value = $pdf->getY();
$pdf->setX($x_value);
$pdf->setY($y_value + 80);

$pdf->setX($x_value);
$pdf->setY($y_value + 37);
// Set font for the package cost
$pdf->SetFont('helvetica', '', 12);
$pdf->SetTextColor(255, 255, 255); // White text color

// Set background color
$pdf->SetFillColor(0, 0, 128); // Navy Blue background color


// Display the package cost with background color
$pdf->Cell(0, 10, 'Over All Package Cost: Rs. 80,000', 0, 1, 'C', true);

// City list
$pdf->SetFont('helvetica', 'BIU', 10);
$pdf->SetTextColor(0, 0, 54); // Change text color to blue
$pdf->Cell(0, 10, 'Routes:', 0, 1, 'L');
$pdf->SetTextColor(0, 0, 0); // Change text color to blue
$pdf->SetFont('helvetica', 'B', 10);
$cities = array('Chennai', 'Salem', 'Trichy', 'Madurai', 'Dindigul', 'Kanyakumari', 'Cochin');

// Concatenate city names with arrows
$cityString = implode(' -> ', $cities);

// Output the city list in a single line
$pdf->Cell(0, 5, $cityString, 0, 1, 'L');
$pdf->SetFont('helvetica', '', 8);
$pdf->SetFillColor(255, 255, 255); // Reset background color to white

$pdf->SetTextColor(0, 0, 0); // Change text color to blue

// Next line of code

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(30, 10, 'List of Hotspots', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 8);
$table = '<table border="1" cellpadding="4" width="100%">
<tr>
<th colspan="6" align="center" style="font-size: 13px; font-weight:bold; background-color:#b0c4de;">Chennai</th>
</tr>
            <tr>
                <th width="10%" style="font-weight:bold">Date</th>
                <th width="40%" style="font-weight:bold">Hotspot Place</th>
                <th width="20%" style="font-weight:bold">Sightseeing Time</th>
                <th width="10%" style="font-weight:bold">Duration</th>
                <th width="10%" style="font-weight:bold">Guide</th>                
                <th width="10%" style="font-weight:bold">Guide Cost</th>                
            </tr>
            <tr>
                <td>20/11/2023</td>
                <td>Kaapaleeshwara Temple</td>
                <td>@9.30AM</td>
                <td>1 hour</td>
                <td>Yes</td>
                <td>Rs. 200</td>
            </tr>
            <tr>
                <td>20/11/2023</td>
                <td>Kaapaleeshwara Temple</td>
                <td>@9.30AM</td>
                <td>1 hour</td>
                <td>Yes</td>
                <td>Rs. 200</td>
            </tr>
            <tr>
                  <td>20/11/2023</td>
                  <td>Kaapaleeshwara Temple</td>
                  <td>@9.30AM</td>
                  <td>1 hour</td>
                  <td>Yes</td>
                  <td>Rs. 200</td>
            </tr>
        </table>';

$pdf->SetTextColor(0, 0, 0); // Reset text color to black
$pdf->SetFont('helvetica', '', 8);

$pdf->writeHTML($table, true, false, true, false, '');

// $pdf->AddPage();

// $x_value = $pdf->getX();
// $y_value = $pdf->getY();
// $pdf->setX($x_value);
// $pdf->setY($y_value + 80);

// $pdf->setX($x_value);
// $pdf->setY($y_value + 37);
$table = '<table cellpadding="4" width="100%">
<tr>
<th colspan="6" align="center" style=" font-weight:bold; font-size: 12px;background-color:#b0c4de;">Complete Summary</th>
</tr>
            <tr>
                <th width="20%" style="font-weight:bold">Total Vehicles Taken</th>
                <th width="20%" style="font-weight:bold">Onward distance</th>
                <th width="20%" style="font-weight:bold">Origin City</th>     
                <th width="20%" style="font-weight:bold">Airport / Railstation pick-up/drop distance</th>                             
                <th width="20%" style="font-weight:bold">Total distance (including pick-up/drop)</th>
            </tr>
            <tr>
                <td>1</td>
                <td>65 KM</td>
                <td>Chennai</td>    
                <td>80 KM</td>     
                <td>15 KM</td>      
            </tr>
            <br>
            <tr>
                <th width="20%" style="font-weight:bold">Return distance</th>                
                <th width="20%" style="font-weight:bold">Permit State Applicable</th>   
                <th width="20%" style="font-weight:bold">Total Sight Seeing Distance</th>                
                <th width="40%" style="font-weight:bold">Extra KMS covered</th>   
            </tr>
            <tr>
               <td>199 KM</td>
               <td>Pudhucherry - Rs. 200</td>
               <td>200 KM</td>
               <td>Yes - 50 KM</td>
            </tr>
        </table>';

$pdf->writeHTML($table, true, false, true, false, '');

$pdf->SetTextColor(0, 0, 0); // Reset text color to black
$pdf->SetFillColor(176, 196, 222); // Navy Blue background color
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Total amount chargeble for transport: Rs. 30,000', 0, 1, 'C', true);
// Next line of code
$pdf->Cell(100, 10, '', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 8);
$table = '<table  colspan="6" border="1" cellpadding="6" width="100%">
            <tr>
                <th width="50%">Grand Total Of This Plan</th>
                <th width="50%"> Rs. 11,950</th>           
            </tr>
            <tr>
               <th width="50%">Selling cost to agent[Selling % = 10.00]</th>
               <th width="50%"> Rs. 13,195</th>           
            </tr>
            <tr>
               <th width="50%">Profit amount to DVI</th>
               <th width="50%"> Rs. 1,950</th>           
            </tr>
            <tr>
               <th width="50%">Profit amount to agent(0.00%)</th>
               <th width="50%"> Rs. 0</th>           
            </tr>
            <tr>
               <th width="50%">This Itinerary Cost</th>
               <th width="50%"> Rs. 13,145</th>           
            </tr>
</table>';
$pdf->writeHTML($table, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('travel_itinerary.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+