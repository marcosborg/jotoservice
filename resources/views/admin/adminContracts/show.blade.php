<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contrato de prestação de serviços</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        html {
            font-family: sans-serif;
            font-size: 14px;
            text-align: justify;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
        }

        @page {
            margin-top: 80px;
            margin-bottom: 80px;
            margin-left: 100px;
            margin-right: 80px;
        }

        body {
            margin: 0;
        }

        footer {
            position: fixed;
            bottom: -0px;
            left: 0px;
            right: 0px;
            height: 50px;
            line-height: 35px;
        }
    </style>
</head>

<body>
    <h4 class="text-center">CONTRATO DE PRESTAÇÃO DE SERVIÇOS N.º{{ $adminContract->number }} /2023</h4>
    <br>
    <br>
    <p>O presente documento regula as relações de serviços profissionais entre:</p>
    <br>
    <p>1.º: NOME DA EMPRESA, com sede MORADA DA EMPRESA, NIF: NIF DA EMPRESA,
        neste ato representada pelo seu gerente com poderes para o ato, NOME DO GERENTE, doravante
        designado por 1.º Outorgante,</p>
    <p>2.º: Outorgante: {{ $adminContract->driver->name }},
        morador em {{ $adminContract->driver->address }}, {{ $adminContract->driver->zip }}, {{
        $adminContract->driver->city }}, Portugal, com NIF {{ $adminContract->driver->driver_vat }},
        doravante designado por 2.º
        Outorgante,</p>
    <br>
    <p>Celebram entre si um contrato de prestação de serviços ao abrigo do disposto no artigo 1154.º do Código Civil,
        que, mutuamente subordinam às cláusulas seguintes:</p>
    <br>
    <p class="text-center"><strong>Cláusula 1.ª</strong></p>
    <p>O 2.º Outorgante prestará ao 1.º Outorgante os seguintes serviços: condutor de Transportes de Passageiros em
        veículo descaracterizado (em particular, na atividade de TVDE no âmbito da Lei 45/2018 de 10/08 e Declaração de
        Retificação de 10/08, transferes e passeios turísticos em automóvel).</p>
    <br>
    <p class="text-center"><strong>Cláusula 2.ª</strong></p>
    <p>Os serviços são prestados pelo 2.º Outorgante de forma autónoma e independente.</p>
    <br>
    <p class="text-center"><strong>Cláusula 3.ª</strong></p>
    <ol>
        <li>Como contrapartida dos serviços contratados, o 2.º Outorgante, após a dedução das comissões pagas às
            plataformas, bem como dos impostos resultantes pelo trabalho por si efetuado (iva 6%) e a comissão de gestão
            de ___€ semanais. Este valor será recebido mensalmente, no máximo de cinco dias úteis, após a
            disponibilização das verbas por parte da plataforma, contra a entrega da respetiva fatura ou documento
            equivalente.</li>
        <li>O segundo outorgante obriga-se a emitir as competentes faturas ou recibo Verde à NOME DA EMPRESA Lda.,
            respeitante às comissões que lhe serão devidas.</li>
    </ol>
    <br>
    <p class="text-center"><strong>Cláusula 4.ª</strong></p>
    <p>O presente contrato entra em vigor no dia {{ \Carbon\Carbon::parse($adminContract->driver->start_date)->day }} de
        {{ \Carbon\Carbon::parse($adminContract->driver->start_date)->formatLocalized('%B') }} de {{
        \Carbon\Carbon::parse($adminContract->driver->start_date)->year }} e tem a duração
        de doze meses, renovável por
        sucessivos e iguais períodos, podendo, no entanto, ser denunciado ou alterado por qualquer das partes mediante
        comunicação escrita enviada à outra, desde que faça com a antecedência de 30 dias.</p>
    <br>
    <p class="text-center"><strong>Cláusula 5.ª</strong></p>
    <p>Ambos os outorgantes acordam que, pelo facto de serem entidades juridicamente autónomas e não existir qualquer
        relação de trabalho, antes existe e apenas, a de prestação de serviços. O 2.º Outorgante é o único e exclusivo
        responsável pelos pagamentos e contribuições relativas a impostos, segurança social, seguros de acidentes de
        trabalho ou outras importâncias devidas e inerentes à sua atividade de profissional liberal (ou empresário em
        nome individual), salvo disposições legais em contrário, <strong>bem como por cumprir os horários de prestação
            de
            serviços de acordo com a lei vigente para a atividade</strong>. Os impostos decorrentes do pagamento
        referido na cláusula
        3.ª são inteiramente suportados pelo 2.º Outorgante, bem como todas as despesas que ela houver de efetuar para o
        correto desempenho das suas funções, nomeadamente custos para acesso à atividade exarada na cláusula primeira,
        bem como, o custo da franquia a assumir, em caso de sinistro, de acordo com as condições particulares do seguro
        automóvel.</p>
    <br>
    <p class="text-center"><strong>Cláusula 6.ª</strong></p>
    <p>O 2.º Outorgante utilizará uma viatura da sua responsabilidade (MARCA {{ $adminContract->driver->brand }}, Modelo
        {{ $adminContract->driver->model }},
        Matricula {{ $adminContract->driver->license_plate }}), autorizada a operar na atividade referida na clausula
        1.ª, assumindo todos os custos com a
        mesma incluindo os custos com a manutenção e combustível/energia da mesma.
        O 1º Outorgante não assumirá qualquer responsabilidade sobre custo, responsabilidade civil ou outro relacionado
        com a viatura utilizada pelo 2º Outorgante, bem como por possíveis coimas resultantes do não cumprimento das
        regras estabelecidas para a atividade.</p>
    <br>
    <p class="text-center"><strong>Cláusula 7.ª</strong></p>
    <p>2.º Outorgante encontra-se obrigado a guardar sigilo e confidencialidade de quaisquer informações ou documentos
        obtidos no âmbito da sua atividade, nomeadamente no que respeita aos dados pessoais. Fica, assim, obrigado a não
        copiar, utilizar, divulgar, transmitir ou conservar, seja de que forma for, para lá das necessidades derivadas
        da sua atividade, quaisquer documentos ou informação da empresa.
        Após o termo do presente contrato, o 2.º outorgante deverá devolver toda a documentação e informação que, direta
        ou indiretamente, tenha recebido no desenvolvimento do negócio mantendo o dever de sigilo e confidencialidade
        previsto na cláusula anterior.</p>
    <br>
    <p class="text-center"><strong>Cláusula 8.ª</strong></p>
    <p>Na resolução de dúvidas decorrentes do cumprimento do presente Contrato, serão de aplicar as disposições
        previstas nos artigos 1154.º e seguintes do Código Civil.</p>
    <br>
    <p>O presente contrato é feito em dois exemplares, ambos valendo como originais, os quais vão ser assinados pelas
        partes, sendo um exemplar entregue a cada uma delas.</p>
    <br>
    <br>
    @if ($adminContract->signed_at)
    {{ $adminContract->driver->city }}, {{ \Carbon\Carbon::parse($adminContract->signed_at)->day }} de {{
    \Carbon\Carbon::parse($adminContract->signed_at)->formatLocalized('%B') }} de {{
    \Carbon\Carbon::parse($adminContract->signed_at)->year }}
    <br>
    <br>
    <div class="text-center">
        <p><strong>O 1.º Contratante</strong></p>
        <strong></strong>Orlando Saraiva<br>
        <strong></strong><small>Gerente</small><br>
        <strong><small><small>(Assinado eletronicamente)</small></small></strong>
        <br>
        <br>
        <p><strong>O 2.º Contratante</strong></p>
        <strong></strong>{{ $adminContract->driver->name }}<br>
        <strong></strong><small>Condutor</small><br>
        <strong><small><small>(Assinado eletronicamente)</small></small></strong>
    </div>
    @else
    <p style="text-align: left; font-size: 11px;"><strong>O CONTRATO AINDA NÃO FOI ASSINADO. O CONDUTOR DEVE ASSINAR EM
            "CONTRATOS/CONTRATO".</strong></p>
    @endif
    <footer>Página 2 de 2</footer>
</body>

</html>