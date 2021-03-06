<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Elcheffe\Laratoshl\Report\ToshlCategoryReport;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

/**
 * Class ToshlController
 * @package App\Http\Controllers
 */
class ToshlController extends Controller
{
    /**
     * Category Listing Test
     * @param ToshlCategoryReport $Report
     */
    public function test(ToshlCategoryReport $Report)
    {
        // Get the necessary Data from TOSHL API
        $currentUser = $Report->Toshl->getUserData();
        $reportData = $Report->getData();

        // Set locale and get some Date Stuff
        setlocale(LC_TIME, 'German');
        $year = Carbon::now()->formatLocalized('%Y');
        $month = Carbon::now()->formatLocalized('%B');

        $data = [
            'user' => $currentUser,
            'income' => $reportData['income'],
            'expense' => $reportData['expense'],
            'month' => $month,
            'year' => $year
        ];

        // Render a new PDF Document with help of a blade view
        $pdf = Pdf::loadView('pdf.report_categories', $data);

        // Set the footer of our new document
        $pdf->SetHTMLFooter($this->getHTMLFooter());

        // Output the PDF to the Browser
        return $pdf->stream('report_'.strtolower($month).'_'.$year.'.pdf');
    }

    /**
     * Return a string with the default laratoshl Footer
     * @return string
     */
    public function getHTMLFooter()
    {
        return '<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000;"><tr>
                <td width="33%">Generated by Laratoshl</td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right; ">'.date('d.m.Y H:i') .'</td>
                </tr></table>';
    }
}
