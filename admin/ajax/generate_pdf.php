<?php
require_once '../../lib/checkAdmin.php';
require_once '../../Models/Database.php';
require_once '../../vendor/tecnickcom/tcpdf/tcpdf.php'; // Adjust the path if necessary

use Models\Comment;

// Fetch comments data
$comments = Comment::with('user', 'place')->get();

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Comments List');
$pdf->SetSubject('Comments');
$pdf->SetKeywords('TCPDF, PDF, comments');

// Set default header data


// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Create HTML content
$html = '<h1>Comments List</h1>';
$html .= '<table border="1" cellpadding="4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Content</th>
                    <th>User</th>
                    <th>Place</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>';

foreach ($comments as $comment) {
    $html .= '<tr>
                <td>' . $comment->id . '</td>
                <td>' . $comment->content . '</td>
                <td>' . ($comment->user ? $comment->user->name : 'Anonymous') . '</td>
                <td>' . ($comment->place ? $comment->place->name : 'Unknown') . '</td>
                <td>' . $comment->created_at->format('Y-m-d H:i:s') . '</td>
              </tr>';
}

$html .= '</tbody></table>';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('komentar.pdf', 'I');
// Close and output
