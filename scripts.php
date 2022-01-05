        
		<?php

            if($_SERVER["REMOTE_ADDR"]=="127.0.0.1"){
                $add = "http://localhost/athealth-software-application/";
            }else{
                $add = "https://athealth-project.herokuapp.com/";
            }
        ?>
		<script type="text/javascript" src="<?php echo $add; ?>js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="<?php echo $add; ?>js/popper.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="js/Chart.js"></script>
        <script type="text/javascript" src="js/script.js"></script>

        <?php 
			if(isset($res)){//print_r($res);
				echo "<script type='text/javascript'>showMessage(); </script>";
			} 
		?>

        <script type="text/javascript">
            function showMenu(){
				var menu = document.getElementById("menu");
				var main = document.getElementById("main");

				menu.style.left = 0;
				// menu.classList.remove("d-none");
				// menu.classList.add("d-inline-block");
				// menu.classList.add("col-4");

				// main.classList.remove("col-12")
				// main.classList.add("col-8");
			}

			function dismissMenu(){//alert("here")
				document.getElementById("menu").style.left = "-80%"
			}
        </script>