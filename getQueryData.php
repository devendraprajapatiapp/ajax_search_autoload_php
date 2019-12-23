<?php
	$conn = new mysqli('localhost','root','','testdata');
	if($conn->connect_error) {
		die();
	}
	if(isset($_POST['type']) && isset($_POST['count'])) {
		$data = $_POST['search'];

		if($_POST['type'] == "Search") {
			$a = [];		
			array_push($a,15);
			$sql = "SELECT * FROM `finance` WHERE `segment` like '%".$data."%' OR `country` like '%".$data."%' OR `product` like '%".$data."%' OR `discount_band` like '%".$data."%' OR `units_sold` like '%".$data."%' OR `manufacturing_price` like '%".$data."%' OR `sale_price` like '%".$data."%' OR `gross_sales` like '%".$data."%' OR `discounts` like '%".$data."%' OR `sales` like '%".$data."%' OR `cogs` like '%".$data."%' OR `profit` like '%".$data."%' OR `date` like '%".$data."%' OR `month` like '%".$data."%' OR `month_name` like '%".$data."%' OR `year` like '%".$data."%' LIMIT 15 OFFSET 0";

			$result = $conn->query($sql);
			$html = '';
			if(isset($result->num_rows)) {
				if($result->num_rows > 0) {
					$cnt = 1;
					while ($row = $result->fetch_assoc()) {
						$html .= "<tr>
									<td>".$cnt."</td>
									<td>".$row['segment']."</td>
									<td>".$row['country']."</td>
									<td>".$row['product']."</td>
									<td>".$row['discount_band']."</td>
									<td>".$row['units_sold']."</td>
									<td>".$row['manufacturing_price']."</td>
									<td>".$row['gross_sales']."</td>
									<td>".$row['discounts']."</td>
									<td>".$row['sales']."</td>
									<td>".$row['cogs']."</td>
									<td>".$row['profit']."</td>
									<td>".$row['date']."</td>
									<td>".$row['month']."</td>
									<td>".$row['month_name']."</td>
									<td>".$row['year']."</td>
								</tr>";
						$cnt = $cnt + 1;
					}
				}	
			}
			array_push($a,$html);
			echo json_encode($a);

		} elseif($_POST['type'] == "loadMore") {
			$a = [];
			$start = $_POST['count'];
			$sqlCount = "SELECT * FROM `finance` WHERE `segment` like '%".$data."%' OR `country` like '%".$data."%' OR `product` like '%".$data."%' OR `discount_band` like '%".$data."%' OR `units_sold` like '%".$data."%' OR `manufacturing_price` like '%".$data."%' OR `sale_price` like '%".$data."%' OR `gross_sales` like '%".$data."%' OR `discounts` like '%".$data."%' OR `sales` like '%".$data."%' OR `cogs` like '%".$data."%' OR `profit` like '%".$data."%' OR `date` like '%".$data."%' OR `month` like '%".$data."%' OR `month_name` like '%".$data."%' OR `year` like '%".$data."%' LIMIT 5 OFFSET ".$start;
			$result = $conn->query($sqlCount);
			if(isset($result->num_rows)) {
				if($result->num_rows > 0) {
					array_push($a,$start+5);
					$sql = "SELECT * FROM `finance` WHERE `segment` like '%".$data."%' OR `country` like '%".$data."%' OR `product` like '%".$data."%' OR `discount_band` like '%".$data."%' OR `units_sold` like '%".$data."%' OR `manufacturing_price` like '%".$data."%' OR `sale_price` like '%".$data."%' OR `gross_sales` like '%".$data."%' OR `discounts` like '%".$data."%' OR `sales` like '%".$data."%' OR `cogs` like '%".$data."%' OR `profit` like '%".$data."%' OR `date` like '%".$data."%' OR `month` like '%".$data."%' OR `month_name` like '%".$data."%' OR `year` like '%".$data."%' LIMIT 5 OFFSET ".$start;

					$result = $conn->query($sql);
					$html = '';
					if(isset($result->num_rows)) {
						if($result->num_rows > 0) {
							$cnt = $start + 1;
							while ($row = $result->fetch_assoc()) {
								$html .= "<tr>
											<td>".$cnt."</td>
											<td>".$row['segment']."</td>
											<td>".$row['country']."</td>
											<td>".$row['product']."</td>
											<td>".$row['discount_band']."</td>
											<td>".$row['units_sold']."</td>
											<td>".$row['manufacturing_price']."</td>
											<td>".$row['gross_sales']."</td>
											<td>".$row['discounts']."</td>
											<td>".$row['sales']."</td>
											<td>".$row['cogs']."</td>
											<td>".$row['profit']."</td>
											<td>".$row['date']."</td>
											<td>".$row['month']."</td>
											<td>".$row['month_name']."</td>
											<td>".$row['year']."</td>
										</tr>";
								$cnt = $cnt + 1;
							}
						}	
					}
					array_push($a,$html);
					echo json_encode($a);
				} else {
					exit();
				}
			}			
		}

	}
	
	//echo $_POST['search'];
	//echo "<tr class='tm-text-left'><td>".$_POST['search']."</td><td></td><td></td><td></td></tr>";
//	echo "<tr class='tm-text-left'><td>".date('d-m-Y H:i:s')."</td><td></td><td></td><td></td></tr>";
