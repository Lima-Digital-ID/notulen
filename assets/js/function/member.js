(function($) {

	'use strict';

	var datatableInit = function() {

		$('#datatable-default').DataTable({
			"processing": true,
	        "serverSide": true,
	        "ajax": {
	            "url": "member/json",
	            "type": "POST"
	        },
	        "columns": [
	            { "data": "us_id" },
	            { "data": "us_nama" },
	            { "data": "us_email" },
	            { "data": "us_jkel" },
	            { "data": "us_foto", "render" : function(data, type, row){
	            	return '<img src="'+uri+'assets/img/'+row.us_foto+'" width="50px">';
	            }},
	            { "data": "us_status" },
	            { "data": "us_id", "render" : function(data, type, row){
	            	return '<a class="btn btn-primary text-white" data-toggle="modal" data-target="#exampleModal" onclick="cekHistory('+row.us_id+');"><i class="fa fa-address-book"></i></a>';
	            	// return '<button class="btn btn-sm btn-primary" onclick="cekHistory('+row.us_id+');"><i class="fa fa-address-book"></i></button>'; 
	            }},
	        ]
		});

	};

	$(function() {
		datatableInit();
	});

}).apply(this, [jQuery]);


function cekHistory(id){
	(function($) {

		'use strict';

		var t=$('#history-poin').DataTable();
		t.clear().draw(false);
		$.ajax({
	        type: "GET",
	        url: "member/history_trx/"+id, //json get site
	        dataType : 'json',
	        success: function(response){
	            var arrData = response['data'];
	            $('#namaMember').html('Member '+arrData[0]['us_nama']);
	            for(var i = 0; i < arrData.length; i++){
	            	var date=dateFormat(arrData[i]['tpoin_create']);
	                t.row.add([
	                    '<div class="text-left">'+date+'</div>',
	                    '<div class="text-left">'+arrData[i]['tpoin_jumlah']+'</div>',
	                ]).draw(false);
	            }
	        }
	    });
	}).apply(this, [jQuery]);
}
function dateFormat(val){
	var date=val.split('-');
	return date[2]+'-'+date[1]+'-'+date[0];
}