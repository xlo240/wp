<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'sidebar-city' ) ) {
	return;
}
?>

<div class="widget-area" role="complementary">
	<?php //dynamic_sidebar( 'sidebar-city' ); ?>
	<h3>Добавить новый объект недвижимости</h3>
	<form id="xloform" onsubmit="return false">
		<input type="text" name="name"> Название<br>
		<input type="text" name="plosh"> Площадь<br>
		<input type="text" name="zhil_plosh"> Жилая площадь<br>
		<input type="text" name="stoimost"> Стоимость<br>
		<input type="text" name="adress"> Адрес<br>
		<input type="text" name="floor"> Этаж<br>
		<input type="submit" onclick="formSender(this.form)" value="Отправить">
	</form>
<div id="modal">
	<span id="modal_close">X</span>
	<p>Запись внесена</p>
</div>
<div id="overlay"></div>
</div>

<script>
function formSender(data){
	/*console.log(data.plosh.value);
	console.log(data.zhil_plosh.value);
	console.log(data.stoimost.value);
	console.log(data.adress.value);
	console.log(data.floor.value);*/
	
	jQuery.ajax({
		url: '<?=get_site_url();?>/wp-admin/admin-ajax.php',
		type: 'POST',
		data: {
			action: 'addnedv',
			name: data.name.value,
			plosh: data.plosh.value,
			zhil_plosh: data.zhil_plosh.value,
			stoimost: data.stoimost.value,
			adress: data.adress.value,
			floor: data.floor.value
		},
		success: function (msg){
			console.log("ответ", msg);
			jQuery('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
		 	function(){ // пoсле выпoлнения предъидущей aнимaции
				jQuery('#modal') 
					.css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
					.animate({opacity: 1, top: '50%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
			});

		}
	});
}
jQuery('#modal_close, #overlay').click( function(){ // лoвим клик пo крестику или пoдлoжке
	
	jQuery('#modal')
		.animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
			function(){ // пoсле aнимaции
				jQuery(this).css('display', 'none'); // делaем ему display: none;
				jQuery('#overlay').fadeOut(400); // скрывaем пoдлoжку
			}
		);
	document.getElementById('xloform').reset();//очищаем форму
});
</script>