(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else {
		factory(jQuery);
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ID (Indonesia; Indonesian)
 */
$.extend($.validator.messages, {
	required: "<b>Kolom ini diperlukan.</b>",
	remote: "<b>Harap benarkan kolom ini.</b>",
	email: "<b>Silakan masukkan format email yang benar. Sebagai contoh : namauser@namahost.com</b>",
	url: "<b>Silakan masukkan format URL yang benar.</b>",
	date: "<b>Silakan masukkan format tanggal yang benar.</b>",
	dateISO: "<b>Silakan masukkan format tanggal(ISO) yang benar.</b>",
	number: "<b>Silakan masukkan angka yang benar.</b>",
	digits: "<b>Harap masukan angka saja.</b>",
	creditcard: "<b>Harap masukkan format kartu kredit yang benar.</b>",
	equalTo: "<b>Harap masukkan nilai yg sama dengan sebelumnya.</b>",
	maxlength: $.validator.format("<b>Input dibatasi hanya {0} karakter.</b>"),
	minlength: $.validator.format("<b>Input tidak kurang dari {0} karakter.</b>"),
	rangelength: $.validator.format("<b>Panjang karakter yg diizinkan antara {0} dan {1} karakter.</b>"),
	range: $.validator.format("<b>Harap masukkan nilai antara {0} dan {1}.</b>"),
	max: $.validator.format("<b>Harap masukkan nilai lebih kecil atau sama dengan {0}.</b>"),
	min: $.validator.format("<b>Harap masukkan nilai lebih besar atau sama dengan {0}.</b>")
});

}));