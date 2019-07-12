<?php
    require(INDEX_PATH.'apps/finance/pdf/genPdf.php');
    // print_r($hGET);
    $reportId=$hGET['id'];
?>
    <div class="btn-group">
                  <button type="button" class="btn btn-default">ใบเบิกวัสดุ (แบบ พ.43)</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php print genReport($reportId);?>">Download</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>

