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
		if (o.selectionStart > -1) {
			fontStyleOb = getStyle(o, 'textDecoration');
			if (fontStyleOb === "underline") {
				var selectionStart = 2,
				selectionEnd = 8;
				o.setSelectionStyles({ textDecoration: '' }, selectionStart, selectionEnd);
			}
			else if (fontStyleOb != "underline") {
				var selectionStart = 2,
				selectionEnd = 8;
				o.setSelectionStyles({ textDecoration: 'underline' }, selectionStart, selectionEnd);
			}
			o.set({ dirty: true });
			fabricObj.renderAll();
		}
	}

	function getStyle(object, styleName) {
		var selecteItemOb = object.getSelectionStyles();
		return selecteItemOb[styleName];
	}

	this.toggleitalicbtnClickHandler = function (event, fabricObj) {
		var o = fabricObj.getActiveObject();
		var fontStyleOb = "";
		if (o.selectionStart > -1) {
			fontStyleOb = getStyle(o, 'fontStyle');
			if (fontStyleOb === "italic") {
				var selectionStart = 2,
					selectionEnd = 8;
				o.setSelectionStyles({ fontStyle: '' }, selectionStart, selectionEnd);
			}
			else if (fontStyleOb != "italic") {
				var selectionStart = 2,
					selectionEnd = 8;
				o.setSelectionStyles({ fontStyle: 'italic' }, selectionStart, selectionEnd);
			}
			o.set({ dirty: true });
			fabricObj.renderAll();
		}
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
	var activeObject = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if (activeObject) {
		activeObject.fontSize = fontSize;
	}
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
	doc.save('sample.pdf');
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
	var fabricObj = inst.fabricObjects[0]
	var o = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if (o.selectionStart > -1) {
		var selectionStart = 2,
			selectionEnd = 8;
		o.setSelectionStyles({ fill: color }, selectionStart, selectionEnd);
	} else {
		o.set({ fill: color });
	}
	fabricObj.renderAll().setActiveObject(o);
}

PDFAnnotate.prototype.setTextColor = function (color) {
	var inst = this;
	
}

PDFAnnotate.prototype.setBorderColor = function (color) {
	var inst = this;
	inst.borderColor = color;
}

PDFAnnotate.prototype.setFontSize = function (size) {
	this.font_size = size;
}

PDFAnnotate.prototype.setBorderSize = function (size) {
	this.borderSize = size;
}

PDFAnnotate.prototype.setBold = function () {
	this.fontWeight = 'bold';
	var inst = this;
	var fabricObj = inst.fabricObjects[0]
	var o = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if (o.selectionStart > -1) {
		var selectionStart = 2,
			selectionEnd = 8;
		o.setSelectionStyles({ fontWeight: 'bold' }, selectionStart, selectionEnd);
	} else {
		o.set({ fontWeight: 'bold' });
	}
	fabricObj.renderAll().setActiveObject(o);
}

PDFAnnotate.prototype.removeBold = function () {
	this.fontWeight = 'normal';
	var inst = this;
	var fabricObj = inst.fabricObjects[0]
	var o = inst.fabricObjects[inst.active_canvas].getActiveObject();
	if (o.selectionStart > -1) {
		var selectionStart = 2,
			selectionEnd = 8;
		o.setSelectionStyles({ fontWeight: 'normal' }, selectionStart, selectionEnd);
	} else {
		o.set({ fontWeight: 'normal' });
	}
	fabricObj.renderAll().setActiveObject(o);
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
