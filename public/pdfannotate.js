/**
 * PDFAnnotate v1.0.0
 * Author: Ravisha Heshan
 */

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
	var inst = this;

	var loadingTask = PDFJS.getDocument(this.url);
	loadingTask.promise.then(function (pdf) {
		var scale = 1.3;
		inst.number_of_pages = pdf.pdfInfo.numPages;

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
		if(o){
			fontStyleOb = getStyle(o, 'textDecoration');
			if (fontStyleOb === "underline") {
				o.set({ textDecoration: '' });
			}
			else if (fontStyleOb != "underline") {
				o.set({ textDecoration: 'underline' });
			}
			o.set({ dirty: true });
			fabricObj.renderAll();
		}
		inst.active_tool = 1;
	}

	function getStyle(object, styleName) {
		var selecteItemOb = object;
		return selecteItemOb[styleName];
	}

	this.toggleitalicbtnClickHandler = function (event, fabricObj) {
		var o = fabricObj.getActiveObject();
		var fontStyleOb = "";
		if(o){
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
				fontWeight: inst.fontWeight
			});
			fabricObj.add(text);
			inst.active_tool = 0;
		}
	}
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

PDFAnnotate.prototype.savePdf = function () {
	var inst = this;
	var doc = new jsPDF();
	$.each(inst.fabricObjects, function (index, fabricObj) {
		if (index != 0) {
			doc.addPage();
			doc.setPage(index + 1);
		}
		doc.addImage(fabricObj.toDataURL(), 'png', 0, 0);
	});
	var d = new Date();
	const hr = d.getHours();
	const min = d.getMinutes();
	const sec = d.getSeconds();
	const fileName = "file"+hr+min+sec;
	localStorage.setItem("pdfFile", fileName);
	doc.save(fileName+'.pdf');
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
	if(o){
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

PDFAnnotate.prototype.setFontFamily = function(fontFamily){
	this.fontFamily = fontFamily;
	var inst = this;
	var fabricObj = inst.fabricObjects[0]
	var o = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if(o){
		o.set({ fontFamily: fontFamily });
		fabricObj.renderAll().setActiveObject(o);
	}
	inst.active_tool = 1;
}

PDFAnnotate.prototype.setBorderSize = function (size) {
	this.borderSize = size;
}

PDFAnnotate.prototype.movePage=function(direction){
	var inst = this;
	let currentIndex = inst.active_canvas;
		pageId = inst.fabricObjects[inst.active_canvas].lowerCanvasEl.getAttribute('id');
		pageId = pageId.match("page-(.*)-canvas")[1];
		element = document.getElementById("page-"+pageId+"-canvas").parentNode;
	var newIndex = 0;
	if(currentIndex == 0 && direction == "up"){
		newIndex = inst.fabricObjects.length-1;
		document.getElementById("pdf-container").appendChild(element);
	} else if(currentIndex == inst.fabricObjects.length-1 && direction == "down") {
		newIndex = 0;
		document.getElementById("pdf-container").prepend(element);
	} else if(direction == "down" ) {
		newIndex = currentIndex+1;
		document.getElementById("pdf-container").insertBefore(element, element.nextSibling.nextSibling);
	} else if(direction == "up"){
		newIndex = currentIndex-1;
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
	if(o){
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
	if(o){
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

PDFAnnotate.prototype.addSignature = function(url){
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

PDFAnnotate.prototype.addDrawSignature = function(url){
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

PDFAnnotate.prototype.addCrossIcon = function(){
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

PDFAnnotate.prototype.addCircleIcon = function(){
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

PDFAnnotate.prototype.addCheckIcon = function(){
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

PDFAnnotate.prototype.addPage = function(pageNumber, jsonData){
	var inst = this;
	inst.number_of_pages = inst.number_of_pages+1;
	const current_cans = $(".canvas-container").length;
	var loadingTask = pageNumber != "" ? PDFJS.getDocument(this.url) : PDFJS.getDocument("./blank.pdf");
	loadingTask.promise.then(function (pdf) {
		var scale = 1.3;
		if(pageNumber == ""){
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
				const newidex= parseInt(current_cans)+1;
				canvas.id = "page-"+newidex+"-canvas";
				context = canvas.getContext('2d');

				var renderContext = {
					canvasContext: context,
					viewport: viewport
				};
				var renderTask = page.render(renderContext);
					options = {};
				renderTask.then(function () {
					inst.pages_rendered++;
					if (inst.pages_rendered == inst.number_of_pages){
						var el = $('#' + inst.container_id + ' canvas').last();
						$(el).each(function (index, el) {
							var background = el.toDataURL("image/png");
							var fabricObj = new fabric.Canvas(el.id, {
								freeDrawingBrush: {
									width: 1,
									color: inst.color
								}
							});
							inst.fabricObjects.push(fabricObj);
							var newindex = inst.fabricObjects.length;
							if (typeof options.onPageUpdated == 'function') {
								fabricObj.on('object:added', function () {
									var oldValue = Object.assign(jsonData ? jsonData : {}, inst.fabricObjectsData[newindex-1]);
									inst.fabricObjectsData[newindex-1] = fabricObj.toJSON()
									options.onPageUpdated(newindex-1 + 1, oldValue, inst.fabricObjectsData[newindex-1])
								})
							}
							fabricObj.setBackgroundImage(background, fabricObj.renderAll.bind(fabricObj));
							$(fabricObj.upperCanvasEl).click(function (event) {
								inst.active_canvas = newindex-1;
								inst.fabricClickHandler(event, fabricObj);
							});
							fabricObj.on('after:render', function () {
								inst.fabricObjectsData[newindex-1] = fabricObj.toJSON()
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

PDFAnnotate.prototype.rotatePage = function(){
	var inst = this;
	var o = inst.fabricObjects[inst.active_canvas];
	const rotationValue = o.wrapperEl.style.transform;
	if(rotationValue){
		const currentRotation = rotationValue.substring(
			rotationValue.lastIndexOf("(") + 1, 
			rotationValue.lastIndexOf("deg)")
		);
		let newValue = parseInt(currentRotation)+90;
		if(newValue == 360){
			newValue = 0;
		}
		o.wrapperEl.style.transform = "rotate("+newValue+"deg)";
	} else {
		o.wrapperEl.style.transform = "rotate(90deg)";
	}
	
}

PDFAnnotate.prototype.addDate = function(event){
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
		fontWeight: inst.fontWeight
	});
	fabricObj.add(text).renderAll().setActiveObject(text);
}

PDFAnnotate.prototype.addWatermark = function(orientation, watermark){
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
			left: orientation == 'quarter' ? 100 : orientation == 'half' ? $('.canvas-container').width()/2 : 0,
			top: $('.canvas-container').height()/2,
			fontSize: 100,
			lineHeight: 1.15
		});
		fabricObj.add(text).renderAll().setActiveObject(text);
	}
}

PDFAnnotate.prototype.deletePage = function(){
	var inst = this;
	var activePage = inst.fabricObjects[inst.active_canvas];
		pageId = activePage.lowerCanvasEl.getAttribute('id');
		pageId = pageId.match("page-(.*)-canvas")[1];
		inst.fabricObjectsData.splice(inst.active_canvas, 1);
	if (activePage) {
		if (confirm('Are you sure you want to delete page number '+pageId+' ?')) activePage.wrapperEl.remove();
	}	
}

PDFAnnotate.prototype.duplicatePage = function(){
	var inst = this;
	var activePage = inst.fabricObjects[inst.active_canvas];
	const pageData = activePage.toJSON();
	var pageId = activePage.lowerCanvasEl.getAttribute('id');
	pageId = pageId.match("page-(.*)-canvas")[1];
	this.addPage(pageId, pageData);
}

PDFAnnotate.prototype.addPickDate = function (date, header_footer, text_align) {
	var inst = this;
	var fabricObj = inst.fabricObjects[inst.active_canvas];
	//alert("current canvas width " + inst.fabricObjects[inst.active_canvas].width);
	const box_width = inst.fabricObjects[inst.active_canvas].width;
	const box_height = 60;
	const canvas_height = inst.fabricObjects[inst.active_canvas].height;
	var rect = new fabric.Rect({
		width: box_width, height: box_height,
		fill: false, stroke: '#fff',
	})
	var textAlignVal = 0.5;
	var verticalAlign = 0.45;
	if (text_align == 1)
		textAlignVal = 0.05;
	else if (text_align == 2)
		textAlignVal = 0.95;


	//alert(text_align + "text align val " + textAlignVal);

	var text = new fabric.IText(date, {
		fill: inst.color,
		fontSize: inst.font_size,
		selectable: true,
		originX: 'center',
		fontFamily: inst.fontFamily,
		fontWeight: inst.fontWeight,
		originX: 'center', originY: 'center',
		left: textAlignVal * box_width, top: verticalAlign * box_height,
	});

	var headerFooter = "top";
	var top_margin = 0;
	if (header_footer == 2) {
		headerFooter = "bottom";
		top_margin = canvas_height - box_height;
	}
	var group = new fabric.Group(
		[rect, text], {
		top: top_margin,
	})

	fabricObj.add(group).renderAll().setActiveObject(text);
}