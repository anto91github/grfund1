<?php

return array(

	"accepted"         => ":Attribute  harus disetujui.",
	"active_url"       => ":Attribute bukan URL yang valid.",
	"after"            => ":Attribute harus tanggal setelah :date.",
	"alpha"            => ":Attribute hanya mengandung huruf.",
	"alpha_dash"       => ":Attribute hanya mengandung huruf, angka, dan garis.",
	"alpha_num"        => ":Attribute hanya mengandung huruf dan angka.",
	"array"            => ":Attribute harus merupakan array.",
	"before"           => ":Attribute harus tanggal sebelum :date.",
	"between"          => array(
		"numeric" => ":Attribute harus diantara :min dan :max.",
		"file"    => ":Attribute harus diantara :min dan :max kilobytes.",
		"string"  => ":Attribute harus diantara :min dan :max karakter.",
		"array"   => ":Attribute harus diantara :min dan :max item.",
	),
	"confirmed"        => "Konfirmasi :Attribute tidak cocok.",
	"date"             => ":Attribute bukan tanggal yang valid.",
	"date_format"      => ":Attribute tidak cocok dengan format :format.",
	"different"        => ":Attribute dan :others harus berbeda.",
	"digits"           => ":Attribute harus :digits digits.",
	"digits_between"   => ":Attribute harus diantara :min dan :max digits.",
	"email"            => "Format :Attribute tidak valid.",
	"exists"           => ":Attribute yang dipilih tidak valid.",
	"image"            => ":Attribute harus gambar.",
	"in"               => ":Attribute yang dipilih tidak valid.",
	"integer"          => ":Attribute haruslah integer.",
	"ip"               => ":Attribute harus alamat IP yang valid.",
	"max"              => array(
		"numeric" => ":attribute tidak boleh lebih besar dari :max.",
		"file"    => ":attribute tidak boleh lebih besar :max kilobytes.",
		"string"  => ":attribute tidak boleh lebih besar :max characters.",
		"array"   => ":attribute tidak boleh memiliki lebih dari :max items.",
	),
	"mimes"            => ":attribute harus merupakan data type: :values.",
	"min"              => array(
		"numeric" => ":attribute harus paling tidak :min.",
		"file"    => ":attribute harus paling tidak :min kilobytes.",
		"string"  => ":attribute harus paling tidak :min characters.",
		"array"   => ":attribute harus paling tidak :min items.",
	),
	"not_in"           => ":attribute yang dipilih tidak valid.",
	"numeric"          => ":attribute harus merupakan nomor.",
	"regex"            => "format :attribute tidak valid.",
	"required"         => "kolom :attribute harus diisi.",
	"required_if"      => "kolom :attribute harus diisi saat :other adalah :value.",
	"required_with"    => "kolom :attribute harus diisi saat :values adalah saat ini.",
	"required_without" => "kolom :attribute harus diisi saat :values bukan saat ini.",
	"same"             => ":attribute dan :other harus cocok.",
	"size"             => array(
		"numeric" => ":attribute harus :size.",
		"file"    => ":attribute harus :size kilobytes.",
		"string"  => ":attribute harus :size characters.",
		"array"   => ":attribute harus mengandung :size items.",
	),
	"unique"           => ":attribute sudah dipakai.",
	"url"              => "format :attribute tidak valid.",
	"recaptcha" => 'kolom :attribute tidak benar.',
        "alpha_spaces"        => ":attribute hanya mengandung huruf dan spasi.",
	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		"field" => "Kolom ini harus diisi.",
		),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
