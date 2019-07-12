<?php 
  $acc=substr(current_user("accession"),1,-1);
  $acc=explode(',',$acc);
  for($i=0;$i<count($acc);$i++)
    $acc[$i]=substr($acc[$i],1,-1);
  // print_r($acc);
  if(!in_array("teacher",$acc))redirect('');
  $fulName=current_user('title').current_user('name').' '.current_user('surname');
  $s=selectTb('userdata','title,name,surname');
  // print_r($s);
?>
<form role="form">
                <!-- text input -->
                <div class="form-group">
                  <label>ชื่อผู้โอน</label>
                  <input type="text" class="form-control" value="<?php print $fulName?>" disable>
                </div>
                <div class="form-group">
                  <label>ผู้รับเงิน</label>
                  <select class="form-control">
                    <?php 
                      foreach($s as $r){
                        if(strtolower($r['name'])=='administrator'||$r['title'].$r['name'].' '.$r['surname']==$fulName)continue;
                        print "<option>".$r['title'].$r['name'].' '.$r['surname']."</option>";
                      }
                    ?>
                    <!-- <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option> -->
                  </select>
                </div>
                <div class="input-group">
                    <!-- <label>จำนวนเงิน</label><br> -->
                    <span class="input-group-addon">จำนวนเงิน</span>
                    <input type="text" class="form-control">
                    <span class="input-group-addon">บาท</span>
                </div>
                <div class="form-group">
                    <label>หมายเหตุเพิ่มเติม</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                    <!-- <div class="box-footer"> -->
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
              <!-- </div> -->
            </form>
<?php    
    $title="โอนเงิน";
    $subtitle="Transfer Money";