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
                		//returnView(modulo, ctrl, 1, 'edit', div, '', '', '', data.id, titulo);
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
	    	var dataIniName = "";
	    	var dataFinName = "";

	    	var index = $('#tabs').data('tabs').options.selected;  //Retorna o número do índice da aba usada
	    	var titulo = $('#tabs ul:first li:eq('+index+') span:first').text();	
		    	
	    	if ($('#'+form).attr("data-tipo_view") == undefined || $('#'+form).attr("data-tipo_view") == null || $('#'+form).attr("data-tipo_view") == '' ) {
	    		view = false;
	    	} else {
	    		view = $('#'+form).attr("data-tipo_view");
	    	}
	        
	       	
	        returnView(modulo, ctrl, page, 'index',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, order, view);
	        });
    })

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
    	var dataIni = "";
        var dataFinal = "";
        var page =  $(this).attr("data-page");
        var id = 0;	
        	
       	returnView(modulo, ctrl, page, 'index',div, filterLetter, dataIni, dataFinal, id, titulo, order_by, order);
    });    

});

