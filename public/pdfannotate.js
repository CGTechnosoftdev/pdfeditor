/**
 * PDFAnnotate v1.0.0
 * Author: Ravisha Heshan
 */
// import canvas2pdf from 'canvas2pdf'
var PDFAnnotate = function (container_id, url, options = {}) {
	this.number_of_pages = 0;
	this.pages_rendered = 0;
	this.active_tool = 1; // 1 - Free hand, 2 - Text, 3 - Arrow, 4 - Rectangle, 5 - Add Image
	this.fabricObjects = [];
	this.fabricObjectsData = [];
	this.color = '#212121';
	this.borderColor = '#000000';
	this.borderSize = 1;
	this.font_size = 16;
	this.fontFamily = "Lucida Console", 'monospace';
	this.active_canvas = 0;
	this.container_id = container_id;
	this.url = url;
	this.fontWeight = 'normal';
	this.last_deleted_page = 0;
	this.main_page_numbers = 0;
	var inst = this;

	var loadingTask = PDFJS.getDocument(this.url);
	loadingTask.promise.then(function (pdf) {
		var scale = 1.3;
		inst.number_of_pages = pdf.pdfInfo.numPages;
		inst.main_page_numbers = pdf.pdfInfo.numPages;

		for (var i = 1; i <= pdf.pdfInfo.numPages; i++) {
			pdf.getPage(i).then(function (page) {
				var viewport = page.getViewport(scale);
				var canvas = document.createElement('canvas');
				document.getElementById(inst.container_id).appendChild(canvas);
				canvas.className = 'pdf-canvas';
				canvas.height = viewport.height;
				canvas.width = viewport.width;
				context = canvas.getContext('2d');

				var renderContext = {
					canvasContext: context,
					viewport: viewport
				};
				var renderTask = page.render(renderContext);
				renderTask.then(function () {
					$('.pdf-canvas').each(function (index, el) {
						$(el).attr('id', 'page-' + (index + 1) + '-canvas');
					});
					inst.pages_rendered++;
					if (inst.pages_rendered == inst.number_of_pages) inst.initFabric();
				});
			});
		}
	}, function (reason) {
		console.log(reason);
	});

	this.initFabric = function () {
		var inst = this;
		$('#' + inst.container_id + ' canvas').each(function (index, el) {
			var background = el.toDataURL("image/png");
			var fabricObj = new fabric.Canvas(el.id, {
				freeDrawingBrush: {
					width: 1,
					color: inst.color
				}
			});
			inst.fabricObjects.push(fabricObj);
			if (typeof options.onPageUpdated == 'function') {
				fabricObj.on('object:added', function () {
					var oldValue = Object.assign({}, inst.fabricObjectsData[index]);
					inst.fabricObjectsData[index] = fabricObj.toJSON()
					options.onPageUpdated(index + 1, oldValue, inst.fabricObjectsData[index])
				})
			}
			fabricObj.setBackgroundImage(background, fabricObj.renderAll.bind(fabricObj));
			$(fabricObj.upperCanvasEl).click(function (event) {
				inst.active_canvas = index;
				inst.fabricClickHandler(event, fabricObj);
			});
			fabricObj.on('after:render', function () {
				inst.fabricObjectsData[index] = fabricObj.toJSON()
				fabricObj.off('after:render')
			})
		});
	}

	//toggleitalicid

	$("#toggleitalicid").click(function (event) {
		inst.toggleitalicbtnClickHandler(event, inst.fabricObjects[0]);
	});

	$("#toggleunderline").click(function (event) {
		inst.togglebtnClickHandler(event, inst.fabricObjects[0]);
	});

	this.togglebtnClickHandler = function (event, fabricObj) {
		var o = fabricObj.getActiveObject();
		var fontStyleOb = "";
		if (o) {
			fontStyleOb = getStyle(o, 'textDecoration');
			if (fontStyleOb === "underline") {
				o.set({ textDecoration: '' });
			}
			else if (fontStyleOb != "underline") {
				o.set({ textDecoration: 'underline  #000000', color: this.color });
			}
			o.set({ dirty: true });
			fabricObj.renderAll();
		}
		inst.active_tool = 1;
	}



	this.toggleitalicbtnClickHandler = function (event, fabricObj) {
		var o = fabricObj.getActiveObject();
		var fontStyleOb = "";
		if (o) {
			fontStyleOb = getStyle(o, 'fontStyle');
			console.log(fontStyleOb);
			if (fontStyleOb) {
				o.set({ fontStyle: '' });
			}
			else if (fontStyleOb != "italic") {
				o.set({ fontStyle: 'italic' });
			}
			o.set({ dirty: true });
			fabricObj.renderAll();
		}
		inst.active_tool = 1;
	}

	this.fabricClickHandler = function (event, fabricObj) {
		var inst = this;
		if (inst.active_tool == 2) {
			var text = new fabric.IText('Sample text', {
				left: event.clientX - fabricObj.upperCanvasEl.getBoundingClientRect().left,
				top: event.clientY - fabricObj.upperCanvasEl.getBoundingClientRect().top,
				fill: inst.color,
				fontSize: inst.font_size,
				selectable: true,
				fontFamily: inst.fontFamily,
				fontWeight: 'normal'
			});
			fabricObj.add(text);
		}
		inst.active_tool = 0;
	}
}
function getStyle(object, styleName) {
	var selecteItemOb = object;
	return selecteItemOb[styleName];
}
PDFAnnotate.prototype.enableSelector = function () {
	var inst = this;
	inst.active_tool = 0;
	if (inst.fabricObjects.length > 0) {
		$.each(inst.fabricObjects, function (index, fabricObj) {
			fabricObj.isDrawingMode = false;
		});
	}
}

PDFAnnotate.prototype.enablePencil = function () {
	var inst = this;
	inst.active_tool = 1;
	if (inst.fabricObjects.length > 0) {
		$.each(inst.fabricObjects, function (index, fabricObj) {
			fabricObj.isDrawingMode = true;
			fabricObj.freeDrawingBrush.color = inst.color;
		});
	}
}

PDFAnnotate.prototype.enableAddText = function () {
	var inst = this;
	inst.active_tool = 2;
	if (inst.fabricObjects.length > 0) {
		$.each(inst.fabricObjects, function (index, fabricObj) {
			fabricObj.isDrawingMode = false;
		});
	}
}

PDFAnnotate.prototype.enableRectangle = function () {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	inst.active_tool = 4;
	if (inst.fabricObjects.length > 0) {
		$.each(inst.fabricObjects, function (index, fabricObj) {
			fabricObj.isDrawingMode = false;
		});
	}

	var rect = new fabric.Rect({
		width: 100,
		height: 100,
		fill: inst.color,
		stroke: inst.borderColor,
		strokeSize: inst.borderSize
	});
	fabricObj.add(rect);
}

PDFAnnotate.prototype.enableAddArrow = function () {
	var inst = this;
	inst.active_tool = 3;
	if (inst.fabricObjects.length > 0) {
		$.each(inst.fabricObjects, function (index, fabricObj) {
			fabricObj.isDrawingMode = false;
			new Arrow(fabricObj, inst.color, function () {
				inst.active_tool = 0;
			});
		});
	}
}

PDFAnnotate.prototype.deleteSelectedObject = function () {
	var inst = this;
	var activeObject = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if (activeObject) {
		if (confirm('Are you sure ?')) inst.fabricObjects[inst.active_canvas].remove(activeObject);
	}
}

PDFAnnotate.prototype.changeFontSize = function (fontSize) {
	var inst = this;
	this.font_size = fontSize;
	var fabricObj = inst.fabricObjects[0]
	var o = inst.fabricObjects[inst.active_canvas].getActiveObject();
	o.set({ fontSize: fontSize });
	fabricObj.renderAll().setActiveObject(o);
}

PDFAnnotate.prototype.savePdf = async function () {
	var inst = this;
	var doc = new jsPDF();
	var ctx = new canvas2pdf.PdfContext(blobStream());
	console.log(ctx, inst)
	// $.each(inst.fabricObjects, function (index, fabricObj) {
	// 	if (index != 0) {
	// 		doc.addPage();
	// 		doc.setPage(index + 1);
	// 	}
	// 	// doc.addImage(fabricObj.toDataURL(), 'png', 0, 0);
	// 	// doc.addSvg(fabricObj.toDataURL(), 'svg', 0, 0);
	// 	console.log(fabricObj)
	// });
	ctx.fillStyle = 'black';
	ctx.fillRect(100, 100, 100, 100);
	// ctx.fontSize(40);
	let formField = `<form action="/action_page.php">
	<label for="fname">First name:</label><br>
	<input type="text" id="fname" name="fname" value="John"><br>
	<label for="lname">Last name:</label><br>
	<input type="text" id="lname" name="lname" value="Doe"><br><br>
	<input type="submit" value="Submit">
  </form> `;
	var image = new Image();
	let customCanvasSeq = localStorage.getItem("customCanvasDataArr") && JSON.parse(localStorage.getItem("customCanvasDataArr")).length ? JSON.parse(localStorage.getItem("customCanvasDataArr")).length : null;
	let customCanvasDataArr = localStorage.getItem("customCanvasDataArr") ? JSON.parse(localStorage.getItem("customCanvasDataArr")) : [];
	image.crossOrigin = 'Anonymous';
	image.src = 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/17/Tiger_in_Ranthambhore.jpg/220px-Tiger_in_Ranthambhore.jpg';
	image.onload = function () {
		console.log("end")
		// doc.text(formField, 10, 10);
		doc.addImage(image, 'png', 150, 50)
		var specialElementHandlers = {
			'#editor': function (element, renderer) {
				return true;
			}
		};
		// html2canvas(document.getElementById('custom-pdf-container'), {
		// 	onrendered: function (canvasObj) {
		// 		document.body.appendChild(canvasObj);
		// 		let pdfConf = {
		// 			pagesplit: false,
		// 			background: '#fff',
		// 		};
		// 		doc.addHTML(canvasObj, 15, 15, pdfConf, function () {
		// 			document.body.removeChild(canvasObj);
		// 			alert("added");
		// 			// pdf.addPage();
		// 		});
		// 	}
		// });
		// ctx.drawImage(image, 0, 0);
		if (customCanvasSeq) {
			let seq = 1;
			$.each(customCanvasDataArr, function (index, imgObj) {
				// let xPosDy = $('#divDraw_' + imgObj.seq).position() ? $('#divDraw_' + imgObj.seq).position().left : imgObj.xPos;
				// let yPosDy = $('#divDraw_' + imgObj.seq).position() ? $('#divDraw_' + imgObj.seq).position().top : imgObj.yPos;
				var parentPos = document.getElementById('custom-pdf-container').getBoundingClientRect()
				var childPos = document.getElementById('imgDraw_' + imgObj.seq).getBoundingClientRect()
				console.log(childPos.left - parentPos.left, childPos.top - parentPos.top, $('#divDraw_' + imgObj.seq), $('#divDraw_' + imgObj.seq).position())
				// ctx.drawImage(imgObj.blog, childPos.left - parentPos.left, childPos.top - parentPos.top);
				doc.addImage(imgObj.blog, 'png', childPos.left - parentPos.left, childPos.top - parentPos.top);
				seq++;
			});
		}
		//inputBox
		doc.text(40, 30, 'Input 1 :');
		var inputForm1 = new TextField();
		inputForm1.Rect = [40, 40, 120, 30];
		inputForm1.V = "TextField 2, TextField 2, TextField 2, TextField 2, ";
		inputForm1.T = "TestTextBox";
		doc.addField(inputForm1);

		//textField1
		doc.text(40, 90, 'TextField 1 :');
		var textField1 = new TextField();
		textField1.Rect = [40, 100, 120, 30];
		textField1.multiline = true;
		textField1.V = "TextField 1, TextField 1, TextField 1, TextField 1, ";
		textField1.T = "TestTextBox";
		doc.addField(textField1);

		//textField2
		doc.text(40, 140, 'TextField 2 :');
		var textField2 = new TextField();
		textField2.Rect = [40, 150, 120, 30];
		textField2.multiline = true;
		textField2.V = "TextField 2, TextField 2, TextField 2, TextField 2, ";
		textField2.T = "TestTextBox";
		doc.addField(textField2);

		//textField2
		// doc.text(40, 180, 'DP 2 :');
		// var combo = $("<select></select>").attr("id", "avava").attr("name", "dddsds");
		// combo.append("<option>" + "el" + "</option>");
		// combo.append("<option>" + "els" + "</option>");
		// combo.append("<option>" + "el" + "</option>");
		// combo.Rect = [40, 200, 120, 30];
		// doc.addField(combo);

		doc.setFontSize(12);
		var radioGroup = new RadioButton();
		radioGroup.value = "Test";
		radioGroup.Subtype = "Form";
		radioGroup.setAppearance(AcroForm.Appearance.RadioButton.Cross);
		doc.addField(radioGroup);
		var radioButton1 = radioGroup.createOption("Test");
		radioButton1.Rect = [40, 200, 30, 10];
		radioButton1.AS = "/Test";
		var radioButton2 = radioGroup.createOption("Test2");
		radioButton2.Rect = [40, 210, 30, 10];
		var radioButton3 = radioGroup.createOption("Test3");
		radioButton3.Rect = [40, 220, 20, 10];

		// doc.fromHTML($('#custom-pdf-container').html(), 15, 15, {
		// 	'width': 70,
		// 	'elementHandlers': specialElementHandlers,
		// }, function () {
		// 	// doc.save("pdfFile" + '.pdf');
		// });

		// doc.save("pdfFile" + '.pdf');

		// ctx.fillText("<a>Here and There</a>", 50, 50);
		// ctx.fillText(formField, 50, 500);
		// ctx.stream.on('finish', function () {
		// 	var blob = ctx.stream.toBlob('application/pdf');
		// 	saveAs(blob, 'example.pdf', true);
		// 	console.log("end")
		// });
		// ctx.end();
	};


	var d = new Date();
	const hr = d.getHours();
	const min = d.getMinutes();
	const sec = d.getSeconds();
	const fileName = "file" + hr + min + sec;
	localStorage.setItem("pdfFile", fileName);
	// doc.save(fileName + '.pdf');

	modifyPdf();
}
function fileToByteArray(file) {
	return new Promise((resolve, reject) => {
		try {
			let reader = new FileReader();
			let fileByteArray = [];
			reader.readAsArrayBuffer(file);
			reader.onloadend = (evt) => {
				if (evt.target.readyState == FileReader.DONE) {
					let arrayBuffer = evt.target.result,
						array = new Uint8Array(arrayBuffer);
					for (byte of array) {
						fileByteArray.push(byte);
					}
				}
				resolve(fileByteArray);
			}
		}
		catch (e) {
			reject(e);
		}
	})
}
async function modifyPdf() {
	const { degrees, PDFDocument, rgb, StandardFonts } = PDFLib
	// Fetch an existing PDF document
	const url = 'https://pdf-lib.js.org/assets/with_update_sections.pdf'
	// const url = 'http://3.236.78.127/pdfFile.pdf'
	const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer())
	console.log(existingPdfBytes)

	let inputPDFFile = document.getElementById('input_pdf_file').files[0];
	let pdfDoc = null;
	if (inputPDFFile) {
		let byteArray = await fileToByteArray(inputPDFFile);
		console.log(new Uint8Array(byteArray))
		// Load a PDFDocument from the existing PDF bytes
		pdfDoc = await PDFDocument.load(new Uint8Array(byteArray))
	} else {
		// Create a new PDFDocument
		pdfDoc = await PDFDocument.create()
	}

	// Embed the Helvetica font
	const helveticaFont = await pdfDoc.embedFont(StandardFonts.Helvetica)
	let firstPage = null;
	if (inputPDFFile) {
		// Get the first page of the document
		let pages = pdfDoc.getPages()
		firstPage = pages[0]
	} else {
		// Add a blank page to the document
		firstPage = pdfDoc.addPage([550, 750])
	}


	// Get the width and height of the first page
	const { width, height } = firstPage.getSize()

	// Draw a string of text diagonally across the first page
	firstPage.drawText('Overlay text using pdf', {
		x: 5,
		y: height / 2 + 300,
		size: 50,
		font: helveticaFont,
		color: rgb(0.95, 0.1, 0.1),
		rotate: degrees(-45),
	})

	const form = pdfDoc.getForm();
	const superheroField = form.createTextField('favorite.superhero_new')
	// superheroField.setText('New field added in form')
	superheroField.isFileSelector(true)
	superheroField.enableFileSelection()
	superheroField.addToPage(firstPage, { x: 55, y: 40 })

	const personField = form.createOptionList('favorite.personal')
	personField.addOptions([
		'Julius Caesar',
		'Ada Lovelace',
		'Cleopatra',
		'Aaron Burr',
		'Mark Antony',
	])
	personField.select('Ada Lovelace')
	personField.addToPage(firstPage, { x: 55, y: 70 })

	// Serialize the PDFDocument to bytes (a Uint8Array)
	const pdfBytes = await pdfDoc.save()

	// Trigger the browser to download the PDF document
	// console.log(pdfBytes)
	// download(pdfBytes, "pdf-lib_modification_example.pdf", "application/pdf");

	var blob = new Blob([pdfBytes], { type: "application/pdf" });
	var link = document.createElement('a');
	link.href = window.URL.createObjectURL(blob);
	var fileName = "pdf-lib_modification_example.pdf";
	link.download = fileName;
	link.click();
}
PDFAnnotate.prototype.setBrushSize = function (size) {
	var inst = this;
	$.each(inst.fabricObjects, function (index, fabricObj) {
		fabricObj.freeDrawingBrush.width = size;
	});
}

PDFAnnotate.prototype.setColor = function (color) {
	var inst = this;
	inst.color = color;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var o = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if (o) {
		o.set({ fill: color });
		fabricObj.renderAll().setActiveObject(o);
	}
	inst.active_tool = 1;
}

PDFAnnotate.prototype.setBorderColor = function (color) {
	var inst = this;
	inst.borderColor = color;
}

PDFAnnotate.prototype.setFontSize = function (size) {
	this.font_size = size;
}

PDFAnnotate.prototype.setFontFamily = function (fontFamily) {
	this.fontFamily = fontFamily;
	var inst = this;
	var fabricObj = inst.fabricObjects[0]
	var o = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if (o) {
		o.set({ fontFamily: fontFamily });
		fabricObj.renderAll().setActiveObject(o);
	}
	inst.active_tool = 1;
}

PDFAnnotate.prototype.setBorderSize = function (size) {
	this.borderSize = size;
}

PDFAnnotate.prototype.movePage = function (direction) {
	var inst = this;
	let currentIndex = inst.active_canvas;
	pageId = inst.fabricObjects[inst.active_canvas].lowerCanvasEl.getAttribute('id');
	pageId = pageId.match("page-(.*)-canvas")[1];
	element = document.getElementById("page-" + pageId + "-canvas").parentNode;
	var newIndex = 0;
	if (currentIndex == 0 && direction == "up") {
		newIndex = inst.fabricObjects.length - 1;
		document.getElementById("pdf-container").appendChild(element);
	} else if (currentIndex == inst.fabricObjects.length - 1 && direction == "down") {
		newIndex = 0;
		document.getElementById("pdf-container").prepend(element);
	} else if (direction == "down") {
		newIndex = currentIndex + 1;
		document.getElementById("pdf-container").insertBefore(element, element.nextSibling.nextSibling);
	} else if (direction == "up") {
		newIndex = currentIndex - 1;
		document.getElementById("pdf-container").insertBefore(element, element.previousSibling);
	}
	inst.active_canvas = newIndex;
	var newData = array_move(inst.fabricObjects, currentIndex, newIndex);
	inst.fabricObjects = newData;
	localStorage.setItem("pdfData", JSON.stringify(newData));
}

function array_move(arr, old_index, new_index) {
	if (new_index >= arr.length) {
		var k = new_index - arr.length + 1;
		while (k--) {
			arr.push(undefined);
		}
	}
	arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
	return arr;
};

PDFAnnotate.prototype.setBold = function () {
	this.fontWeight = 'bold';
	var inst = this;
	var fabricObj = inst.fabricObjects[0]
	var o = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if (o) {
		o.set({ fontWeight: 'bold' });
	}
	fabricObj.renderAll().setActiveObject(o);
	enableSelector();
}

PDFAnnotate.prototype.removeBold = function () {
	this.fontWeight = 'normal';
	var inst = this;
	var fabricObj = inst.fabricObjects[0]
	var o = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if (o) {
		o.set({ fontWeight: 'normal' });
		fabricObj.renderAll().setActiveObject(o);
	}
}

PDFAnnotate.prototype.clearActivePage = function () {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var bg = fabricObj.backgroundImage;
	if (confirm('Are you sure?')) {
		fabricObj.clear();
		fabricObj.setBackgroundImage(bg, fabricObj.renderAll.bind(fabricObj));
	}
}

PDFAnnotate.prototype.serializePdf = function () {
	var inst = this;
	return JSON.stringify(inst.fabricObjects, null, 4);
}

PDFAnnotate.prototype.enableAddImage = function () {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var canvas = document.createElement('canvas');
	new fabric.Image.fromURL("./logo512.png", function (img) {
		img.set({
			id: 'image_' + 1,
			width: canvas.width / 2,
			height: canvas.height / 2
		});
		fabricObj.add(img).renderAll().setActiveObject(img);
	});
}

PDFAnnotate.prototype.addSignature = function (url) {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var canvas = document.createElement('canvas');
	new fabric.Image.fromURL(url, function (img) {
		img.set({
			id: 'image_' + 1,
			width: canvas.width / 2,
			height: canvas.height / 2
		});
		fabricObj.add(img).renderAll().setActiveObject(img);
	});
}

PDFAnnotate.prototype.addNewImage = function (url) {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var canvas = document.createElement('canvas');
	new fabric.Image.fromURL(url, function (img) {
		img.set({
			angle: 0,
			padding: 10,
			cornersize: 10,
			height: 110,
			width: 110,
		});
		fabricObj.add(img).renderAll().setActiveObject(img);
	});
}
PDFAnnotate.prototype.eraseText = function (url) {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	fabricObj.isDrawingMode = false;
	fabricObj.isDrawingMode = true;
	fabric.PencilBrush.prototype.globalCompositeOperation = "destination-out";
	fabricObj.freeDrawingBrush.color = 'white';
	fabricObj.renderAll();
};

PDFAnnotate.prototype.toggleHighlighter = function (url) {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var o = fabricObj.getActiveObject();
	var fontStyleOb = "";
	if (o.selectionStart > -1) {
		var objectColor = getStyle(o, 'fill');
		fontStyleOb = o.getSelectionStyles()["textBackgroundColor"];
		if (fontStyleOb === "yellow") {
			var selectionStart = 2,
				selectionEnd = 8;
			o.setSelectionStyles({ textBackgroundColor: '', fill: objectColor }, selectionStart, selectionEnd);
		}
		else if (fontStyleOb != "yellow") {
			var selectionStart = 2,
				selectionEnd = 8;
			o.setSelectionStyles({ textBackgroundColor: 'yellow' }, selectionStart, selectionEnd);
		}
		o.set({ dirty: true });
		fabricObj.renderAll();
	}
};
PDFAnnotate.prototype.toggleBlackout = function (url) {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var o = fabricObj.getActiveObject();
	var fontStyleOb = "";
	if (o.selectionStart > -1) {
		var objectColor = getStyle(o, 'fill');
		fontStyleOb = o.getSelectionStyles()["textBackgroundColor"];
		if (fontStyleOb === "black") {
			var selectionStart = 2,
				selectionEnd = 8;
			o.setSelectionStyles({ textBackgroundColor: '', fill: objectColor }, selectionStart, selectionEnd);
		}
		else if (fontStyleOb != "black") {
			var selectionStart = 2,
				selectionEnd = 8;
			o.setSelectionStyles({ textBackgroundColor: 'black', fill: 'black' }, selectionStart, selectionEnd);
		}
		o.set({ dirty: true });
		fabricObj.renderAll();
	}
};

PDFAnnotate.prototype.addDrawSignature = function (url) {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var canvas = document.createElement('canvas');
	new fabric.Image.fromURL(url, function (img) {
		img.set({
			id: 'image_' + 1,
			width: canvas.width / 2,
			height: canvas.height / 2
		});
		fabricObj.add(img).renderAll().setActiveObject(img);
	});
}

PDFAnnotate.prototype.addCrossIcon = function () {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var canvas = document.createElement('canvas');
	new fabric.Image.fromURL("./times-solid.png", function (img) {
		img.set({
			id: 'image_' + 1,
			width: canvas.width / 4,
			height: canvas.height / 4
		});
		fabricObj.add(img).renderAll().setActiveObject(img);
	});
}

PDFAnnotate.prototype.addCircleIcon = function () {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var canvas = document.createElement('canvas');
	new fabric.Image.fromURL("./circle-regular.png", function (img) {
		img.set({
			id: 'image_' + 1,
			width: canvas.width / 4,
			height: canvas.height / 4
		});
		fabricObj.add(img).renderAll().setActiveObject(img);
	});
}

PDFAnnotate.prototype.addCheckIcon = function () {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var canvas = document.createElement('canvas');
	new fabric.Image.fromURL("./check-solid.png", function (img) {
		img.set({
			id: 'image_' + 1,
			width: canvas.width / 4,
			height: canvas.height / 4
		});
		fabricObj.add(img).renderAll().setActiveObject(img);
	});
}


PDFAnnotate.prototype.loadFromJSON = function (jsonData) {
	var inst = this;
	$.each(inst.fabricObjects, function (index, fabricObj) {
		if (jsonData.length > index) {
			fabricObj.loadFromJSON(jsonData[index], function () {
				inst.fabricObjectsData[index] = fabricObj.toJSON()
			})
		}
	})
}

PDFAnnotate.prototype.resizePage = function (page_width, page_height) {
	var inst = this;
	var canvas = inst.fabricObjects[inst.active_canvas];
	canvas.setWidth(page_width);
	canvas.setHeight(page_height);
	$(".canvas-container").css('background', '#fff');
	canvas.renderAll();
}

PDFAnnotate.prototype.addPage = function (pageNumber, jsonData) {
	console.log(jsonData);
	var inst = this
	currentpageMatchingPageId = inst.active_canvas + 1;
	var loadingTask_pre = PDFJS.getDocument(this.url);
	inst.number_of_pages = inst.number_of_pages + 1;
	const current_cans = $(".canvas-container").length;
	// var loadingTask = pageNumber == "" || pageNumber > inst.main_page_numbers ? PDFJS.getDocument("./blank.pdf") :  PDFJS.getDocument(this.url);
	var loadingTask = PDFJS.getDocument("./blank.pdf");
	// if(inst.last_deleted_page == currentpageMatchingPageId){
	// 	loadingTask = PDFJS.getDocument("./blank.pdf");
	// }
	loadingTask.promise.then(function (pdf) {
		var scale = 1.3;
		if (pageNumber == "" || pageNumber > inst.main_page_numbers) {
			pageNumber = 1;
		}
		pageNumber = parseInt(pageNumber);
		pdf.getPage(pageNumber).then(function (page) {
			var viewport = page.getViewport(scale);
			var canvas = document.createElement('canvas');
			document.getElementById(inst.container_id).appendChild(canvas);
			canvas.className = 'pdf-canvas';
			canvas.height = viewport.height;
			canvas.width = viewport.width;
			const newidex = parseInt(current_cans) + 1;
			canvas.id = "page-" + newidex + "-canvas";
			context = canvas.getContext('2d');

			var renderContext = {
				canvasContext: context,
				viewport: viewport
			};
			var renderTask = page.render(renderContext);
			options = {};
			renderTask.then(function () {
				inst.pages_rendered++;
				if (inst.pages_rendered == inst.number_of_pages) {
					var el = $('#' + inst.container_id + ' canvas').last();
					$(el).each(function (index, el) {
						var background = el.toDataURL("image/png");
						var fabricObj = new fabric.Canvas(el.id, {
							freeDrawingBrush: {
								width: 1,
								color: inst.color
							}
						});
						fabric.util.enlivenObjects(jsonData.objects, function (enlivenedObjects) {
							enlivenedObjects.forEach(function (obj, index) {
								fabricObj.add(obj);
							});
							fabricObj.renderAll();
						});
						console.log("fabricObj", fabricObj.toJSON());
						inst.fabricObjects.push(fabricObj);
						var newindex = inst.fabricObjects.length;
						if (typeof options.onPageUpdated == 'function') {
							fabricObj.on('object:added', function () {
								var oldValue = Object.assign(jsonData ? jsonData : {}, inst.fabricObjectsData[newindex - 1]);
								inst.fabricObjectsData[newindex - 1] = fabricObj.toJSON()
								options.onPageUpdated(newindex - 1 + 1, oldValue, inst.fabricObjectsData[newindex - 1])
							})
						}
						fabricObj.setBackgroundImage(background, fabricObj.renderAll.bind(fabricObj));
						$(fabricObj.upperCanvasEl).click(function (event) {
							inst.active_canvas = newindex - 1;
							inst.fabricClickHandler(event, fabricObj);
						});
						fabricObj.on('after:render', function () {
							inst.fabricObjectsData[newindex - 1] = fabricObj.toJSON()
							fabricObj.off('after:render')
						})
					});
				}
			});
		});
	}, function (reason) {
		console.log(reason);
	});
}

PDFAnnotate.prototype.rotatePage = function () {
	var inst = this;
	var o = inst.fabricObjects[inst.active_canvas];
	const rotationValue = o.wrapperEl.style.transform;
	if (rotationValue) {
		const currentRotation = rotationValue.substring(
			rotationValue.lastIndexOf("(") + 1,
			rotationValue.lastIndexOf("deg)")
		);
		let newValue = parseInt(currentRotation) + 90;
		if (newValue == 360) {
			newValue = 0;
		}
		o.wrapperEl.style.transform = "rotate(" + newValue + "deg)";
	} else {
		o.wrapperEl.style.transform = "rotate(90deg)";
	}

}

PDFAnnotate.prototype.addDate = function (event) {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0');
	var yyyy = today.getFullYear();
	today = mm + '/' + dd + '/' + yyyy;
	var text = new fabric.IText(today, {
		fill: inst.color,
		fontSize: 16,
		selectable: true,
		fontFamily: inst.fontFamily,
		fontWeight: 'normal'
	});
	fabricObj.add(text).renderAll().setActiveObject(text);
}

PDFAnnotate.prototype.addWatermark = function (orientation, watermark) {
	var inst = this;
	var fabricObj = [];
	for (let i = 0; i < inst.fabricObjects.length; i++) {
		fabricObj = inst.fabricObjects[i];
		var text = new fabric.IText(watermark, {
			fill: 'black',
			fontSize: 16,
			selectable: true,
			fontFamily: inst.fontFamily,
			fontWeight: inst.fontWeight,
			angle: orientation == 'quarter' ? 315 : orientation == 'half' ? 270 : '',
			opacity: 0.1,
			originX: 'left',
			originY: 'top',
			left: orientation == 'quarter' ? 100 : orientation == 'half' ? $('.canvas-container').width() / 2 : 0,
			top: $('.canvas-container').height() / 2,
			fontSize: 100,
			lineHeight: 1.15
		});
		fabricObj.add(text).renderAll().setActiveObject(text);
	}
}

PDFAnnotate.prototype.deletePage = function () {
	var inst = this;
	var activePage = inst.fabricObjects[inst.active_canvas];
	pageId = activePage.lowerCanvasEl.getAttribute('id');
	pageId = pageId.match("page-(.*)-canvas")[1];
	inst.fabricObjectsData.splice(inst.active_canvas, 1);
	if (activePage) {
		if (confirm('Are you sure you want to delete this page?')) {
			activePage.wrapperEl.remove();
			inst.last_deleted_page = pageId;
		}
	}
}

PDFAnnotate.prototype.duplicatePage = function () {
	var inst = this;
	var activePage = inst.fabricObjects[inst.active_canvas];
	const pageData = activePage.toJSON();
	console.log(pageData);
	var pageId = activePage.lowerCanvasEl.getAttribute('id');
	pageId = pageId.match("page-(.*)-canvas")[1];
	this.addPage(pageId, pageData);
}

PDFAnnotate.prototype.addPickDate = function (date, header_footer, text_align) {
	var inst = this;
	var fabricObj = [];
	var fabricObj;
	for (let i = 0; i < inst.fabricObjects.length; i++) {
		fabricObj = inst.fabricObjects[i];


		const box_width = inst.fabricObjects[i].width;
		const box_height = 60;
		const canvas_height = inst.fabricObjects[i].height;
		var rect = new fabric.Rect({
			width: box_width, height: box_height,
			fill: false, stroke: '#fff',
			lockMovementX: true,
			lockMovementY: true,
		})
		var textAlignVal = 0.5;
		var verticalAlign = 0.5;
		//width = context.measureText(inputText).width;
		var context = fabricObj.getContext("2d");
		var datewidth = context.measureText(date).width;

		var leftAlignVal = 0;
		if (text_align == 1) {
			textAlignVal = 0;
			leftAlignVal += datewidth;
		}
		else if (text_align == 2) {

			textAlignVal = 1;
			leftAlignVal = box_width - datewidth;
		}
		else if (text_align == 3) {
			leftAlignVal = box_width * 0.5;
		}



		//alert(text_align + "text align val " + textAlignVal);

		var text = new fabric.IText(date, {
			fill: inst.color,
			fontSize: inst.font_size,
			selectable: true,
			originX: 'center',
			fontFamily: inst.fontFamily,
			fontWeight: inst.fontWeight,
			originX: 'center', originY: 'center',
			left: leftAlignVal, top: verticalAlign * box_height,
			lockMovementX: true,
			lockMovementY: true,
		});

		var headerFooter = "top";
		var top_margin = 0;
		if (header_footer == 2) {
			headerFooter = "bottom";
			top_margin = canvas_height - (box_height - 5);
		}
		var group = new fabric.Group(
			[rect, text], {
			top: top_margin,
		})

		fabricObj.add(group).renderAll().setActiveObject(rect);



	}
	//var inst = this;
	//var fabricObj = inst.fabricObjects[inst.active_canvas];
	//alert("current canvas width " + inst.fabricObjects[inst.active_canvas].width);

}