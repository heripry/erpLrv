            <?php 
			         echo "<option value=0>-Pilih-</option>";
			     $no=1; foreach($data as $list) 
					 { 
					  echo "<option value='".$list['City']."'>".$list['City']."</option>";
					 } 
			?>