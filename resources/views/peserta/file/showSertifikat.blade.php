<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>


  <title>Document</title>
</head>
<body>

  <div class="invoice" id="invoice">
  
  <img style="height: 1280px !important;width:1774px" src="{{Request::root()}}/peserta/app/file/generateSertifikat/{{ $data->id }}" alt="">
</div>
</body>


<script>
  window.onload = function() { 
const element = document.getElementById("invoice");
// Choose the element and save the PDF for our user.
html2pdf()
  .set({ html2canvas: { width: 1760,height: 1240 },jsPDF: { unit: 'in', format: 'A4', orientation: 'landscape' }})
  .from(element)
  .save('Webinar.pdf');
}

</script> 
</html>