const fileInput = document.querySelector(".file-input");
const previewDiv = document.querySelector(".preview-div div");
const previewBg = document.querySelector(".preview-bg");

const chooseImgBtn = document.querySelector(".choose-img");
const resetBtn = document.querySelector(".resetBtn");
const extBtn = document.querySelector(".extBtn");
const downloadIniBtn = document.querySelector(".downloadIniBtn");

const rangeBtn = document.querySelector(".range");
const textRangeBtn = document.querySelector(".textRange");
const clearBtn = document.querySelector(".clearBtn");

const copyBtn = document.querySelector(".copyBtn");
const simpleCaptionBtn = document.querySelector(".simpleCaptionBtn");
const fullCaptionBtn = document.querySelector(".fullCaptionBtn");

const loadImage = () => {
    let file = fileInput.files[0];
    previewBg.style.backgroundImage = "url('" + URL.createObjectURL(file) + "')"; 
}

const resetSrc = () => {
    previewBg.style.backgroundImage = "url('sample.png')"; 
}

// function downloadIni() {
//     html2canvas(document.querySelector(".preview-div")).then(canvas => {
//         const base64image = canvas.toDataURL("image/png");
//         var anchor = document.createElement('a');
//         anchor.setAttribute('href', base64image);
//         anchor.setAttribute('download', 'ini-gambar.png');
//         anchor.click();
//         anchor.remove();
//     });
// }

function downloadIni() {
    html2canvas(document.querySelector("#capture"), {
        // logging: true,
        // letterRendering: 1,
        // scale: 1,
        proxy: "https://hm-proxy.herokuapp.com/",
        allowTaint: false,
        useCORS: false
    }).then(canvas => {
        const base64image = canvas.toDataURL("image/png");
        var anchor = document.createElement('a');
        anchor.setAttribute('href', base64image);
        anchor.setAttribute('download', 'ini-gambar.png');
        anchor.click();
        anchor.remove();
    })
};

function range(){
    // previewDiv.style.backgroundPositionX = `${((rangeBtn.value*10)-100)*-1}%`;
    console.log("range bisa");
    previewBg.style.backgroundPositionX = `${(rangeBtn.value*10)}%`; 
    document.querySelector(".nilai").innerText = `${(rangeBtn.value*10)}%`; 
}

function textRange(){
    previewDiv.style.backgroundPositionX = `${(rangeBtn.value*10)}%`; 
    document.querySelector(".textGambar").style.transform = `translate(0px, ${(textRangeBtn.value*10)}px)`; 
}

function clearFn(){
    document.querySelector(".textAreaLink").value = '';
}

function simpleCaptionFn(){
    document.querySelector(".textAreaCaption").value = document.querySelector(".simpleCaption").innerText;
}

function fullCaptionFn(){
    document.querySelector(".textAreaCaption").value = document.querySelector(".fullCaption").innerText;
}

function extFn(){
    previewBg.style.backgroundImage = "url('" + document.querySelector(".linkGambar").innerText + "')"; 
}

function copyTextFn() {
    var copyText = document.querySelector(".textAreaCaption");
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    navigator.clipboard.writeText(copyText.value);
    // console.log("works");
    alert("Berhasil disalin!");
  }


fileInput.addEventListener("change", loadImage);
chooseImgBtn.addEventListener("click", () => fileInput.click());
resetBtn.addEventListener("click", resetSrc);
extBtn.addEventListener("click", extFn);

downloadIniBtn.addEventListener("click", downloadIni);
rangeBtn.addEventListener("change", range);
textRangeBtn.addEventListener("change", textRange);

clearBtn.addEventListener("click", clearFn);
copyBtn.addEventListener("click", copyTextFn);
simpleCaptionBtn.addEventListener("click", simpleCaptionFn);

fullCaptionBtn.addEventListener("click", fullCaptionFn);

