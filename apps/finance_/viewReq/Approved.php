<?php
    $title="Approved";
    $subtitle="ใบเบิกที่อนุมัติแล้ว";
    $listData=selectTb('req_material','*','isApprove="1"');
    $i=0;
    foreach($listData as $r=>$k){
      // print_r($k);
      $req_user_id=($k['req_user_id']);
      $n=selectTb('userdata','title,name,surname','user_id="'.$req_user_id.'"');
      $n=$n[0];
      $fullName=$n['title'].$n['name'].' '.$n['surname'];
      $box.='
      <div class="col-lg-4 col-xs-6">
      <div class="box box-default collapsed-box">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>'.number_format($k['total_cost'],2,'.',',').'</h3>
            <p>'.$fullName.'</p>
          </div>
          <div class="icon">
            <i class="fa fa-shopping-cart"></i>
          </div>
          <a href="" class="small-box-footer" data-widget="collapse">
            เพิ่มเติม <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
        <div class="box-body no-padding">
              <ul class="nav nav-stacked">
                <li><a target="_blank" rel="noopener noreferrer" href="'.site_url('ajax/finance/pdf/genPdf/t/1/id/'.$k['id']).'">บันทึกรายงานขอซื้อ/จ้าง (แบบ พจ.1)<span class="pull-right badge bg-blue"><span class="fa fa-download"></span></span></a></li>
                <li><a target="_blank" rel="noopener noreferrer" href="'.site_url('ajax/finance/pdf/genPdf/t/2/id/'.$k['id']).'">ใบเบิกวัสดุ (แบบ พ.43)<span class="pull-right badge bg-aqua"><span class="fa fa-download"></span></span></a></li>
                <li><a href="javascript:void(0)" name="markAsUnread'.$i.'">ทำเครื่องหมายว่ายังไม่ได้อนุมัติ<span class="pull-right badge bg-green">12</span></a></li>
                <input type="hidden" name="docId'.$i.'" value="'.$k['id'].'">
              </ul>
            </div>

      </div>
    </div>
      ';
      $i++;
    }
    print $box;
    ?>
    <script>
      <?php for($j=0;$j<$i;$j++){ ?>
        $("a[name='markAsUnread<?php print $j;?>']").on("click",function(){
            var id=$("input[name='docId<?php print $j;?>']").val();
            var url="<?php print site_url('ajax/finance/set/markAsUnread'); ?>";
            var posting = $.post( url, {docId:id});

            posting.done(function( data ) {
              showUpdate(data);

            });
        });
      <?php
      }
      ?>
      function showUpdate(txt){
        $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i><b>'
                  +txt+
                  '</b></div>').hide().slideDown();
                  $(function(){
                    setTimeout(function(){
                      $("#systemAlert").slideUp();
                      $(function(){
                        setTimeout(function(){
                          window.location.href="<?php print site_url('main/finance/viewReq/Approved');?>";
                        },1000);
                      });
                    },3000);
                  });
        }
    </script>