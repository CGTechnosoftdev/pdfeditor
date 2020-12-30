const fileName = localStorage.getItem("pdfFile") ? localStorage.getItem("pdfFile") : 'blank';
var pdf = new PDFAnnotate('pdf-container', fileName + ".pdf", {
    onPageUpdated: (page, oldData, newData) => {

    }
});

var canvas = document.getElementById('signature-pad');
var signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'transparent'
});

const jsonData = localStorage.getItem("pdfData") ? JSON.parse(localStorage.getItem("pdfData")) : [];

function loadFromJson() {
    pdf.loadFromJSON(jsonData);


    function addDateModel(event) {
        $('#selectdateModal').modal('show');
    }
}

function addDate(event) {
    pdf.addDate(event);
}

function addPage() {
    pdf.addPage("", "");
}

$("#pick_date_button").click(function() {
    // $('#dataModal').modal('show');
    $("#select_date_msg_id").removeClass('show');
    $("#select_date_msg_id").removeClass('alert-success');
    $("#select_date_msg_id").addClass('hide');
    $('#selectdateModal').modal('show');
});

$("#new-date-select-button").click(function(event) {
    var is_valid = true;
    var messages = [];
    var error_index = 0
    if ($("#dateid").val() == "") {
        messages[error_index] = "Please select date field!";
        error_index += 1;
        is_valid = false;
    }
    if ($("#header_footerid").val() == 0) {
        messages[error_index] = "Please select header footer drop-down!";
        error_index += 1;
        is_valid = false;
    }
    if ($("#text_alignid").val() == 0) {
        messages[error_index] = "Please select the text align!";
        error_index += 1;
        is_valid = false;
    }
    if (!is_valid) {
        var msgString = '<ul>';
        $.each(messages, function(index, value) {
            msgString += '<li>' + value + '</li>'
        })
        msgString += '</ul>';
        $("#select_date_msg_id").html(msgString);
        $("#select_date_msg_id").removeClass('hide');
        //alert-danger
        $("#select_date_msg_id").addClass('alert-danger');
        $("#select_date_msg_id").addClass('show');
        return false;
    }
    var dateVal = $("#dateid").val();
    var header_footer = $("#header_footerid").val();
    var text_align = $("#text_alignid").val();
    pdf.addPickDate(dateVal, header_footer, text_align);
    $("#select_date_msg_id").html("Date added Successfully!");
    $("#select_date_msg_id").removeClass('alert-danger');
    $("#select_date_msg_id").addClass('alert-success');
    $("#select_date_msg_id").addClass('show');
    setTimeout(function() {
        $('#selectdateModal').modal('hide');
    }, 3000);
});
$("#resize_canvas").click(function(event) {
    //  pdf.resizePage(event);
    $("#setuppage_msg_id").removeClass('show');
    $("#setuppage_msg_id").addClass('hide');
    $('#setpagesizeModal').modal('show');
});
$("#new-width-height-button").click(function(event) {
    var numchk = /^[0-9]+$/;
    var is_valid = true;
    var messages = [];
    var error_index = 0
    if (!numchk.test($("#page_widthid").val())) {
        messages[error_index] = "Please enter valid width,it should be number";
        error_index += 1;
        is_valid = false;
    }
    if (!numchk.test($("#page_heightid").val())) {
        messages[error_index] = "Please enter valid height,it should be number";
        error_index += 1;
        is_valid = false;
    }
    if (!is_valid) {
        var msgString = '<ul>';
        $.each(messages, function(index, value) {
            msgString += '<li>' + value + '</li>'
        })
        msgString += '</ul>';
        $("#setuppage_msg_id").html(msgString);
        $("#setuppage_msg_id").removeClass('hide');
        $("#setuppage_msg_id").addClass('alert-danger');
        $("#setuppage_msg_id").addClass('show');
        return false;
    }
    var page_width = $("#page_widthid").val();
    var page_height = $("#page_heightid").val();
    pdf.resizePage(page_width, page_height);
    $("#setuppage_msg_id").html("Page size updated Successfully!");
    $("#setuppage_msg_id").removeClass('hide');
    $("#setuppage_msg_id").removeClass('alert-danger');
    $("#setuppage_msg_id").addClass('alert-success');
    $("#setuppage_msg_id").addClass('show');
    setTimeout(function() {
        $('#setpagesizeModal').modal('hide');

    }, 3000);
});

function rotatePage() {
    pdf.rotatePage();
}

function deletePage() {
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

function enableAddImage(event) {
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
}

function movePage(direction) {
    pdf.movePage(direction);
}

function clearPage() {
    pdf.clearActivePage();
}

function addCrossIcon() {
    pdf.addCrossIcon();
}

function addCircleIcon() {
    pdf.addCircleIcon();
}

function addCheckIcon() {
    pdf.addCheckIcon();
}

function showPdfData() {
    var string = pdf.serializePdf();
    $('#dataModal .modal-body pre').first().text(string);
    PR.prettyPrint();
    $('#dataModal').modal('show');
}

function openSignatureModal() {
    $('#signatureModal').modal('show');
}

/*Open Image Model */
$(document).on("click", "#openImageModelId", function() {
    $("#new-img-save-png").show();
    $(".new-img-wrapper").hide();
    getNewImages();
    document.getElementById('preview-image').src = "";
    $('#imageModal').modal('show');
});
$(document).on("click", "img[id ^= 'old_images_']", function() {
    pdf.addNewImage($(this).attr("src"));
    $('#imageModal').modal('hide');
});

document.getElementById('clear').addEventListener('click', function() {
    signaturePad.clear();
});

document.getElementById('undo').addEventListener("click", function(event) {
    var data = signaturePad.toData();
    if (data) {
        data.pop();
        signaturePad.fromData(data);
    }
});

document.getElementById('save-png').addEventListener('click', function() {
    if (signaturePad.isEmpty()) {
        return alert("Please provide a signature first.");
    }
    var data = signaturePad.toDataURL('image/png');
    var d = new Date();
    const hr = d.getHours();
    const min = d.getMinutes();
    const sec = d.getSeconds();
    const fileName = "signature" + hr + min + sec;
    download(data, fileName + ".png");
    document.getElementById('drawed-signature').src = data;
    signaturePad.clear();
    $('#signatureModal').modal('hide');
    pdf.addDrawSignature(data);
});

document.getElementById('eraser_btn_id').addEventListener('click', function(event) {
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').removeClass('active');
    $(element).addClass('active');
    pdf.eraseText();
});
document.getElementById('highlight_btn_id').addEventListener('click', function(event) {
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').removeClass('active');
    $(element).addClass('active');
    pdf.toggleHighlighter();
});
document.getElementById('blackout_btn_id').addEventListener('click', function(event) {
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').removeClass('active');
    $(element).addClass('active');
    pdf.toggleBlackout();
});
document.getElementById('new-img-save-png').addEventListener('click', function() {
    const data = document.getElementById('preview-image').src;
    pdf.addNewImage(data);
    $('#imageModal').modal('hide');
});
document.getElementById("use-sign").addEventListener('click', function() {
    const preview = document.getElementById('preview-sign');
    pdf.addSignature(preview.src);
    $('#signatureModal').modal('hide');
    signaturePad.clear();
    preview.src = '';
    enableDrawingMode();
    document.getElementById("signature-selector").value = '';
})

function changeFontSize(event) {
    pdf.changeFontSize(event.target.value);
}

function selectSignature(event) {
    $(".img-wrapper").show();
    $(".signature-wrapper").hide();
    signaturePad.clear();
    const preview = document.getElementById('preview-sign');
    const file = document.getElementById("signature-selector").files[0];
    const reader = new FileReader();
    reader.addEventListener("load", function() {
        let mimeType = (reader.result.match(/[^:]\w+\/[\w-+\d.]+(?=;|,)/) ? reader.result.match(/[^:]\w+\/[\w-+\d.]+(?=;|,)/)[0] : "");
        var is_valid_image = false;
        if (mimeType == 'image/jpeg' || mimeType == 'image/jpg' || mimeType == 'image/png') {
            is_valid_image = true;
        }
        if (!is_valid_image) {
            alert("File format is not valid,Please use jpg or png file format!");
            return false;
        }
        preview.src = reader.result;
    }, false);
    if (file) {
        reader.readAsDataURL(file);
    }
    $("#save-png").hide();
    $("#use-sign").show();
}

function getNewImages() {
    //var imageContainer = document.getElementById("new_images");
    //PreviewImagesContainer
    //alert($("#newImageTemplateId").clone());
    let myImages = [];
    myImages = JSON.parse(localStorage.getItem("new_images")) || [];
    var image_itmes = "";
    if (myImages.length > 0)
        $("#PreviousContainer").show();
    for (var i = 0; i < myImages.length; i++) {
        //alert(myImages[i]);
        var ColumnTemplateHTML = $("#newImageTemplateId").html();
        //ColumnTemplateHTML.replace("-imgItem-", "<img src='" + myImages[i] + "' id='old_images_" + i + "' width='50px' / >");
        image_itmes += '<div class="col col-md-4">' + "<img src='" + myImages[i] + "' id='old_images_" + i + "' class='img-thumbnail' / ></div>";
    }
    $("#PreviousImageContainer").html(image_itmes);
}

function saveInLocalStorage(url) {
    let myImages = [];
    myImages = JSON.parse(localStorage.getItem("new_images")) || [];
    myImages.push(url);
    localStorage.setItem("new_images", JSON.stringify(myImages));
}

function selectImage(event) {
    $(".new-img-wrapper").show();
    const preview = document.getElementById('preview-image');
    const file = document.getElementById("image-selector").files[0];
    const reader = new FileReader();
    reader.addEventListener("load", function() {
        let mimeType = (reader.result.match(/[^:]\w+\/[\w-+\d.]+(?=;|,)/) ? reader.result.match(/[^:]\w+\/[\w-+\d.]+(?=;|,)/)[0] : "");
        var is_valid_image = false;
        if (mimeType == 'image/jpeg' || mimeType == 'image/jpg' || mimeType == 'image/png') {
            is_valid_image = true;
        }
        if (!is_valid_image) {
            alert("File format is not valid,Please use jpg or png file format!");
            return false;
        }
        preview.src = reader.result;
        saveInLocalStorage(reader.result);
    }, false);
    if (file) {
        reader.readAsDataURL(file);
    }
    $("#new-img-save-png").show();
}

function enableDrawingMode() {
    $(".img-wrapper").hide();
    $(".signature-wrapper").show();
    $("#save-png").show();
    $("#use-sign").hide();
    const preview = document.getElementById('preview-sign');
    preview.src = '';
    document.getElementById("signature-selector").value = '';
}

function duplicatePage() {
    pdf.duplicatePage();
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

function changeFontWeight(event) {
    event.preventDefault();
    var element = ($(event.target).hasClass('tool-button')) ? $(event.target) : $(event.target).parents('.tool-button').first();
    $('.tool-button.active').not("#bold").removeClass('active');
    if ($(element).hasClass('active')) {
        $(element).removeClass('active');
        pdf.removeBold();
    } else {
        $(element).addClass('active');
        pdf.setBold()
    }

    pdf.enableAddText();
}

function addWatermark() {
    $("#watermarkModal").modal('show');
}

$("#submit").click(function() {
    if ($("#watermark").val() == '') {
        return;
    } else {
        var orientation_value = $(".orientation_group img.active").data('value');
        pdf.addWatermark(orientation_value, $("#watermark").val());
        $("#watermarkModal").modal('hide');
        $("#watermark").val("");
    }
})

$(".orientation_group img").on('click', function() {
    $('.orientation_group img').removeClass('active');
    $(this).addClass('active');
    var orientation_value = $(this).data('value');
    $("#orientation").val(orientation_value);
})

$(function() {
    $('.color-tool').click(function() {
        $('.color-tool.active').removeClass('active');
        $(this).addClass('active');
        color = $(this).get(0).style.backgroundColor;
        pdf.setColor(color);
    });

    $('#brush-size').change(function() {
        var width = $(this).val();
        pdf.setBrushSize(width);
    });

    $('#font-size').change(function() {
        var font_size = $(this).val();
        pdf.setFontSize(font_size);
    });

    $("#font-family").change(function() {
        var font_family = $(this).val();
        pdf.setFontFamily(font_family);
    })
});