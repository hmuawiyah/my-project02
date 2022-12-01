const fileInput = document.querySelector(".file-input");
const previewDiv = document.querySelector(".preview-div div");
const previewBg = document.querySelector(".preview-bg");
const coverBg = document.querySelector(".cover-bg");
const textAreaEditJudul = document.querySelector(".textAreaEditJudul");
const textAreaCaption = document.querySelector(".textAreaCaption");

const chooseImgBtn = document.querySelector(".choose-img");
const resetBtn = document.querySelector(".resetBtn");
const extBtn = document.querySelector(".extBtn");
const downloadIniBtn = document.querySelector(".downloadIniBtn");

const squareBtn = document.querySelector(".squareBtn");
const feedBtn = document.querySelector(".feedBtn");
const storyBtn = document.querySelector(".storyBtn");

const rangeBtn = document.querySelector(".range");
const filterBrgnRangeBtn = document.querySelector(".filterBrgnRange");
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

function downloadIni() {
    html2canvas(document.querySelector("#capture"), {
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
    previewBg.style.backgroundPositionX = `${(rangeBtn.value*10)}%`; 
}

function filterBrgnRangeFn(){
    previewBg.style.filter = `brightness(${filterBrgnRangeBtn.value/100})`; 
}

function textRange(){
    previewDiv.style.backgroundPositionX = `${(rangeBtn.value*10)}%`; 
    document.querySelector(".textGambar").style.transform = `translate(0px, ${(textRangeBtn.value*15)}px)`; 
}

function extFn(){
    previewBg.style.backgroundImage = "url('" + document.querySelector(".linkGambar").innerText + "')"; 
}

function copyTextFn() {
    var copyText = textAreaCaption;
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    document.execCommand("copy");
    alert("Berhasil disalin!");
}

function textAreaEditJudulFn(){
    document.querySelector(".textJudul").innerText = textAreaEditJudul.value;
}

fileInput.addEventListener("change", loadImage);
chooseImgBtn.addEventListener("click", () => fileInput.click());
resetBtn.addEventListener("click", resetSrc);
extBtn.addEventListener("click", extFn);
textAreaEditJudul.addEventListener("keyup", textAreaEditJudulFn);

downloadIniBtn.addEventListener("click", downloadIni);
filterBrgnRangeBtn.addEventListener("change", filterBrgnRangeFn);
rangeBtn.addEventListener("change", range);
textRangeBtn.addEventListener("change", textRange);

squareBtn.addEventListener("click", () => document.querySelector("#capture").style.height = "375px");
feedBtn.addEventListener("click", () => document.querySelector("#capture").style.height = "500px");
storyBtn.addEventListener("click", () => document.querySelector("#capture").style.height = "666px");

clearBtn.addEventListener("click", () => document.querySelector(".textAreaLink").value = '');
copyBtn.addEventListener("click", copyTextFn);

simpleCaptionBtn.addEventListener("click", () => textAreaCaption.value = document.querySelector(".simpleCaption").innerText);
fullCaptionBtn.addEventListener("click", () => textAreaCaption.value = document.querySelector(".fullCaption").innerText);

