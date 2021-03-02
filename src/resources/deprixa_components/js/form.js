function revisar(elemento) {
    if (elemento.value==""){
        elemento.className='error';
    } else {
        elemento.className='form-input';
    }
}

function revisaremail(elemento) {
    if (elemento.value!=""){
        var dato = elemento.value;
        var expresion = /^([a-zA-Z0-9_.-])+@(([a-zA-z0-9-])+.)+([a-zA-Z0-9-]{2,4})+$/;
        if (!expresion.test(dato)) {
            elemento.className='error';
        } else {
        elemento.className='form-input';
        }
	}
}


function validar(form) {
  if(form.nombre.value=="") { 
    alert('No has escrito tu nombre'); 
    return false; 
  }
  
  if(form.email.value=="") { 
    alert('No has escrito tu e-Mail'); 
    return false; 
  }
  
  if(form.asunto.value=="") { 
    alert('No has escrito el Asunto'); 
    return false; 
  }
 
  return true; 
}