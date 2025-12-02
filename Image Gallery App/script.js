const dropArea = document.getElementById("drop-area");
const fileInput = document.getElementById("fileInput");
const browseBtn = document.getElementById("browseBtn");
const preview = document.getElementById("preview");

browseBtn.onclick = () => fileInput.click();

dropArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropArea.style.background = "#d0d0d0";
});

dropArea.addEventListener("dragleave", () => {
    dropArea.style.background = "#e8e8e8";
});

dropArea.addEventListener("drop", (e) => {
    e.preventDefault();
    dropArea.style.background = "#e8e8e8";
    fileInput.files = e.dataTransfer.files;
    showPreview();
});

fileInput.onchange = showPreview;

function showPreview() {
    preview.innerHTML = "";
    Array.from(fileInput.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = () => {
            const img = document.createElement("img");
            img.src = reader.result;
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}
