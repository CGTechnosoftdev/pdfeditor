const fileName = localStorage.getItem("pdfFile") ? localStorage.getItem("pdfFile") : 'blank';
var pdf = new PDFAnnotate('pdf-container', fileName+".pdf", {
    onPageUpdated: (page, oldData, newData) => {
        
    }
});

var canvas = document.getElementById('signature-pad');
var signaturePad = new SignaturePad(canvas, {
  backgroundColor: 'transparent'
});

const jsonData = localStorage.getItem("pdfData") ? JSON.parse(localStorage.getItem("pdfData")) : [];

function loadFromJson(){
    pdf.loadFromJSON(jsonData);
}

function addDate(event){
    pdf.addDate(event);
}

function addPage(){
    pdf.addPage();
}

function rotatePage(){
    pdf.rotatePage();
}

function deletePage(){
    pdf.deletePage();
}

function enableSelector(event) {
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').removeClass('active');
    $(element).addClass('active');
    pdf.enableSelector();
}

function enablePencil(event) {
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').removeClass('active');
    $(element).addClass('active');
    pdf.enablePencil();
}

function enableAddText(event) {
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').removeClass('active');
    $(element).addClass('active');
    pdf.enableAddText();
}

function enableAddArrow(event) {
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').removeClass('active');
    $(element).addClass('active');
    pdf.enableAddArrow();
}

function enableRectangle(event) {
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').removeClass('active');
    $(element).addClass('active');
    pdf.setColor('rgba(255, 0, 0, 0.3)');
    pdf.setBorderColor('blue');
    pdf.enableRectangle();
}

function enableAddImage(event){
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').removeClass('active');
    $(element).addClass('active');
    pdf.enableAddImage();
}

function deleteSelectedObject() {
    event.preventDefault();
    pdf.deleteSelectedObject();
}

function savePDF() {
    var json_data = pdf.serializePdf();
    localStorage.setItem("pdfData", json_data);
    pdf.savePdf();
    // var fs = require('fs')
	// fs.readFile("json_data.txt", 'utf8', function (err,data) {
	// 	console.log(data);
	// 	fs.writeFile(json_data.txt, JSON.stringify(json_data), 'utf8', function (err) {
	// 		if (err) return console.log(err);
	// 	});
	// });
}

function clearPage() {
    pdf.clearActivePage();
}

function addCrossIcon(){
    pdf.addCrossIcon();
}

function addCircleIcon(){
    pdf.addCircleIcon();
}

function addCheckIcon(){
    pdf.addCheckIcon();
}

function showPdfData() {
    var string = pdf.serializePdf();
    $('#dataModal .modal-body pre').first().text(string);
    PR.prettyPrint();
    $('#dataModal').modal('show');
}

function openSignatureModal(){
    $('#signatureModal').modal('show');
}

document.getElementById('clear').addEventListener('click', function () {
    signaturePad.clear();
});

document.getElementById('undo').addEventListener("click", function (event) {
    var data = signaturePad.toData();  
    if (data) {
      data.pop();
      signaturePad.fromData(data);
    }
  });

document.getElementById('save-png').addEventListener('click', function () {
    if (signaturePad.isEmpty()) {
      return alert("Please provide a signature first.");
    }    
    var data = signaturePad.toDataURL('image/png');
    var d = new Date();
	const hr = d.getHours();
	const min = d.getMinutes();
	const sec = d.getSeconds();
	const fileName = "signature"+hr+min+sec;
    download(data, fileName+".png");
    document.getElementById('drawed-signature').src=data;
    signaturePad.clear();
    $('#signatureModal').modal('hide');
    pdf.addDrawSignature(data);
  });

document.getElementById("use-sign").addEventListener('click', function(){
    const preview = document.getElementById('preview-sign');
    pdf.addSignature(preview.src);
    $('#signatureModal').modal('hide');
    signaturePad.clear();
    preview.src = '';
    enableDrawingMode();
    document.getElementById("signature-selector").value = '';
})

function changeFontSize(event){
    pdf.changeFontSize(event.target.value);
}

function selectSignature(event){
    $(".img-wrapper").show();
    $(".signature-wrapper").hide();
    signaturePad.clear();
    const preview = document.getElementById('preview-sign');
    const file = document.getElementById("signature-selector").files[0];
    const reader = new FileReader();  
    reader.addEventListener("load", function () {
      preview.src = reader.result;
    }, false);  
    if (file) {
      reader.readAsDataURL(file);
    }
    $("#save-png").hide();
    $("#use-sign").show();
}

function enableDrawingMode(){
    $(".img-wrapper").hide();
    $(".signature-wrapper").show();
    $("#save-png").show();
    $("#use-sign").hide();
    const preview = document.getElementById('preview-sign');
    preview.src = '';
    document.getElementById("signature-selector").value = '';
}

function download(dataURL, filename) {
    var blob = dataURLToBlob(dataURL);
    var url = window.URL.createObjectURL(blob);
  
    var a = document.createElement("a");
    a.style = "display: none";
    a.href = url;
    a.download = filename;
  
    document.body.appendChild(a);
    a.click();
  
    window.URL.revokeObjectURL(url);
}

function dataURLToBlob(dataURL) {
    // Code taken from https://github.com/ebidel/filer.js
    var parts = dataURL.split(';base64,');
    var contentType = parts[0].split(":")[1];
    var raw = window.atob(parts[1]);
    var rawLength = raw.length;
    var uInt8Array = new Uint8Array(rawLength);
  
    for (var i = 0; i < rawLength; ++i) {
      uInt8Array[i] = raw.charCodeAt(i);
    }
  
    return new Blob([uInt8Array], { type: contentType });
}

function changeFontWeight(event){
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').not("#bold").removeClass('active');
    if($(element).hasClass('active')){
        $(element).removeClass('active');
        pdf.removeBold();
    } else{
        $(element).addClass('active');
        pdf.setBold()
    }
    
    pdf.enableAddText();
}

$(function () {
    $('.color-tool').click(function () {
        $('.color-tool.active').removeClass('active');
        $(this).addClass('active');
        color = $(this).get(0).style.backgroundColor;
        pdf.setColor(color);
    });

    $('#brush-size').change(function () {
        var width = $(this).val();
        pdf.setBrushSize(width);
    });

    $('#font-size').change(function () {
        var font_size = $(this).val();
        pdf.setFontSize(font_size);
    });

    $("#font-family").change(function(){
        var font_family = $(this).val();
        pdf.setFontFamily(font_family);
    })
});
