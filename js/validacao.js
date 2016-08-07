
	function validaUsuario() {
	var usuario = cadastro.usuario.value;
	var senha = cadastro.senha.value;
	var rep_senha = cadastro.senhaConfirma.value;
	
	if (usuario.length < 5) {
	alert('Digite seu usuário no mínimo 5 caracteres.');
	cadastro.usuario.focus();
	return false;
	}

	if(senha.length <5 && rep_senha.length < 5){
	    alert('Preencha a sua senha pessoal no cadastro no mínimo 5 caracteres.');
		cadastro.senha.focus();
		cadastro.senhaConfirma.focus();
		return false;
		}
	if (senha != rep_senha ) {
		alert('Senhas diferentes! Favor preencher as duas senhas igualmente.');
		cadastro.senha.focus();
		cadastro.senhaConfirma.focus();
		return false;
		}
		return true;
		
	}
	function validaEdicaoUsuario() {
	var usuario = cadastro.nome.value;
	var senha = cadastro.senha.value;

	
	if (usuario.length < 5) {
	alert('Digite seu usuário no mínimo 5 caracteres.');
	cadastro.nome.focus();
	return false;
	}

	if(senha.length <5){
	    alert('Preencha a sua senha pessoal no cadastro no mínimo 5 caracteres.');
		cadastro.senha.focus();
		return false;
		}
		return true;
		
	}
	function validaSala() {
	var nome = cadastro.nome.value;
	var numero = cadastro.numero.value;
	
	if (nome.length < 5) {
	alert('Digite o nome da sala no mínimo 5 caracteres.');
	cadastro.nome.focus();
	return false;
	}

	if(numero ==" "){
	    alert('Digite o número da sala.');
		cadastro.numero.focus();
		return false;
		}
		return true;
		
	}
	
	function validaLogin() {
	var usuario = login.usuario.value;
	var senha = login.senha.value;
	
	if (usuario.length < 5) {
	alert('Preencha o usuário cadastro com o mínimo de 5 caracteres.');
	login.usuario.focus();
	return false;
	}

	if(numero ==" "){
	    alert('Digite a sua senha');
		login.senha.focus();
		return false;
		}
		return true;
		
	}
	
	