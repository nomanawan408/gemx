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
            width: 800px;
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
        <section id="invitation_letter" class="d-flex justify-content-center">
            <div class="letter">
                <div style="padding: 180px 70px; ">
                    <h1 style="text-align: center;font-size: 46px; color: black; font-weight: bold;">Invitation Letter</h1>
                    <p style="text-align: justify;line-height: 1.5; font-size: 15px; color: black;">
                        On behalf of PKGJS, we are pleased to extend a formal invitation to you to attend the Gems and Jewellery Show Pakistan 2025, which will take place from 02 to 04 MAY at the Serena Hotel, Islamabad, Pakistan. This prestigious event brings together the finest jewelry designers, manufacturers, and suppliers from around the world, offering a unique opportunity to explore the latest trends, technologies, and innovations in the gems and jewelry industry. 
                        <br><br>
                        We believe your participation in this event would be a valuable addition, allowing you to meet with key industry professionals, explore new business opportunities, and showcase your company’s expertise in this exciting sector. 
                        <br><br>
                        We are confident that your presence at this distinguished event will help foster meaningful connections and enable you to gain valuable insights into the evolving trends in the global gems and jewelry market. 
                        <br><br>
                        Thank you for considering our invitation, and we look forward to your positive response.
                        <br><br>
                        <br><br>
                        <br><br>
                        Warm regards,
                        <br>
                        Farukh Sajjad Alvi
                        <br>
                        President PGMA
                    </p>
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

