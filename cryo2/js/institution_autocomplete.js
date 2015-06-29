$(document).ready(function(){
	// Aqui que tudo come�a. Observe que usei o atributo name do campo que ser� digitado o texto como refer�ncia.
	new Autocomplete("campo_estado", function() {
		// Quando o autocomplete trazer o resultado da consulta, vai atribuir nos campos correspondentes
		this.setValue = function( id, estado, sigla ) {
			$("#id_val").val(id);
			$("#estado_val").val(estado);
			$("#sigla_val").val(sigla);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		// O arquivo php abaixo � que ser� chamado via AJAX, sendo passado o par�metro q com o valor digitado no campo
		return "ajax.php?q=" + this.value;
	});

});
