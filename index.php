<?php
include("simple_html_dom.php");
if(isset($_POST['isiTextArea'])){
    $html = file_get_html($_POST['isiTextArea']);
    echo "<p class='ambilIni' hidden>".$html->find(".photo__item img", 0)->src."</p>";
    $gambar = $html->find(".photo__item img", 0)->src;
    $judul = $html->find(".read h1", 0)->plaintext;
    $media = 'Bolasport.com';
}
?>

<html>
<head>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
<div class="container ">
<div class="row mt-5">
    <!-- GAMBAR YANG AKAN DICETAK -------------------- -->
    <div class="justify-content-center d-flex col-12">
        <div class="preview-div" id="capture" style="width:375px; height: 500px">
            <div class='textGambar' style="transform: translate(0px, 0px);">
                <h4 style="transform: translate(10px, 10px);
                        background-color: #ffffff;
                        z-index: 2;
                        padding: 15px;
                        text-transform: uppercase;
                        position: absolute;">folkative 
                </h4>
                <h6 style="transform: translate(10px, 50px);
                        background-color: #ffffff;
                        z-index: 2;
                        font-weight: 400;
                        width : 275px;
                        padding: 15px;
                        text-transform: uppercase;
                        position: absolute;"><?php echo isset($judul) ? $judul : ''; ?> 
                </h6>
            </div>
            <div class="preview-bg"
                style="height: 100%;
                width: 100%;
                background: url('<?php echo isset($gambar) ? $gambar : 'sample.png'; ?>');
                background-size: cover;
                background-position-x: center;
                background-repeat: no-repeat;">
            </div>
        </div>
    </div>
    
    <!-- TOMBOL TOMBOL -------------------- -->
    <div class="justify-content-center d-flex mb-5">
    <div class="col-lg-5 col-11 ">
        <p class="nilai">nilai</p>
        <input type="range" min="0" max="31" class="form-range textRange pb-3" width="auto" >
        <input type="range" min="0" max="10" class="form-range range pb-3" width="auto" >
        <input type="file" class="file-input" accept="image/*" hidden>
        <div class="d-flex justify-content-between mt-4">
            <div>
                <button class="btn btn-primary btn-sm choose-img">Choose Img</button>
                <button class="btn btn-outline-primary btn-sm resetBtn">Reset Img</button>
            </div>
            <div>
                <button class="btn btn-primary btn-sm downloadIniBtn">Download ini</button>
            </div>
        </div>
    </div>
    </div>

    <div class="justify-content-center d-flex mb-5">
    <div class="col-lg-5 col-12 ">
        <form action="" method="post">
        <div class="form-floating">
        <textarea class="form-control" name="isiTextArea"></textarea>
        <label for="floatingTextarea">Link</label>
        <div class="d-flex justify-content-end mt-2">
            <input type="button" class="col-2 btn btn-sm btn-outline-primary clearBtn mx-1" value="clear">
            <button class="col-4 btn btn-sm btn-primary linkBtn" type="submit">Kirim</button>
            <!-- <button class="col-4 btn btn-sm btn-primary testBtn">test</button> -->
        </div>
        </div>
        </form>
    </div>
    </div>

</div>
</div>
    
    <script src="script.js"></script>
</body>
</html>