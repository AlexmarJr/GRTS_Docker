@extends('layouts.app')

@section('content')
<head>
    <!--DataTable CDN-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</head>



@if(isset($modal))
<script>
    $(document).ready(function(){
    $('#store_company').modal({backdrop: 'static', keyboard: false});
    $('#store_company .close').css('display', 'none');
    $("#store_company").modal("show");});
</script>
@endif


<form action="{{route('store_companies')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf
<input type="hidden" value="{{$companie_head->id}}" name="id">

<div class="container" style="border: 2px solid black; background-color: white">
@include('flash::message')
    <div class="row">
        <div class="col-sm-4" style="padding: 10px">
            <a class="btn btn-primary" href="{{route('home')}}">Voltar</a>
        </div>

        <div class="col-sm-6">
            <h2> Empresa: {{$companie_head->name_company}}</h2>
        </div>

        <div class="col-sm-2" style="padding: 10px">
            <a class="btn btn-success" type="button" data-toggle="modal" data-backdrop="static" data-target="#store_company">Novo Endereço</a>
        </div>
    </div>
    <hr>

    <div class="row" style="margin: 10px">
        <div class="col-sm-12">
            <label>Nome da Empresa</label>
            <input class="form-control" name="name_company" value="{{$companie_head->name_company}}" maxlength = "40"  required>
        </div>

        <div class="col-sm-4">
            <label>CNPJ</label>
            <input class="form-control" name="cnpj" id="cnpj"  value="{{$companie_head->cnpj}}" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' type="text" maxlength="18" required>
        </div>

        <div class="col-sm-4">
            <label>Telefone</label>
            <input class="form-control telefone" name="phone" value="{{$companie_head->phone}}" type="text" required>
        </div>

        <div class="col-sm-4">
            <label>E-Mail</label>
            <input class="form-control" name="email"value="{{$companie_head->email}}" type="text" maxlength = "40" required>
        </div>

        <div class="col-sm-6">
            <label>Nome do Responsável</label>
            <input class="form-control" name="name_person" value="{{$companie_head->name_person}}" type="text" required>
        </div>

        <div class="col-sm-6">
            <label>Registrado por usuario</label>
            <input class="form-control" value="{{$employee->name}}" type="text" readonly>
        </div>
    
    </div>
    </br>
    <button class="btn btn-warning" type="submit" >Editar Dados</button>
    <hr>
</form>


    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>CEP</th>
                <th>Logradouro</th>
                <th>Bairro</th>
                <!-- <th>Complemento</th> -->
                <th>Numero</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($address_head as $value)
            <tr>
                <td>{{$value->cep}}</td>
                <td>{{$value->public_place}}</td>
                <td>{{$value->neighborhood}}</td>
                <!-- <td>{{$value->adjunct}}</td> -->
                <td>{{$value->number_house}}</td>
                <td>{{$value->city}}</td>
                <td>{{$value->state}}</td>
                @if($value->status == 1)<td style="background-color: green">Principal</td> @else <td style="background-color: gray">Secondario</td> @endif
                <td><a class="" href="{{route('read_address', $value->id)}}"><img src="/img/lupa.jpg" style="width: 5vh"></a>  |
                 <a class=""  href="{{route('deleteAddress', $value->id)}}" onclick="return confirm(' Deseja apagar?');"><img src="/img/lixo.jpg" style="width: 4vh"></a> </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<!-- Modal de Adicionar Endereço--> 
<form action="{{route('store_address')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf

<div class="modal fade store_company-lg" id="store_company" tabindex="-1" role="dialog" aria-labelledby="storage_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="storage_modal_title">Novo Endereço para Empresa: {{$companie_head->name_company}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <div class="row" style="margin: 10px">
                    <div class="col-sm-4">
                    @if(isset($read_address))
                        <input type="hidden" value="{{$read_address->id}}" name="id"> 
                    @endif
                    <input type="hidden" value="{{$companie_head->id}}" name="id_company">
                        <label>CEP</label>
                        <input class="form-control" name="cep" id="cep" placeholder="99999-999" required @if(isset($read_address))value="{{$read_address->cep}}" @endif>
                    </div>

                    <div class="col-sm-4">
                        <label>Logradouro</label>
                        <input class="form-control" name="public_place" id="rua" placeholder="Setor A" type="text" required @if(isset($read_address))value="{{$read_address->public_place}}" @endif>
                    </div>

                    <div class="col-sm-4">
                        <label>Bairro</label>
                        <input class="form-control" name="neighborhood" id="bairro" placeholder="Pituba" type="text" required @if(isset($read_address))value="{{$read_address->neighborhood}}" @endif>
                    </div>

                    <div class="col-sm-6">
                        <label>Complemento</label>
                        <input class="form-control" name="adjunct" placeholder="Proximo ao Parque" type="text" required @if(isset($read_address))value="{{$read_address->adjunct}}" @endif>
                    </div>

                    <div class="col-sm-6">
                        <label>Numero</label>
                        <input class="form-control" name="number_house" placeholder="99" type="text" required @if(isset($read_address))value="{{$read_address->number_house}}" @endif>
                    </div>

                    <div class="col-sm-6">
                        <label>Cidade</label>
                        <input class="form-control" name="city" id="cidade" placeholder="Salvador" type="text" required @if(isset($read_address))value="{{$read_address->city}}" @endif>
                    </div>

                    <div class="col-sm-6">
                        <label>Estado</label>
                        <input class="form-control" name="state" id="uf" placeholder="Bahia" type="text" required @if(isset($read_address))value="{{$read_address->state}}" @endif>
                    </div>
                </div>
                <hr>

                @if(isset($read_address))
                    @if($read_address->status == 1)
                        <h5>Esse é o Endereço Principal</h5>
                        <input type="hidden" value="on" name="status">
                    @else
                        <div class="container" style="margin-left: 25px">
                            <input class="form-check-input" type="checkbox" name="status" id="defaultCheck1" style="transform: scale(2.2);">
                            <label class="form-check-label" style="font-size: 18px">
                                &nbspTornar esse endereço o principal?
                            </label>
                        <div>
                    @endif
                @else
                <div class="container" style="margin-left: 25px">
                    <input class="form-check-input" type="checkbox" name="status" id="defaultCheck1" style="transform: scale(2.2);">
                    <label class="form-check-label" style="font-size: 18px">
                        &nbspTornar esse endereço o principal?
                    </label>
                <div>
                @endif
                
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary"  @if(isset($read_address)) href="{{route('read', $companie_head->id)}}" @else data-dismiss="modal" @endif >Fechar</a>
                    <button type="submit" class="btn btn-success">salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>

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
