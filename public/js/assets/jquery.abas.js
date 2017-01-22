/**
 * Variável global para contar o número de abas
 */
var container = 0;

/**
 * Monta a aba
 * @param title nome a ser mostrado na aba
 * @param url rota a ser enviada
 * @param rel campo rel dos parametros da div
 */
function addTab(title, url, rel)
{
	var titulo = rel;
	var numAbas = 0;
	container += 1;
	
	var content = "";    
	if ($('#tabs').tabs('exists', title)) {
        $('#tabs').tabs('select', title);
    } else{
    	rel = rel+'_'+container;
    	
		$.ajax({
		      url: url+'/'+rel,
		      type: 'Post',
		      dataType: 'json',
		      data: numAbas,
		      success:function(json) {
		    	  content = '<div id ="'+rel+'" name ="'+titulo+'" style="width:100%;height:530px;" class=tab-view"></div>';
		    	  $('#tabs').tabs('add',{
		              title:title,
		              content:content,
		              closable:true
		          });
		          
		    	  retornaHtml(json.html,rel);
		    	  
		    	  var index = $('#tabs').data('tabs').options.selected;
		    	  $('#tabs ul:first li:eq('+index+') a:first').attr('href','#'+rel);	
		      },
		      /*Se erro retorna a tela de erros*/
		      error:function(response){
		    	 $('#principal').html(response.responseText);  	    	  
		      } 
		 });
    }
}

/**
 * Monta html na div fornecida
 * @param html html a ser montado
 * @param id  id da div onde será montado o html
 */
function retornaHtml(html,id)
{
	$("#"+id).html('');
	$("#"+id).append(html);
}

/*
 * Envia uma solicitação Ajax, o retorno Json é usado para renderizar a tela(modo paginação)
 * @var string modulo usado para selecionar em qual div os dados serão renderizados
 * @var string title nome que será mostrado na aba usada
 * @var string divDados nome da div usada para renderizar os dados
 * @var string ctrl nome do controle as ser usado
 * @var string action nome da ação a ser invocada
 * @var string searchBy dados a serem pesquisados no banco
 * @var string dataIni Data Inicial
 * @var string dataFinal Data Final
 * @var string view Usada em atalhos, true=imprementar funçoes de atalho
 */
function returnView(modulo, ctrl, page, action, divDados, searchBy, dataIni, dataFinal, id, title, orderBy, order, view = false, ajaxOff = false)
{   
	if (searchBy == undefined || searchBy == null || searchBy == '' ) {
		searchBy = '';
	} else {
		searchBy = '/search_frase/' + searchBy;
	}
	
	if (page == undefined || page == null || page == '' ) {
		page = '';
	} else {
		page = '/page/' + page;
	}
	
	if (id == undefined || id == null || id == '' ) {
		id = '';
	} else {
		id = '/id/' + id;
	}

	if (dataIni == undefined || dataIni == null || dataIni == '' ) {
		dataIni='';
	} else {
		dataIni = '/data_ini/' + formataData(dataIni);
	}
	
	if (dataFinal == undefined || dataFinal == null || dataFinal == '' ) {
		dataFinal = '';
	} else {
		dataFinal = '/data_fin/' + formataData(dataFinal);
	}


	if (title == undefined || title == null || title == '' ) {
		titulo = titulo;
	} else {
		titulo = title;
	}
	
	if (orderBy == undefined || orderBy == null || orderBy == '' ) {
		orderBy = '/order_by/id';
	} else {
		orderBy = '/order_by/' + orderBy;
	}
	
	if (order == undefined || order == null || order == '' ) {
		order = '/ASC';
	} else {
		order = '/' + order;
	}
	
	if (view == undefined || view == null || view == '' ) {
		view = '';
	} else {
		view = '/tipo_view/' + view;
	}

	var url = modulo + '/' + ctrl + '/' + action + id + page + '/' + divDados + orderBy + order + searchBy + dataIni + dataFinal + view; //Monta a url

	if(!ajaxOff) {
		consultaAjax(url, divDados, titulo);
	}else{
		return url;
	}
	
}

/**
 *  Modulo usado para solitações/retornos Ajax
 * @param url rota a ser enviada
 * @param divDados id da div onde sera renderizado o html
 * @param titulo
 */
function consultaAjax(url, divDados, titulo)
{	
	var dados = $(this).serialize();
	$.ajax({
	      url: url,
	      type: 'Post',
	      dataType: 'json',
	      data: dados,
	      success:function(json){
	    	  var index = $('#tabs').data('tabs').options.selected;  //Retorna o número do índice da aba usada
	    	  $('#tabs ul:first li:eq('+index+') span:first').text(titulo);	    	 
	    	  retornaHtml(json.html, divDados);    	  
	      },
	      /*Se erro retorna a tela de erros*/
	      error:function(response){
	    	  $('#principal').html(response.responseText);  	    	  
		  } 
	 });	
}
/**
 * Formata data para ser enviada pela url;
 * @param data
 * @returns
 */
function formataData(data) 
{
	if (data.indexOf("/") > 0) {
		var retorno = data.split("/");
		return retorno[2] + "-" + retorno[1] + "-" + retorno[0];
	} else {
		return data;
	}
}
