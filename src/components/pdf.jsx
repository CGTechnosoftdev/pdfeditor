import React, { Component } from 'react'

export default class PdfViewr extends Component{
    constructor(props){
        super(props);
    }

    render() {
        return (
            <div>
                <div className="toolbar">
                <div className="tool">
                    <span>PDFJS + FabricJS + jsPDF</span>
                </div>
                <div className="tool">
                    <label htmlFor="">Brush size</label>
                    <input type="number" onChange={(event)=>this.setState({brushSize: event.target.value})} className="form-control text-right" value="1" id="brush-size" max="50" />
                </div>
                <div className="tool">
                    <label htmlFor="">Font size</label>
                    <select id="font-size" value={"16"} onChange={(event)=>this.setState({fontSize:event.target.value})} className="form-control">
                        <option value="10">10</option>
                        <option value="12">12</option>
                        <option value="16">16</option>
                        <option value="18">18</option>
                        <option value="24">24</option>
                        <option value="32">32</option>
                        <option value="48">48</option>
                        <option value="64">64</option>
                        <option value="72">72</option>
                        <option value="108">108</option>
                    </select>
                </div>
                <div className="tool">
                    <button className="color-tool active" style={{backgroundColor: '#212121'}}></button>
                    <button className="color-tool" style={{backgroundColor: 'red'}}></button>
                    <button className="color-tool" style={{backgroundColor: 'blue'}}></button>
                    <button className="color-tool" style={{backgroundColor: 'green'}}></button>
                    <button className="color-tool" style={{backgroundColor: 'yellow'}}></button>
                </div>
                <div className="tool">
                    <button className="tool-button active"><i className="fa fa-hand-paper-o" title="Free Hand" click="enableSelector(event)"></i></button>
                </div>
                <div className="tool">
                    <button className="tool-button"><i className="fa fa-pencil" title="Pencil" click="enablePencil(event)"></i></button>
                </div>
                <div className="tool">
                    <button className="tool-button"><i className="fa fa-font" title="Add Text" click="enableAddText(event)"></i></button>
                </div>
                <div className="tool">
                    <button className="tool-button"><i className="fa fa-long-arrow-right" title="Add Arrow" click="enableAddArrow(event)"></i></button>
                </div>
                <div className="tool">
                    <button className="tool-button"><i className="fa fa-square-o" title="Add rectangle" click="enableRectangle(event)"></i></button>
                </div>
                <div className="tool">
                    <button className="btn btn-danger btn-sm" click="deleteSelectedObject(event)"><i className="fa fa-trash"></i></button>
                </div>
                <div className="tool">
                    <button className="btn btn-danger btn-sm" click="clearPage()">Clear Page</button>
                </div>
                <div className="tool">
                    <button className="btn btn-info btn-sm" click="showPdfData()">{}</button>
                </div>
                <div className="tool">
                    <button className="btn btn-light btn-sm" click="savePDF()"><i className="fa fa-save"></i> Save</button>
                </div>
            </div>
            <div id="pdf-container"></div>

            <div className="modal fade" id="dataModal" tabIndex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
                <div className="modal-dialog modal-lg" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title" id="dataModalLabel">PDF annotation data</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <pre className="prettyprint lang-json linenums">
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        )
    }
}