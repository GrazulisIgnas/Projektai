function validation(event) {
    event.preventDefault();
    var email = document.getElementById("email");
    var psw = document.getElementById("psw");
    var pswr = document.getElementById("psw-repeat");
    var name = document.getElementById("name");
    var lastname = document.getElementById("lastname");
    var date = document.getElementById("date");
    if (email.checkValidity() && psw.checkValidity() && psw.value == pswr.value
        && name.value != '' && lastname.value != '' && date.value != ''
        ){
		fetch("available.php?email=" + email.value)
		.then(function(response){
			return response.json();	
		})
		.then(function(json){
			if(json.available){
				Swal.fire({
				title: 'Registracija sėkminga!',
				icon: 'success',
				confirmButtonText: 'OK',
				}).then((result) => {
				  if (result.isConfirmed) {
					document.theForm.submit();
				  }
				})
        		return true;
			} 
			else {
				Swal.fire({
                title: 'Elektroninis paštas jau užimtas!',
                icon: 'error'
            	})
				return false;
			}
		}) 
    } 
    else {
        if (psw.value != pswr.value) {
            Swal.fire({
                title: 'Slaptažodžiai nesutampa!',
                icon: 'error'
            })
        }
        if (name.value == '' || lastname.value == '' || date.value == '') {
            Swal.fire({
                title: 'Ne visi laukai yra užpildyti!',
                icon: 'error'
            })
        }
        return false;
    }  
}