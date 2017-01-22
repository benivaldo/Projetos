/**
 * Funções utilizadas no projeto
 */

$(document).ready(function(){
	$('#menu').metisMenu({
	    	doubleTapToGo: false
	});

	/**
	 * Serializa dados do forme e envia para a url solicitada no form
	 */
    $(document).on("submit", '.form-add, .form-edit', function(event) {
        event.preventDefault();
        var form = $(this).closest("form").attr('id');
    	var modulo = $('#'+form).attr("data-modulo");
        var ctrl = $('#'+form).attr("data-ctrl");
    	var titulo = $('#'+form).attr("data-titulo");
    	var div = $('#'+form).attr("data-div");
    	
        $.ajax({
            url     :$(this).attr("action"),// or the ure of your action
            type    : $(this).attr("method"),// POST, GET
            cache   : false,
            data    : $(this).serialize(), // the data from your form , in your case the :selected
            dataType: "json",
            success : function(data)
            {
                alert(data.errorMessage);
                //Aqui se deve colocar uma rota para voltar ao index
                if ($(event.target).attr('class').indexOf("add") > 0) {
                	/*Se existir um id valido retorna a view*/
                	if (data.id > 0) {
                		returnView(modulo, ctrl, 1, 'edit', div, '', '', '', data.id, titulo);
                	}
                	
                }
            },

            /*Se erro retorna a tela de erros*/
			error:function(response){
				$('#principal').html(response.responseText);  	    	  
			} 
        });
        return false;
    });

    /**
     * Volta para index /limpa dados
     * form deve possuir os atributos 
     * data-modulo:nome do modulo a ser acessado
     * data-ctrl: nome da controler
     * data-div: nome da div a ser rederizado os dados
     * data-titulo: nome atribuido a aba tab
     * data-id: id a ser consultado na tabela
     * data-order_by: nome da coluna a ser ordenada na tabela
     */
    $( document ).on( "click", ".btn-voltar, .btn-limpar, .btn-prev, .btn-next, .btn-novo", function() {
    	var form = $(this).closest("form").attr('id');
        var page = 1;
        var modulo = $('#'+form).attr("data-modulo");
        var ctrl = $('#'+form).attr("data-ctrl");
    	var titulo = $('#'+form).attr("data-titulo");
    	var div = $('#'+form).attr("data-div");
		var dataIni = '';
        var dataFinal = '';
        var filterLetter = '';
        var id = $('#'+form).attr("data-id");
        var order_by = $('#'+form).attr("data-order_by");
        
        switch ( $(this).attr("data-modo")){
        	default:
        		returnView(modulo, ctrl, page, 'index',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, 'ASC');
        		break;
        		
        	case 'limparAdd':
        		returnView(modulo, ctrl, page, (id.length > 0?'edit':'add'),div, filterLetter, dataIni, dataFinal, id, titulo);
        		break;
        		
        	case 'previous':
        		returnView(modulo, ctrl, page, 'prev',div, filterLetter, dataIni, dataFinal, id, titulo);
        		break;
        	
        	case 'next':
        		returnView(modulo, ctrl, page, 'next',div, filterLetter, dataIni, dataFinal, id, titulo);
        		break;
        		
        	case 'novo':
        		returnView(modulo, ctrl, page, 'add',div, filterLetter, dataIni, dataFinal, id, titulo);
        		break;
        }    	
  	});
    
    /**
     * Função para pesquisa digitada pelo campo busca
     * Deverá ser atribuido um id único para o form de pesquisa
     * Nome da classe form de ser form-pesquisa
     * form deve possuir os atributos 
     * data-modulo: nome do modulo a ser acessado
     * data-ctrl: nome da controler
     * data-div: nome da div a ser rederizado os dados
     * data-titulo: nome atribuido a aba tab
     * data-order_by: nome da coluna a ser ordenada na tabela
     * data-order: tipo de ordenação asc/desc
     * data-tipo_view: Usado na criação de atalhos para retorno de pesquisa de campo, necessário onde existem telas que solicitam atallhos
     */
    $(function() {        
    	$(document).on("keyup", ".search", function() {
    		var form = $(this).closest("form").attr('id');
	       	var dataIni = '';
	       	var dataFinal = '';
	       	var id = '';
	        var filterLetter = $('#'+form).find('input[name="search"]').val();
	       	var page = 1;
	        var modulo = $('#'+form).attr("data-modulo");
	        var ctrl = $('#'+form).attr("data-ctrl");
	    	//var titulo = $('#'+form).attr("data-titulo");
	    	var div = $('#'+form).attr("data-div");
	    	var order_by = $('#'+form).attr("data-order_by");
	    	var order = $('#'+form).attr("data-order");
	    	var dataIniName = $('#'+form).attr("data-data_ini");
	    	var dataFinName = $('#'+form).attr("data-data_fin");

	    	var index = $('#tabs').data('tabs').options.selected;  //Retorna o número do índice da aba usada
	    	var titulo = $('#tabs ul:first li:eq('+index+') span:first').text();	
		    	
	    	if ($('#'+form).attr("data-tipo_view") == undefined || $('#'+form).attr("data-tipo_view") == null || $('#'+form).attr("data-tipo_view") == '' ) {
	    		view = false;
	    	} else {
	    		view = $('#'+form).attr("data-tipo_view");
	    	}
	        
	        if ($("#"+dataIniName).val().length > 0 && $("#"+dataFinName).val().length > 0) {
	            dataIni = $("#"+dataIniName).val();
	            dataFinal = $("#"+dataFinName).val();
	        }
	
	        returnView(modulo, ctrl, page, 'index',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, order, view);
	        });
    })

    /**
     * Função para o primeiro calendario
     * Classe deve ter o nome: data_ini
     * Id deve ser dirente da classe e não deve ser usado em outros tabs
     */
    $(document).on("click", ".data_ini", function() {
    	var form = $(this).closest("form").attr('id');
    	var modulo = $('#'+form).attr("data-modulo");
        var ctrl = $('#'+form).attr("data-ctrl");
    	var titulo = $('#'+form).attr("data-titulo");
    	var div = $('#'+form).attr("data-div");
    	var order_by = $('#'+form).attr("data-order_by");
    	var order = $('#'+form).attr("data-order");
    	var filterLetter = $('#'+form).find('input[name="search"]').val();
    	var page = 1;
    	var id = 0;
    	var dataIniName = $('#'+form).attr("data-data_ini");
    	var dataFinName = $('#'+form).attr("data-data_fin");
    	
    	 $("#"+dataIniName).datepicker('destroy').datepicker({showOn:'focus',
    		 showButtonPanel: true,
         	 beforeShow: function() {    
                 $(".ui-datepicker").css('font-size', 12) 
                 },
                 onSelect: function() { 
                	 if ($("#"+dataIniName).val().length > 0 && $("#"+dataFinName).val().length > 0) {
                         dataIni = $("#"+dataIniName).val();
                         dataFinal = $("#"+dataFinName).val();
                         returnView(modulo, ctrl, page, 'index',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, order);
                     }
                 }}).focus();
    });
    
    /**
     * Função para o segundo calendario
     * Classe deve ter o nome: data_ini
     * I deve ser o mesmo nome da classe
     */
    $(document).on("click", ".data_fin", function() {
    	var form = $(this).closest("form").attr('id');
    	var modulo = $('#'+form).attr("data-modulo");
        var ctrl = $('#'+form).attr("data-ctrl");
    	var titulo = $('#'+form).attr("data-titulo");
    	var div = $('#'+form).attr("data-div");
    	var order_by = $('#'+form).attr("data-order_by");
    	var order = $('#'+form).attr("data-order");
    	var filterLetter = $('#'+form).find('input[name="search"]').val();
    	var page = 1;
    	var id = 0;
    	var dataIniName = $('#'+form).attr("data-data_ini");
    	var dataFinName = $('#'+form).attr("data-data_fin");
       
    	 $("#"+dataFinName ).datepicker('destroy').datepicker({showOn:'focus',
    		 showButtonPanel: true,
    		 beforeShow: function() {    
                 $(".ui-datepicker").css('font-size', 12) 
                 },
                 onSelect: function() { 
                	 if ($("#"+dataIniName).val().length > 0 && $("#"+dataFinName).val().length > 0) {
                         dataIni = $("#"+dataIniName).val();
                         dataFinal = $("#"+dataFinName ).val();
                         returnView(modulo, ctrl, page, 'index',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, order);
                     }
                 }}).focus();
    });
    
    /**
     * Função para manipulação do paginator
     */
    $(document).on("click", ".paginator-page-number", function() {
    	var index = $('#tabs').data('tabs').options.selected;
		var selectedPanel = $('#tabs ul:first li:eq('+index+') a:first').attr('href').replace('#','');
		
	   	var modulo = $(this).attr("data-modulo");
        var ctrl = $(this).attr("data-ctrl");
    	var titulo = $(this).attr("data-titulo");
    	var div = $(this).attr("data-div");
    	var order_by = $(this).attr("data-order_by");
    	var order = $(this).attr("data-order");
    	var filterLetter = $(this).attr("data-search_frase");
    	var dataIni = $(this).attr("data-data_ini");
        var dataFinal = $(this).attr("data-data_fin");
        var page =  $(this).attr("data-page");
        var id = 0;	
        
    	if (dataIni.length > 0 && dataFinal.length > 0) {
            dataIni = dataIni;
            dataFinal = dataFinal;
        }
        	
       	returnView(modulo, ctrl, page, 'index',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, order);
    });
    
    /**
     * 
     * função para criação de um input select
     * Devera ser utlizado um atributo data-ctrl_pesquisa no form, controller a ser consultado, 
     * Devera ser utilizado um atributo data-novo_select no form, name do select a receber as atualizações,
     * o novo input type="select" devera receber as novas entradas
     */
    $(document).on("change", ".select-create", function() {
    	var form = $(this).closest("form").attr('id');
    	var id = $(this).val();
    	
    	if (!$.isNumeric($(this).val())) {
    		id = 0;
    	}
    	
		$.ajax({
			url     : $(this).attr("data-modulo")+"/"+$(this).attr("data-ctrl_pesquisa")+"/get/id/"+id+"", // or the ure of your action
			type    : "POST",// POST, GET
			cache   : false,
			data    : {name: $(this).attr('data-novo_select'), form: $(this).closest("form").attr('id')}, // the data from your form , in your case the :selected
			dataType: "json",
			success : function(data)
			{
				/*Seleciona o primeiro text do option do select em uso*/
				var selecionado = $('#'+data.form).find("select[name='"+data.name+"'] option:first").text();
				/*Limpa options do select que vai receber os options atualizados pertencente ao id e campo selecionados*/
				$('#'+data.form).find("select[name='"+data.name+"']").empty();
				
				$('#'+data.form).find("select[name='"+data.name+"']").append($('<option>', {
				    value: null,
				    text: selecionado
				}));
				
				$.each(data.dados, function (i, item) {
					$('#'+data.form).find("select[name='"+data.name+"']").append($('<option>', {
					    value: data.dados[i].id,
					    text: data.dados[i].nome
					}));
				});
			},
		
			/*Se erro retorna a tela de erros*/
			error:function(response){
				$('#principal').html(response.responseText);  	    	  
			} 
		});
    });
});

/**
 * Função para deletar um item da tabela
 */
$(document).on("click", '.delete', function(event) {
	var r = confirm("Deseja mesmo excluir esse registro?");
    if (r == true) {
    	var form = $(this).closest("form").attr('id');
    	var modulo = $('#'+form).attr("data-modulo");
        var ctrl = $('#'+form).attr("data-ctrl");
    	var titulo = $('#'+form).attr("data-titulo");
    	var div = $('#'+form).attr("data-div");
    	var order_by = $('#'+form).attr("data-order_by");
    	var order = $('#'+form).attr("data-order");
    	var filterLetter = '';
    	var page = 1;
    	var id = $('#'+form).attr("data-id");
    	var dataIni = '';
    	var dataFinal = '';
    	
	   	$.ajax({
			url     :modulo+"/"+ctrl+"/delete/id/"+id,// or the url of your action
			type    : 'POST',// POST, GET
			cache   : false,
			data    : {del: 'Yes'}, // the data from your form , in your case the :selected
			dataType: "json",
			success : function(data)
			{
			    alert(data.errorMessage);
			    //Aqui se deve colocar uma rota para voltar ao index
			    returnView(modulo, ctrl, page, 'index',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, order);
			},
			
			/*Se erro retorna a tela de erros*/
			error:function(response){
				$('#principal').html(response.responseText);  	    	  
			} 
	   	});
	} else {
	    txt = "Você pressionou cancela!";
	    return false;
	}
	return false;
});

/**
 * Função para exibir div de atalho
 * Criar data-atalho no button e colorar o nome da div de popup do form
 */
var current_form; /*Pega nome do form atual para ser usado no retorno de dados*/
$(document).on("click", ".atalhos", function() {
    var page = 1;
    current_form = $(this).closest("form").attr('id');
    var modulo = $(this).attr("data-modulo");
    var ctrl = $(this).attr("data-ctrl");
	var titulo = '';
	var div = $(this).attr("data-div");
	var current_div = $(this).attr("data-current_div"); 
	var dataIni = '';
    var dataFinal = '';
    var filterLetter = '';
    var id = $(this).attr("data-id");
    var order_by = $(this).attr("data-order_by");

    $('#'+div).show();
    
    returnView(modulo, ctrl, page, 'index',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, 'ASC', true);

	
});


/**
* Função para exibir div de atalho
* Criar data-atalho no button e colorar o nome da div de popup do form
*/
$(document).on("click", ".selecao", function() {	
    var page = 1;
    var modulo = $(this).attr("data-modulo");
    var ctrl = $(this).attr("data-ctrl");
	var titulo = '';
	var div = $(this).attr("data-div");	
	var dataIni = '';
    var dataFinal = '';
    var filterLetter = '';
    var id = $(this).attr("data-id");
    var order_by = '';

    
    var url = returnView(modulo, ctrl, page, 'get',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, 'ASC', true, true);
    
    var dados = $(this).serialize();
	$.ajax({
	      url: url,
	      type: 'Post',
	      dataType: 'json',
	      data: dados,
	      success:function(json){
	    	  $('#'+div).hide();
	    	  $.each(json.dados[0], function(key,value) {
	    		  try { 
	    			  $('#'+current_form).find("[name='"+key+"']").val(value);
	    		  } catch (e) {
	    			  
	    		  }	    		 
	    		});
	      },
	      /*Se erro retorna a tela de erros*/
	      error:function(response){
	    	  alert("Erro");    	  
		  } 
	 });	
	
});
