<?php 
    $title="กรอกใบเบิก";
    load_fun('TinyDB');
    $sOrg=selectTb('sub_orgdata','id,sub_org_name');
    $s=selectTb('userdata','user_id,title,name,surname');
    $fulName=current_user('title').current_user('name').' '.current_user('surname');
    $unitData=selectTb('unit_data','unit_name');
    $reason=selectTb('req_reason','id,reason');
?>
<script src="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',true); ?>"></script>
<form method="POST" action="<?php print site_url('main/teacher/fillReq/check'); ?>">
    <div class="col-md-6">
        <div class="form-group">
            <label>ภาควิชา</label>
            <select class="form-control select2" style="width: 100%;" name="dept">
                <?php
                    foreach($sOrg as $k){
                        // print $k;
                        print("<option value='".$k['id']."'>".$k['sub_org_name']."</option>");
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>ใช้ในงาน</label>
            <select class="form-control select2" style="width: 100%;" name="usefor">
                <?php
                    foreach($reason as $r){
                        print("<option value='".$r['id']."'>".$r['reason']."</option>");
                    }
                ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>ต้องการใช้ภายในวันที่</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
            <input type="text" class="form-control pull-right" id="datepicker" name="requireDate" autocomplete="off" value="<?php print date('Y-m-d')?>">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>ผู้รับพัสดุ</label>
            <select class="form-control select2" style="width: 100%;" name="receiver">
                <?php
                    foreach($s as $r){
                        if(strtolower($r['name'])=='administrator')continue;
                        // $isSelected=$i==1?'selected':'';
                        if($r['title'].$r['name'].' '.$r['surname']==$fulName)$isSelected='selected';
                        else $isSelected='';
                        print "<option value='".$r['user_id']."' $isSelected>".$r['title'].$r['name'].' '.$r['surname']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="fillReq">
                    <tr>
                        <th width='35%' style="vertical-align : middle; text-align:center" rowspan='2'>รายการ</th>
                        <th style="text-align:center" colspan='3'>จำนวน</th>
                        <th width='auto' style="vertical-align : middle; text-align:center" rowspan='2'>หน่วยนับ</th>
                        <th style="text-align:center" colspan='3'>ส่วนของงานพัสดุ</th>
                        <th style="vertical-align : middle; text-align:center" rowspan='2'>หมายเหตุ</th>
                        <th>
                    </tr>
                    <tr>
                        <td style="text-align:center">เบิก</td>
                        <td style="text-align:center">จ่าย</td>
                        <td style="text-align:center">ค้างจ่าย</td>
                        <td style="text-align:center">รหัสพัสดุ</td>
                        <td style="text-align:center">ต้นทุน/หน่วย</td>
                        <td style="text-align:center">จำนวนเงิน</td>
                        
                        
                        <!-- <td><span class="label label-success">Approved</span></td>
                        <td><input type="text" name="Monday2" size="3" maxlength="4" value="" onkeypress="return inputLimiter(event,'Numbers')"> <input type="checkbox" tabindex="-1" name="Stime2">Sick?<input type="checkbox" tabindex="-1" name="Vac2">Vacation?</td> -->
                    </tr>
                    <?php for($i=0;$i<5;$i++){ ?>
                    <tr>
                        <!-- <input type="hidden" name="vat_<?php print $i;?>"> -->
                        <td><input type="text" name="listName[]" id="listName_<?php print $i;?>" style="width:100%; text-align: left;"></td>
                        <td><input type="text" name="request[]" id="request_<?php print $i;?>" class="value" style="width:100%; text-align: right;"></td>
                        <td><input type="text" name="dispense[]" id="dispense_<?php print $i;?>" class="disvalue" style="width:100%; text-align: right;" readonly></td>
                        <td><input type="text" name="remain[]" id="remain_<?php print $i;?>" class="disvalue" style="width:100%; text-align: right;" readonly></td>
                        <td><select class="form-control select2" style="width: auto;" name="unit[]">
                            <?php
                                $j=0;
                                foreach($unitData as $r){
                                    $j++;
                                    print "<option value='$j'>".$r['unit_name']."</option>";
                                }
                            ?>
                            </select>
                        </td>
                        <td><input type="text" name="material_id[]" id="material_id_<?php print $i;?>" style="width:100%; text-align: right;"></td>
                        <!-- <td><input type="text" name="cost_<?php print $i;?>" id="test" style="width:100%" onkeypress="this.style.width = ((this.value.length + 4) * 8) + 'px';"></td>
                        <td><input type="text" name="amount_<?php print $i;?>" id="test" style="width:100%" onkeypress="this.style.width = ((this.value.length + 4) * 8) + 'px';"></td> -->
                        <td><input type="text" name="cost[]" id="cost_<?php print $i;?>" class="money" style="width:100%; text-align: right;"></td>
                        <td><input type="text" name="amount[]" id="amount_<?php print $i;?>" class="money" style="width:100%; text-align: right;" readonly></td>
                        <td><input type="text" name="note[]" style="width:100%; text-align: right;"></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td style="text-align: right;"><label>ส่วนลด</label></td>
                        <td colspan="4"><input type="text" name="textDiscount" id="textDiscount" style="width:100%; text-align: left;" readonly></td>
                        <td colspan="3"><input type="text" name="discount" id="discount" class="money" style="width:100%; text-align: right;"></td>
                        <td><input type="text" style="width:100%; text-align: right;" readonly></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label>รวมราคา</label></td>
                        <td colspan='4'><input type="text" name="textBeforeTaxAmount" id="textBeforeTaxAmount" style="width:100%; text-align: left;" readonly></td>
                        <td colspan="3"><input type="text" name="beforeTaxAmount" id="beforeTaxAmount" class="money" style="width:100%; text-align: right;" readonly></td>
                        <td><input type="text" style="width:100%; text-align: right;" readonly></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label>ภาษีมูลค่าเพิ่ม 7%</label></td>
                        <td colspan="4"><input type="text" name="textTaxAmount" id="textTaxAmount" style="width:100%; text-align: left;" readonly></td>
                        <td colspan="3"><input type="text" name="taxAmount" id="taxAmount" class="money" style="width:100%; text-align: right;" readonly></td>
                        <td><input type="text" style="width:100%; text-align: right;" readonly></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label>รวม</label></td>
                        <td colspan="4"><input type="text" name="textSumAmount" id="textSumAmount" style="width:100%; text-align: left;" readonly></td>
                        <td colspan="3"><input type="text" name="sumAmount" id="sumAmount" class="money" style="width:100%; text-align: right;" readonly></td>
                        <td><input type="text" style="width:100%; text-align: right;" readonly></td>
                    </tr>
                </table>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
    </div>
</form>
<script src="<?php print site_url('system/library/js/thaibaht/thaibaht.js',true);?>" type="text/javascript" charset="utf-8"></script>
<script>

    $('input[class=money]').focusout(function(){
        if(this.value!=''){
        this.value=parseFloat(this.value.replace(/,/g, ""))
        .toFixed(2)
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });

    $('input[class=value]').focusout(function(){
        if(this.value!=''){
        this.value=parseFloat(this.value.replace(/,/g, ""))
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });

    <?php for($i=0;$i<5;$i++){ ?>
        // $('input[name=<?php print "amount_$i";?>').focusout(function(){
        //     if(this.value=='')this.value=0;
        // });
        // $('input[name='+amount+']').val(15);
        /************************* cost field *********************/
            $('input[id=<?php print "cost_$i" ;?>]').change(function(){
                $('input[id=<?php print "cost_$i" ;?>]').val(this.value);
                var request_val=$('input[id=<?php print "request_$i" ;?>]').val()==''?0:$('input[id=<?php print "request_$i" ;?>]').val().replace(/,/g, "");
                var dispense_val=$('input[id=<?php print "dispense_$i" ;?>]').val()==''?0:$('input[id=<?php print "dispense_$i" ;?>]').val().replace(/,/g, "");
                var remain_val=$('input[id=<?php print "remain_$i" ;?>]').val()==''?0:$('input[id=<?php print "remain_$i" ;?>]').val().replace(/,/g, "");
                var totalVal=   parseInt(request_val)+
                                parseInt(dispense_val)+
                                parseInt(remain_val);
                
                var totalAmount=parseFloat(this.value.replace(/,/g, ""))*parseFloat(totalVal);
                totalAmount=parseFloat(totalAmount).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $('input[id=<?php print "amount_$i" ;?>]').val(totalAmount);
                
                var sumAmount=0;
                <?php for($j=0;$j<5;$j++){ ?>
                    var textAmount=$('input[id=<?php print"amount_$j";?>').val()==''?0:$('input[id=<?php print"amount_$j";?>').val().replace(/,/g, "");
                    var amount=parseFloat(textAmount);
                    sumAmount+=amount;
                    // alert("sumAmount"+sumAmount);
                
                <?php } ?>
                
                var discount=$('input[id=discount]').val()==''?0:$('input[id=discount]').val().replace(/,/g, "");
                if(discount>0)$('input[id=textDiscount]').val(ArabicNumberToText(discount));
                else $('input[id=textDiscount]').val('');
                
                sumAmount-=parseFloat(discount);
                if(sumAmount>0)$('input[id=textSumAmount]').val(ArabicNumberToText(sumAmount));
                else $('input[id=textSumAmount]').val('');

                var beforeTaxAmount=((sumAmount*100)/107);
                if(beforeTaxAmount>0)$('input[id=textBeforeTaxAmount]').val(ArabicNumberToText(beforeTaxAmount));
                else $('input[id=textBeforeTaxAmount]').val('');
                
                var taxAmount=(sumAmount-beforeTaxAmount);
                if(taxAmount>0)$('input[id=textTaxAmount').val(ArabicNumberToText(taxAmount));
                else $('input[id=textTaxAmount').val('');
                
                sumAmount=sumAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=sumAmount]').val(sumAmount);
                
                taxAmount=taxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=taxAmount]').val(taxAmount);

                beforeTaxAmount=beforeTaxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=beforeTaxAmount]').val(beforeTaxAmount);
            })
            .focusout(function(){
                if(this.value=='')this.value=0;
            });

        
        

        /************************* request field *********************/
            $('input[id=<?php print "request_$i" ;?>]')
            .change(function(){
                $('input[id=<?php print "request_$i" ;?>]').val(this.value);
                var request_val=this.value;
                var dispense_val=$('input[id=<?php print "dispense_$i" ;?>]').val()==''?0:$('input[id=<?php print "dispense_$i" ;?>]').val().replace(/,/g, "");
                var remain_val=$('input[id=<?php print "remain_$i" ;?>]').val()==''?0:$('input[id=<?php print "remain_$i" ;?>]').val().replace(/,/g, "");
                var cost_val=$('input[id=<?php print "cost_$i";?>').val()==''?0:$('input[id=<?php print "cost_$i";?>').val().replace(/,/g, "");

                var totalVal=   parseFloat(request_val)+
                                parseFloat(dispense_val)+
                                parseFloat(remain_val);

                var totalAmount=parseFloat(cost_val)*parseFloat(totalVal);
                totalAmount=parseFloat(totalAmount).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=<?php print "amount_$i" ;?>]').val(totalAmount);

                var sumAmount=0;
                <?php for($j=0;$j<5;$j++){ ?>
                    var textAmount=$('input[id=<?php print"amount_$j";?>').val()==''?0:$('input[id=<?php print"amount_$j";?>').val().replace(/,/g, "");
                    var amount=parseFloat(textAmount);
                    sumAmount+=amount;
                    // alert("sumAmount"+sumAmount);
                
                <?php } ?>
                
                var discount=$('input[id=discount]').val()==''?0:$('input[id=discount]').val().replace(/,/g, "");
                if(discount>0)$('input[id=textDiscount]').val(ArabicNumberToText(discount));
                else $('input[id=textDiscount]').val('');
                
                sumAmount-=parseFloat(discount);
                if(sumAmount>0)$('input[id=textSumAmount]').val(ArabicNumberToText(sumAmount));
                else $('input[id=textSumAmount]').val('');

                var beforeTaxAmount=((sumAmount*100)/107);
                if(beforeTaxAmount>0)$('input[id=textBeforeTaxAmount]').val(ArabicNumberToText(beforeTaxAmount));
                else $('input[id=textBeforeTaxAmount]').val('');
                
                var taxAmount=(sumAmount-beforeTaxAmount);
                if(taxAmount>0)$('input[id=textTaxAmount').val(ArabicNumberToText(taxAmount));
                else $('input[id=textTaxAmount').val('');
                
                sumAmount=sumAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=sumAmount]').val(sumAmount);
                
                taxAmount=taxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=taxAmount]').val(taxAmount);

                beforeTaxAmount=beforeTaxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=beforeTaxAmount]').val(beforeTaxAmount);
            })
            .focusout(function(){
                if(this.value=='')this.value=0;
            })
            ;

        /************************* dispense field *********************/
            $('input[id=<?php print "dispense_$i" ;?>]')
            .change(function(){
                $('input[id=<?php print "dispense_$i" ;?>]').val(this.value);
                var request_val=$('input[id=<?php print "request_$i" ;?>]').val()==''?0:$('input[id=<?php print "request_$i" ;?>]').val().replace(/,/g, "");
                var dispense_val=this.value;
                var remain_val=$('input[id=<?php print "remain_$i" ;?>]').val()==''?0:$('input[id=<?php print "remain_$i" ;?>]').val().replace(/,/g, "");
                var cost_val=$('input[id=<?php print "cost_$i";?>').val()==''?0:$('input[id=<?php print "cost_$i";?>').val().replace(/,/g, "");
                
                var totalVal=   parseFloat(request_val)+
                                parseFloat(dispense_val)+
                                parseFloat(remain_val);
                
                var totalAmount=parseFloat(cost_val)*parseFloat(totalVal);
                totalAmount=parseFloat(totalAmount).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=<?php print "amount_$i" ;?>]').val(totalAmount);
                
                var sumAmount=0;
                <?php for($j=0;$j<5;$j++){ ?>
                    var textAmount=$('input[id=<?php print"amount_$j";?>').val()==''?0:$('input[id=<?php print"amount_$j";?>').val().replace(/,/g, "");
                    var amount=parseFloat(textAmount);
                    sumAmount+=amount;
                    // alert("sumAmount"+sumAmount);
                
                <?php } ?>
                
                var discount=$('input[id=discount]').val()==''?0:$('input[id=discount]').val().replace(/,/g, "");
                if(discount>0)$('input[id=textDiscount]').val(ArabicNumberToText(discount));
                else $('input[id=textDiscount]').val('');
                
                sumAmount-=parseFloat(discount);
                if(sumAmount>0)$('input[id=textSumAmount]').val(ArabicNumberToText(sumAmount));
                else $('input[id=textSumAmount]').val();

                var beforeTaxAmount=((sumAmount*100)/107);
                if(beforeTaxAmount>0)$('input[id=textBeforeTaxAmount]').val(ArabicNumberToText(beforeTaxAmount));
                else $('input[id=textBeforeTaxAmount]').val('');
                
                var taxAmount=(sumAmount-beforeTaxAmount);
                if(taxAmount>0)$('input[id=textTaxAmount').val(ArabicNumberToText(taxAmount));
                else $('input[id=textTaxAmount').val('');
                
                sumAmount=sumAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=sumAmount]').val(sumAmount);
                
                taxAmount=taxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=taxAmount]').val(taxAmount);

                beforeTaxAmount=beforeTaxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=beforeTaxAmount]').val(beforeTaxAmount);
            })
            // .focusout(function(){
            //     if(this.value=='')this.value=0;
            // })
            ;
        
        /************************* remain field *********************/
            $('input[id=<?php print "remain_$i" ;?>]')
            .change(function(){
                $('input[id=<?php print "remain_$i" ;?>]').val(this.value);
                var remain_val=this.value;
                var request_val=$('input[id=<?php print "request_$i" ;?>]').val()==''?0:$('input[id=<?php print "request_$i" ;?>]').val().replace(/,/g, "");
                var dispense_val=$('input[id=<?php print "dispense_$i" ;?>]').val()==''?0:$('input[id=<?php print "dispense_$i" ;?>]').val().replace(/,/g, "");
                var cost_val=$('input[id=<?php print "cost_$i";?>').val()==''?0:$('input[id=<?php print "cost_$i";?>').val().replace(/,/g, "");
                
                var totalVal=   parseFloat(request_val)+
                                parseFloat(dispense_val)+
                                parseFloat(remain_val);
                
                var totalAmount=parseFloat(cost_val)*parseFloat(totalVal);
                totalAmount=parseFloat(totalAmount).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=<?php print "amount_$i" ;?>]').val(totalAmount);

                var sumAmount=0;
                <?php for($j=0;$j<5;$j++){ ?>
                    var textAmount=$('input[id=<?php print"amount_$j";?>').val()==''?0:$('input[id=<?php print"amount_$j";?>').val().replace(/,/g, "");
                    var amount=parseFloat(textAmount);
                    sumAmount+=amount;
                    // alert("sumAmount"+sumAmount);
                
                <?php } ?>
                
                var discount=$('input[id=discount]').val()==''?0:$('input[id=discount]').val().replace(/,/g, "");
                if(discount>0)$('input[id=textDiscount]').val(ArabicNumberToText(discount));
                else $('input[id=textDiscount]').val('');
                
                sumAmount-=parseFloat(discount);
                if(sumAmount>0)$('input[id=textSumAmount]').val(ArabicNumberToText(sumAmount));
                else $('input[id=textSumAmount]').val('');

                var beforeTaxAmount=((sumAmount*100)/107);
                if(beforeTaxAmount>0)$('input[id=textBeforeTaxAmount]').val(ArabicNumberToText(beforeTaxAmount));
                else $('input[id=textBeforeTaxAmount]').val('');
                
                var taxAmount=(sumAmount-beforeTaxAmount);
                if(taxAmount>0)$('input[id=textTaxAmount').val(ArabicNumberToText(taxAmount));
                else $('input[id=textTaxAmount').val('');
                
                sumAmount=sumAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=sumAmount]').val(sumAmount);
                
                taxAmount=taxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=taxAmount]').val(taxAmount);

                beforeTaxAmount=beforeTaxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=beforeTaxAmount]').val(beforeTaxAmount);
            })
            // .focusout(function(){
            //     if(this.value=='')this.value=0;
            // })
            ;
    <?php } ?>
    /************************* discount field *********************/
        $('input[id=discount]').change(function(){
            var sumAmount=0;
            
            <?php for($j=0;$j<5;$j++){ ?>
                var textAmount=$('input[id=<?php print"amount_$j";?>').val()==''?0:$('input[id=<?php print"amount_$j";?>').val().replace(/,/g, "");
                var amount=parseFloat(textAmount);
                sumAmount+=amount;
            <?php } ?>
            
            var discount=$('input[id=discount]').val()==''?0:$('input[id=discount]').val().replace(/,/g, "");
                if(discount>0)$('input[id=textDiscount]').val(ArabicNumberToText(discount));
                else $('input[id=textDiscount]').val('');
                
                sumAmount-=parseFloat(discount);
                if(sumAmount>0)$('input[id=textSumAmount]').val(ArabicNumberToText(sumAmount));
                else $('input[id=textSumAmount]').val('');

                var beforeTaxAmount=((sumAmount*100)/107);
                if(beforeTaxAmount>0)$('input[id=textBeforeTaxAmount]').val(ArabicNumberToText(beforeTaxAmount));
                else $('input[id=textBeforeTaxAmount]').val('');
                
                var taxAmount=(sumAmount-beforeTaxAmount);
                if(taxAmount>0)$('input[id=textTaxAmount').val(ArabicNumberToText(taxAmount));
                else $('input[id=textTaxAmount').val('');
                
                sumAmount=sumAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=sumAmount]').val(sumAmount);
                
                taxAmount=taxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=taxAmount]').val(taxAmount);

                beforeTaxAmount=beforeTaxAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[id=beforeTaxAmount]').val(beforeTaxAmount);
        });
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    })
</script>
<!-- <script src="<?php print site_url('system/library/js/arrow/src/arrow-table.js',true);?>" type="text/javascript"></script>
<script src="<?php print site_url('system/library/js/arrow/dist/arrow-table.js',true);?>" type="text/javascript"></script> -->
<script src="<?php print site_url('system/library/js/arrow/dist/arrow-table.min.js',true);?>" type="text/javascript"></script>
<script>
    $("#fillReq").arrowTable({
        listenTarget:'input, select',
        focusTarget:'input, select',
    });
    // $("button").click(function(){
    //     // alert($("select[name=usefor]").val());
    //     $.post("<?php print site_url('main/teacher/fillReq/check'); ?>",
    //     {
    //       dept: "1",
    //       usefor : $("select[name=usefor]").val(),
    //       requireDate : $("input[name=]"),
    //     //   city: "Duckburg"
    //     },
    //     function(data,status){
    //         // alert(usefor);
    //         // alert(data+"\nStatus: " + status);
    //     });
    // });
    
</script>
