/// Authentication setup ///
qz.security.setCertificatePromise(function(resolve, reject) {
    //Preferred method - from server
        fetch("../js/qztray/cert.pem", {cache: 'no-store', headers: {'Content-Type': 'text/plain'}})
          .then(function(data) { data.ok ? resolve(data.text()) : reject(data.text()); });

});

/// Connection ///
function launchQZ() {
    if (!qz.websocket.isActive()) {
        window.location.assign("qz:launch");
        //Retry 5 times, pausing 1 second between each attempt
        startConnection({ retries: 5, delay: 1 });
    }
}

function startConnection(config) {
    if (!qz.websocket.isActive()) {
        updateState('Waiting', 'default');

        qz.websocket.connect(config).then(function() {
            updateState('Active', 'success');
            findVersion();
        }).catch(handleConnectionError);
    } else {
        displayMessage('An active connection with QZ already exists.', 'alert-warning');
    }
}

function endConnection() {
    if (qz.websocket.isActive()) {
        qz.websocket.disconnect().then(function() {
            updateState('Inactive', 'default');
        }).catch(handleConnectionError);
    } else {
        displayMessage('No active connection with QZ exists.', 'alert-warning');
    }
}

function findPrinter(query, set) {
    $("#printerSearch").val(query);
    qz.printers.find(query).then(function(data) {
        displayMessage("<strong>Found:</strong> " + data);
        if (set) { setPrinter(data); }
    }).catch(displayError);
}

function findDefaultPrinter(set) {
    qz.printers.getDefault().then(function(data) {
        displayMessage("<strong>Found:</strong> " + data);
        if (set) { setPrinter(data); }
    }).catch(displayError);
}

function findPrinters() {
    qz.printers.find().then(function(data) {
        var list = '';
        for(var i = 0; i < data.length; i++) {
            list += "&nbsp; " + data[i] + "<br/>";
        }

        displayMessage("<strong>Available printers:</strong><br/>" + list, null, 15000);
    }).catch(displayError);
}

function detailPrinters() {
    qz.printers.details().then(function(data) {
        var list = '';
        for(var i = 0; i < data.length; i++) {
            list += "<li>" + (data[i].default ? "* " : "") + data[i].name + "<ul>" +
                "<li><strong>Driver:</strong> " + data[i].driver + "</li>" +
                "<li><strong>Density:</strong> " + data[i].density + "dpi</li>" +
                "<li><strong>Connection:</strong> " + data[i].connection + "</li>" +
                (data[i].trays ? "<li><strong>Trays:</strong> " + data[i].trays + "</li>" : "") +
                "</ul></li>";
        }

        pinMessage("<strong>Printer details:</strong><br/><ul>" + list + "</ul>");
    }).catch(displayError);
}

function listNetworkDevices() {
    var listItems = function(obj) {
        var html = '';
        var labels = { mac: 'MAC', ip: 'IP', up: 'Up', ip4: 'IPv4', ip6: 'IPv6', primary: 'Primary' };

        Object.keys(labels).forEach(function(key) {
            if (!obj.hasOwnProperty(key)) { return; }
            if (key !== 'ip' && obj[key] == obj['ip']) { return; }

            var value = obj[key];
            if (key === 'mac') { value = obj[key].match(/.{1,2}/g).join(':'); }
            if (typeof obj[key] === 'object') { value = value.join(', '); }

            html += '<li><strong>' + labels[key] + ':</strong> <code>' + value + '</code></li>';
        });

        return html;
    };

    qz.networking.devices().then(function(data) {
        var list = '';
        var hostname = '';
        var username = '';
        for(var i = 0; i < data.length; i++) {
            var info = data[i];

            if (i == 0) {
                list += "<li>" +
                    "   <strong>Hostname:</strong> <code>" + info.hostname + "</code>" +
                    "</li>" +
                    "<li>" +
                    "   <strong>Username:</strong> <code>" + info.username + "</code>"
                "</li>";
            }
            list += "<li>" +
                "   <strong>Interface:</strong> <code>" + (info.name || "UNKNOWN") + (info.id ? "</code> (<code>" + info.id + "</code>)" : "</code>") +
                "   <ul>" + listItems(info) + "</ul>" +
                "</li>";
        }

        pinMessage("<strong>Network details:</strong><ul>" + list + "</ul>");
    }).catch(displayError);
}

function displayMessage(msg, css, time) {
    if (css == undefined) { css = 'alert-info'; }

    var timeout = setTimeout(function() { $('#' + timeout).alert('close'); }, time ? time : 5000);

    var alert = $("<div/>").addClass('alert alert-dismissible fade in ' + css)
        .css('max-height', '20em').css('overflow', 'auto')
        .attr('id', timeout).attr('role', 'alert');
    alert.html("<button type='button' class='close' data-dismiss='alert'>&times;</button>" + msg);

    $("#qz-alert").append(alert);
}

function displayError(err) {
    console.error(err);
    displayMessage(err, 'alert-danger');
}

function pinMessage(msg, id, css) {
    if (css == undefined) { css = 'alert-info'; }

    var alert = $("<div/>").addClass('alert alert-dismissible fade in ' + css)
        .css('max-height', '20em').css('overflow', 'auto').attr('role', 'alert')
        .html("<button type='button' class='close' data-dismiss='alert'>&times;</button>");

    var text = $("<div/>").html(msg);
    if (id != undefined) { text.attr('id', id); }

    alert.append(text);

    $("#qz-pin").append(alert);
}

function updateState(text, css) {
    $("#qz-status").html(text);
    $("#qz-connection").removeClass().addClass('panel panel-' + css);

    if (text === "Inactive" || text === "Error") {
        $("#launch").show();
    } else {
        $("#launch").hide();
    }
}

var qzVersion = 0;
function findVersion() {
    qz.api.getVersion().then(function(data) {
        $("#qz-version").html(data);
        qzVersion = data;
    }).catch(displayError);
}

function includedValue(element, value) {
    if (value != null) {
        return value;
    } else if (element.hasClass("dirty")) {
        return element.val();
    } else {
        return undefined;
    }
}

/// QZ Config ///
var cfg = null;
function getUpdatedConfig(cleanConditions) {
    if (cfg == null) {
        cfg = qz.configs.create(null);
    }

    updateConfig(cleanConditions || {});
    return cfg
}

function updateConfig(cleanConditions) {
    var pxlSize = null;
    if (isChecked($("#pxlSizeActive"), cleanConditions['pxlSizeActive'])) {
        pxlSize = {
            width: $("#pxlSizeWidth").val(),
            height: $("#pxlSizeHeight").val()
        };
    }

    var pxlBounds = null;
    if (isChecked($("#pxlBoundsActive"), cleanConditions['pxlBoundsActive'])) {
        pxlBounds = {
            x: $("#pxlBoundX").val(),
            y: $("#pxlBoundY").val(),
            width: $("#pxlBoundWidth").val(),
            height: $("#pxlBoundHeight").val()
        };
    }

    var pxlDensity = includedValue($("#pxlDensity"));
    if (isChecked($("#pxlDensityAsymm"), cleanConditions['pxlDensityAsymm'])) {
        pxlDensity = {
            cross: $("#pxlCrossDensity").val(),
            feed: $("#pxlFeedDensity").val()
        };
    }

    var pxlMargins = includedValue($("#pxlMargins"));
    if (isChecked($("#pxlMarginsActive"), cleanConditions['pxlMarginsActive'])) {
        pxlMargins = {
            top: $("#pxlMarginsTop").val(),
            right: $("#pxlMarginsRight").val(),
            bottom: $("#pxlMarginsBottom").val(),
            left: $("#pxlMarginsLeft").val()
        };
    }

    var copies = 1;
    var jobName = null;
    if ($("#rawTab").hasClass("active")) {
        copies = includedValue($("#rawCopies"));
        jobName = includedValue($("#rawJobName"));
    } else {
        copies = includedValue($("#pxlCopies"));
        jobName = includedValue($("#pxlJobName"));
    }

    cfg.reconfigure({
        altPrinting: includedValue($("#rawAltPrinting"), isChecked($("#rawAltPrinting"), cleanConditions['rawAltPrinting'])),
        encoding: includedValue($("#rawEncoding")),
        endOfDoc: includedValue($("#rawEndOfDoc")),
        perSpool: includedValue($("#rawPerSpool")),

        bounds: pxlBounds,
        colorType: includedValue($("#pxlColorType")),
        copies: copies,
        density: pxlDensity,
        duplex: includedValue($("#pxlDuplex")),
        interpolation: includedValue($("#pxlInterpolation")),
        jobName: jobName,
        margins: pxlMargins,
        orientation: includedValue($("#pxlOrientation")),
        paperThickness: includedValue($("#pxlPaperThickness")),
        printerTray: includedValue($("#pxlPrinterTray")),
        rasterize: includedValue($("#pxlRasterize"), isChecked($("#pxlRasterize"), cleanConditions['pxlRasterize'])),
        rotation: includedValue($("#pxlRotation")),
        scaleContent: includedValue($("#pxlScale"), isChecked($("#pxlScale"), cleanConditions['pxlScale'])),
        size: pxlSize,
        units: includedValue($("input[name='pxlUnits']:checked"))
    });
}

function setPrinter(printer) {
    var cf = getUpdatedConfig();
    cf.setPrinter(printer);

    if (printer && typeof printer === 'object' && printer.name == undefined) {
        var shown;
        if (printer.file != undefined) {
            shown = "<em>FILE:</em> " + printer.file;
        }
        if (printer.host != undefined) {
            shown = "<em>HOST:</em> " + printer.host + ":" + printer.port;
        }

        $("#configPrinter").html(shown);
    } else {
        if (printer && printer.name != undefined) {
            printer = printer.name;
        }

        if (printer == undefined) {
            printer = 'NONE';
        }
        $("#configPrinter").html(printer);
    }
}

function isChecked(checkElm, ifClean) {
    if (!checkElm.hasClass("dirty")) {
        if (ifClean !== undefined) {
            var lbl = checkElm.siblings("label").text();
            displayMessage("Forced " + lbl + " " + ifClean + ".", 'alert-warning');

            return ifClean;
        }
    }

    return checkElm.prop("checked");
}

function handleConnectionError(err) {
    updateState('Error', 'danger');

    if (err.target != undefined) {
        if (err.target.readyState >= 2) { //if CLOSING or CLOSED
            displayError("Connection to QZ Tray was closed");
        } else {
            displayError("A connection error occurred, check log for details");
            console.error(err);
        }
    } else {
        displayError(err);
    }
}

///Send label data to printer///
qz.websocket.connect();

$('#printBtn').click(function (){
    var prufzeichen = $.trim($('#prufzeichen').val());
    var werkstoffbezeichnung = $.trim($('#werkstoffbezeichnung').val());
    var lagerort = $.trim($('#lagerort').val());
    var num = $.trim($('#anzahl').val());

    qz.printers.find("Zpl").then((found) => {       // Pass the printer name into the next Promise
        var config = qz.configs.create(found, {size:{width:5, height:3}, unit: 'cm', copies:num});       // Create a default config for the found printer
        var data = [
            '^XA',
            '^FO15,50^A0N,50,40^FD'+prufzeichen+'^FS',
            '^FO15,100^A0N,50,40^FD'+werkstoffbezeichnung+'^FS',
            '^FO15,150^A0N,50,40^FD'+lagerort+'^FS',
            '^FO235,30^BQN,6,6,2^FDQA',' '+prufzeichen+' '+werkstoffbezeichnung+' '+lagerort+'^FS',
            '^XZ'
        ];
        return qz.print(config, data);
    }).catch((e) => {
        alert(e);
    });
})
