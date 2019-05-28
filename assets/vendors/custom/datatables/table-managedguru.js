function getURLParameter(name) {
	return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
	}
	jQuery.fn.dataTableExt.oApi.fnSetFilteringEnterPress = function ( oSettings ) {
    var _that = this;

    this.each( function ( i ) {
        $.fn.dataTableExt.iApiIndex = i;
        var
            $this = this, 
            oTimerId = null, 
            sPreviousSearch = null,
            anControl = $( 'input', _that.fnSettings().aanFeatures.f );

            anControl
              .unbind( 'keyup' )
              .bind( 'keyup', function(e) {

              if ( anControl.val().length > 2 && e.keyCode == 13){
                _that.fnFilter( anControl.val() );
              }
        });

        return this;
    } );
    return this;
}
	$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
		{
			return {
			"iStart":         oSettings._iDisplayStart,
			"iEnd":           oSettings.fnDisplayEnd(),
			"iLength":        oSettings._iDisplayLength,
			"iTotal":         oSettings.fnRecordsTotal(),
			"iFilteredTotal": oSettings.fnRecordsDisplay(),
			"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
			"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
			};
	};
	$.fn.dataTableExt.oApi.fnDisplayStart = function ( oSettings, iStart, bRedraw )
	{
	if ( typeof bRedraw == 'undefined' )
	{
		bRedraw = true;
	}
	
	oSettings._iDisplayStart = iStart;
	oSettings.oApi._fnCalculateEnd(oSettings);
	
	if ( bRedraw )
	{
		oSettings.oApi._fnDraw( oSettings );
	}
	};
	$.fn.dataTableExt.oApi.fnFixPaginationParams = function(oSettings, aoData) {
	if (oSettings.newPage == undefined) { 
		var oData;
		var sData = this.oApi._fnReadCookie("SpryMedia_DataTables_" + oSettings.sInstance);
		if (sData !== null && sData !== '') {
		try {
			if (typeof JSON == 'object' && typeof JSON.parse == 'function') {
			oData = JSON.parse(sData.replace(/'/g, '"'));
			}
			else {
			oData = eval('(' + sData + ')');
			}
			for (var i = 0; i < aoData.length; i++) {
			if (aoData[i].name == "iDisplayStart") {
				aoData[i].value = oData.iLength;
				break;
			}
			}
		}
		catch (e) {
		}
		oSettings.newPage = true;
		}
	}
	}
	
	
	function getServerData(sSource, aoData, fnCallback, oSettings ) {
		$.getJSON(sSource, aoData, function (json) {
		fnCallback(json)	
		});
	}

var DatatablesDataSourceAjaxServer = function() {
	var initTable1 = function() {
		var table = $('#data_sekolah');
		table.DataTable({
			lengthMenu: [5, 10, 25, 50,100],
			// Order settings
			order: [[2, 'asc']],
			pageLength: 10,
			autoWidth: false,
			responsive: true,
			processing: true,
			serverSide: true,
			// enable scroll datatable
			//responsive: false,
			//scrollX:!0,
			//scrollCollapse:!0,
			ajax: {
                url : "sekolah/ajax_data_sekolah",
                type: 'post',
			},
			"aoColumnDefs": [
				{"bSortable":false, "className": "dt-center", "aTargets": [1] },
			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null,null,null,null,null,null,null,
			],
			"bSort": true,
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      {
			//$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
			//$($.fn.dataTable.tables(true)).DataTable().fixedHeader.adjust()
			//change filter input width to 150px
			//$('.dataTables_wrapper .dataTables_filter input').css("width","150px");
			 var dtable = $(".dataTables").dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable.columns([1]).header().to$().removeClass("dt-center");
        $('.dataTables_filter input').unbind('.DT').bind('keyup.DT', function(e)
        {
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl = $(".dataTables").dataTable().api();
					tbl.search('').columns().search('').draw();
			});
      },
			"fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_sekolah_filter input').val() != '') {
					$("div.alert.alert-warning.data_sekolah").empty().append('Kata kunci <strong>'+$('#data_sekolah_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_sekolah").css("display","block");
					} else {
					$("div.alert.alert-warning.data_sekolah").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_sekolah").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_sekolah").empty().append('');
					$("div.alert.alert-warning.data_sekolah").css("display","none");
					}
			  },           
		});
		var table2 = $('#data_guru');
		table2.DataTable({
			lengthMenu: [5, 10, 25, 50,100],
			// Order settings
			order: [[2, 'desc'],[4,'asc']],
			pageLength: 10,
			autoWidth: false,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url : "guru/ajax_data_guru",	
        	type: 'post',
			},
			"aoColumnDefs": [
				{"bSortable":false, "className": "dt-left","visible": false, "aTargets": [1] },
				// {"bSortable":false,"sWidth": "10%" , "aTargets": [0] },
				//{ "sWidth": "10%", "aTargets": [1,2,3,4,5, 6, 7, 8, 9] },
			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null,null,null,null,null,null,null,null,null,null,null,null
			],			
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      		{
			 var dtable = $(".dataTables").dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable.columns([1]).header().to$().removeClass("dt-center");
        	$('.dataTables_filter input').unbind('.DT').bind('keyup.DT', function(e)
        	{
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl = $(".dataTables").dataTable().api();
					tbl.search('').columns().search('').draw();
			});
			jQuery(".details-control").each(function() {
				jQuery(this).click(function(){
					table.rows('.parent').nodes().to$().find('.details-control').not(this).trigger('click');
				});
			});
     		 },
			"fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_guru_filter input').val() != '') {
					$("div.alert.alert-warning.data_guru").empty().append('Kata kunci <strong>'+$('#data_guru_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_guru").css("display","block");
					} else {
					$("div.alert.alert-warning.data_guru").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_guru").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_guru").empty().append('');
					$("div.alert.alert-warning.data_guru").css("display","none");
					}
			  },           
		});
		var table3 = $('#data_kelompok');
		table3.DataTable({
			lengthMenu: [5, 10, 25, 50,100],
			// Order settings
			order: [[2, 'asc']],
			pageLength: 10,
			autoWidth: false,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url : "kelompok/ajax_data_kelompok",	
                type: 'post',
			},
			"aoColumnDefs": [
				{"bSortable":false,"sWidth": "15%", "className": "dt-center", "aTargets": [1] },
				{"iDataSort": 0, "aTargets": [2] } ,
			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null
			],			
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      		{
			 var dtable = $(".dataTables").dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable.columns([1]).header().to$().removeClass("dt-center");
        	$('.dataTables_filter input').unbind('.DT').bind('keyup.DT', function(e)
        	{
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl = $(".dataTables").dataTable().api();
					tbl.search('').columns().search('').draw();
			});
			jQuery(".details-control").each(function() {
				jQuery(this).click(function(){
					table.rows('.parent').nodes().to$().find('.details-control').not(this).trigger('click');
				});
			});
     		 },
			"fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_kelompok_filter input').val() != '') {
					$("div.alert.alert-warning.data_kelompok").empty().append('Kata kunci <strong>'+$('#data_kelompok_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_kelompok").css("display","block");
					} else {
					$("div.alert.alert-warning.data_kelompok").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_kelompok").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_kelompok").empty().append('');
					$("div.alert.alert-warning.data_kelompok").css("display","none");
					}
			  },           
		});
		var id_kelompok = getURLParameter('id_kelompok');
		if ((id_kelompok !== null)) {
			var alamaturlkompetensi = "kompetensi/ajax_data_kompetensi?id_kelompok="+id_kelompok;
		} else {
			var alamaturlkompetensi = "kompetensi/ajax_data_kompetensi";	
		}
		var table4 = $('#data_kompetensi');
		table4.DataTable({
			lengthMenu: [5, 10, 25, 50, 100],
			// Order settings
			order: [[2,'desc'],[3,'asc']],
			pageLength: 10,
			autoWidth: false,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url : alamaturlkompetensi,	
                type: 'post',
			},
			"aoColumnDefs": [
				{"bSortable":false,"sWidth": "10%", "className": "dt-center", "aTargets": [1] },
				{"sWidth": "30%" , "aTargets": [2] },
				{"sWidth": "4%" , "aTargets": [3] },
				{"sWidth": "30%" , "aTargets": [4] },
				{"sWidth": "10%" , "aTargets": [5] },
				//{ "sWidth": "10%", "aTargets": [1,2,3,4,5, 6, 7, 8, 9] },
			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null,null
			],			
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      		{
			 var dtable = $(".dataTables").dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable.columns([1]).header().to$().removeClass("dt-center");
        	$('.dataTables_filter input').unbind('.DT').bind('keyup.DT', function(e)
        	{
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl = $(".dataTables").dataTable().api();
					tbl.search('').columns().search('').draw();
			});
			jQuery(".details-control").each(function() {
				jQuery(this).click(function(){
					table.rows('.parent').nodes().to$().find('.details-control').not(this).trigger('click');
				});
			});
     		},
			"fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_kompetensi_filter input').val() != '') {
					$("div.alert.alert-warning.data_kompetensi").empty().append('Kata kunci <strong>'+$('#data_kompetensi_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_kompetensi").css("display","block");
					} else {
					$("div.alert.alert-warning.data_kompetensi").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_kompetensi").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_kompetensi").empty().append('');
					$("div.alert.alert-warning.data_kompetensi").css("display","none");
					}
			  },           
		});
		var table5 = $('#data_kinerja');
		table5.DataTable({
			lengthMenu: [5, 10, 25, 50, 100],
			// Order settings
			order: [[5,'asc'],[7,'asc'],[2,'desc'],[3,'asc'],[4,'asc']],
			pageLength: 10,
			autoWidth: false,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url : "kinerja/ajax_data_kinerja",	
                type: 'post',
			},
			"aoColumnDefs": [
				{"sWidth": "1%" , "aTargets": [0] },
				{"bSortable":false,"sWidth": "10%", "className": "dt-center", "aTargets": [1] },
				{"sWidth": "15%" , "aTargets": [2] },
				{"sWidth": "25%" , "aTargets": [3] },
				{"sWidth": "25%" , "aTargets": [4] },
				{"sWidth": "4%" , "aTargets": [5] },
				{"sWidth": "3%" , "aTargets": [6] },
				{"sWidth": "4%" , "aTargets": [7] },
				//{ "sWidth": "10%", "aTargets": [1,2,3,4,5, 6, 7, 8, 9] },
			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null,null,null,null
			],			
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      		{
			 var dtable = $(".dataTables").dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable.columns([1]).header().to$().removeClass("dt-center");
        	$('.dataTables_filter input').unbind('.DT').bind('keyup.DT', function(e)
        	{
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl = $(".dataTables").dataTable().api();
					tbl.search('').columns().search('').draw();
			});
			jQuery(".details-control").each(function() {
				jQuery(this).click(function(){
					table.rows('.parent').nodes().to$().find('.details-control').not(this).trigger('click');
				});
			});
     		},
			"fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_kinerja_filter input').val() != '') {
					$("div.alert.alert-warning.data_kinerja").empty().append('Kata kunci <strong>'+$('#data_kinerja_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_kinerja").css("display","block");
					} else {
					$("div.alert.alert-warning.data_kinerja").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_kinerja").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_kinerja").empty().append('');
					$("div.alert.alert-warning.data_kinerja").css("display","none");
					}
			  },           
		});
		var table6 = $('#data_kuisioner');
		table6.DataTable({
			lengthMenu: [5, 10, 25, 50,100],
			// Order settings
			order: [[4, 'asc'],[6,'asc'],[2, 'desc'],[3,'asc']],
			pageLength: 5,
			autoWidth: false,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url : "kuisioneruser/ajax_data_kuisioner",	
                type: 'post',
			},
			"aoColumnDefs": [
				{"bSortable":false,"sWidth": "15%", "className": "dt-left", "aTargets": [1] },
				//{"iDataSort": 0, "aTargets": [2] } ,
			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null,null,null
			],			
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      		{
			 var dtable = $(".dataTables").dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable.columns([1]).header().to$().removeClass("dt-center");
        	$('.dataTables_filter input').unbind('.DT').bind('keyup.DT', function(e)
        	{
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl = $(".dataTables").dataTable().api();
					tbl.search('').columns().search('').draw();
			});
			jQuery(".details-control").each(function() {
				jQuery(this).click(function(){
					table.rows('.parent').nodes().to$().find('.details-control').not(this).trigger('click');
				});
			});
     		 },
			"fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_kuisioner_filter input').val() != '') {
					$("div.alert.alert-warning.data_kuisioner").empty().append('Kata kunci <strong>'+$('#data_kuisioner_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_kuisioner").css("display","block");
					} else {
					$("div.alert.alert-warning.data_kuisioner").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_kuisioner").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_kuisioner").empty().append('');
					$("div.alert.alert-warning.data_kuisioner").css("display","none");
					}
			  },           
		});
		var table7 = $('#data_hasilkuisioner');
		table7.DataTable({
			lengthMenu: [5, 10, 25, 50,100],
			// Order settings
			order: [[2, 'desc'],[4,'asc']],
			pageLength: 5,
			autoWidth: false,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url : "hasilkuisioner/ajax_data_hasilkuisioner",	
                type: 'post',
			},
			"aoColumnDefs": [
				{"bSortable":false,"sWidth": "15%", "className": "dt-center", "aTargets": [1] },
				//{"iDataSort": 0, "aTargets": [2] } ,
			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null,null
			],			
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      		{
			 var dtable = $(".dataTables").dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable.columns([1]).header().to$().removeClass("dt-center");
        	$('.dataTables_filter input').unbind('.DT').bind('keyup.DT', function(e)
        	{
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl = $(".dataTables").dataTable().api();
					tbl.search('').columns().search('').draw();
			});
			jQuery(".details-control").each(function() {
				jQuery(this).click(function(){
					table.rows('.parent').nodes().to$().find('.details-control').not(this).trigger('click');
				});
			});
     		 },
			"fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_hasilkuisioner_filter input').val() != '') {
					$("div.alert.alert-warning.data_hasilkuisioner").empty().append('Kata kunci <strong>'+$('#data_hasilkuisioner_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_hasilkuisioner").css("display","block");
					} else {
					$("div.alert.alert-warning.data_hasilkuisioner").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_hasilkuisioner").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_hasilkuisioner").empty().append('');
					$("div.alert.alert-warning.data_hasilkuisioner").css("display","none");
					}
			  },           
		});

		var table8 = $('#data_assesor');
		table8.DataTable({
			lengthMenu: [5, 10, 25, 50,100],
			// Order settings
			order: [[2, 'asc'],[4, 'asc'],[6,'asc']],
			pageLength: 10,
			autoWidth: false,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url : "assesor/ajax_data_assesor",	
                type: 'post',
			},
			"aoColumnDefs": [
				{"bSortable":false, "className": "dt-center", "aTargets": [1] },
			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null,null,null
			],			
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      		{
			 var dtable = $(".dataTables").dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable.columns([1]).header().to$().removeClass("dt-center");
        	$('.dataTables_filter input').unbind('.DT').bind('keyup.DT', function(e)
        	{
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl = $(".dataTables").dataTable().api();
					tbl.search('').columns().search('').draw();
			});
			jQuery(".details-control").each(function() {
				jQuery(this).click(function(){
					table.rows('.parent').nodes().to$().find('.details-control').not(this).trigger('click');
				});
			});
     		 },
			"fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_assesor_filter input').val() != '') {
					$("div.alert.alert-warning.data_assesor").empty().append('Kata kunci <strong>'+$('#data_assesor_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_assesor").css("display","block");
					} else {
					$("div.alert.alert-warning.data_assesor").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_assesor").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_assesor").empty().append('');
					$("div.alert.alert-warning.data_assesor").css("display","none");
					}
			  },           
		});
		var table9 = $('#data_kinerjadinilai');
		table9.DataTable({
			lengthMenu: [5, 10, 25, 50,100],
			// Order settings
			order: [[2, 'asc'],[4, 'asc'],[6,'asc']],
			pageLength: 5,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url : "kinerjadinilai/ajax_data_kinerjadinilai",	
                type: 'post',
			},
			"aoColumnDefs": [
				{"bSortable":false, "className": "dt-center", "aTargets": [1] },
			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null,null,null
			],			
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      		{
			 var dtable = $("#data_kinerjadinilai").dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable.columns([1]).header().to$().removeClass("dt-center");
        	$('#data_kinerjadinilai_filter input').unbind('.DT').bind('keyup.DT', function(e)
        	{
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl = $("#data_kinerjadinilai").dataTable().api();
					tbl.search('').columns().search('').draw();
			});
			var table10 = $('#data_evaluasi');
			table10.DataTable({
				"paging":   false,
				"ordering": false,
				"info":     false,
				"bFilter":  false,
				"language": {
					"emptyTable": "<div class='alert alert-danger justify-content-center' style='font-weight:600;'>Silahkan pilih salah satu guru terlebih dahulu</div>"
				},
			});
     		},
			 "fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_kinerjadinilai_filter input').val() != '') {
					$("div.alert.alert-warning.data_kinerjadinilai").empty().append('Kata kunci <strong>'+$('#data_kinerjadinilai_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_kinerjadinilai").css("display","block");
					} else {
					$("div.alert.alert-warning.data_kinerjadinilai").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_kinerjadinilai").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_kinerjadinilai").empty().append('');
					$("div.alert.alert-warning.data_kinerjadinilai").css("display","none");
					}
			 },          
		});
		
		
		$(document).on("click",'.pilih_guru', function(e) {	
		blockPageUI();
		var nuptk = $(this).attr('value'); 
		//alert(nuptk);
		$('#data_evaluasi').DataTable().destroy();
		var table10 = $('#data_evaluasi');
		table10.DataTable({
			lengthMenu: [5, 10, 25, 50,100],
			// Order settings
			order: [[7,'asc'],[5,'desc'],[2,'desc'],[3,'asc'],[4,'asc']],
			pageLength: 10,
			responsive: false,
			scrollX:!0,
			scrollCollapse:!0,
			processing: true,
			destroy : true,
			serverSide: true,
			ajax: {
				url : "kinerjadinilai/ajax_data_kinerja?nuptk="+nuptk,	
                type: 'post',
			},
			"aoColumnDefs": [
				{"sWidth": "1%" ,"visible": false, "aTargets": [0] },
				{"bSortable":false,"sWidth": "10%", "className": "dt-center", "aTargets": [1] },
				{"sWidth": "15%" , "aTargets": [2] },
				{"sWidth": "25%" , "aTargets": [3] },
				{"sWidth": "25%" , "aTargets": [4] },
				{"sWidth": "4%" , "aTargets": [5] },
				{"sWidth": "3%" , "aTargets": [6] },
				{"sWidth": "4%" , "aTargets": [7] },

			], 
			columns: [
				{   // Responsive control column
						data: null,
						defaultContent: '',
						className: 'control',
						orderable: false
				},
				null,null,null,null,null,null,null
			],			
			"language": {
				"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
			},
			initComplete: function()
      		{
						unblockPageUI();
			 var dtable2 = $('#data_evaluasi').dataTable().api();
			 var searchWait = 0;
			 var searchWaitInterval;
			 dtable2.columns([1]).header().to$().removeClass("dt-center");
        	$('#data_evaluasi_filter input').unbind('.DT').bind('keyup.DT', function(e)
        	{
					var item = $(this);
					searchWait = 0;
					if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
							if(searchWait>=3){
								clearInterval(searchWaitInterval);
								searchWaitInterval = '';
								searchTerm = $(item).val();
								dtable2.search(searchTerm).draw();								
								searchWait = 0;
							}
							searchWait++;
					},300);
				});
				$('input[type=search]').on('search', function () {
					var tbl2 = $("#data_evaluasi").dataTable().api();
					tbl2.search('').columns().search('').draw();
			});
			var $target = $('html, body, #data_evaluasi'); 
			$target.animate({scrollTop: $target.height()}, 1000);
			//window.scrollTo(0, $("#data_evaluasi").offset().top);
     		},
			"fnDrawCallback": function () {
				if((this.fnPagingInfo().iFilteredTotal) == 0) {
					if($('#data_evaluasi_filter input').val() != '') {
					$("div.alert.alert-warning.data_evaluasi").empty().append('Kata kunci <strong>'+$('#data_evaluasi_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
					$("div.alert.alert-warning.data_evaluasi").css("display","block");
					} else {
					$("div.alert.alert-warning.data_evaluasi").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
					$("div.alert.alert-warning.data_evaluasi").css("display","block");
					}
					} else {
					$("div.alert.alert-warning.data_evaluasi").empty().append('');
					$("div.alert.alert-warning.data_evaluasi").css("display","none");
					}
			},          
			}); 
			//window.scrollTo(0, $("#data_evaluasi").offset().top);
			});

			var table11 = $('#data_kuisionerdinilai');
			table11.DataTable({
				lengthMenu: [5, 10, 25, 50,100],
				// Order settings
				order: [[2, 'asc'],[4, 'asc'],[6,'asc']],
				pageLength: 5,
				responsive: true,
				processing: true,
				serverSide: true,
				ajax: {
					url : "kuisionerdinilai/ajax_data_kuisionerdinilai",	
									type: 'post',
				},
				"aoColumnDefs": [
					{"bSortable":false, "className": "dt-center", "aTargets": [1] },
				], 
				columns: [
					{   // Responsive control column
							data: null,
							defaultContent: '',
							className: 'control',
							orderable: false
					},
					null,null,null,null,null,null
				],			
				"language": {
					"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
				},
				initComplete: function()
						{
				 var dtable = $("#data_kuisionerdinilai").dataTable().api();
				 var searchWait = 0;
				 var searchWaitInterval;
				 dtable.columns([1]).header().to$().removeClass("dt-center");
						$('#data_kuisionerdinilai_filter input').unbind('.DT').bind('keyup.DT', function(e)
						{
						var item = $(this);
						searchWait = 0;
						if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
								if(searchWait>=3){
									clearInterval(searchWaitInterval);
									searchWaitInterval = '';
									searchTerm = $(item).val();
									dtable.search(searchTerm).draw();								
									searchWait = 0;
								}
								searchWait++;
						},300);
					});
					$('input[type=search]').on('search', function () {
						var tbl = $("#data_kuisionerdinilai").dataTable().api();
						tbl.search('').columns().search('').draw();
				});
				var table12 = $('#data_evaluasikuisioner');
				table12.DataTable({
					"paging":   false,
					"ordering": false,
					"info":     false,
					"bFilter":  false,
					"language": {
						"emptyTable": "<div class='alert alert-danger justify-content-center' style='font-weight:600;'>Silahkan pilih salah satu guru terlebih dahulu</div>"
					},
				});
					 },
				 "fnDrawCallback": function () {
					if((this.fnPagingInfo().iFilteredTotal) == 0) {
						if($('#data_kuisionerdinilai_filter input').val() != '') {
						$("div.alert.alert-warning.data_kuisionerdinilai").empty().append('Kata kunci <strong>'+$('#data_kuisionerdinilai_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
						$("div.alert.alert-warning.data_kuisionerdinilai").css("display","block");
						} else {
						$("div.alert.alert-warning.data_kuisionerdinilai").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
						$("div.alert.alert-warning.data_kuisionerdinilai").css("display","block");
						}
						} else {
						$("div.alert.alert-warning.data_kuisionerdinilai").empty().append('');
						$("div.alert.alert-warning.data_kuisionerdinilai").css("display","none");
						}
				 },          
			});
			
			
			$(document).on("click",'.pilih_guru2', function(e) {	
				blockPageUI();
			var nuptk2 = $(this).attr('value'); 
			$('#data_evaluasikuisioner').DataTable().destroy();
			var table12 = $('#data_evaluasikuisioner');
			table12.DataTable({
				lengthMenu: [5, 10, 25, 50,100],
				// Order settings
				order: [[6,'asc'],[5,'desc'],[2,'desc'],[3,'asc'],[4,'asc']],
				pageLength: 10,
				responsive: false,
				scrollX:!0,
				scrollCollapse:!0,
				processing: true,
				destroy : true,
				serverSide: true,
				ajax: {
					url : "kuisionerdinilai/ajax_data_kuisioner?nuptk="+nuptk2,	
									type: 'post',
				},
				"aoColumnDefs": [
					{"sWidth": "1%" ,"visible": false, "aTargets": [0] },
					{"bSortable":false,"sWidth": "10%", "className": "dt-center", "aTargets": [1] },
					{"sWidth": "20%" , "aTargets": [2] },
					{"sWidth": "30%" , "aTargets": [3] },
					{"sWidth": "5%" , "aTargets": [4] },
					{"sWidth": "5%" , "aTargets": [5] },
					{"sWidth": "5%" , "aTargets": [6] },
				], 
				columns: [
					{   // Responsive control column
							data: null,
							defaultContent: '',
							className: 'control',
							orderable: false
					},
					null,null,null,null,null,null
				],			
				"language": {
					"sUrl" :"../assets/vendors/custom/datatables/datatables.id.json"
				},
				initComplete: function()
						{
							unblockPageUI();
				 var dtable2 = $('#data_evaluasikuisioner').dataTable().api();
				 var searchWait = 0;
				 var searchWaitInterval;
				 dtable2.columns([1]).header().to$().removeClass("dt-center");
						$('#data_evaluasikuisioner_filter input').unbind('.DT').bind('keyup.DT', function(e)
						{
						var item = $(this);
						searchWait = 0;
						if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
								if(searchWait>=3){
									clearInterval(searchWaitInterval);
									searchWaitInterval = '';
									searchTerm = $(item).val();
									dtable2.search(searchTerm).draw();								
									searchWait = 0;
								}
								searchWait++;
						},300);
					});
					$('input[type=search]').on('search', function () {
						var tbl2 = $("#data_evaluasikuisioner").dataTable().api();
						tbl2.search('').columns().search('').draw();
				});
				var $target = $('html, body, #data_evaluasikuisioner'); 
				$target.animate({scrollTop: $target.height()}, 1000);
				//window.scrollTo(0, $("#data_evaluasi").offset().top);
					 },
				"fnDrawCallback": function () {
					if((this.fnPagingInfo().iFilteredTotal) == 0) {
						if($('#data_evaluasikuisioner_filter input').val() != '') {
						$("div.alert.alert-warning.data_evaluasikuisioner").empty().append('Kata kunci <strong>'+$('#data_evaluasikuisioner_filter input').val()+'</strong> tidak menampilkan data hasil pencarian');
						$("div.alert.alert-warning.data_evaluasikuisioner").css("display","block");
						} else {
						$("div.alert.alert-warning.data_evaluasikuisioner").empty().append('Tidak ada data yang sesuai dengan kriteria yang diinginkan');
						$("div.alert.alert-warning.data_evaluasikuisioner").css("display","block");
						}
						} else {
						$("div.alert.alert-warning.data_evaluasikuisioner").empty().append('');
						$("div.alert.alert-warning.data_evaluasikuisioner").css("display","none");
						}
				},          
				}); 
				//window.scrollTo(0, $("#data_evaluasi").offset().top);
				});
	}; 
	return {
		//         function to initiate the module
		init: function() {
			initTable1();
       
		},
	};
}();

$(document).ready(function() {
DatatablesDataSourceAjaxServer.init();
//$('.dataTables').dataTable().fnSetFilteringEnterPress();
});
