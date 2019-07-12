<?php
    // print_r($hGET);
    if($hGET['t']==1)genReport($hGET['id']);
    if($hGET['t']==2)genReq($hGET['id']);

    function genReport($id){
        load_fun('mpdf');
        load_fun('tinyDB');
        $data=selectTb('req_material','*','id="'.$id.'"');
        $subData=selectTb('req_item','material_name,request_quantity,unit_id,cost_per_unit,note','req_id="'.$id.'"');
        $data=$data[0];
        // print_r($data);
        // print_r($subData);
        $TAB='<span style="visibility: hidden; color: white;">XXXX</span>';
        $html = '
        <table style="border-collapse:collapse;">
            <tr>
                <td rowspan="3" style="width: 2.31in;"><img style="width: 0.89in; height: 0.89in;" src="'.site_url('system/pictures/logo/institute.jpg',true).'"></td>
                <td rowspan="3" style="width: 2.31in;"><h1 style="font-size: 20pt; font-weight: bold; vertical-align : middle; text-align: center;"><span></span>บันทึกรายงานขอซื้อ/จ้าง</h1></td>
                <td style="width: 2.31in; font-size: 16pt; font-weight: bold; vertical-align : top; text-align: right;">แบบ พจ.1</td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>

        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="10%" style="font-size: 16pt; font-weight: bold;">หน่วยงาน</td>
                <td width="80%" style="font-size: 15pt; border-bottom: 1px solid black; border-style: dotted;">
                    คณะครุศาสตร์อุตสาหกรรมและเทคโนโลยี ส่วนสนับสนุนวิชาการ โทร. 3681, 6087, 6091
                </td>
                <td width="10%"></td>
            </tr>
        </table>

        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="6%" style="font-size: 16pt; font-weight: bold;">ที่</td>
                <td width="17%" style="font-size: 15pt;">    ศธ  0524.04(1.5)/ </td>
                <td width="27%" style="border-bottom: 1px solid black; border-style: dotted;"></td>
                <td width="10%"></td>
                <td width="5%" style="font-size: 16pt;">     <b>วันที่</b>       </td>
                <td width="35%" style="font-size: 15pt; border-bottom: 1px solid black; border-style: dotted;"></td>
            </tr>
        </table>
        
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="6%" style="font-size: 16pt; font-weight: bold;">เรื่อง</td>
                <td width="20%" style="font-size: 15pt;">รายงานขอซื้อ/จ้าง</td>
                <td width="74%" style="font-size: 15pt; border-bottom: 1px solid black; border-style: dotted;">วัสดุการศึกษา</td>
            </tr>
        </table>
        
        <table width="100%" style="">
            <tr>
                <td width="6%" style="font-size: 15pt;"></td>
                <td width="37%" style="font-size: 15pt;">ด้วยเงินงบประมาณ/เงินรายได้ ประจำปี</td>
                <td width="6%" style="font-size: 15pt; border-bottom: 1px solid black; border-style: dotted;">2561</td>
                <td style="font-size: 15pt;">โดยวิธีเฉพาะเจาะจง</td>
            </tr>
        </table>

        <table width="100%" style="border-collapse:collapse;">
            <tr>
            <td width="100%" style="border-bottom: 1px solid black;"></td>
            </tr>
        </table>

        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="6%" style="font-size: 16pt; font-weight: bold;">เรียน</td>
                <td width="10%" style="font-size: 15pt; border-bottom: 1px solid black; border-style: dotted;">อธิการบดี</td>
                <td width="85%"></td>
            </tr>
        </table>

        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="6%" style="font-size: 15pt;"></td>
                <td width="20%" style="font-size: 15pt;">ด้วยภาควิชา/งานพัสดุ</td>
                <td width="23%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">ครุศาสตร์วิศวกรรม</td>
                <td width="28%" style="font-size: 15pt;">ขอรายงานเสนอเพื่อขอจัดซื้อ/จ้าง</td>     
                <td width="24%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">วัสดุการศึกษา</td>
            </tr>
        </table>

        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="5%" style="font-size: 15pt;">ให้แก่</td>
                <td width="35%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">ภาควิชาครุศาสตร์วิศวกรรม</td>
                <td width="15%" style="font-size: 15pt;">เนื่องจากมีความจำเป็น</td>
                <td width="45%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">เพื่อใช้ในการเรียนการสอน</td>
            </tr>
        </table>

        <table width="70%" style="border-collapse:collapse;">
            <tr>
                <td width="50%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">หลักสูตรครุศาสตร์วิศวกรรม 5 ปี (ป.ตรี)</td>
                <td width="20%"style="font-size: 15pt;">ตามรายการและราคาต่อไปนี้</td>
            </tr>
            <tr><td style="font-size: 5pt;">&nbsp;</td></tr>
        </table>
        

        <table border="1" style="border-collapse:collapse; margin-left: auto; margin-right: auto;">
            <tr>
                <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.5in;">ลำดับที่</td>
                <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.63in;">รหัสพัสดุ GPSC</td>
                <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 2.22in;">รายการและรายละเอียด</td>
                <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.79in;">จำนวน หน่วย</td>
                <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.98in;">ราคาซื้อ/จ้าง ครั้งหลังสุด หน่วยละ(บาท)</td>
                <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 1.07in;">ราคาซื้อ/จ้าง ครั้งนี้ หน่วยละ(บาท)</td>
                <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.74in;">รวมเงิน (บาท)</td>
            </tr>';
            $i=0;
            foreach($subData as $k=>$v){
                $unitId=$v['unit_id'];
                $unitName=selectTb('unit_data','unit_name','id="'.$unitId.'"');
                $unitName=$unitName[0]['unit_name'];
                $strCost=$v['cost_per_unit'];
                $qty=$v['request_quantity'];
                $moneyCost = number_format($strCost,2,'.',',');
                // $moneyCost=explode('.',$moneyCost);
                $sumAmount=0;
                if(is_numeric($strCost)&&is_numeric($qty))$sumAmount=$strCost*$qty;
                $moneySumAmount=number_format($sumAmount,2,'.',',');
                // $moneySumAmount=explode('.',$moneySumAmount);
                $i++;
                $html.=
                '<tr>
                    <td style="font-size: 14pt; text-align:center">'.$i.'</td>
                    <td style="font-size: 14pt; text-align:center"></td>
                    <td style="font-size: 14pt; text-align:left;">'.$v['material_name'].'</td>
                    <td style="font-size: 14pt; text-align:center">'.$v['request_quantity']." ".$unitName.'</td>
                    <td style="font-size: 14pt; text-align:center"></td>
                    <td style="font-size: 14pt; text-align:right;">'.$moneyCost.'</td>
                    <td style="font-size: 14pt; text-align:right;">'.$moneySumAmount.'</td>
                </tr>';
            }
            while($i<5){
                $i++;
                $html.=
                '<tr>
                    <td style="font-size: 14pt; text-align:center;"><span style="visibility: hidden; color: white; font-size: 14pt;">X</span></td>
                    <td style="font-size: 14pt; text-align:center; border-bottom: 0;"></td>
                    <td style="font-size: 14pt; text-align:center"></td>
                    <td style="font-size: 14pt; text-align:center"></td>
                    <td style="font-size: 14pt; text-align:center"></td>
                    <td style="font-size: 14pt; text-align:center"></td>
                    <td style="font-size: 14pt; text-align:center"></td>
                </tr>';
            }
            $discount=$data['discount'];
            $strDiscount=(number_format($discount,2,'.',','));
            $html.=
            '<tr>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right;">ส่วนลด</td>
                <td style="font-size: 14pt; text-align:right">'.$strDiscount.'</td>
            </tr>';
                
            $totalAmount=$data['total_cost'];
            $tax=$data['vat'];
            $beforeTaxAmount=is_numeric($totalAmount)&&is_numeric($tax)?$totalAmount-$tax:$totalAmount;
            $strBefore=(number_format($beforeTaxAmount,2,'.',','));
            $html.=
            '<tr>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right;">รวมราคา</td>
                <td style="font-size: 14pt; text-align:right">'.$strBefore.'</td>
            </tr>';
            
            $strTax=(number_format($tax,2,'.',','));
            $html.=
            '<tr>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right;">ภาษีมูลค่าเพิ่ม 7%</td>
                <td style="font-size: 14pt; text-align:right">'.$strTax.'</td>
            </tr>';

            $strTotalAmount=number_format($totalAmount,2,'.',',');
            $html.=
            '<tr>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
                <td style="font-size: 14pt; text-align:center; border-bottom: 0; border-left: 0;">รวมเป็นเงินทั้งสิ้น</td>
                <td style="font-size: 14pt; text-align:right;">'.$strTotalAmount.'</td>
            </tr>
            <tr>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
                <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
                <td style="font-size: 14pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
                <td style="font-size: 14pt; text-align:right; border-left: 0; border-right: 0; border-top: 0;"></td>
            </tr>
            ';
        $html.='</table>

        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="100%" colspan="6" style="font-size: 14pt;">หน่วยงานขอใช้เงินในการจัดหา ตามรหัสดังนี้</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="12%" style="font-size: 14pt;">วิทยาเขต/คณะ</td>
                <td width="40%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">คณะครุศาสตร์อุตสาหกรรมและเทคโนโลยี</td>
                <td width="26%" style="font-size: 14pt;">รหัสวิทยาเขต/คณะ/สำนัก/บัณฑิต</td>
                <td width="22%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">03</td>
            </tr>
        </table>
        
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="15%" style="font-size: 14pt;">ภาควิชา/กอง/ฝ่าย</td>
                <td width="38.30%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">ครุศาสตร์วิศวกรรม</td>
                <td width="15%" style="font-size: 14pt;">รหัสภาควิชา/กอง/ฝ่าย</td>
                <td width="31.70%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">03050</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="6%" style="font-size: 14pt;">กองทุน</td>
                <td width="45.85%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">เพื่อการศึกษา</td>
                <td width="10%" style="font-size: 14pt;">รหัสกองทุน</td>
                <td width="38.15%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">0200</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="5%" style="font-size: 14pt;">แผนงาน</td>
                <td width="47.1%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">จัดการศึกษาอุดมศึกษา</td>
                <td width="8%" style="font-size: 14pt;">รหัสแผนงาน</td>
                <td width="39.9%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">09007</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="3%" style="font-size: 14pt;">งาน</td>
                <td width="12.25%" style="font-size: 14pt;">- กิจกรรมหลัก</td>
                <td width="36.85%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">จัดการศึกษาด้านวิทยาศาสตร์และเทคโนโลยี</td>
                <td width="4%" style="font-size: 14pt;">รหัส</td>
                <td width="12.25%" style="font-size: 14pt;">- กิจกรรมหลัก</td>
                <td width="31.65%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">0102</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="3.5%" style="font-size: 14pt;"></td>
                <td width="12.75%" style="font-size: 14pt;">- กิจกรรมรอง</td>
                <td width="35.85%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">สาขาครุศาสตร์อุตสาหกรรม</td>
                <td width="4%" style="font-size: 14pt;"></td>
                <td width="12.25%" style="font-size: 14pt;">- กิจกรรมรอง</td>
                <td width="31.65%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">20</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="3.5%" style="font-size: 14pt;"></td>
                <td width="12.75%" style="font-size: 14pt;">- กิจกรรมย่อย</td>
                <td width="35.85%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">ระดับปริญญาตรี</td>
                <td width="4%" style="font-size: 14pt;"></td>
                <td width="12.25%" style="font-size: 14pt;">- กิจกรรมย่อย</td>
                <td width="31.65%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">211</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="9%" style="font-size: 14pt;">งบรายจ่าย</td>
                <td width="44.1%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">งบดำเนินงาน</td>
                <td width="10%" style="font-size: 14pt;">รหัสงบรายจ่าย</td>
                <td width="36.9%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">52000</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="12%" style="font-size: 14pt;">ประเภทรายจ่าย</td>
                <td width="40%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">ค่าวัสดุ</td>
                <td width="16%" style="font-size: 14pt;">รหัสประเภทรายจ่าย</td>
                <td width="32%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">52500</td>
            </tr>
        </table>
        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="6%" style="font-size: 14pt;">ค่าใช้จ่าย</td>
                <td width="46.30%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">ค่าวัสดุการศึกษาใช้ไป</td>
                <td width="10%" style="font-size: 14pt;">รหัสค่าใช้จ่าย</td>
                <td width="38.70%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">5104010103</td>
            </tr>
        </table>

        <table width="100%" style="border-collapse:collapse;">
            <tr>
                <td width="100%" style="font-size: 14pt; text-align: center;">-2-</td>
            </tr>
        </table>

        และพร้อมกันนี้ได้แนบเอกสารประกอบการพิจารณา ดังนี้
            <table width="50%" style="border-collapse:collapse;">
                <tr>
                    <td width="23%"></td>
                    <td width="5%">1.</td>
                    <td width="42%">บันทึกเสนอซื้อ/จ้าง(พัสดุ)</td>
                    <td width="17%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                    <td></td>
                </tr>
            </table>
            <table width="50%" style="border-collapse:collapse;">
                <tr>
                    <td width="23%"></td>
                    <td width="5%">2.</td>
                    <td width="30%">ใบเสนอราคาพัสดุ</td>
                    <td width="24%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                    <td>ชุด</td>
                </tr>
            </table>
            <columns column-count="2" vAlign="J" column-gap="3" />
            จึงเรียนมาเพื่อโปรดพิจารณา
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%">1.1 </td>
                    <td>อนุมัติให้จัดซื้อ/จ้าง ทำวัสดุ/ครุภัณฑ์</td>
                    <td width="30%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">วัสดุการศึกษา</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td>จำนวน</td>
                    <td width="20%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">3</td>
                    <td>รายการ</td>
                    <td></td>
                    <td>วงเงิน</td>
                    <td width="30%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">3</td>
                    <td>บาท</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td style="font-size: 14pt;">ตามรายละเอียดข้างต้น โดยวิธีเฉพาะเจาะจง ตามพระราชบัญญัติ</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td style="font-size: 14pt;">การจัดซื้อจัดจ้างและการบริหารพัสดุภาครัฐ พ.ศ.2560 ข้อ 56 (2)</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td style="font-size: 14pt;">ข้อ(ข) และกฎกระทรวงเรื่อง กำหนดวงเงินการจัดซื้อจัดจ้างพัสดุ</td>                
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td style="font-size: 14pt;">โดยวิธีเฉพาะเจาะจง วงเงินการจัดซื้อจัดจ้างที่ไม่ทำข้อตกลงเป็น</td>                
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td style="font-size: 14pt;">หนังสือ และวงเงินจัดซื้อจัดจ้างในการแต่งตั้งผู้ตรวจรับพัสดุ</td>                
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td style="font-size: 14pt;">พ.ศ.2560 ข้อ 1 ซึ่งอยู่ภายใต้อำนาจจัดซื้อจัดจ้าง ข้อ 86 (1)</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td style="font-size: 14pt;">ของระเบียบกระทรวงการคลังว่าด้วยการจัดซื้อจัดจ้างและการ</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td style="font-size: 14pt;">บริหารพัสดุภาครัฐ พ.ศ.2560 และได้ตรวจสอบเอกสารควบคุมเงิน</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td style="font-size: 14pt;">เป็นที่เรียบร้อยแล้ว โดยขอเบิกจ่ายจากเงินงบประมาณ/เงินรายได้</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="15%" style="font-size: 14pt;">ประจำปี</td>
                    <td width="10%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">2561</td>
                    <td width="75%"></td>    
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="16%">จากผู้ขาย</td>
                    <td style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">บริษัท ไอที ซิตี้ จำกัด (มหาชน)</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="16%">เนื่องจาก</td>
                    <td style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">เป็นผู้จำหน่าย</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%">1.2 </td>
                    <td>อนุมัติแต่งตั้งกรรมการตรวจรับพัสดุ</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%">1.2.1</td>
                    <td width="80%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">รศ.ปิยะ ศุภวราสุวัฒน์</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%">1.2.2</td>
                    <td width="80%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%">1.2.3</td>
                    <td width="80%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                </tr>
            </table>

            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%">1.3</td>
                    <td>ลงนามในใบสั่งซื้อ/จ้าง ที่แนบมานี้</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%">ลงชื่อ</td>
                    <td width="35%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                    <td width="45%">(เจ้าหน้าที่ภาควิชา ครุ.วศ.)</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%"></td>
                    <td style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">(นางรวีวรรณ มุขแก้ว)</td>
                    <td width="45%"></td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%">ลงชื่อ</td>
                    <td width="35%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                    <td width="45%">(หัวหน้าภาควิชา ครุ.วศ.)</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="7%"></td>
                    <td width="11%"></td>
                    <td style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">(ผศ.ดร.สันติ ตันตระกูล)</td>
                    <td width="43%"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>ซึ่งได้รับการแต่งตั้งเป็นเจ้าหน้าที่พัสดุ</td>
                    <td></td>
                </tr>
            </table>
            <columnbreak/>
            <br>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="42%" style="font-size: 14pt; font-weight: bold;"><u>ส่วนบันทึกงานพัสดุคณะ/สำนัก</u></td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="10%">เรียน</td>
                    <td width="20%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">อธิการบดี</td>
                    <td width="70%"></td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="10%"></td>
                    <td width="40%" style="font-size: 14pt; text-align: center; ">เห็นควรโปรดพิจารณา</td>
                    <td width="50%"></td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%">1.4</td>
                    <td width="63%">อนุมัติให้ภาคฯ,ศูนย์,โครงการ จัดซื้อ/จ้าง</td>
                    <td width="29%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="70%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">วัสดุการศึกษา</td>
                    <td width="30%">ตามรายละเอียดข้างต้น</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%">1.5</td>
                    <td width="63%">อนุมัติแต่งตั้งกรรมการตรวจรับตามเสนอ</td>
                    <td width="29%"></td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%">1.6</td>
                    <td width="63%">ลงนามในใบสั่งซื้อ/จ้าง ที่แนบมานี้</td>
                    <td width="29%"></td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
            <!--    <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr> -->
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%">ลงชื่อ</td>
                    <td width="40%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                    <td width="40%">เจ้าหน้าที่พัสดุคณะ/สำนัก</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%"></td>
                    <td style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">(นางสาวจิราพร เวชพันธุ์)</td>
                    <td width="40%"></td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%">1.7</td>
                    <td width="63%">บันทึกชี้แจงเพิ่มเติม(ถ้ามี)</td>
                    <td width="29%"></td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="92%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">&nbsp;</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="92%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">&nbsp;</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="92%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">&nbsp;</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="92%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
            </table>

            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%">ลงชื่อ</td>
                    <td width="50%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                    <td width="30%"></td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="14%"></td>
                    <td style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">(อาจารย์สรรวดี เจริญชาศรี)</td>
                    <td width="32%"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="font-size: 14pt; text-align: center;">รองคณะบดี</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
            </table>

            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%">1.8</td>
                    <td width="92%">อนุมัติให้ดำเนินการจัดซื้อและลงนามเรียบร้อยแล้ว</td>
                </tr>
                <tr>
                    <td style="font-size: 14pt;">&nbsp;</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="12%">ลงชื่อ</td>
                    <td width="60%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;"></td>
                    <td width="20%">ผู้อนุมัติ</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="8%"></td>
                    <td width="14%"></td>
                    <td style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">(รองศาสตราจารย์ ดร.กิติพงค์ มะโน)</td>
                    <td width="22%"></td>
                </tr>
            </table>
            <table>   
                <tr>
                    <td width="12%"></td>
                    <td style="font-size: 14pt; text-align: center;">คณบดี คณะครุศาสตร์อุตสาหกรรมและเทคโนโลยี</td>
                </tr>
                <tr>
                    <td width="12%"></td>
                    <td style="font-size: 14pt; text-align: center;">ปฏิบัติการแทนอธิการบดี</td>
                </tr>
            </table>
        ';
        
        
            // $click='<a href="'.genPdf(true,false,$html).'">Click Here to Download as PDF</a>';
            // print ($html);
            // print($click);
        redirect(genPdf(true,false,$html),true);
    }

    function genReq($id){
        load_fun('mpdf');
        load_fun('tinyDB');
        $data=selectTb('req_material','*','id="'.$id.'"');
        $subData=selectTb('req_item','material_name,request_quantity,unit_id,cost_per_unit,note','req_id="'.$id.'"');
        $data=$data[0];
        //ใบเบิกวัสดุ
        $html='
        <table border="1" style="border-collapse:collapse; margin-left: auto; margin-right: auto;">
            <tr>
                <td style="font-weight: bold; font-size: 10pt; width: 0.44in; text-align:center;" rowspan="2">ลำดับ</td>
                <td style="font-weight: bold; font-size: 10pt; vertical-align : middle; text-align:center; width:2.71in;" rowspan="2">รายการ</td>
                <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 1.68in;" colspan="3">จำนวน</td>
                <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 2.31in;" colspan="5">ส่วนของงานพัสดุ</td>
                <td style="font-weight: bold; font-size: 10pt; vertical-align : middle; width:0.55in; text-align:center;" rowspan="2">หมายเหตุ</td>
            </tr>
            <tr>
                <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.79in;">เบิก</td>
                <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.43in;">จ่าย</td>
                <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.46in;">ค้างจ่าย</td>
                <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.56in;">รหัสพัสดุ</td>
                <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.89in;" colspan="2">ต้นทุน/หน่วย</td>
                <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.86in;" colspan="2">จำนวนเงิน</td>
            </tr>';
            $i=0;
            foreach($subData as $k=>$v){
                
                $strCost=$v['cost_per_unit'];
                $qty=$v['request_quantity'];
                $moneyCost = number_format($strCost,2,'.',',');
                $moneyCost=explode('.',$moneyCost);
                $sumAmount=0;
                if(is_numeric($strCost)&&is_numeric($qty))$sumAmount=$strCost*$qty;
                $moneySumAmount=number_format($sumAmount,2,'.',',');
                $moneySumAmount=explode('.',$moneySumAmount);
                $i++;
                $html.=
                '<tr>
                    <td style="font-size: 14pt; text-align:center">'.$i.'</td>
                    <td style="font-size: 14pt; text-align:left;">'.$v['material_name'].'</td>
                    <td style="font-size: 14pt; text-align:center">'.$v['request_quantity']." ".$unitName.'</td>
                    <td style="font-size: 14pt; text-align:center"></td>
                    <td style="font-size: 14pt; text-align:center"></td>
                    <td style="font-size: 14pt; text-align:center"></td>
                    <td style="font-size: 14pt; text-align:right; width: 0.6in;">'.$moneyCost[0].'</td>
                    <td style="font-size: 14pt; text-align:left; width: 0.29in;">'.$moneyCost[1].'</td>
                    <td style="font-size: 14pt; text-align:right; width: 0.56in;">'.$moneySumAmount[0].'</td>
                    <td style="font-size: 14pt; text-align:left; width: 0.3in;">'.$moneySumAmount[1].'</td>
                    <td style="font-size: 14pt; text-align:center">'.$v['note'].'</td>
                </tr>';
            }
            while($i<5){
                $i++;
                $html.=
                '<tr>
                    <td style="padding-bottom: 0.22in; font-size: 10pt; text-align:center"></td>
                    <td style="font-size: 10pt; text-align:center; border-bottom: 0;"></td>
                    <td style="font-size: 10pt; text-align:center"></td>
                    <td style="font-size: 10pt; text-align:center"></td>
                    <td style="font-size: 10pt; text-align:center"></td>
                    <td style="font-size: 10pt; text-align:center"></td>
                    <td style="font-size: 10pt; text-align:center"></td>
                    <td style="font-size: 10pt; text-align:center"></td>
                    <td style="font-size: 10pt; text-align:center"></td>
                    <td style="font-size: 10pt; text-align:center"></td>
                    <td style="font-size: 10pt; text-align:center"></td>
                </tr>';
            }
            $discount=$data['discount'];
            $strDiscount=explode('.',number_format($discount,2,'.',','));
            $html.=
            '<tr>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right;">ส่วนลด</td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right">'.$strDiscount[0].'</td>
                <td style="font-size: 14pt; text-align:left">'.$strDiscount[1].'</td>
                <td style="font-size: 10pt; text-align:center"></td>
            </tr>';
                
            $totalAmount=$data['total_cost'];
            $tax=$data['vat'];
            $beforeTaxAmount=is_numeric($totalAmount)&&is_numeric($tax)?$totalAmount-$tax:$totalAmount;
            $strBefore=explode('.',number_format($beforeTaxAmount,2,'.',','));
            $html.=
            '<tr>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right;">รวมราคา</td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right">'.$strBefore[0].'</td>
                <td style="font-size: 14pt; text-align:left">'.$strBefore[1].'</td>
                <td style="font-size: 10pt; text-align:center"></td>
            </tr>';
            
            $strTax=explode('.',number_format($tax,2,'.',','));
            $html.=
            '<tr>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right;">ภาษีมูลค่าเพิ่ม 7%</td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 10pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right">'.$strTax[0].'</td>
                <td style="font-size: 14pt; text-align:left">'.$strTax[1].'</td>
                <td style="font-size: 10pt; text-align:center"></td>
            </tr>';

            
        $html.='</table>
        ';
        redirect(genPdf(false,true,$html),true);
    }