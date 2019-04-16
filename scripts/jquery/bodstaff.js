$(function () {
$('#btn-1').css("borderTop","6px Solid #1A6FB0");
$('.BodButton').click(function () {

$('.slider-1').show();

$('.slider-2').hide();
$('#btn-1').css("borderTop","6px Solid #1A6FB0");
$('#btn-2').css("borderTop","none");


});
$('.staffButton').click(function () {

$('.slider-1').hide();

$('.slider-2').show();
$('#btn-2').css("borderTop","6px Solid #1A6FB0");
$('#btn-1').css("borderTop","none");

});
});