<?php //$res = ['status'=>1, 'message'=>'my message']; ?>
<div id="dialog" class="offset-1 col-10 offset-md-4 col-md-4 p-3 rounded shadow-lg bg-light">
	<?php
		if (isset($res) && $res['status'] == 0) {
			$res['title'] = "Error message";
		}
		else if(isset($res) && $res['status'] == 1){
			$res['title'] = "Information message";
		}
	?>
	<h3 id="dialogHead"><?php if(isset($res['title'])){echo $res['title'];} ?></h3>
	<p id="dialogMessage"><?php if(isset($res['message'])){echo $res['message'];} ?></p>
	<button class="btn btn-primary" onclick="dismissMessage();">Close</button>
</div>