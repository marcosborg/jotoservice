<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contrato de Prestação de Serviços</title>
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
            margin-bottom: 0;
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
    <h4 class="text-center">DECLARAÇÃO DE UTILIZAÇÃO E TERMO DE RESPONSABILIDADE DE<br>UTILIZAÇÃO DE VIATURA</h4>
    <br>
    <br>
    <p class="text-center"><strong>(Contrato de Prestação de Serviços n.º {{
            $adminStatementResponsibility->contract_number }}/ {{
            \Carbon\Carbon::parse($adminStatementResponsibility->driver->start_date)->year }})</strong></p>
    <br>
    <p>NOME DA EMPRESA Lda, com sede MORADA DA EMPRESA, NIF: NIF DA EMPRESA, neste
        ato representada pelo seu Gerente com poderes para o ato, GERENTE DA EMPRESA, declara para os
        devidos efeitos que autoriza, {{ $adminStatementResponsibility->driver->name }},
        com morada em {{ $adminStatementResponsibility->driver->address }}, {{
        $adminStatementResponsibility->driver->zip }},
        {{ $adminStatementResponsibility->driver->city }}, Portugal, com NIF {{
        $adminStatementResponsibility->driver->driver_vat }}, a conduzir e utilizar a viatura
        {{ $adminStatementResponsibility->driver->brand }}, {{
        $adminStatementResponsibility->driver->model }}, {{
        $adminStatementResponsibility->driver->license_plate }}, no âmbito do contrato de prestação de
        serviços n.º {{ $adminStatementResponsibility->driver->admin_contract->number }}/ 2023, assinado entre as
        partes.</p>
    <br>
    <p class="text-center"><strong>Clausula 1.ª</strong></p>
    <br>
    <p>A utilização do veículo acima referido, destina-se única e exclusivamente para fins da atividade de TVDE no
        âmbito da Lei 45/2018 de 10/08 e Declaração de Retificação de 10/08, transferes e passeios turísticos em
        automóvel conforme contrato de prestação de serviços n.{{
        $adminStatementResponsibility->driver->admin_contract->number }}/ 2023, assinado entre as partes bem como para
        seu uso pessoal quando não estiver a ser utilizado no âmbito da atividade profissional.</p>
    <br>
    <p class="text-center"><strong>Clausula 2.ª</strong></p>
    <br>
    <p>O condutor em cima identificada assume a total responsabilidade da viatura no que respeita a:</p>
    <ol>
        <li>Prejuízos que a referida viatura possa eventualmente sofrer ou provocar a terceiros durante a utilização por
            esta.</li>
        <li>Pelas multas ou coimas que possam vir a ser aplicadas, na sequência da utilização do veículo, por infração
            às disposições do Código de Estrada ou à atividade.</li>
        <li>Cumprimento integral de todas as leis inerentes há atividade TVDE (EX: autocolantes TVDE, dístico de não
            fumador).</li>
    </ol>
    <br>
    <p class="text-center"><strong>Clausula 3.ª</strong></p>
    <br>
    <p>Por ser da responsabilidade do condutor todos os custos associados à utilização e manutenção do veículo, o mesmo
        não integrará contrapartida financeira.</p>
    <br><br>
    @if ($adminStatementResponsibility->signed_at)
    <p>Assinado eletronicamente em, {{ $adminStatementResponsibility->driver->city }}, {{
        \Carbon\Carbon::parse($adminStatementResponsibility->signed_at)->day }} de {{
        \Carbon\Carbon::parse($adminStatementResponsibility->signed_at)->formatLocalized('%B') }} de {{
        \Carbon\Carbon::parse($adminStatementResponsibility->signed_at)->year }}</p>
    <br>
    <table style="width: 100%">
        <thead>
            <tr>
                <th class="text-center">Empresa:</th>
                <th class="text-center">Condutor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">
                    <strong>Nome:</strong> Orlando Saraiva<br>
                    <strong>Título: </strong> Gerente<br>
                    <strong><small><small>(Assinado eletronicamente)</small></small></strong>
                </td>
                <td class="text-center">
                    <strong>Nome:</strong> {{ $adminStatementResponsibility->driver->name }}<br>
                    <strong>Título: </strong> Condutor<br>
                    <strong><small><small>(Assinado eletronicamente)</small></small></strong>
                </td>
            </tr>
        </tbody>
    </table>
    @else
    <p style="text-align: left; font-size: 11px;"><strong>A DECLARAÇÃO AINDA NÃO FOI ASSINADA. O CONDUTOR DEVE ASSINAR
            EM "CONTRATOS/DECLARAÇÃO DE RESPONSABILIDADE".</strong></p>
    @endif
    <footer>
        ExpertCom ©
        <?php echo date("Y");?>
    </footer>
</body>

</html>