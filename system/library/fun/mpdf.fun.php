<?php
function genPdf($html, $size = 'A4', $pageNo = NULL)
{
	require_once(INDEX_PATH . 'system/library/ext/mpdf/vendor/autoload.php');
	$mpdf = new \Mpdf\Mpdf();

	$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
	$fontDirs = $defaultConfig['fontDir'];

	$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
	$fontData = $defaultFontConfig['fontdata'];

	$mpdf = new \Mpdf\Mpdf([
		'fontDir' => array_merge($fontDirs, [
			__DIR__ . '/fonts',
		]),
		'fontdata' => $fontData + [
			'thsarabun' => [
				'R' => 'THSarabun.ttf',
				'I' => 'THSarabun Italic.ttf',
				'B' => 'THSarabun Bold.ttf'
			],
		],
		'default_font_size' => 16,
		'default_font' => 'thsarabun',
		'format' => 'A4',
		'margin_left' => 17.78,
		'margin_right' => 17.78,
		// 'margin_top' => 10,
		// 'margin_buttom' => 0,
		// 'margin_header' => 0,
		// 'margin_footer' => 0,
	]);

	$fname = "stk_" . date('Ymdhis') . ".pdf";
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->SetHTMLHeader('<div style="text-align: right; font-size: 12pt;">'.$fname.'</div>');
	$mpdf->WriteHTML(thai($html));
	$pf = INDEX_PATH . "system/pdf/" . $fname;
	$mpdf->Output($pf);
	return (site_url('system/pdf/' . $fname, true));
}

function thai($x)
{
	$back = array(
		"\xE0\xB9\x88" => "\xEF\x9C\x85",
		"\xE0\xB9\x89" => "\xEF\x9C\x86",
		"\xE0\xB9\x8A" => "\xEF\x9C\x87",
		"\xE0\xB9\x8B" => "\xEF\x9C\x88",
		"\xE0\xB9\x8C" => "\xEF\x9C\x89"
	);
	// print_r($back);
	$cross = array();
	foreach (array("\xE0\xB8\xB4", "\xE0\xB8\xB5", "\xE0\xB8\xB6", "\xE0\xB8\xB7", "\xE0\xB8\xB1") as $p) {
		for ($i = 0x85; $i <= 0x89; $i++) {
			$from = $p . "\xEF\x9C" . chr($i);
			$to   = $p . "\xE0\xB9" . chr($i + 3);
			$cross[$from] = $to;
		}
	}
	// print_r($cross);
	$x = strtr($x, $back);
	// print "first".$x;
	$x = strtr($x, $cross);
	// print "second".$x;
	return $x;
}
