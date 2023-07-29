<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Generate Report</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
	    
	  <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
	  
	  <style>#loader{transition:all .3s ease-in-out;opacity:1;visibility:visible;position:fixed;height:100vh;width:100%;background:#fff;z-index:90000}#loader.fadeOut{opacity:0;visibility:hidden}.spinner{width:40px;height:40px;position:absolute;top:calc(50% - 20px);left:calc(50% - 20px);background-color:#333;border-radius:100%;-webkit-animation:sk-scaleout 1s infinite ease-in-out;animation:sk-scaleout 1s infinite ease-in-out}@-webkit-keyframes sk-scaleout{0%{-webkit-transform:scale(0)}100%{-webkit-transform:scale(1);opacity:0}}@keyframes sk-scaleout{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}</style>
	  	<style>
				table {
  				font-family: arial, sans-serif;
  				border-collapse: collapse;
  				width: 100%;
				}
				td, th {
  				border: 1px solid #dddddd;
  				text-align: left;
  				padding: 8px;
				}
				tr:nth-child(even) {
  				background-color: #dddddd;
				}
        h2,h4 {
          width:100%;
          text-align:center;
        }
			</style>
	</head>
	<body class="skin-josh" >
  	<div id="loader">
    	<div class="spinner"></div>
   	</div>
    <script>
    	window.addEventListener('load', () => {
      	const loader = document.getElementById('loader');
        setTimeout(() => {
        	loader.classList.add('fadeOut');
        }, 300);
      });
    </script>
    <div class="wrapper row-offcanvas row-offcanvas-left">
			<aside class="right-side">
        <section class="content-header">
          <h2>Order Details Report</h2>
          
          <ol class="breadcrumb">
          </ol>
        </section>
        <section class="content paddingleft_right15">
        	<div class="row">
        		<div class="panel panel-primary ">
            	<div class="panel-heading">
                <h4 class="panel_title">
                  <?php if ($isDateEnter == 'YES') {
                    echo 'From '.date('d-m-Y', strtotime($start_date));
                    echo ' to '.date('d-m-Y', strtotime($end_date));}
                  ?>
                </h4>
              	<h4 class="panel-title">
                	As On <?php echo date('d-m-Y',strtotime(now())); ?>
              	</h4>
              </div>
              <br />
              <div class="panel-body">
              	<?php if(count($tblOrder) > 0) {?>
              		<table class="table table-hover">
                		<thead>
                			<tr>
                        <?php $sno = 1; ?>
                				<?php if($is_group == 0) {?>
                          <th>Sr.No.</th>
                          <th>Order ID</th>
                          <th>Brand</th>
                          <th>Model</th>
                          <th>Country</th>
                          <th>Network</th>
                          <th>Amount</th>
                          <th>Date</th>
           							<?php } else { ?>
           								<th>Brand</th>
           								<th>Model</th>
           								<th>Country</th>
           								<th>Network</th>
           								<th>Total Qty</th>
           								<th>Total Paid</th>
                          <th>Total Refund</th>
           							<?php } ?>
           						</tr>
                  	</thead>
                  	<tbody>
                      <?php $tQty=0;$tPaid=0;$tRefund=0;?>
                  		<?php foreach($tblOrder as $tOrd) { ?>
                  			<tr>
                    			<?php if($is_group == 0) {?>
                    				<td><?php echo $sno; $sno++;?></td>
                            <td><?php echo $tOrd->order_id;  ?></td>
                    				<td><?php echo $tOrd->manu_name; ?></td>
                            <td><?php echo $tOrd->model_num; ?></td>
                            <td><?php echo $tOrd->country_name; ?></td>
                            <td><?php echo $tOrd->network_name; ?></td>
                            <td><?php if(isset($tOrd->paid_amount)) {
                                echo $tOrd->paid_amount;
                                $tPaid += $tOrd->paid_amount;
                              }
                              else
                              {
                                echo '0';
                              }?>
                            </td>
                            <?php if(isset($tOrd->insert_time) && !empty($tOrd->insert_time)) { ?>
                    					<td><?php echo date('d-m-Y',strtotime($tOrd->insert_time)); ?></td>
                    				<?php } else { ?>
                    					<td> - </td>
                    				<?php } ?>
                    			<?php } else { ?>
           									<td><?php echo $tOrd->manu_name; ?></td>
           									<td><?php echo $tOrd->model_num; ?></td>
           									<td><?php echo $tOrd->country_name; ?></td>
           									<td><?php echo $tOrd->network_name; ?></td>
           									<?php if (isset($tOrd->qty)) { $tQty += $tOrd->qty; ?>
           										<td><?php echo $tOrd->qty; ?></td>
           									<?php } ?>
           									<?php if (isset($tOrd->paid)) { $tPaid += $tOrd->paid;?>
           										<td><?php echo $tOrd->paid; ?></td>
           									<?php } else { ?>
                              <td> 0 </td>
                            <?php } ?>
                            <?php if (isset($tOrd->refund)) { $tRefund += $tOrd->refund; ?>
                              <td><?php echo $tOrd->refund; ?></td>
                            <?php } else { ?>
                              <td> 0 </td>
                            <?php } ?>
           								<?php } ?>
                    		</tr>
                    	<?php } ?>
                      <tr>
                        <?php if($is_group == 0) {?>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th>Total</th>
                          <th><?php echo $tPaid;?></th>
                          <th></th>
                        <?php } else { ?>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th>Total</th>
                          <th><?php echo $tQty;?></th>
                          <th><?php echo $tPaid;?></th>
                          <th><?php echo $tRefund;?></th>
                        <?php } ?>
                      </tr>
                    </tbody>

                	</table>
                <?php } else { ?>
                	<p> Sorry Data is not avaliable </p>
                <?php } ?>
              </div>
            </div>
          </div>
       	</section>
    	</aside>
		</div>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
    	<i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
   	</a>

   	<script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
  </body>
</html>
