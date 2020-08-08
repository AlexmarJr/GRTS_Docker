## Descrição da Vaga

Vaga Analista de Desenvolvimento de Sistemas Jr

Atuar no desenvolvimento de novas funcionalidades e na manutenção dos sistema da empresa. Atualmente temos dois sistemas desenvolvidos com Laravel + Vue.js, você vai estar em contato direto também com Docker, ElasticSearch e GCP.

Precisamos de alguém com experiência em PHP/Laravel, MySql, HTML, CSS e JavaScript, se tiver experiência com algum framework front-end será muito bom.

Se você já teve alguma experiência ou ao menos algum contato com Docker, ElasticSearch e/ou GCP será um diferencial, não é um requisito, você vai ter a oportunidade de aprender na prática com a gente.

## Atenção

Estamos disponibilizando para você a base do projeto em um ambiente Docker, sendo necessário que você tenha o docker instalado na máquina que for usar para desenvolvimento. 

### Por que tenho que fazer usando docker?

#### Conhecer docker não é uma obrigação na descrição da vaga, então porque tenho que fazer o projeto usando o docker? 

Simplesmente por uma questão de praticidade para podermos avaliar os teste sem termos problemas com diferentes ambientes de desenvolvimento, usando Docker temos isso mais padronizado.

Justamente pelo fato de não ser um requisito estamos disponilizando o projeto configurado para você implementar o desafio, basta rodar poucos comandos.

### Orientação para rodar o projeto

Após baixar o repositório e rodar os comandos necessários para configurar seu projeto laravel, na pasta raiz aonde se encontra o arquivo "docker-compose.yml" você deve rodar os seguintes comandos no seu terminal

Para subir os containers: docker-compose up -d

Para remover os containers: docker-compose down

O acesso se dará por localhost:8888 e o phpmyadmin por localhost:8050

Use o arquivo .env.local como seu .env

## O Desafio

### Parabéns, Dev!

Você está mais próximo de fazer parte da Equipe GRTS. Agora, queremos ver você metendo a mão na massa!

Elaboramos um desafio para você colocar as suas habilidades no desenvolvimento de um sistema em prática.

#### Are you ready? 

### O desafio é o seguinte:

Uma empresa de distribuição de alimentos precisa de um sistema interno para gerenciar seus clientes e endereços de entrega.

O cadastro será interno e deve ser restrito a usuários logados com login e senha. O cadastro do cliente deve conter Nome Empresa, CNPJ, Telefone, Nome do Responsável, Email e Endereço(Cep, Logradouro, Bairro, Complemento, Número, Cidade, Estado).

Quanto ao Endereço podem ser cadastrados mais de um endereço para cada cliente devendo ser selecionado UM endereço como principal, a definição do endereço principal pode ser alterada a qualquer momento.

O sistema deve permitir Listagem, Criação, Edição, Exclusão e Visualização do Cliente e de seus endereços.

Requisitos
	
	Utilizar API ViaCEP (https://viacep.com.br/ ) para preenchimento automático dos campos de endereço ao digital o cep.
	Utilizar DataTable (https://datatables.net/ ) na listagem para ordenação e busca rápida.
	O desafio deve ser feito utilizando como base este projeto. Leia com atenção as instruções acima.

As modelagens não foram propostas nem enviadas junto ao desafio porque queremos ver a sua solução. Não há certo nem errado, mas queremos enxergar a sua forma de desenvolver. Nos envie a modelagem junto com o desafio(pode colocá-la no repositório do projeto).

Você deve enviar o link do repositório da sua solução do desafio para o email vagas@grtsdigital.com.br com o assunto Desafio Analista de Desenvolvimento Jr. - {{$seu_nome}} até o dia 09/08/2020 às 23:59h. 

Caso tenha alguma instrução para executarmos o projeto você pode enviar no corpo do email.

#### Let’s go? Show me the code!

### Boa sorte!
