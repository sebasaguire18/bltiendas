<section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__content">
                        <div class="contact__address">
                            <h5>Información de contacto</h5>
                            <ul>
                                <li>
                                    <h6><i class="fa fa-map-marker"></i> Dirección</h6>
                                    <p>Colombia | Eje cafetero</p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-whatsapp"></i> Celular</h6>
                                    <p><a href="https://wa.me/573233858522?text=Hola,%20deseo%20contactarme%20porque%20tengo%20un%20problema" target="_blank" rel="noopener noreferrer" class="text-black"><span>+57 323 385 8522</span></a></p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-headphones"></i> Soporte</h6>
                                    <p><span><a href="mailto:soporte@bltiendas.com" target="_blank" rel="noopener noreferrer" class="text-black">soporte@bltiendas.com</a></span><span><a href="mailto:contacto@bltiendas.com" target="_blank" rel="noopener noreferrer" class="text-black">contacto@bltiendas.com</a></span></p>
                                </li>
                            </ul>
                        </div>
                        <div class="contact__form">
                            <h5>Envianos Un Mensaje</h5>
                            <form id="contactForm"  action="" method="POST">
                                <input type="text" name="emailContacto" id="emailContacto" placeholder="Email">
                                <div class="invalid-feedback mt-0">
                                    Por favor ingresa un email valido
                                </div>
                                <input type="text" name="asuntoContacto" id="asuntoContacto" placeholder="Asunto">
                                <div class="invalid-feedback mt-0">
                                    Por favor ingresa el asunto
                                </div>
                                <textarea name="mensajeContacto" id="mensajeContacto" placeholder="Mensaje"></textarea>
                                <div class="invalid-feedback mt-0">
                                    Por favor ingresa un mensaje
                                </div>
                                <button type="submit" id="btn_contacto" class="site-btn">Enviar Contacto</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__map">
                        <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48158.305462977965!2d-74.13283844036356!3d41.02757295168286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2e440473470d7%3A0xcaf503ca2ee57958!2sSaddle%20River%2C%20NJ%2007458%2C%20USA!5e0!3m2!1sen!2sbd!4v1575917275626!5m2!1sen!2sbd"
                        height="780" style="border:0" allowfullscreen="">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        $(document).ready(function() {
            $('#contactForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                  // Para el fomulario de contacto
                    let exprEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$/;
                    $('#emailContacto','#asuntoContacto','#mensajeContacto').removeClass('is-invalid');

                    let emailContacto = $('#emailContacto').val();
                    let asuntoContacto = $('#asuntoContacto').val();
                    let mensajeContacto = $('#mensajeContacto').val();


                    if(emailContacto == '' || !exprEmail.test(emailContacto)){
                        $('#emailContacto').addClass('border-danger');
                        $('#emailContacto').addClass('is-invalid');
                        return false;
                    }else{
                        $('#emailContacto').removeClass('border-danger');
                        $('#emailContacto').removeClass('is-invalid');

                        if(asuntoContacto == ''){
                            $('#asuntoContacto').addClass('border-danger');
                            $('#asuntoContacto').addClass('is-invalid');
                            return false;
                        }else{
                            $('#asuntoContacto').removeClass('border-danger');
                            $('#asuntoContacto').removeClass('is-invalid');
                            if(mensajeContacto == '' || mensajeContacto == ' '){
                                $('#mensajeContacto').addClass('border-danger');
                                $('#mensajeContacto').addClass('is-invalid');
                                return false;
                            }else{
                                $('#mensajeContacto').removeClass('border-danger');
                                $('#mensajeContacto').removeClass('is-invalid');
                                
                                // Envio de datos por ajax
                                $tipo = 'EnviarDatosContacto';
                                $.ajax({
                                    type: 'POST',
                                    url: '../php/controler.php',
                                    dataType: 'html',
                                    data: {
                                        tipo: $tipo,
                                        emailContacto: emailContacto,
                                        asuntoContacto: asuntoContacto,
                                        mensajeContacto: mensajeContacto
                                    },
                                    success: function(response) {
                                        if (response == 1) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Mensaje enviado correctamente',
                                                showConfirmButton: false,
                                                timer: 1500
                                            });
                                            $('#contactForm')[0].reset(); // Reset the form after successful submission
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error al enviar el mensaje',
                                                text: response,
                                            });
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText); // Log the error for debugging
                                    }
                                });
                            }
                        }
                    }
            });
        });
    </script>