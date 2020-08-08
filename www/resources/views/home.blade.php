@extends('layouts.app')

@section('content')
<head>
    <!--DataTable CDN-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</head>

<form action="{{route('store_companies')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf

<div class="container" style="border: 2px solid black; background-color: white">
@include('flash::message')
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-success" style="padding: 15px; margin-top: 15px" data-toggle="modal" data-target="#store_company">Nova Empresa</button>
        </div>
      
        <div class="col">
            <h2 style="margin-top: 15px;" >Empresas</h2>
        </div>
    </div>
    <hr>

    <table id="example" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>Nome Empresa</th>
                <th>CNPJ</th>
                <th>Responsavel</th>
                <th>Telefone</th>
                <th>E-Mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr>
                <td>{{$value->name_company}}</td>
                <td>{{$value->cnpj}}</td>
                <td>{{$value->name_person}}</td>
                <td>{{$value->phone}}</td>
                <td>{{$value->email}}</td>
                <td><a class="" href="{{route('read', $value->id)}}"><img src="/img/lupa.jpg" style="width: 5vh"></a> | 
                <a class="" href="{{route('delete', $value->id)}}" onclick="return confirm(' Deseja apagar?');"><img src="/img/lixo.jpg" style="width: 4vh"></a> </td>
            </tr>
        @endforeach
        </tbody>
            <tfoot>
            <tr>
                <th>Nome Empresa</th>
                <th>CNPJ</th>
                <th>Responsavel</th>
                <th>Telefone</th>
                <th>E-Mail</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>

</div>


<!-- Modal de Adicionar Empresa e Endereço Principal--> 

<div class="modal fade store_company-lg" id="store_company" tabindex="-1" role="dialog" aria-labelledby="storage_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="storage_modal_title">Detalhes da Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 10px">
                    <div class="col-sm-12">
                        <label>Nome da Empresa</label>
                        <input class="form-control" name="name_company" placeholder="Nome da empresa" style="text-transform: uppercase" required>
                    </div>

                    <div class="col-sm-6">
                        <label>CNPJ</label>
                        <input class="form-control" name="cnpj" id="cnpj" placeholder="XX.XXX.XXX/XXXX-XX" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' type="text" maxlength="18" required>
                    </div>

                    <div class="col-sm-6">
                        <label>Telefone</label>
                        <input class="form-control telefone" name="phone" placeholder="71 9 9999-9999" type="text" required>
                    </div>

                    <div class="col-sm-6">
                        <label>Nome do Responsável</label>
                        <input class="form-control" name="name_person" placeholder="David Lokarn" type="text" required>
                    </div>

                    <div class="col-sm-6">
                        <label>e-Mail</label>
                        <input class="form-control" name="email" placeholder="test@gamil.com" type="text" required>
                    </div>
                </div>

                <hr>
                <h4>Endereço Principal</h4>
                <div class="row" style="margin: 10px">
                    
                    <div class="col-sm-4">
                        <label>CEP</label>
                        <input class="form-control" name="cep" id="cep" placeholder="99999-999" required>
                    </div>

                    <div class="col-sm-4">
                        <label>Logradouro</label>
                        <input class="form-control" name="public_place" id="rua" placeholder="Setor A" type="text" required>
                    </div>

                    <div class="col-sm-4">
                        <label>Bairro</label>
                        <input class="form-control" name="neighborhood" id="bairro" placeholder="Pituba" type="text" required>
                    </div>

                    <div class="col-sm-6">
                        <label>Complemento</label>
                        <input class="form-control" name="adjunct" placeholder="Proximo ao Parque" type="text" required>
                    </div>

                    <div class="col-sm-6">
                        <label>Numero</label>
                        <input class="form-control" name="number_house" placeholder="99" type="text" required>
                    </div>

                    <div class="col-sm-6">
                        <label>Cidade</label>
                        <input class="form-control" name="city" id="cidade" placeholder="Salvador" type="text" required>
                    </div>

                    <div class="col-sm-6">
                        <label>Estado</label>
                        <input class="form-control" name="state" id="uf" placeholder="Bahia" type="text" required>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">salvar</button>
                </div>

                <div>
                
            </div>
        </div>
    </div>

</form>

<script>
    $('#example').DataTable();

    $(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
        }
            
        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#rua").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#uf").val(dados.uf);
                    $("#ibge").val(dados.ibge);
                    } //end if.
                            
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
                }
        } //end if.
            else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
            }
        });
    });

     //Função para mascara de CNPJ
     function mascaraMutuario(o,f){
            v_obj=o
            v_fun=f
            setTimeout('execmascara()',1)
        }
        
        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }
        
        function cpfCnpj(v){
        
            //Remove tudo o que não é dígito
            v=v.replace(/\D/g,"")
        
            v=v.replace(/^(\d{2})(\d)/,"$1.$2")
            v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
            v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
            v=v.replace(/(\d{4})(\d)/,"$1-$2")
        
            
            return v
        }

        // Função de mascara para telefone
        jQuery("input.telefone")
        .mask("(99) 99999-999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  

                element.mask("(99) 99999-999?9");  
  
        });
    </script>
@endsection
