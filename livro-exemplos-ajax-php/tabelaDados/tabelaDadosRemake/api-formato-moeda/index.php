<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <input type="text" name="campo" id="campo-moeda">

        <footer>
            <script>
                
                var campo_moeda = document.getElementById('campo-moeda');
                campo_moeda.addEventListener('change', function(event){;

                    event.preventDefault();
                    this.value = Formata_Moeda(this.value);

                });
                
                function Formata_Moeda(campo){

                    var contador              = 0;
                    var contadorAuxliar       = 0;
                    
                    var campoLength           = 0;
                    var campoLengthAuxliar    = 0;

                    var campoCharacter        = '';
                    var campoCharacterAuxliar = '';

                    var listaNumerosPossiveis = '0123456789';

                    var SeparadorDecimal      = ',';

                    var SeparadorMilesimo     = '.';
                    
                    for(contador = 0; contador < campo.length; contador++){
                        if ((campo.charAt(contador) != '0') && (campo.charAt(contador) != SeparadorDecimal)){
        	                break;
                        }
                    }

                    for(; contador < campo.length; contador++){
                        if (listaNumerosPossiveis.indexOf(campo.charAt(contador)) != -1){
        	                campoCharacter += campo.charAt(contador);
                        }
                    }                            

                    campoLength = campoCharacter.length;
                    if (campoLength == 0){ // ''
                        campo = '';
                    }

                    if (campoLength == 1){ // 0,05
                        campo = '0' + SeparadorDecimal + '0' + campoCharacter;
                    }

                    if (campoLength == 2){ // 0,50
                        campo = '0' + SeparadorDecimal + campoCharacter;
                    }

                    if (campoLength == 3){ // 1,50
                        campo = campoCharacter.substr((campoLength - 3), (campoLength - 2)) + SeparadorDecimal + campoCharacter.substr((campoLength - 2), (campoLength - 1));
                    }                    

                    if (campoLength > 3) { // 25,50 ou 225,50 ou 2.250,50
                        for (contadorAuxliar = 0, contador = (campoLength - 3); contador >= 0; contador--) {
                            if (contadorAuxliar == 3) {
                                campoCharacterAuxliar += SeparadorMilesimo;
                                contadorAuxliar = 0;
                            }
                        
                            campoCharacterAuxliar += campoCharacter.charAt(contador);
                            contadorAuxliar++;
                        }
                    
                        campo = '';
                        campoLengthAuxliar = campoCharacterAuxliar.length;

                        for (contador = (campoLengthAuxliar - 1); contador >= 0; contador--){
                            campo += campoCharacterAuxliar.charAt(contador);
                        }

                        // campo += SeparadorDecimal + campoCharacter.substr(campoLength - 2, campoLength);
                        // (campoLength - (campoLength - 2)) = 10 - (10 - 2)
                        campo += SeparadorDecimal + campoCharacter.substr((campoLength - 2), (campoLength - (campoLength - 2)));
                    }
                    
                    return campo;
                }
            </script>
        </footer>
    </body>
</html>