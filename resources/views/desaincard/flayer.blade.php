@extends('layouts.layouts_desain')
@section('content')
<div class="row" style="margin-top: 3rem">
    <div class="col-md-1">
        <div id="toolbox" class="btn-group-vertical btn-group-lg" role="group" aria-label="...">
            <button id="add-text" type="button" class="btn btn-default">
                <i class="fa fa-font" aria-hidden="true" title="Add text"></i>
            </button>
            <button id="shapes" type="button" class="btn btn-default">
                <i class="fa fa-object-ungroup" aria-hidden="true" title="Shapes"></i>
            </button>
            <button id="images2" type="button" class="btn btn-default">
                <i class="fa fa-file-image-o" aria-hidden="true" title="Logo"></i>
            </button>
            <button id="images" type="button" class="btn btn-default">
                <i class="fa fa-picture-o" aria-hidden="true" title="Images"></i>
            </button>
            <button id="themes" type="button" class="btn btn-default">
                <i class="fa fa-id-card-o" aria-hidden="true" title="Themes"></i>
            </button>
            <button id="clear" type="button" class="btn btn-default">
                <i class="fa fa-trash-o" aria-hidden="true" title="Clear canvas"></i>
            </button>
            <button id="save" type="button" class="btn btn-default">
                <i class="fa fa-floppy-o" aria-hidden="true" title="Save"></i>
            </button>
            <button id="saveAs" type="button" class="btn btn-default">
                <i class="fa fa-files-o" aria-hidden="true" title="SaveAs"></i>
            </button>
            <button id="download" type="button" class="btn btn-default">
                <i class="fa fa-download" aria-hidden="true" title="Download png"></i>
            </button>
            <button id="downloadpreview" type="button" class="btn btn-default">
                <i class="glyphicon glyphicon-download-alt" aria-hidden="true" title="Download Preview"></i>
            </button>
            <button id="downloadpdf" type="button" class="btn btn-default">
                <i class="glyphicon glyphicon-save-file" aria-hidden="true" title="Download PDF"></i>
            </button>
        </div>
    </div>
    <div class="col-md-9">
        <div class="container" style="width: 900px; height:50px; background: white; border-radius: 5px">
            <div class="row">
                <div class="col-lg-3">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Width:</span>
                        <input id="widthcanvas" type="number" class="form-control" value="">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Height:</span>
                        <input id="heightcanvas" type="number" class="form-control" value="">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon">Color Preview:</span>
                        <select id="colors" class="form-control">
                            <option value="">Color</option>
                            @foreach ($color as $itemcolor)
                            <option value="{{$itemcolor->hex_code}}">{{$itemcolor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-1" style="margin-top: 1rem">
                    <button id="clear2" type="button" class="btn btn-default">
                        <i class="fa fa-trash-o" aria-hidden="true" title="Clear canvas"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="canvas" id="html-content-holder">
            <canvas id=canvas width="1500" height="670"></canvas>
            <div style="height:0px;overflow:hidden">
                <input type="file" id="imgLoader">
            </div>
            <div style="height:0px;overflow:hidden">
                <input type="file" id="upload-bcd">
            </div>
            <script type="text/javascript">
                var canvas = new fabric.Canvas("canvas", {
                    backgroundColor: '#FFFFFF'
                });

            </script>
        </div>
    </div>
    <div class="col-md-2">
        <div id="properties" class="panel panel-default">
            <div class="panel-body">
                <h4 style="color:grey">Properties</h4>
                <div class="input-group" style="display:none;">
                    <span class="input-group-addon" id="basic-addon1">Font:</span>
                    <select class="form-control" id="text-font">
                        <option>Helvetica</option>
                        <option>Arial</option>
                        <option>Arial Black</option>
                        <option>Comic Sans MS</option>
                        <option>Georgia</option>
                        <option>Impact</option>
                        <option>Lucida Sans Unicode</option>
                        <option>Palatino Linotype</option>
                        <option>Tahoma</option>
                        <option>Times New Roman</option>
                        <option>Trebuchet MS</option>
                        <option>Verdana</option>
                    </select>
                </div>
                <div class="input-group" style="display:none;">
                    <span class="input-group-addon" id="basic-addon1">Font Size:</span>
                    <input id="text-fontsize" type="number" class="form-control" value=""
                        aria-describedby="basic-addon1">
                </div>
                <div class="input-group" style="display:none;">
                    <span class="input-group-addon" id="basic-addon1">Font Weight:</span>
                    <select class="form-control" id="text-fontweight">
                        <option selected>normal</option>
                        <option>bold</option>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Width:</span>
                    <input id="width" type="number" class="form-control" value="" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Height:</span>
                    <input id="height" type="number" class="form-control" value="" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Angle:</span>
                    <input id="angle" type="number" class="form-control" value="" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Color:</span>
                    <select id="color" class="form-control" aria-describedby="">
                        <option value="">Color</option>
                        @foreach ($color as $itemcolor)
                        <option value="{{$itemcolor->hex_code}}">{{$itemcolor->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Opacity:</span>
                    <input id="opacity" type="number" class="form-control" value="" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        <!--end of properties panel-->
        <div id="layers" class="panel panel-default">
            <div class="panel-body">
                <h4 style="color:grey">Layers</h4>
                <ul class="background">
                    <li onclick="deneme();">
                        <div class="panel panel-default">
                            <div class="layer panel-body">
                                Background
                                <button id="canvas-props" type="button" class="btn btn-default">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul id="sortable">
                    <!-- Magic happens here-->
                </ul>
            </div>
        </div>
    </div>
</div>
<!--Shapes Panel-->
<div id="shapes-panel" class="footer" style="display:none">
    <div class="panel panel-default" style="height:100%;">
        <div class="panel-body">
            <div class="footer-panel">
                <div class="footer-item">
                    <button id="add-rect" type="button" class="btn btn-default">
                        <i style="color:#e74c3c; font-size:80px;" class="fa fa-stop" aria-hidden="true"></i>
                        <p>Rectangle</p>
                    </button>
                </div>
                <div class="footer-item">
                    <button id="add-circ" type="button" class="btn btn-default">
                        <i style="color:#3498db; font-size:80px;" class="fa fa-circle" aria-hidden="true"></i>
                        <p>Circle</p>
                    </button>
                </div>
                <div class="footer-item">
                    <button id="add-tri" type="button" class="btn btn-default">
                        <i style="color: #2ecc71;font-size:80px;-webkit-transform: rotate(270deg);" class="fa fa-play"
                            aria-hidden="true"></i>
                        <p>Triangle</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end of shapes panel-->
<!--Images Panel-->
<div id="images-panel" class="footer" style="display:none">
    <div class="panel panel-default" style="height:100%;">
        <div class="panel-body">
            <div class="footer-panel">

                <div class="footer-item">
                    <button type="button" class="btn btn-default" onclick="loadImage();">
                        <i style="font-size:50px;" class="fa fa-upload" aria-hidden="true"></i>
                        <h5>Upload Image</h5>
                    </button>
                </div>
                <div class="footer-item">
                    <button type="button" class="btn btn-default">
                        <i style="font-size:50px;" class="fa fa-phone" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="footer-item">
                    <button type="button" class="btn btn-default">
                        <i style="font-size:50px;" class="fa fa-mobile" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="footer-item">
                    <button type="button" class="btn btn-default">
                        <i style="font-size:50px;" class="fa fa-map-marker" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="footer-item">
                    <button type="button" class="btn btn-default">
                        <i style="font-size:50px;" class="fa fa-envelope-o" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="footer-item">
                    <button type="button" class="btn btn-default">
                        <i style="font-size:50px;" class="fa fa-user" aria-hidden="true"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
<!--Images Panel Logo-->
<div id="images-panel-logo" class="footer" style="display:none">
    <div class="panel panel-default" style="height:100%;">
        <div class="panel-body">
            <div class="footer-panel">
                <div class="footer-item">
                    <button type="button" class="btn btn-default" onclick="loadImageLogo();">
                        <i style="font-size:50px;" class="fa fa-upload" aria-hidden="true"></i>
                        <h5>Upload Image</h5>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end of images panel-->
<!--Themes Panel-->
<div id="themes-panel" class="footer">
    <div class="panel panel-default" style="height:100%;">
        <div class="panel-body">
            <div class="footer-panel">
                <div class="footer-item">
                    <button id="load-bcd" type="button" class="btn btn-default">
                        <i style="font-size:50px;" class="fa fa-upload" aria-hidden="true"></i>
                        <h5>Load your design</h5>
                    </button>
                </div>
                <?php $i=0?>
                @foreach ($themes as $itemthemes)
                <div class="footer-item">
                    <button type="button" class="btn btn-default" onclick="loadTemplate('{{$itemthemes->id}}');">
                        <img src="{{$itemthemes->thumnail}}" alt="">
                        <h5>{{$itemthemes->name}}</h5>
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--end of themes panel-->
<script type="text/javascript">
    $(function () {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });

    var edit_canvas = 0;

    var global_id = 1;
    canvas.uniScaleTransform = true;
    canvas.renderAll();

    canvas.on('object:selected', onObjectSelected);

    var selected_obj = new fabric.Object();

    function onObjectSelected(e) {
        onSelectionCleared();
        selected_obj = e.target;
        selectLayer(selected_obj.get('id'));

        if (selected_obj.get('type') == 'i-text') {
            document.getElementById('text-font').parentNode.style.display = "table";
            document.getElementById('text-font').value = e.target.get('fontFamily');
            document.getElementById('text-fontsize').parentNode.style.display = "table";
            document.getElementById('text-fontsize').value = e.target.get('fontSize');
            document.getElementById('text-fontweight').parentNode.style.display = "table";
            document.getElementById('text-fontweight').value = e.target.get('fontWeight');
            document.getElementById('color').value = rgb2hex(e.target.get('fill'));
            document.getElementById('color').parentNode.style.display = "table";
        } else if (selected_obj.get('type') == 'image') {
            document.getElementById('color').parentNode.style.display = "none";
        } else {
            document.getElementById('color').value = e.target.get('fill');
            document.getElementById('color').parentNode.style.display = "table";
        }
        document.getElementById('width').value = Math.round(e.target.get('width') * e.target.get('scaleX'));
        document.getElementById('height').value = Math.round(e.target.get('height') * e.target.get('scaleY'));
        document.getElementById('angle').value = Math.round(e.target.get('angle'));
        document.getElementById('opacity').value = e.target.get('opacity');

    }

    canvas.on('selection:cleared', onSelectionCleared);

    function onSelectionCleared() {

        document.getElementById('text-font').parentNode.style.display = "none";
        document.getElementById('text-fontsize').parentNode.style.display = "none";
        document.getElementById('text-fontweight').parentNode.style.display = "none";
        document.getElementById('color').parentNode.style.display = "table";
        document.getElementById('color').value = "";
        document.getElementById('width').parentNode.style.display = "table";
        document.getElementById('width').value = "";
        document.getElementById('height').parentNode.style.display = "table";
        document.getElementById('height').value = "";
        document.getElementById('angle').parentNode.style.display = "table";
        document.getElementById('angle').value = "";
        document.getElementById('opacity').parentNode.style.display = "table";
        document.getElementById('opacity').value = "";

        var layeritems = document.getElementsByClassName("layeritem");
        for (var i = 0; i < layeritems.length; i++) {
            layeritems[i].childNodes[0].style.backgroundColor = "#fff";
        }

        selected_obj = null;
        edit_canvas = 0;
    }

    canvas.on('object:scaling', onObjectScaled);

    function onObjectScaled(e) {

        document.getElementById('width').value = Math.round(e.target.get('width') * e.target.get('scaleX'));
        document.getElementById('height').value = Math.round(e.target.get('height') * e.target.get('scaleY'));
        document.getElementById('angle').value = Math.round(parseInt(e.target.get('angle')));
        canvas.renderAll();
    }

    canvas.on('object:rotating', onObjectRotated);

    function onObjectRotated(e) {
        document.getElementById('angle').value = e.target.get('angle');
        canvas.renderAll();
    }

    canvas.on('object:added', onObjectAdded);

    function onObjectAdded(e) {
        //Doesn't work :(
        selected_obj = searchObjById(e.target.get('id'));
        canvas.setActiveObject(selected_obj);
        canvas.renderAll();
    }

    $('#text-font').on('input', function () {
        if (selected_obj != null) {
            selected_obj.set("fontFamily", $(this).val());
            canvas.renderAll();
        }
    });

    $('#text-fontsize').on('keydown', function () {
        if (event.which == 13 || event.keyCode == 13) {
            if (selected_obj != null) {
                selected_obj.set("fontSize", parseInt($(this).val()));
                canvas.renderAll();
            }
        }
    });
    $('#text-fontsize').on('blur', function () {
        if (selected_obj == canvas.getActiveObject()) {
            if (selected_obj != null) {
                document.getElementById('text-fontsize').value = selected_obj.get('fontSize');
            }
        }
    });

    $('#text-fontweight').on('input', function () {
        if (selected_obj != null) {
            selected_obj.set("fontWeight", $(this).val());
            canvas.renderAll();
        }
    });

    $('#width').on('keydown', function () {
        if (event.which == 13 || event.keyCode == 13) {
            if (selected_obj != null) {
                selected_obj.set("width", Math.round(parseInt($(this).val())));
                canvas.renderAll();
            }
        }
    });

    $('#width').on('blur', function () {
        if (selected_obj == canvas.getActiveObject() && selected_obj != null) {
            document.getElementById('width').value = Math.round(selected_obj.get('width') * selected_obj
                .get('scaleX'));
        } else {
            document.getElementById('width').value = "";
        }
    });

    $('#height').on('keydown', function () {
        if (event.which == 13 || event.keyCode == 13) {
            if (selected_obj != null) {
                selected_obj.set("height", Math.round(parseInt($(this).val())));
                canvas.renderAll();
            }
        }
    });

    $('#height').on('blur', function () {
        if (selected_obj == canvas.getActiveObject() && selected_obj != null) {
            document.getElementById('height').value = Math.round(selected_obj.get('height') * selected_obj
                .get('scaleY'));
        } else {
            document.getElementById('height').value = "";
        }
    });

    $('#angle').on('keydown', function () {
        if (event.which == 13 || event.keyCode == 13) {
            if (selected_obj != null) {
                selected_obj.setAngle(Math.round(parseInt($(this).val())));
                canvas.renderAll();
            }
        }
    });

    $('#angle').on('blur', function () {

        if (selected_obj == canvas.getActiveObject() && selected_obj != null) {
            document.getElementById('angle').value = Math.round(selected_obj.get('angle'));
        } else {
            document.getElementById('angle').value = "";
        }
    });

    $('#color').change(function () {

        // if (event.which == 13 || event.keyCode == 13) {
        if (edit_canvas == 1) {
            canvas.backgroundColor = $(this).val();
        } else {
            if (selected_obj != null) {
                selected_obj.setColor($(this).val());
            }
        }
        canvas.renderAll();
        // }
    });
    $('#color').on('blur', function () {
        if (selected_obj == canvas.getActiveObject() && selected_obj != null) {
            if (selected_obj.get('type') == 'i-text') {
                document.getElementById('color').value = rgb2hex(selected_obj.get('fill'));
            } else {
                document.getElementById('color').value = selected_obj.get('fill');
            }
        } else if (edit_canvas == 0) {
            document.getElementById('color').value = "";
        }

    });

    $('#opacity').on('keydown', function () {
        if (event.which == 13 || event.keyCode == 13) {
            if (selected_obj != null) {
                selected_obj.set({
                    opacity: $(this).val()
                });
                canvas.renderAll();
            }
        }
    });
    $('#opacity').on('blur', function () {
        if (selected_obj == canvas.getActiveObject() && selected_obj != null) {
            document.getElementById('opacity').value = selected_obj.get('opacity');
        } else {
            document.getElementById('opacity').value = "";
        }
    });


    //Adding Objects

    var canvas_items = []; //This array holds objects' ids added to canvas, ordered by z index.

    $("#add-rect").click(function () {

        var rect = new fabric.Rect({
            left: 100,
            top: 150,
            fill: '#e74c3c',
            width: 200,
            height: 200,
            id: global_id
        });
        onSelectionCleared();
        canvas.add(rect);
        add_layer(global_id);
        global_id++;
        selected_obj = rect;
        canvas.renderAll();
    });

    $("#add-circ").click(function () {

        var circ = new fabric.Circle({
            left: 100,
            top: 150,
            fill: '#3498db',
            radius: 100,
            id: global_id
        });
        canvas.add(circ);
        onSelectionCleared();
        canvas.setActiveObject(circ);
        canvas.renderAll();
        selected_obj = circ;
        add_layer(global_id);
        global_id++;

    });

    $("#add-tri").click(function () {

        var triangle = new fabric.Triangle({
            left: 100,
            top: 150,
            fill: '#2ecc71',
            width: 200,
            height: 200,
            id: global_id
        });
        canvas.add(triangle);
        onSelectionCleared();
        canvas.setActiveObject(triangle);
        canvas.renderAll();
        selected_obj = triangle;
        add_layer(global_id);
        global_id++;

    });

    //Toolbox

    $("#add-text").click(function () {

        var text = new fabric.IText('Click to edit text...', {
            left: 100,
            top: 100,
            fontFamily: "Helvetica",
            fontSize: 32,
            id: global_id
        });
        canvas.add(text);
        onSelectionCleared();
        canvas.renderAll();
        canvas.discardActiveObject();
        selected_obj = text;
        add_layer(global_id);
        global_id++;
    });

    $("#shapes").click(function () {
        document.getElementById('shapes-panel').style.display = "block";
        document.getElementById('images-panel').style.display = "none";
        document.getElementById('images-panel-logo').style.display = "none";
        document.getElementById('themes-panel').style.display = "none";
    });

    $("#images").click(function () {
        document.getElementById('shapes-panel').style.display = "none";
        document.getElementById('images-panel').style.display = "block";
        document.getElementById('images-panel-logo').style.display = "none";
        document.getElementById('themes-panel').style.display = "none";
    });
    $("#images2").click(function () {
        document.getElementById('images-panel').style.display = "none";
        document.getElementById('shapes-panel').style.display = "none";
        document.getElementById('images-panel-logo').style.display = "block";
        document.getElementById('themes-panel').style.display = "none";
    });

    $("#themes").click(function () {
        document.getElementById('shapes-panel').style.display = "none";
        document.getElementById('images-panel').style.display = "none";
        document.getElementById('images-panel-logo').style.display = "none";
        document.getElementById('themes-panel').style.display = "block";
    });

    function loadImage() {
        $("#imgLoader").click();
    }

    function loadImageLogo() {
        $("#imgLoader").click();
    }

    document.getElementById('imgLoader').onchange = function handleImage(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function (f) {
            var data = f.target.result;
            fabric.Image.fromURL(data, function (img) {
                var oImg = img.set({
                    angle: 0,
                    padding: 10,
                    cornersize: 10,
                    id: global_id,
                });
                canvas.centerObject(oImg);
                add_layer(global_id);
                global_id++;
                canvas.add(oImg);
                onSelectionCleared();
                canvas.setActiveObject(oImg);
                canvas.renderAll();
                selected_obj = oImg;
                var dataURL = canvas.toDataURL({
                    format: 'png',
                    quality: 0.8
                });
            });
        };
        reader.readAsDataURL(file);
        $('#imgLoader')[0].value = "";
    }

    $("#clear").click(function () {
        var buttons = document.getElementsByClassName("delete-layer");
        var count = buttons.length;
        for (var i = 0; i < count; i++) {
            buttons[0].parentNode.parentNode.parentNode.remove();
        }
        global_id = 1;
        canvas.clear();
        canvas.backgroundColor = "#FFFFFF";
        onSelectionCleared();
        canvas.renderAll();

    });

    $("#clear2").click(function () {
        var buttons = document.getElementsByClassName("delete-layer");
        var count = buttons.length;
        for (var i = 0; i < count; i++) {
            buttons[0].parentNode.parentNode.parentNode.remove();
        }
        global_id = 1;
        canvas.clear();
        canvas.backgroundColor = "#FFFFFF";
        onSelectionCleared();
        canvas.renderAll();

    });

    $("#save").click(function () {

        var jsonObj = canvas.toJSON(['id']);

        var layersArr = [];
        var layeritems = document.getElementsByClassName("layeritem");
        for (var i = 0; i < layeritems.length; i++) {
            layersArr.push({
                layertitle: layeritems[i].childNodes[0].childNodes[0].childNodes[0].textContent,
                id: layeritems[i].getAttribute('id')
            });
        }
        jsonObj.Layers = layersArr;

        var json = JSON.stringify(jsonObj);
        let _url = '/themes/store';
        let _token = $('meta[name="csrf-token"]').attr('content');
        var dataURL = canvas.toDataURL();

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token,
                themes: json,
                imagess: dataURL,
                choices: 'flayer',
                title: '{{$title}}',
            },
            success: function (hasil) {
                // console.log(hasil.data)
                if (hasil.success == 200) {
                    alert('Theme Success Save')
                }
            }
        })
    });
    $("#saveAs").click(function () {

        var jsonObj = canvas.toJSON(['id']);

        var layersArr = [];
        var layeritems = document.getElementsByClassName("layeritem");
        for (var i = 0; i < layeritems.length; i++) {
            layersArr.push({
                layertitle: layeritems[i].childNodes[0].childNodes[0].childNodes[0].textContent,
                id: layeritems[i].getAttribute('id')
            });
        }
        jsonObj.Layers = layersArr;

        var json = JSON.stringify(jsonObj);
        var _id = $(this).data('id')
        let _url = '/themes/update/';
        let _token = $('meta[name="csrf-token"]').attr('content');
        var dataURL = canvas.toDataURL();

        $.ajax({
            type: 'POST',
            url: _url + _id,
            data: {
                _token: _token,
                themes: json,
                imagess: dataURL,
            },
            success: function (hasil) {
                // console.log(hasil.data)
                if (hasil.success == 200) {
                    alert('Theme Success SaveAs')
                }
            }
        })
    });

    $('#widthcanvas').val('1500')
    $('#heightcanvas').val('670')

    $('#widthcanvas').keyup(function () {
        var widthcanvas = $('.upper-canvas').attr('width');
        var heightcamvas = $('.upper-canvas').attr('height');
        var width = $(this).val();
        var height = $('#heightcanvas').val();
        if (widthcanvas == '1500' && heightcamvas == '670') {
            $('.upper-canvas').attr('width', width);
            $('.canvas-container').attr('width', width);
            $('#canvas').attr('width', width);
        } else {
            $('.upper-canvas').attr('width', width);
            $('.canvas-container').attr('width', width);
            $('#canvas').attr('width', width);
        }
    })
    $('#heightcanvas').keyup(function () {
        var widthcanvas = $('.upper-canvas').attr('width');
        var heightcamvas = $('.upper-canvas').attr('height');
        var width = $('#widthcanvas').val();
        var height = $(this).val();
        if (widthcanvas == '1500' && heightcamvas == '670') {
            $('.upper-canvas').attr('height', height);
            $('.canvas-container').attr('height', height);
            $('#canvas').attr('height', height);
        } else if (widthcanvas == width && heightcamvas == '670') {
            $('.upper-canvas').attr('height', height);
            $('.canvas-container').attr('height', height);
            $('#canvas').attr('height', height);
        } else {
            $('.upper-canvas').attr('height', height);
            $('.canvas-container').attr('height', height);
            $('#canvas').attr('height', height);
        }
    })

    $("#load-bcd").click(function () {
        $("#upload-bcd").click();
    });

    $("#upload-bcd").change(function (e) {
        onChange(e);
    });

    function onChange(event) {
        var reader = new FileReader();
        reader.onload = onReaderLoad;
        reader.readAsText(event.target.files[0]);
    }


    function onReaderLoad(event) {
        var obj = JSON.parse(event.target.result);
        $("#upload-bcd")[0].value = "";
        $("#clear").click();

        global_id = 1;
        for (var i = 0; i < obj.Layers.length; i++) {
            add_layer(obj.Layers[i].id, true);
            if (global_id <= obj.Layers[i].id) {
                global_id = obj.Layers[i].id;
            }
        }
        global_id++;
        delete obj.Layers;

        canvas.loadFromJSON(obj);
        canvas.renderAll();

    }

    $("#download").click(function () {
        canvas.discardActiveObject();
        canvas.renderAll();
        $("#canvas").get(0).toBlob(function (blob) {
            saveAs(blob, "my-business-card.png");
        });
    });

    $("#downloadpreview").click(function () {
        var colorbackgroundcanvas = $('#colors').val()
        console.log(colorbackgroundcanvas);
        html2canvas(document.getElementById("html-content-holder"), {
            allowTaint: true,
            useCORS: true,
            backgroundColor: colorbackgroundcanvas.toLowerCase(),
            width: 2000,
            height: 1000,
            x: -250,
            y: -150,
        }).then(function (canvass) {
            var anchorTag = document.createElement("a");
            document.body.appendChild(anchorTag);
            anchorTag.download = "filename.jpg";
            anchorTag.href = canvass.toDataURL();
            anchorTag.target = '_blank';
            anchorTag.click();
        });
    });

    $("#downloadpdf").click(function () {
        var context = canvas.getContext('2d');
        var width = $('#widthcanvas').val();
        var height = $('#heightcanvas').val();

        // draw a blue cloud
        context.beginPath();
        context.moveTo(170, 80);
        context.bezierCurveTo(130, 100, 130, 150, 230, 150);
        context.bezierCurveTo(250, 180, 320, 180, 340, 150);
        context.bezierCurveTo(420, 150, 420, 120, 390, 100);
        context.bezierCurveTo(430, 40, 370, 30, 340, 50);
        context.bezierCurveTo(320, 5, 250, 20, 250, 50);
        context.bezierCurveTo(200, 5, 150, 20, 170, 80);
        context.closePath();
        context.lineWidth = 5;
        context.fillStyle = '#8ED6FF';
        context.fill();
        context.strokeStyle = '#0000ff';
        context.stroke();
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        const doc = new jsPDF();
        doc.addImage(imgData, "PNG", 15, 20, 180, 80);
        doc.save("a4.pdf");
    });
    //Layer Operations

    $("#canvas-props").click(function () {
        canvas.discardActiveObject();
        canvas.renderAll();
        edit_canvas = 1;

        document.getElementById('text-font').parentNode.style.display = "none";
        document.getElementById('text-fontsize').parentNode.style.display = "none";
        document.getElementById('width').parentNode.style.display = "none";
        document.getElementById('height').parentNode.style.display = "none";
        document.getElementById('angle').parentNode.style.display = "none";
        document.getElementById('opacity').parentNode.style.display = "none";

        document.getElementById('color').value = canvas.backgroundColor;

    });


    function add_layer(id, loading) {

        var li = document.createElement("LI");
        li.setAttribute('id', id);
        li.setAttribute('class', 'layeritem');
        var div = document.createElement("DIV");
        div.setAttribute('class', 'panel panel-default');
        var innerdiv = document.createElement("DIV");
        innerdiv.setAttribute('class', 'layer panel-body');
        var layer_name = document.createTextNode("Layer " + id);
        var span = document.createElement("SPAN");
        span.setAttribute('for', 'layer' + id);
        span.setAttribute('class', 'clickMe');
        var input = document.createElement("INPUT");
        input.setAttribute('type', 'text');
        input.setAttribute('value', '');
        input.setAttribute('id', 'layer' + id);
        input.setAttribute('class', 'blur');
        input.style.display = "none";
        var delete_btn = document.createElement("BUTTON");
        delete_btn.setAttribute('id', id);
        delete_btn.setAttribute('type', 'button');
        delete_btn.setAttribute('class', 'delete-layer btn btn-default');
        var i = document.createElement("I");
        i.setAttribute('class', 'fa fa-trash');
        i.setAttribute('aria-hidden', 'true');

        delete_btn.appendChild(i);
        span.appendChild(layer_name);
        innerdiv.appendChild(span);
        innerdiv.appendChild(input);
        innerdiv.appendChild(delete_btn);
        div.appendChild(innerdiv);
        li.appendChild(div);
        if (loading == true) {
            document.getElementById('sortable').appendChild(li);
        } else {
            document.getElementById('sortable').insertBefore(li, document.getElementById('sortable').firstChild);
        }

        $('.clickMe').click(function () {
            "use strict";
            $(this).hide();
            $('#' + $(this).attr('for'))
                .val($(this).text())
                .toggleClass("form-control")
                .show()
                .focus();
        });

        $('.blur').blur(function () {
            "use strict";
            $(this)
                .hide()
                .toggleClass("form-control");
            $('span[for=' + (this).id + ']')
                .text($(this).val())
                .show();
        });

        var layeritems = document.getElementsByClassName("layeritem");
        for (var i = 0; i < layeritems.length; i++) {
            layeritems[i].onclick = function () {
                selected_obj = searchObjById(this.id);
                selectLayer(selected_obj.get('id'));
                canvas.setActiveObject(selected_obj);
                canvas.renderAll();
            };
        }

        var buttons = document.getElementsByClassName("delete-layer");
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].onclick = function () {
                this.parentNode.parentNode.parentNode.remove();
                canvas.remove(searchObjById(this.id));
                canvas.renderAll();
            };
        }
    }

    function searchObjById(id) {
        var objs = canvas.getObjects();
        for (var i = 0; i < objs.length; i++) {
            if (objs[i].get('id') == id) {
                return objs[i];
            }
        }
    }

    //Delete layer through keyboard
    $('html').keyup(function (e) {
        if (e.keyCode == 46) {
            if (canvas.getActiveObject().get('type') != 'i-text') {
                var buttons = document.getElementsByClassName("delete-layer");
                for (var i = 0; i < buttons.length; i++) {
                    if (buttons[i].getAttribute("id") == canvas.getActiveObject().get('id')) {
                        buttons[i].parentNode.parentNode.parentNode.remove();
                    }
                }
                canvas.remove(canvas.getActiveObject());
            }
        }
    });

    //Layer Sort Z-index
    $(document).ready(function () {
        $("#sortable").sortable({
            stop: function (event, ui) {
                canvas_items = $("#sortable").sortable('toArray', {
                    attribute: "id"
                });
                canvas_items.reverse();
                for (var i = 0; i < canvas_items.length; i++) {
                    canvas.moveTo(searchObjById(canvas_items[i]), i + 1);
                }
            }
        });
    });

    $('#shapes-panel').click(function () {

        canvas.discardActiveObject();
        canvas.renderAll();
    });
    $('#images-panel').click(function () {

        canvas.discardActiveObject();
        canvas.renderAll();
    });
    $('#images-panel-logo').click(function () {

        canvas.discardActiveObject();
        canvas.renderAll();
    });
    $('#themes-panel').click(function () {

        canvas.discardActiveObject();
        canvas.renderAll();
    });

    //Selected objects layer gets highlighted
    function selectLayer(id) {
        var layeritems = document.getElementsByClassName("layeritem");
        for (var i = 0; i < layeritems.length; i++) {
            if (id == layeritems[i].getAttribute('id')) {
                layeritems[i].childNodes[0].style.backgroundColor = "#eee";
            }
        }
    }

    //RGB to HEX
    function rgb2hex(rgb) {
        rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
        return (rgb && rgb.length === 4) ? "#" +
            ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : '';
    }

    function loadTemplate(template) {
        let _url = '/themes/loadthemes/';
        let _token = $('meta[name="csrf-token"]').attr('content');
        $('#saveAs').attr('data-id',template)

        $.ajax({
            type: 'POST',
            url: _url + template,
            data: {
                _token: _token
            },
            success: function (hasil) {
                var obj = JSON.parse(hasil.theme.themes)

                $("#clear").click();

                global_id = 1;
                for (var i = 0; i < obj.Layers.length; i++) {
                    add_layer(obj.Layers[i].id, true);
                    if (global_id <= obj.Layers[i].id) {
                        global_id = obj.Layers[i].id;
                    }
                }
                global_id++;
                delete obj.Layers;

                canvas.loadFromJSON(obj);
                canvas.renderAll();
                obj = "";
            }
        })
    }
</script>
@endsection
