(function($) {

	'use strict';
	if (filter == 0) {

		var datatableInit = function() {

			$('#transaksi_table').DataTable({
				"processing": true,
		        "serverSide": true,
		        "ajax": {
		            "url": "transaksi/json",
		            "type": "POST"
		        },
		        "columns": [
		            { "data": "tpoin_id" },
		            { "data": "tpoin_create", "render" : function(data, type, row){
		            	return dateFormat(row.tpoin_create);
		            }},
		            { "data": "tpoin_jumlah" },
		            { "data": "us_id" },
		            { "data": "us_nama" },
		        ]
			});

		};
	}else{
		var datatableInit = function() {

			$('#transaksi_table').DataTable({
				"processing": true,
		        "serverSide": true,
		        "ajax": {
		            "url": "transaksi/jsonFilter/"+filter+'/'+value_filter,
		            "type": "POST"
		        },
		        "columns": [
		            { "data": "tpoin_id" },
		            { "data": "tpoin_create", "render" : function(data, type, row){
		            	return dateFormat(row.tpoin_create);
		            }},
		            { "data": "tpoin_jumlah" },
		            { "data": "us_id" },
		            { "data": "us_nama" },
		        ]
			});

		};
	}

	$(function() {
		datatableInit();
	});

}).apply(this, [jQuery]);

function dateFormat(val){
	var date=val.split('-');
	return date[2]+'-'+date[1]+'-'+date[0];
}

function cekFilter(){
	var filter=$('#filter-radio:checked').val();
	if (filter == 'bulan') {
		$('#bulan_filter').show();
		$('#tanggal_filter').hide();
	}else{
		$('#tanggal_filter').show();
		$('#bulan_filter').hide();
	}
}