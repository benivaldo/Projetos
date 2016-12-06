/**
 * 
 */
$(document).ready(function(){
	 $( document ).on('change', 'select[name="tipo"]', function () {
		 var tipo  = $('select[name="tipo"]').val();
		 switch (tipo) {
		 	default:
		 		$("label[for='cnpj']").html("Cnpj:");
		 		$("label[for='razao']").html("Razão:");
		 		$("label[for='ie']").html("IE:");
		 		$("label[for='fantasia']").html("Fantasia:");
		 		break;
			 case 'f':
				  $("label[for='cnpj']").html("Cpf:");
				  $("label[for='razao']").html("Nome:");
				  $("label[for='ie']").html("RG:");
				  $("label[for='fantasia']").html("Apelido:");
				 break;
			 case 'j':
				  $("label[for='cnpj']").html("Cnpj:");
				  $("label[for='razao']").html("Razão:");
				  $("label[for='ie']").html("IE:");
				  $("label[for='fantasia']").html("Fantasia:");
				 break;
			 }

	 });
});