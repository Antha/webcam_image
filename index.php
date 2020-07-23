<!DOCTYPE html>
<html>
<head>
	<title>Webcam</title>
	<script src="machine/html2canvas.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
	<div class="video-wrap" style="float:left" >
		<video id="video" playsinline autoplay></video>
		<div class="controller" > 
			<button id="snap">capture</button>
		</div>
	</div>

	<div id="">
		<canvas class="container-test" id="canvas" width="500" height="500" style="float:left"> </canvas>
	</div>

	<span id="ErrorMsg"></span>

	<script>
		'use strict';
		const video = document.getElementById('video');
		const canvas = document.getElementById('canvas');
		const snap = document.getElementById('snap');
		const errorMsgElement = document.getElementById('ErrorMsg');
		const constraints = {
			audio : true,
			video:{
				width:1280,height:720
			}
		}

		async function init(){
			try{
				const stream = await navigator.mediaDevices.getUserMedia(constraints);
				handleSuccess(stream);
			}catch(e){
				errorMsgElement.innerHtml = `navigator.getUserMedia.error:$(e.toString())`;
			}
		}

		function handleSuccess(stream){
			window.stream = stream;
			video.srcObject = stream;
		}

		init();

		var context = canvas.getContext('2d');
		snap.addEventListener("click",function(){
			context.drawImage(video,0,0,500,400);
			setTimeout(function(){ sti(); }, 2000);
		});

		function sti(){
		   saveToImage(".container-test","Webcam");
		}

		function saveToImage(divtable,fname){
			var div_content;
			var data;
		    //get the div content
		    div_content = document.querySelector(divtable);
		    //make it as html5 canvas
		    html2canvas(div_content).then(function(canvas) {
		        //change the canvas to jpeg image
		        data = canvas.toDataURL('image/jpeg');
		        //then call a super hero php to save the image
		        save_img(data,fname);
		    });
		}

		//to save the canvas image
		function save_img(imagemine,fname){
		    //ajax method.
		    $.post('machine/saveimage.php', {imagemine: imagemine,filename:fname},
		    function(res){
		        //if the file saved properly, trigger a popup to the user.
		        if(res != ''){
		            //alert(res);
		            //yes = confirm('File Disimpan Pada Folder ict/ci/public/capture, klik ok untuk melihat !');
		                //location.href = '<?php //echo base_url()?>'+'/public/capture/'+res+'.jpg';
		                // Fixes dual-screen position                         Most browsers      Firefox
		                // Fixes dual-screen position                         Most browsers      Firefox
		                var w = 900;
		                var h = 500;
		                var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
		                var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
		                var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		                var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
		                var left = ((width / 2) - (w / 2)) + dualScreenLeft;
		                var top = ((height / 2) - (h / 2)) + dualScreenTop;
		                //var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
		                /*window.open('sstest/machine/'+res+'.jpg','targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width='+w+',height='+h+',top='+top+',left='+left);*/
		                //window.open('<?php //echo base_url()?>/public/capture/Resume Branch Per 2017-02-09.xls.jpg','targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
		        }
		        else{
		            alert('something wrong');
		        }
		    }).always(function() {
		    	sendTele();
		  	});
		}

		function sendTele(){
		  $.ajax({
		      type:"POST",
		      data:{chatid:'350633638',img:"Webcam"},
		      url:"machine/sendtele.php",
		      success:function(data){
		      }
		  });
		}

	</script>
</body>
</html>