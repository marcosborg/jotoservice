@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.contract.title') }}
                </div>
                <div class="panel-body">
                    @if (!$adminContract)
                    <p>Ainda não existe contrato para assinar</p>
                    @else
                    <a href="/admin/contracts/pdf" class="btn btn-primary btn-lg">Ler Contrato</a>
                    <a href="/admin/contracts/pdf/download" class="btn btn-success btn-lg">Download do Contrato</a>
                    <br>
                    <br>
                    @if (!$adminContract->signed_at)
                    <p>
                        <strong>Ler o contrato antes de assinar.</strong>
                    </p>
                    <p>Para que possamos dar início ao seu processo de contratação, é necessário que você assine
                        digitalmente o contrato de prestação de serviços. Ao clicar no botão "Concordo com as Condições
                        Contratuais",
                        você estará confirmando que leu e concorda com todas as cláusulas do contrato.</p>
                    <p>Ressaltamos que a assinatura digital é tão válida quanto uma assinatura física, e será
                        considerado
                        um documento legalmente assinado. Portanto, pedimos que leia atentamente todas as cláusulas
                        antes de
                        clicar no botão de concordância.</p>
                    <p>Agradecemos pela sua colaboração e estamos à disposição para quaisquer dúvidas que possam surgir
                        durante o processo de assinatura.</p>
                    <br>
                    <hr>
                    <button onclick="contractualAgreement()" class="btn btn-danger">Concordo com as Condições
                        Contratuais</button>
                    @else
                    <p>O contrato de prestação de serviços encontra-se devidamente assinado digitalmente e possui
                        validade jurídica. Qualquer solicitação de rescisão ou alteração do contrato deve ser realizada
                        por meio de contato com a NOME DA EMPRESA Lda.</p>
                    @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    contractualAgreement = () => {
        Swal.fire({
            title: 'Tem a certeza?',
            text: "Depois da confirmação o contrato torna-se válido!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, quero assinar!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.get('/admin/contracts/signContract').then(() => {
                    Swal.fire(
                        'Assinatura confirmada!',
                        'Pode fazer download do seu contrato.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                });
            }
        });
    }
</script>
@endsection