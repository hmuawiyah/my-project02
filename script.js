const fileInput = document.querySelector(".file-input");
const previewDiv = document.querySelector(".preview-div div");
const previewBg = document.querySelector(".preview-bg");

const chooseImgBtn = document.querySelector(".choose-img");
const resetBtn = document.querySelector(".resetBtn");
const downloadIniBtn = document.querySelector(".downloadIniBtn");

const rangeBtn = document.querySelector(".range");
const textRangeBtn = document.querySelector(".textRange");
const clearBtn = document.querySelector(".clearBtn");

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
    document.querySelector("textarea").value = '';
}

// function loadFromLink(){
//     const bodyNya = document.querySelector('body');
//     const para = document.createElement('p');
//     const isiNya = document.querySelector("textarea").value;
//     para.innerHTML = isiNya;
//     bodyNya.appendChild(para);
// }


fileInput.addEventListener("change", loadImage);
chooseImgBtn.addEventListener("click", () => fileInput.click());
resetBtn.addEventListener("click", resetSrc);

downloadIniBtn.addEventListener("click", downloadIni);
rangeBtn.addEventListener("change", range);
textRangeBtn.addEventListener("change", textRange);

clearBtn.addEventListener("click", clearFn);

