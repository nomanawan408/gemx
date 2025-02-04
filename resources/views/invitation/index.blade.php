<head>
    <style>
        .letter{
            box-shadow:  ;
            /* background: red; */
            background-image: url("{{ url('assets/img/Invitation-Letter-PKGJS.png') }}");
            /* max-height: 1440px;  */
            height: 1440px; 
            background-size: contain;
            background-repeat: no-repeat;
            background-position: top center;
            width: 100%;
            font-size: calc(1em + 0.5vw);
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Invitation Letter</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <button id="downloadButton" class="btn btn-info btn-round me-2">Download Invitation Letter</button>
                {{-- <a href="#" class="btn btn-primary btn-round">Add Buyers</a> --}}
              </div>
        </div>
        <section id="invitation_letter">
            <div class="letter">
                <div style="padding: 200px 70px; ">
                    <h1 style="text-align: center;font-size: 50px; color: black; font-weight: bold;">Invitation Letter</h1>
                    <p style="font-size: 20px; color: black; margin-top: 20px;">We are inviting you to participate in our event.</p>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    window.onload = function() {
        document.getElementById("downloadButton")
            .addEventListener("click", () => {
                const invoice = this.document.getElementById("invitation_letter");
                console.log(invoice);
                console.log(window);
                var opt = {
                    // margin: ,
                    filename: 'Invitational-letter.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 1,
                    },
                    html2canvas: {
                        scale: 1
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                };
                html2pdf().from(invoice).set(opt).save();
            })
    }
</script>
@endsection

