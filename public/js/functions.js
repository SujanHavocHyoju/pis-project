$(function() {
	

	
	//===== Masked input =====//
	
	$.mask.definitions['~'] = "[+-]";
	//$(".maskDate").mask("9999/99/99",{completed:function(){alert("You cannot go out of specified rule");}});
	$(".maskDate").mask("9999/99/99");
	$(".maskPhone").mask("(999) 999-9999");
	$(".maskPhoneExt").mask("(999) 999-9999? x99999");
	$(".maskIntPhone").mask("+33 999 999 999");
	$(".maskTin").mask("99-9999999");
	$(".maskSsn").mask("999-99-9999");
	$(".maskProd").mask("a*-999-a999", { placeholder: " " });
	$(".maskEye").mask("~9.99 ~9.99 999");
	$(".maskPo").mask("PO: aaa-999-***");
	$(".maskPct").mask("99%");
	
	
});