<?php
include("simple_html_dom.php");
if(isset($_POST['textAreaLink'])){
    $html = file_get_html($_POST['textAreaLink']);
    $gambar = $html->find(".photo__item img", 0)->src;
    echo "<p class='linkGambar' hidden>".$html->find(".photo__item img", 0)->src."</p>";
    $judul = $html->find(".read h1", 0)->plaintext;
    $media = 'Bolasport.com';

    $isiBerita = $html->find(".read__right", 0)->plaintext;
    
    $simpleCaption = preg_split('(\n)',$isiBerita)[0];
    

    // $abc = preg_split('(\n)',$isiBerita);

    // $akhir = preg_split('(\n)',$isiBerita)[count(preg_split('(\n)',$isiBerita))-3];
    // count(preg_split('(\n)',$isiBerita))-3

    
    $fullCaption='';
    // for ($i=0;$i<(count(preg_split('(\n)', $isiBerita))-3);$i++) {
    //         $fullCaption .= preg_split('(\n)',$isiBerita)[$i].PHP_EOL;
    // }
    
    $isiBeritaSplit = preg_split('(\n)',$isiBerita);
    // print_r($coba);
    for ($i=0;$i<(count(preg_split('(\n)', $isiBerita))-3);$i++) {
            // print_r(preg_split('(\n)', $isiBerita)[$i]);
            // $n = $i;
            if (isset(preg_grep ('/(?:^|\W)Baca Juga(?:$|\W)/', $isiBeritaSplit)[$i])) {
                        // unset($coba[$i]);
                        $isiBeritaSplit[$i]='';
                        // echo $i.'--works-- ';
            }
            // $fullCaption .= preg_split('(\n)',$isiBerita)[$i].PHP_EOL;
            $fullCaption .= $isiBeritaSplit[$i].PHP_EOL;
    }

    // print_r(preg_grep ('/(?:^|\W)Baca Juga(?:$|\W)/', $coba));
    // echo '<br/>----------<br/>';
    // print_r(preg_split('(\n)',$isiBerita));
    // echo 'ga works';

    // print_r($coba);
    // print_r($fullCaption);

    
    // for($i = 0; $i<count($coba);$i++){
	
    //     if (preg_grep ('/^baca juga (\w+)/i', $coba)[$i]) {
    //         unset($coba[$i]);
    //         echo '--works--';
    //     }
    //    echo "asd-- ";
    // }

    // print_r($coba);
        
    echo "<div class='simpleCaption' hidden>".$simpleCaption."</div>";
    echo "<div class='fullCaption' hidden>".$fullCaption."</div>";
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
    <div class="justify-content-center d-flex mb-5 mt-2">
    <div class="col-lg-5 col-11 ">
        <!-- <p class="nilai">nilai</p> -->
        <label for="customRange1" class="form-label">Geser Text</label>
        <input type="range" id="customRange1" min="0" max="32" class="form-range textRange pb-3" width="auto" >
        <label for="customRange2" class="form-label">Geser Gambar</label>
        <input type="range" id="customRange2" min="0" max="10" class="form-range range pb-3" width="auto" >
        <input type="file" class="file-input" accept="image/*" hidden>
        <div class="d-flex justify-content-between mt-4">
            <div>
                <button class="btn btn-primary btn-sm choose-img">Choose</button>
                <button class="btn btn-outline-primary btn-sm resetBtn">Reset</button>
                <button class="btn btn-outline-primary btn-sm extBtn">Ext.</button>
            </div>
            <div>
                <button class="btn btn-primary btn-sm downloadIniBtn">Download</button>
            </div>
        </div>
    </div>
    </div>

    <div class="justify-content-center d-flex mb-5">
    <div class="col-lg-5 col-12 ">
        <form action="" method="post">
        <div class="form-floating">
        <textarea class="form-control textAreaLink" name="textAreaLink"required></textarea>
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

    <div class="justify-content-center d-flex mb-5">
    <div class="col-lg-5 col-12 ">
        <!-- <form action="" method="post"> -->
        <div class="form-floating">
        <textarea class="form-control textAreaCaption" style="height:230px"><?php echo isset($simpleCaption) ? $simpleCaption : ''; ?></textarea>
        <label for="floatingTextarea">Caption</label>
        <div class="d-flex justify-content-between mt-2">
            <div>                
                <button class=" btn btn-sm btn-outline-primary copyBtn " >Copy Caption</button>
            </div>
            <div>
                <button class=" btn btn-sm btn-outline-primary simpleCaptionBtn" >Simple Caption</button>
                <button class=" btn btn-sm btn-outline-primary fullCaptionBtn" >Full Caption</button>
            </div>
            <!-- <button class="col-4 btn btn-sm btn-primary linkBtn">Kirim</button> -->
        </div>
        </div>
        <!-- </form> -->
    </div>
    </div>

</div>
</div>
    
    <script src="script.js"></script>
</body>
</html>