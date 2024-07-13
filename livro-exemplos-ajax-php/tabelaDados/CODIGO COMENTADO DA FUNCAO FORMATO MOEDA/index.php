<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="text" name="formato-moeda" class="formato-moeda" maxlength="20">
    <input type="text" name="campo" id="campo-moeda">
    <footer>
        <script>
            var ajax = null;
            var formato_moeda = document.querySelector('.formato-moeda');
            
            var campo_moeda = document.getElementById('campo-moeda');
            campo_moeda.addEventListener('change', function(event){;
                
                event.preventDefault(); // essa linha e necessaria para não haver mais de uma chamada da função abaixo                
                this.value = Formata_Moeda(this.value);

            });
            
            formato_moeda.addEventListener('keypress', function(event){;
                
                event.preventDefault(); // essa linha e necessaria para não haver mais de uma chamada da função abaixo
                FormataMoeda(this, '.', ',', event);

                // if(typeof somenteNumeros(e) == 'undefined'){
                //     if(objeto.value.length > 0){
                //         // se correu tudo certo na validação, então podemos realizar nossa requisição
                //         requisicaoHTTP('GET', 'api.php?parametro='+encodeURIComponent(objeto.value), true);
                //     }
                // 
                // }                
            });

            // criar o objeto e realizar a requisição
            function requisicaoHTTP(tipo, url, assinc){
                if(window.XMLHttpRequest){ // Mozilla, Safari, ...
                    ajax = new XMLHttpRequest();

                }else if(window.ActiveXObject){ //IE
                    ajax = new ActiveXObject("Msxml2.XMLHTTP");
                    if(!ajax){
                        ajax = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }

                if(ajax){ // iniciado com sucesso
                    iniciaRequisicao(tipo, url, assinc);
                }else{
                    alert("Seu navegador não possui suporte a essa aplicaçao!");
                }                
            }

            // Inicializa o objeto criado e envia os dados(caso exista)
            function iniciaRequisicao(tipo, url, assinc){                
                ajax.onreadystatechange = trataResposta;
                ajax.open(tipo, url, assinc);
                ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
                ajax.send();
            }
            
            // Trata a resposta do servidor
            function trataResposta(){
                if(ajax.readyState == 4){
                    if(ajax.status == 200){
                        // code response here
                        console.log(ajax.responseText);
                        formato_moeda.value = ajax.responseText;
                    }else{
                        alert("Problema na comunicação com o objeto XMLHttpRequest.");
                    }
                }
            }

            // somente e permitido digitar numeros
            function somenteNumeros(e){
                var charCode = e.charCode ? e.charCode : e.keyCode;
                // charCode 8 = backspace   
                // charCode 9 = tab
                if (charCode != 8 && charCode != 9 && charCode != 44 && charCode != 46) {
                    // charCode 48 equivale a 0   
                    // charCode 57 equivale a 9
                    if (charCode < 48 || charCode > 57) {
                        return e.preventDefault();
                    }
                }
            }

            // formata campo monetario para o padrão brasil
            function FormataMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e) {

                var key = '';
                var i = j = 0;
                var len = len2 = 0;
                var strCheck = '0123456789';
                var aux = aux2 = '';

                var whichCode = (window.addEventListener) ? e.which : e.keyCode;
                // 13=enter, 8=backspace as demais retornam 0(zero)
                // whichCode==0 faz com que seja possivel usar todas as teclas como delete, setas, etc
                
                if ((whichCode == 13) || (whichCode == 0) || (whichCode == 8)){
                    return true;                    
                }

                // CONVERTE DO NUMERO (whichCode) PARA OQUE O USUÁRIO CLICOU NO TECLADO
                key = String.fromCharCode(whichCode); // Valor para o código da Chave

                // VERIFICA SE OQUE A PESSOA DIGITOU E UM NUMERO, CASO NÃO, SAIA DA FUNÇÃO
                if (strCheck.indexOf(key) == -1){ // ESSA LINHA -1 == A TRUE
                    return false; // Chave inválida
                }

                // ARMAZENANDO NA VARIAVEL LEN O TAMANHO DO INPUT
                // LEMBRANDO QUE LEN E <> DO KEY VARIAVEL QUE RECEBE O NOVO NUMERO DIGITADO
                len = objTextBox.value.length;

                // VERIFICANDO SE O VALOR DA VARIAVEL len E MAIOR QUE O DO ATRIBUTO maxlength do INPUT
                if(len >= objTextBox.getAttribute('maxlength')){
                    return false; // SE FOR, ENTÃO IREMOS SAIR DA FUNÇÃO
                }

                // NESSE BLOCO VALIDAMOS SE A POSIÇÃO 'i' E <> DE 0 E <> 'SeparadorDecimal' NOSSO CASO A 'VIRGULA'
                // CASO SEJA, ENTÃO SAIR DA REPETIÇÃO, ESSE BLOCO E NESSECESSARIO POIS E AQUI QUE INCREMENTAMOS A VARIAVEL 'i'
                // E USAMOS ELA NO NOSSO PROXIMO LOOP, MAIS ABAIXO
                for(i = 0; i < len; i++){                    
                    if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)){
                        break;
                    }
                }

                // AQUI ESTAMOS USANDO O ULTIMO VALOR QUE COLOCADO NA VARIAVEL 'i' ACIMA
                // ESTAMOS FAZENDO UMA LIMPEZA NO 'VALUE' DE NOSSO INPUT RETIRANDO SOMENTE OS VALORES
                // SEM OS PONTOS E VIRGULA 100.500,50 => 10050050

                aux = '';
                for(; i < len; i++){
                    // COMO ESTAMOS APROVEITANDO O VALOR DA VARIAVEL i QUE FOI INCREMENTADA NO LOOP ACIMA
                    // AQUI ESTAMOS SOMENTE UMA POSIÇÃO ATRAS DE LEN, DESSA FORMA CONSEGUIMOS PERCORRER
                    // UMA A UMA DAS POSIÇÕES DO NOSSO INPUT
                    // ',' == -1 ou '.' == -1: -1 SIGNIFICA QUE NÃO ACHOU
                    if (strCheck.indexOf(objTextBox.value.charAt(i)) != -1){
                        aux += objTextBox.value.charAt(i);
                    }
                }
                aux += key;
                len = aux.length;
                if (len == 0){
                    objTextBox.value = '';
                }

                if (len == 1){
                    objTextBox.value = '0' + SeparadorDecimal + '0' + aux;
                }

                if (len == 2){
                    objTextBox.value = '0' + SeparadorDecimal + aux;
                }

                // VAMOS ENTRA NA VALIDAÇÃO ABAIXO CASO A QUANTIDADE DE CARACTERES SEJA MAIOR QUE 2
                // EM NOSSO INPUT
                if (len > 2) {
                    aux2 = ''; // INICIANDO A VARIAVEL AUX2
                    
                    // NESSA REPETIÇÃO VAMOS DEFINIR 0 PARA 'j' I PARA 'i' VAMOS DEFINIR (len - 3)
                    // ESSE (-3) SIGNIFICA QUE ESTAMOS REMOVENDO (,00) OU QUALQUER VALOR COMO (,45)
                    // COM ISSO VAMOS CONSEGUIR PERCORRER SOMENTE OS VALORES QUE VÃO NOS AJUDAR A SABER
                    // SE JÁ TEMOS UMA QUANTIDADE DE MILHAR
                    // DECREMENTE i INCREMENTE j VERIFIQUE SE j E == 3 SE SIM INCLUIR UM MILHAR '.'
                    // COMO PODE SER VISTO AGENTE INCLUI O VALOR E O 'PONTO .'
                    // NO 1º MOMENTO ISSO NÃO IRA FUNCIONAR POR QUE
                    // SOMENTE TEREMOS VALORES DECIMAIS COMO (10,45) -3 = (10)
                    for (j = 0, i = (len - 3); i >= 0; i--) {
                        if (j == 3) {
                            aux2 += SeparadorMilesimo; // 1.000 - 000.1
                            j = 0; // REINICIANDO j PARA UM PROXIMO NUMERO MILHAR (1.000)
                        }
                        
                        aux2 += aux.charAt(i); // CONCATENANDO aux2 PEGANDO A POSIÇÃO i NA STRING aux
                        j++; // INCREMENTANDO j PARA VALIDAÇÃO
                    }

                    objTextBox.value = ''; // LIMPANDO NOSSO INPUT PARA FUTURO PREENCHIMENTO
                    len2 = aux2.length; // ATRIBUINDO A VARIAVEL lan2  O TAMANHO DE aux2

                    // AQUI ESTAMOS PERCORRENDO A VARIAVEL len2 E IMPRIMINDO DE FORMA RE-INVERSA A 
                    // VARIAVEL QUE CONTEM O NOSSO VALOR CONCATENADO ACIMA NO LOOP
                    // ISSO AQUI (len2 - 1) E NECESSARIO PARA USARMOS COM A FUNÇÃO charAt
                    // COMO ELA TRABALHA COM ARRAY E NECESSARIO QUE AGENTE PERCORRA ATE O
                    // INDICE 0, POR ISSO NOSSO FOR DEVE IR ATE 0
                    // for (i = (len2 - 1); i >= 0; i--){
                    for (i = (len2 - 1); i >= 0; i--){
                        objTextBox.value += aux2.charAt(i);
                    }

                    // AO CHEGAR AQUI ESTAMOS INCLUINDO A (VIRGULA ,) E OS VALORES DECIMAIS  ASSIM = ,50 OU ,45
                    // DESSA FORMA FICARA NO FINAL ASSIM 1.000,45 OU 1.000,50

                    // ESSA PARTE => aux.substr(len - 2, len); SIGNIFICA QUE ESTA RETIRANDO A PARTE DECIMAL
                    // IREMOS USALA PARA CONCATENAR COM NOSSA STRING FINAL => 10.000,50
                    objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
                }

                return false;
            }

            // formata campo monetario para o padrão brasil
            function Formata_Moeda(campo){

                var i                 = 0;
                var j                 = 0;

                var len               = 0;
                var len2              = 0;

                var aux               = '';
                var aux2              = '';

                var strCheck          = '0123456789';
                var SeparadorDecimal  = ',';
                var SeparadorMilesimo = '.';

                // ARMAZENANDO NA VARIAVEL LEN O TAMANHO DO INPUT
                // LEMBRANDO QUE LEN E <> DO KEY VARIAVEL QUE RECEBE O NOVO NUMERO DIGITADO
                len = campo.length;

                // NESSE BLOCO VALIDAMOS SE A POSIÇÃO 'i' E <> DE 0 E <> 'SeparadorDecimal' NOSSO CASO A 'VIRGULA'
                // CASO SEJA, ENTÃO SAIR DA REPETIÇÃO, ESSE BLOCO E NESSECESSARIO POIS E AQUI QUE INCREMENTAMOS A VARIAVEL 'i'
                // E USAMOS ELA NO NOSSO PROXIMO LOOP, MAIS ABAIXO

                // VARRE NOSSA STRING REMOVENDO '0' A ESQUERDA E ',' FICANDO SOMENTE OS NUMEROS 
                // DA ESQUERDA PARA A DIREIRA.
                // ICORRETO: .100,50 CORRETO 1.000,50
                // ELE IRA PASSAR 0,50 QUANDO ELE ACHAR ALGO <> 0 E , ELE SAI DA REPETIÇÃO

                // for(i = 0; i < len; i++){
                //     if((campo.charAt(i) != '0') && (campo.charAt(i) != SeparadorDecimal)){
                //         break;
                //     }
                // }
                
                // AQUI ESTAMOS USANDO O ULTIMO VALOR QUE COLOCADO NA VARIAVEL 'i' ACIMA
                aux = '';
                // for(; i < len; i++){
                for(i = 0; i < len; i++){
                
                    // COMO ESTAMOS APROVEITANDO O VALOR DA VARIAVEL i QUE FOI INCREMENTADA NO LOOP ACIMA
                    // AQUI ESTAMOS SOMENTE UMA POSIÇÃO ATRAS DE LEN, DESSA FORMA CONSEGUIMOS PERCORRER
                    // UMA A UMA DAS POSIÇÕES DO NOSSO INPUT
                    if (strCheck.indexOf(campo.charAt(i)) != -1){
                        aux += campo.charAt(i);
                    }
                }

                len = aux.length;
                if (len == 0){
                    campo = '';
                }

                if (len == 1){
                    campo = '0' + SeparadorDecimal + '0' + aux;
                }

                if (len == 2){
                    campo = '0' + SeparadorDecimal + aux;
                }

                // VAMOS ENTRA NA VALIDAÇÃO ABAIXO CASO A QUANTIDADE DE CARACTERES SEJA MAIOR QUE 2
                // EM NOSSO INPUT
                if (len > 2) {
                    aux2 = ''; // INICIANDO A VARIAVEL AUX2
                
                    // NESSA REPETIÇÃO VAMOS DEFINIR 0 PARA 'j' I PARA 'i' VAMOS DEFINIR (len - 3)
                    // ESSE (-3) SIGNIFICA QUE ESTAMOS REMOVENDO (,00) OU QUALQUER VALOR COMO (,45)
                    // COM ISSO VAMOS CONSEGUIR PERCORRER SOMENTE OS VALORES QUE VÃO NOS AJUDAR A SABER
                    // SE JÁ TEMOS UMA QUANTIDADE DE MILHAR
                    // DECREMENTE i INCREMENTE j VERIFIQUE SE j E == 3 SE SIM INCLUIR UM MILHAR '.'
                    // COMO PODE SER VISTO AGENTE INCLUI O VALOR E O 'PONTO .'
                    // NO 1º MOMENTO ISSO NÃO IRA FUNCIONAR POR QUE
                    // SOMENTE TEREMOS VALORES DECIMAIS COMO (10,45) -3 = (10)
                    for (j = 0, i = (len - 3); i >= 0; i--) {
                        if (j == 3) {
                            aux2 += SeparadorMilesimo; // 1.000 - 000.1
                            j = 0; // REINICIANDO j PARA UM PROXIMO NUMERO MILHAR (1.000)
                        }
                    
                        aux2 += aux.charAt(i); // CONCATENANDO aux2 PEGANDO A POSIÇÃO i NA STRING aux
                        j++; // INCREMENTANDO j PARA VALIDAÇÃO
                    }
                
                    campo = ''; // LIMPANDO NOSSO INPUT PARA FUTURO PREENCHIMENTO
                    len2 = aux2.length; // ATRIBUINDO A VARIAVEL lan2  O TAMANHO DE aux2
                
                    // AQUI ESTAMOS PERCORRENDO A VARIAVEL len2 E IMPRIMINDO DE FORMA RE-INVERSA A 
                    // VARIAVEL QUE CONTEM O NOSSO VALOR CONCATENADO ACIMA NO LOOP
                    // ISSO AQUI (len2 - 1) E NECESSARIO PARA USARMOS COM A FUNÇÃO charAt
                    // COMO ELA TRABALHA COM ARRAY E NECESSARIO QUE AGENTE PERCORRA ATE O
                    // INDICE 0, POR ISSO NOSSO FOR DEVE IR ATE 0
                    // for (i = (len2 - 1); i >= 0; i--){
                    for (i = (len2 - 1); i >= 0; i--){
                        campo += aux2.charAt(i);
                    }
                
                    // AO CHEGAR AQUI ESTAMOS INCLUINDO A (VIRGULA ,) E OS VALORES DECIMAIS  ASSIM = ,50 OU ,45
                    // DESSA FORMA FICARA NO FINAL ASSIM 1.000,45 OU 1.000,50
                
                    // ESSA PARTE => aux.substr(len - 2, len); SIGNIFICA QUE ESTA RETIRANDO A PARTE DECIMAL
                    // IREMOS USALA PARA CONCATENAR COM NOSSA STRING FINAL => 10.000,50
                    campo += SeparadorDecimal + aux.substr(len - 2, len);
                }
                return campo;
            }
        </script>
    </footer>
</body>
</html>