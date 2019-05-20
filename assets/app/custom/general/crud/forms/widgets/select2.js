$.fn.select2.amd.define('id',[],function () {
// Indonesian
return {
 errorLoading: function () {
	 return 'Terjadi kesalahan dalam memproses data.';
 },
 inputTooLong: function (args) {
	 var overChars = args.input.length - args.maximum;

	 return 'Hapuskan ' + overChars + ' huruf';
 },
 inputTooShort: function (args) {
	 var remainingChars = args.minimum - args.input.length;

	 return 'Masukkan minimal ' + remainingChars + ' huruf untuk pencarian';
 },
 loadingMore: function () {
	 return 'Mengambil data…';
 },
 maximumSelected: function (args) {
	 return 'Anda hanya dapat memilih ' + args.maximum + ' pilihan';
 },
 noResults: function () {
	 return 'Tidak ada data yang sesuai';
 },
 searching: function () {
	 return 'Sedang Mencari…';
 },
 removeAllItems: function () {
	 return 'Hapus semua item';
 }
};
});