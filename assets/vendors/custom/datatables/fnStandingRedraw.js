$('.dataTables').each(function() {
$.fn.dataTableExt.oApi.fnStandingRedraw = function(oSettings) {
	//console.log(oSettings);
    if(oSettings.oFeatures.bServerSide === false){
        var before = oSettings._iDisplayStart;
        oSettings.oApi._fnReDraw(oSettings);
        oSettings._iDisplayStart = before;
        oSettings.oApi._fnCalculateEnd(oSettings);
    }
    oSettings.oApi._fnDraw(oSettings);
};
});