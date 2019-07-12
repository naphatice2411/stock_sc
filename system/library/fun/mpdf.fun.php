<?php
	function genPdf($rp=false,$pr=false,$html,$size='A4',$pageNo=NULL){
		require_once(INDEX_PATH.'system/library/ext/mpdf/vendor/autoload.php');
		$mpdf=new \Mpdf\Mpdf();
		
		$defaultConfig=(new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs=$defaultConfig['fontDir'];

		$defaultFontConfig=(new Mpdf\Config\FontVariables())->getDefaults();
		$fontData=$defaultFontConfig['fontdata'];

		if($pr){
			$mpdf = new \Mpdf\Mpdf([
				'fontDir'=>array_merge($fontDirs,[
					__DIR__.'/fonts',
				]),
				'fontdata'=>$fontData+[
					'thsarabun'=>[
						'R'=>'THSarabun.ttf',
						'I'=>'THSarabun Italic.ttf',
						'B'=>'THSarabun Bold.ttf'
					],
				],
				'default_font_size'=>16,
				'default_font'=>'thsarabun',
				'format'=>'A4',
				'margin_left'=>7.62,
				'margin_right'=>7.62,
				'margin_top'=>5.08,
				'margin_buttom'=>4.318,
				'margin_header'=>0,
				'margin_footer'=>0,
			]);
		}
		if($rp){
			$mpdf = new \Mpdf\Mpdf([
				'fontDir'=>array_merge($fontDirs,[
					__DIR__.'/fonts',
				]),
				'fontdata'=>$fontData+[
					'thsarabun'=>[
						'R'=>'THSarabun.ttf',
						'I'=>'THSarabun Italic.ttf',
						'B'=>'THSarabun Bold.ttf'
					],
				],
				'default_font_size'=>14,
				'default_font'=>'thsarabun',
				'format'=>'A4',
				'margin_left'=>17.78,
				'margin_right'=>17.78,
				'margin_top'=>10,
				'margin_buttom'=>0,
				'margin_header'=>0,
				'margin_footer'=>0,
			]);
		}
		
		$mpdf->SetDisplayMode('fullpage');
		if($pr)$mpdf->SetHTMLHeader('<div style="text-align: right; font-size: 12pt;">แบบ พ.43</div>');
        // else $mpdf->SetHTMLHeader('<div style="text-align: right; font-weight: bold;">'.$pageNo.'</div>');
		$mpdf->WriteHTML(thai($html));
// 		$mpdf->WriteHTML('<columns column-count="3" vAlign="J" column-gap="7" />');
// $mpdf->WriteHTML('Some text...');

// $mpdf->WriteHTML('<columnbreak />');

// $mpdf->WriteHTML('Next column...');
		// $mpdf->WriteHTML($html);
		if($pr)$fname="PR".date('Ymdhis').".pdf";
		if($rp)$fname="RP".date('Ymdhis').".pdf";
		$pf=INDEX_PATH."system/pdf/".$fname;
		$mpdf->Output($pf);
		return (site_url('system/pdf/'.$fname,true));
	}

	function thai($x) {
		$back = array(
			"\xE0\xB9\x88" => "\xEF\x9C\x85",
			"\xE0\xB9\x89" => "\xEF\x9C\x86",
			"\xE0\xB9\x8A" => "\xEF\x9C\x87",
			"\xE0\xB9\x8B" => "\xEF\x9C\x88",
			"\xE0\xB9\x8C" => "\xEF\x9C\x89"
		);
		// print_r($back);
		$cross = array();
		foreach (array("\xE0\xB8\xB4", "\xE0\xB8\xB5", "\xE0\xB8\xB6", "\xE0\xB8\xB7","\xE0\xB8\xB1") as $p) {
			for ($i = 0x85; $i <= 0x89; $i ++) {
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