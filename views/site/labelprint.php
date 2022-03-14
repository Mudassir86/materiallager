<?php

use yii\helpers\Html;

$this->title = 'Etikettendruck';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
    	<h3>Etikettendruck</h3>
        <h5>Bitte füllen Sie die angezeigten Felder aus</h5>
        <hr class="my-4">
    </div>

     <div class="col-md-6">

         <div class="row">
             <h4 id="title">QZ Tray v<span id="qz-version">0</span></h4>
         </div>

        <form class="form-horizontal" id="labelPrint">
        
        <div class="form-group" has-error>        
            <label for="prufzeichen" class="control-label col-md-2">Prüfzeichen<span class="required">*</span></label>
            <div class="col-md-6" style="position:absolute; left: 120pt;">
                <input type="prufzeichen" class="form-control" id="prufzeichen" required maxlength="3">
            </div>
        </div>

        <div class="form-group">
            <label for="werkstoffbezeichnung" class="control-label col-md-2">Werkstoffbezeichnung<span class="required">*</span></label>
            <div class="col-md-6" style="position:absolute; left: 120pt;">
                <input type="werkstoffbezeichnung" class="form-control" id="werkstoffbezeichnung" required>
            </div>
        </div>

        <div class="form-group">        
            <label for="lagerort" class="control-label col-xs-2">Lagerort<span class="required">*</span></label>
            <div class="col-md-6" style="position:absolute; left: 120pt;">
                <input type="lagerort" class="form-control" id="lagerort" required>
            </div>
        </div>

        <div class="form-group">
            <label for="anzahl" class="control-label col-xs-2">Anzahl</label>
            <div class="col-md">
                <input type="number" value="1" min="1" max="9" maxlength="10" class="form-control-md" id="anzahl">
            </div>
        </div>

    </form>

        <button type="button" class="btn btn-info"  id="printBtn" style="" >PRINT </button>

     </div>

    <div class="col-md-4" style="float: right">
        <div id="qz-connection" class="panel panel-default">
            <div class="panel-heading">
                <button class="close tip" data-toggle="tooltip" title="Launch QZ" id="launch" href="#" onclick="launchQZ();" style="display: none;">
                    <i class="fa fa-external-link"></i>
                </button>
                <h3 class="panel-title">
                    Connection: <span id="qz-status" class="text-muted" style="font-weight: bold;">Unknown</span>
                </h3>
            </div>

            <div class="panel-body">
                <div class="btn-toolbar">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-success" onclick="startConnection();">Connect</button>
                        <button type="button" class="btn btn-warning" onclick="endConnection();">Disconnect</button>
                    </div>
                    <button type="button" class="btn btn-info" onclick="listNetworkDevices();">List Network Info</button>
                </div>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Printer</h3>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <label for="printerSearch">Search:</label>
                    <input type="text" id="printerSearch" value="zebra" class="form-control" />
                </div>
                <div class="form-group">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm" onclick="findPrinter($('#printerSearch').val(), true);">Find Printer</button>
                        <button type="button" class="btn btn-default btn-sm" onclick="findDefaultPrinter(true);">Find Default Printer</button>
                        <button type="button" class="btn btn-default btn-sm" onclick="findPrinters();">Find All Printers</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm" onclick="detailPrinters();">Get Printer Details</button>
                    </div>
                </div>
                <div class="form-group">
                    <label>Current printer:</label>
                    <div id="configPrinter">NONE</div>
                </div>
                <div class="form-group">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm" onclick="setPrinter($('#printerSearch').val());">Set To Search</button>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#askFileModal">Set To File</button>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#askHostModal">Set To Host</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="qz-alert" style="position: left:15; width: 60%; margin: 0 4% 0 36%; z-index: 200;"></div>
        <div id="qz-pin" style="position: fixed; width: 30%; margin: 0 66% 0 4%; z-index: 900;"></div>
    </div>

</div>