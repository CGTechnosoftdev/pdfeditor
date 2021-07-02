import { PDFDocument, degrees, rgb } from "pdf-lib";
import { useEffect } from "react";
import download from "downloadjs";
import hexToRgbA from "./HexToRGB";

function App() {
    useEffect(() => {
        readDocumentMetadata();
    }, []);

    function _base64ToArrayBuffer(base64) {
        var binary_string = window.atob(base64);
        var len = binary_string.length;
        var bytes = new Uint8Array(len);
        for (var i = 0; i < len; i++) {
            bytes[i] = binary_string.charCodeAt(i);
        }
        return bytes.buffer;
    }

    async function readDocumentMetadata() {
        const url = "http://localhost:3000/OoPdfFormExample.pdf";
        const existingPdfBytes = await fetch(url).then((res) => res.arrayBuffer());

        const pdfDoc = await PDFDocument.load(existingPdfBytes, {
            updateMetadata: false,
        });
        let annotationData = [];
        let data = localStorage.getItem("pdfData");
        data = JSON.parse(data);
        data.map((object) => annotationData.push(object.objects));
        const pages = pdfDoc.getPages();
        // firstPage.setSize(data[0].backgroundImage.width, data[0].backgroundImage.height);
        // firstPage.setHeight(data[0].backgroundImage.height);
        if (annotationData.length > 0) {
            annotationData.map((annotation, index) => {
                let page = pages[index];
                annotation.map((annotate) => {
                    if (annotate.type === "i-text") {
                        page.drawText(annotate.text, {
                            size: annotate.fontSize,
                            color: rgb(0.95, 0.1, 0.1),
                            rotate: degrees(annotate.angle),
                            x: annotate.left,
                            y: page.getHeight() - annotate.top,
                            width: annotate.width,
                            height: annotate.height,
                        });
                    }

                    if (annotate.type === "image") {}

                    if (annotate.type === 'path') {
                        let newPath = [];
                        let completeOldPath = annotate.path;
                        completeOldPath.map((singlePath) => {
                            let thispath = [];
                            singlePath.map((path, index) => {
                                if (index > 1) {
                                    thispath.push(path)
                                } else if (index === 0) {
                                    thispath.push(singlePath[0] + ' ' + singlePath[1])
                                }
                            })
                            newPath.push(thispath);
                        })
                        console.log(newPath.join(' '));
                        newPath = 'M 0,20 L 100,160 Q 130,200 150,120 C 190,-40 200,200 300,150 L 400,90';
                        page.drawSvgPath(newPath, { x: 25, y: page.getHeight() - annotate.top })
                    }
                });
            });
        }
        // const pdfBytes = await pdfDoc.save()
        const pdfBytes = await pdfDoc.save();
        // download(pdfBytes, "pdf-lib_creation_example.pdf", "application/pdf");
        const pdfDataUri = await pdfDoc.saveAsBase64({ dataUri: true });
        document.getElementById("pdf").src = pdfDataUri;
    }

    return ( < iframe id = "pdf"
        style = {
            { width: "100%", height: "100%", position: "fixed" } } > < /iframe>);
    }

    export default App;