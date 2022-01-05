
			function show(id, elem){
				tabs = document.getElementsByClassName("tab");
				headings = document.getElementsByClassName("tabHeading");
				for(var i =0; i<headings.length; i++){
					headings[i].children[0].classList.remove("active");
				}
				elem.children[0].classList.add("active");

				for(var i=0; i<tabs.length; i++){
					if (tabs[i].id == id) {
						tabs[i].classList.remove("d-none");
					}else{
						tabs[i].classList.add("d-none");
					}
				}
			}
			//alert("here")

			function dismissMessage(){
				var dialog = document.getElementById("dialog")
				dialog.style.top = "-50%";
                dialog.style.opacity = "0";
			}

			function showMessage(){
				//alert("here");
				var supportPageOffset = window.pageXOffset !== undefined;
                var isCSS1Compat = ((document.compatMode || "") === "CSS1Compat");
                var top = supportPageOffset ? window.pageYOffset : isCSS1Compat ? document.documentElement.scrollTop : document.body.scrollTop;
                var dialog = document.getElementById("dialog")

                dialog.style.top = top+"px";
                dialog.style.opacity = 1;
			}