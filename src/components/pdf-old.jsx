import React, { PureComponent } from "react";
import { Document, Page, pdfjs } from "react-pdf";
import PdfComponents from "./PdfComponent";
// import "./PDFdemo.css";
import requiredFile from "./OoPdfFormExample.pdf";
import DragResizeContainer from 'react-drag-resize';
pdfjs.GlobalWorkerOptions.workerSrc = `//cdnjs.cloudflare.com/ajax/libs/pdf.js/${pdfjs.version}/pdf.worker.js`;
const layout = [{ key: 'test', x: 0, y: 0, width: 200, height: 100, zIndex: 1 }]

export default class PdfViewer extends PureComponent {
state = {
    numPages: null,
    pageNumber: 1,
    rotate: 0,
    scale: 1
};
onDocumentLoadSuccess = ({ numPages }) => {
    console.log('this function was triggered')
    this.setState({ numPages });
};

canResizable = (isResize) => {
    return { top: isResize, right: isResize, bottom: isResize, left: isResize, topRight: isResize, bottomRight: isResize, bottomLeft: isResize, topLeft: isResize };
};
render() {
    const { pageNumber, scale, pdf } = this.state;
    console.log("pdf", pdf);
    return (
        <React.Fragment>
            <div className="myDoc">
                <div>
                    {/* <PdfComponents /> */}
                </div>
                <div id="ResumeContainer">
                    <div className="canvasStyle">
                    <DragResizeContainer
                        className='resize-container'
                        resizeProps={{ 
                            minWidth: 10, 
                            minHeight: 10, 
                            enable: this.canResizable(true)  
                        }}
                        // onDoubleClick={clickScreen}
                        layout={layout}
                        dragProps={{ disabled: false }}
                        // onLayoutChange={onLayoutChange}
                        scale={scale}
                    >
                    {layout.map((single) => {
                    return (
                        <div key={single.key} className='child-container size-auto border'>text test</div>
                    );
                    })}
                    </DragResizeContainer>
                        <Document
                            className="PDFDocument"
                            file={requiredFile}
                            onLoadError={(error) => {
                                console.log("Load error", error)
                            }}
                            onSourceSuccess={() => {
                                console.log("Source success")
                            }}
                            onSourceError={(error) => {
                                console.error("Source error", error)
                            }}
                            onLoadSuccess={this.onDocumentLoadSuccess}
                        >
                            {window === undefined ? <div>nothing here</div> : <Page
                                pageNumber={pageNumber}
                                className="PDFPage PDFPageOne"
                                scale={scale}
                            >
                            </Page>}
                        </Document>
                    </div>
                </div>
            </div>
        </React.Fragment>
    );
}
}