<?php
load_fun('ui');
$appData=get_system_config("applications");
						$lsResult=json_decode($appData);
						if(count($lsResult)!=0){
?>
<div class="form-group">
              		<?php
                		//$appPath=BASE_PATH."apps/";
                		//$lsResult=array_slice(scandir($appPath), 2);
                		//print_r($lsResult);
						
                		foreach($lsResult as $row){
							//$URL=site_url("main/manage/academic/view/id/".$academy['academy_id']);
							if($row->config->type=="systemApp"){
								$color="bg-red";
							}else{
								$color="bg-blue";
							}
                        $data=array(
						
								"bgColor"=>"bg-gray",
                                "icon"=>"fa fa-puzzle-piece",
                                "color"=>$color,
                                "title"=>ucfirst($row->name),
                                "subTitle"=>$row->config->type,
                                
                                "url"=>$URL,
                                );
                                print genIcon($data);
                	?>
                  
             
                <?php
                		}						
                ?>
                </div>
				<?php
				}else{							
						print '<center>ไม่มีแอปปลิเคชั่นในระบบ</center>';	
						}
				//sleep(2);
				?>