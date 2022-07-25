<?php

  if (isset($_POST['download']) ) {
    $imgUrl = $_POST['imgurl'];
    $ch = curl_init($imgUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $download=curl_exec($ch);

    curl_close($ch);
    header('Content-type: image/jpg');
    header('Content-Disposition: attachment; filename="Miniatura.jpg"');
    echo $download;
  }
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Descargar miniatura</title>
<link rel="stylesheet" href="estilos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <header>Descargar Miniaturas</header>
    <div class="url-input">
      <span class="title">Pega el URL:</span>
      <div class="field">
        <input type="text" placeholder="https://www.youtube.com/watch?v=FucPPCPDd2Y&list=PLpwngcHZlPaf1aw42OGyitm4jh2Dlmi9c&index=5" required>
        <input type="hidden"class="hidden-input"  name="imgurl" >
        <div class="bottom-line"></div>
      </div>
      
    </div>
    <div class="preview-area">
      <img class="miniatura"   src="" alt="">
      <i class="icon fas fa-cloud-download-alt"></i>
      <span>Pega el url del video</span>

    </div>
    <button class="download-btn" type="submit" name="download">Descargar</button>
  </form>

  <script>
    const urlField = document.querySelector(".field input"),
    previewArea = document.querySelector(".preview-area"),
    imgTag = previewArea.querySelector(".miniatura"),
    hiddenInput = document.querySelector(".hidden-input");

    
    urlField.onkeyup=()=>{
      let imgUrl = urlField.value;
      previewArea.classList.add("active");
     
      if (imgUrl.indexOf("https://www.youtube.com/watch?v=")!=-1 ) {
       
        let vidId=imgUrl.split("v=")[1].substring(0,11);
        let ytMiniUrl=`https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        imgTag.src=ytMiniUrl;

      }else if (imgUrl.indexOf("https://youtu.be/")!=-1) {
        
        let vidId=imgUrl.split("be/")[1].substring(0,11);
        let ytMiniUrl=`https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        imgTag.src=ytMiniUrl;

      }else if(imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)){
        imgTag.src = imgUrl;
      }else{
        imgTag.src="";
        previewArea.classList.remove("active");
      }

      hiddenInput.value=imgTag.src;
      
    }

  </script>
  
</body>
</html>