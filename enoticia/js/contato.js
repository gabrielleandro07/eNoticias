const inputsContact = document.querySelectorAll('.contact-form [require]');
const formContato = document.querySelector('.contact-form');


initEvents();
firstAjax();
addDanger(inputsContact);

function initEvents() {
    formContato.addEventListener('submit', e => {

       // e.preventDefault(); // Impedindo envio direto do submit.
        var inputNull = []; // Array para juntar os forms que ainda faltam ser preenchidos ou com erro (Reseta a cada novo submit).

        // Pecorrendo todos os inputs com o  atributo [require];
        inputsContact.forEach(input => {
            if (input.value === "") {
                addAlert(input,`Preencha o campo ${input.dataset.item}`); // Alerta para o usuário, qual o campo faltante.
                inputNull.push(input); // Adicionar ao array de form vazio.
            }
        });

        // Se a funções a baixo retornarem falso, adicione como erro preenchimento.
        if(!validationEmail() ){
            inputNull.push('E-mail Invalido');
        }; 
        
        if(!validationCpf()){
            inputNull.push('CPF  Invalido');
        };

        if(!validationTelefone()){
            inputNull.push('Telefone  Invalido');
        };

        if(inputNull.length == 0){
            form.submit(); // Se não há nenhum elemento com erro, faça o submit.
        }

    });

}

function validationEmail(){ // Função para validação do e-mail.

    const email = document.querySelector('#email'); // Selecionando o input email.

    if(email){
        const regexEmail = email.value.match(/\S+@\w+\.\w{2,}(\.\w{2})?/g); // Expressão regular para verificação de regras do e-mail.
  
        if(!regexEmail || regexEmail == "") addAlert(email,"E-mail invalido"); // Se não há match, considere o campo com erro.
        return false; // Retorna falso, para verificação e adicionamento no array de erros.
    }
 
    return true; // Caso contrario, retorna verdadeiro.
}

function validationTelefone(){ // Função para validação do telefone.

    const telefone = document.querySelector('#telefone'); // Selecionando o input telefone.

    if(telefone){
        const regexTelefone = telefone.value.match(/(\(\d{2}\)\s?)?\d{4,5}(-)?\d{4}/g); // Expressão regular para verificação de regras do Telefone.
        if(!regexTelefone || regexTelefone == "") addAlert(telefone,"Telefone Invalido"); // Se não h´
        return false;
    }

    return true;

}



function validationCpf(){
    const cpf = document.querySelector('#cpf');

    if(cpf){
        const regexCPF = cpf.value.match(/[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}/g);
        if(!regexCPF || regexCPF == "") addAlert(cpf,"CPF Invalido");
        return false;
    }

    return true;

}

function addAlert(element,txt){

    element.style.borderColor = 'red';
    alert(txt);
}

function firstAjax() {

    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (document.querySelector('.estados')) listEstates(JSON.parse(this.response));
        }
    };
    ajax.open("GET", 'http://servicodados.ibge.gov.br/api/v1/localidades/estados/', true);
    ajax.send();

}

function addDanger(elements) {


    elements.forEach(element => {
        const span = document.createElement('span');
        span.classList.add('text-danger');
        span.classList.add('ml-2');
        span.innerHTML = ' *';
 
        element.parentNode.appendChild(span);
    })

}


function listEstates(res) {
    const listEstados = document.querySelector('.estados');

    res.forEach(element => {

        const html = `
       <option value="${element.id}"> ${element.nome} </option>`

        listEstados.innerHTML += html;
    });


    listEstados.addEventListener('change', event => {
        secondAjax(event.target.value);
    });
}

function secondAjax(value) {
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (document.querySelector('.cidades')) listCities(JSON.parse(this.response));
        }
    };
    ajax.open("GET", `http://servicodados.ibge.gov.br/api/v1/localidades/estados/${value}/municipios`, true);
    ajax.send();
}

function listCities(res) {
    const listEstados = document.querySelector('.cidades');
    listEstados.innerHTML = '<option selected>Selecione sua cidade...</option>';
    res.forEach(element => {
        const html = `
        <option value="${element.id}"> ${element.nome} </option>`

        listEstados.innerHTML += html;
    })
}