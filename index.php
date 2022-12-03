<?php
include("simple_html_dom.php");
if(isset($_POST['textAreaLink'])){
    $html = file_get_html($_POST['textAreaLink']);
    
    if($_POST['textAreaLink']){
        $array = explode('www', $_POST['textAreaLink']);

        //---------------------- CODINGAN DARI LINK BOLASPORT ---------------------------------
        if(preg_grep ('/(?:^|\W)bolasport(?:$|\W)/', $array)){
            $media = 'Bolasport.com';
            $judul = $html->find(".read h1", 0)->plaintext; // text judul utk di gambar
            $gambar = $html->find(".photo__item img", 0)->src;
        
            $isiBerita = $html->find(".read__right", 0)->plaintext; // variable utama utk diolah

            $simpleCaption = preg_split('(\n)',$isiBerita)[0]; //utk simple caption di textarea
            $fullCaption=''; //utk full caption di textarea
            $isiBeritaSplit = preg_split('(\n)',$isiBerita);
        
            for ($i=0;$i<(count(preg_split('(\n)', $isiBerita))-3);$i++) {
        
                if (isset(preg_grep ('/(?:^|\W)Baca Juga(?:$|\W)/', $isiBeritaSplit)[$i])) {
                    $isiBeritaSplit[$i]='';
                }else if (isset(preg_grep ('/(?:^|\W)Baca juga(?:$|\W)/', $isiBeritaSplit)[$i])) {
                    $isiBeritaSplit[$i]='';
                }
                $fullCaption .= $isiBeritaSplit[$i].PHP_EOL;
            }
            echo "<p class='linkGambar' hidden>".$html->find(".photo__item img", 0)->src."</p>";
        }
        //---------------------- END CODINGAN DARI LINK BOLASPORT ---------------------------------
        //---------------------- CODINGAN DARI LINK BOLA KOMPAS ---------------------------------
        if(preg_grep ('/(?:^|\W)kompas(?:$|\W)/', $array)){
            $media = 'bola.kompas.com';
            $judul = $html->find(".read__title", 0)->plaintext; // text judul utk di gambar
            $gambar = $html->find(".photo__wrap img", 0)->src;
        
            $isiBerita = $html->find(".read__content .clearfix", 0)->plaintext; // variable utama utk diolah

            $simpleCaption = preg_split('(\n)',$isiBerita)[0]; //utk simple caption di textarea
            $fullCaption=''; //utk full caption di textarea
            $isiBeritaSplit = preg_split('(\n)',$isiBerita);
        
            for ($i=0;$i<(count(preg_split('(\n)', $isiBerita))-3);$i++) {
        
                    if (isset(preg_grep ('/(?:^|\W)Baca Juga(?:$|\W)/', $isiBeritaSplit)[$i])) {
                                $isiBeritaSplit[$i]='';
                    }else if (isset(preg_grep ('/(?:^|\W)Baca juga(?:$|\W)/', $isiBeritaSplit)[$i])) {
                        $isiBeritaSplit[$i]='';
                    }
                    $fullCaption .= $isiBeritaSplit[$i].PHP_EOL;
            }   
            echo "<p class='linkGambar' hidden>".$html->find(".photo__wrap img", 0)->src."</p>";
        }
        //---------------------- END CODINGAN DARI LINK BOLA KOMPAS ---------------------------------
        $hashtagnya = "\n\nsrc {$media}\n__\n#hashtag1 #hashtag2 #hashtag3";
        echo "<div class='simpleCaption' hidden>".$simpleCaption.$hashtagnya."</div>";
        echo "<div class='fullCaption' hidden>".$fullCaption.$hashtagnya."</div>";
    }
}
?>

<html>
<head>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/08bcd19637.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="container">
<div class="row mt-5 justify-content-center">
    <!-- -------------------------- GAMBAR YANG AKAN DICETAK -------------------------- -->
    <div class="col-lg-5">
    <div class="justify-content-center d-flex col-12 mb-3">
        <div class="preview-div" id="capture" style="width:375px; height: 500px; overflow: hidden;">
            <div class='textGambar' style="transform: translate(0px, 0px);position: absolute;z-index: 5;">
                <h4 style="transform: translate(10px, 10px);
                        background-color: #ffffff;
                        padding: 15px;
                        text-transform: uppercase;
                        position: absolute;">folkative 
                </h4>
                <h6 class="textJudul" style="transform: translate(10px, 50px);
                        background-color: #ffffff;
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
    </div>

    <!-- -------------------------- TOMBOL TOMBOL -------------------------- -->
    <div class="col-lg-5">
    <div class="justify-content-center d-flex mb-3">
        <div class="col-lg-11 col-11 ">
        <!-- <div class="col-5 d-flex"> -->
        <!-- <div class="justify-content-center"> -->
            <label for="customRange1" class="form-label">Brightness</label>
            <input type="range" id="customRange1" min="85" max="115" value="100" class="form-range filterBrgnRange pb-3" width="auto" >
            <label for="customRange1" class="form-label">Geser Text</label>
            <input type="range" id="customRange1" min="0" max="32" value="0" class="form-range textRange pb-3" width="auto" >
            <label for="customRange2" class="form-label">Geser Gambar</label>
            <input type="range" id="customRange2" min="0" max="10" value="5" class="form-range range pb-3" width="auto" >
            <input type="file" class="file-input" accept="image/*" hidden>
        </div>
    </div>
    <div class="justify-content-center d-flex mb-3">
        <div class="col-lg-11 col-12 ">
        <div class="card" width="100%">
            <div class="card-body">
            <h6 class="card-title">Image</h6>
            <div class="d-flex justify-content-between mt-4">
                <div>
                    <button class="btn btn-primary btn-sm choose-img">Img <i class="fa-sharp fa-solid fa-upload"></i></button>
                    <!-- <button class="btn btn-outline-primary btn-sm resetBtn">Reset</button> -->
                    <a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" >Img <i class="fa-sharp fa-solid fa-link"></i></a>
                    <button class="btn btn-outline-primary btn-sm defBtn">Default</button>
                </div>
                <div>
                    <button class="btn btn-primary btn-sm downloadIniBtn">Download <i class="fa-sharp fa-solid fa-download"></i></button>
                </div>
            </div>
            <div class="d-flex justify-content-start mt-4">
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-sm btn-outline-primary squareBtn">Square 1:1</button>
                <button type="button" class="btn btn-sm btn-outline-primary feedBtn">Feed 3:4</button>
                <button type="button" class="btn btn-sm btn-outline-primary storyBtn">Story 9:16</button>
            </div>
            </div>
            <hr/>
            <!-- <h6 class="card-title">Edit Judul</h6> -->
            <div class="form-floating">
            <textarea class="form-control textAreaEditJudul" style="height:100px" name="textAreaLink"required><?php echo isset($judul) ? $judul : ''; ?></textarea>
            <label for="floatingTextarea">Edit Judul - AutoChange on <i class="fa-sharp fa-solid fa-arrows-rotate"></i></label>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="justify-content-center d-flex mb-3">
        <div class="col-lg-11 col-12 ">
        <form action="" method="post">
        <div class="form-floating">
        <textarea class="form-control textAreaLink" name="textAreaLink"required></textarea>
        <label for="floatingTextarea">Link</label>
        <div class="d-flex justify-content-between mt-2">
            <!-- Button trigger modal -->
            <div>
                <a class="" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >See links...</a>
            </div>
            <div>
                <input type="button" class="btn btn-sm btn-outline-primary clearBtn mx-1" value="Clear">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-sm btn-outline-secondary px-3 pasteBtn2" type="button"><i class="fa-sharp fa-solid fa-paste"></i></button>
                    <button class="btn btn-sm btn-primary px-3 linkBtn" type="submit">Proses</button>
                </div>
            </div>
        </div>
        </div>
        </form>
        </div>
    </div>

    <div class="justify-content-center d-flex mb-3">
        <div class="col-lg-11 col-12 ">
        <div class="form-floating">
        <textarea class="form-control textAreaCaption" style="height:230px"><?php echo isset($simpleCaption) ? $simpleCaption.$hashtagnya : ''; ?></textarea>
        <label for="floatingTextarea">Caption</label>
        <div class="d-flex justify-content-between mt-2">
            <div>                
                <button class=" btn btn-sm btn-outline-primary copyBtn " >Copy <i class="fa-sharp fa-solid fa-copy"></i></button>
            </div>
            <div>
                <button class=" btn btn-sm btn-outline-primary simpleCaptionBtn" >Simple Cap</button>
                <button class=" btn btn-sm btn-outline-primary fullCaptionBtn px-3" >Full Cap</button>
            </div>
        </div>
        </div>
        </div>
    </div>
    <div style="margin-bottom: 300px;"></div>
    </div>

</div>
</div>

    <!-- -------------------------- UNSEEN CODE -------------------------- -->    
<!-- Modal --------------------->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-uppercase" id="staticBackdropLabel">List of news link</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a href="https://www.bolasport.com/bola" class="btn btn-outline-primary btn-sm mb-2" target="_blank">BolaSport <i class="fa-sharp fa-solid fa-arrow-up-right-from-square"></i></a><br/>
        <a href="https://bola.kompas.com/" class="btn btn-outline-primary btn-sm mb-2" target="_blank">Bola Kompas <i class="fa-sharp fa-solid fa-arrow-up-right-from-square"></i></a><br/>
        <p class="mt-3 small" >*Pilih portal berita, salin link beritanya lalu paste pada kolom link dan klik proses</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-uppercase" id="staticBackdropLabel">Image Link</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="input-group mb-3">
                <input type="text" class="form-control inputLink" placeholder="paste link gambar disini..." aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary btn-sm px-3 pasteBtn" type="button" id="button-addon2"><i class="fa-sharp fa-solid fa-paste"></i></button>
                <button class="btn btn-outline-primary btn-sm imgLinkBtn" type="button" id="button-addon2">Proses</button>
                <p class="mt-3 small" >*Pilih gambar di google, salin linknya lalu paste dan klik proses<br/>
                *tidak semua gambar bisa dicetak</p>
            </div>
        </div>
    </div>
  </div>
</div>

    <script src="script.js"></script>
</body>
</html>