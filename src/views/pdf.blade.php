<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    body{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
    }
    .header{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 36px;
      color: #3b3b3b;
      text-align: center;
    }
    .footer{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 10px;
    }
    </style>
  </head>
  <body>
   
  
            <br><br><br><br><br><br><br>
  

    <h1 class="header">Invoice</h1>

@foreach($invoice as $i)

{{ $i->company}} <br>
{{ $i->address}} <br>
{{ $i->town}} <br>
{{ $i->county}} <br>
{{ $i->postcode}} <br>
{{ $i->country}} <br>
<br>
Tax ID: {{ $i->vat_no}}
<br><br>

Invoice Ref: {{ $i->invoice_ref}} <br>
Invoice Date: {{date('d/m/y', strtotime($i->invoice_date))}} <br>
Invoice Due: {{date('d/m/y', strtotime($i->invoice_due))}} <br>
<br>
<br><hr><br>
<table width="100%">
<thead>
<tr>
<th align="center">QTY</th>
<th>Description</th>
<th align="right">Unit Price</th>
<th align="right">Net Total</th>
<th align="right">Tax</th>
<th align="right">Gross Total</th>
</tr>
<thead>
<tbody>
@foreach($lines as $ln)
<tr>
<td align="center">{{$ln->qty}}</td>
<td>{{$ln->description}}</td>
<td align="right">{{$ln->line_price}}</td>
<td align="right">{{$ln->line_net}}</td>
<td align="right">{{$ln->line_tax}}</td>
<td align="right">{{$ln->line_total}}</td>
</tr>
@endforeach
</tbody>
</table>

<br>
<br>
<h5>Payment Details</h5>
<p>IBAN: xxxxxxx</p>


<br>
<br>

<table width="100%">
<tr>
<td width="50%">
&nbsp;
</td>
<td align="right">
<b>Net Total: {{ $i->net_total}}</b> <br>
<b>Tax Total: {{ $i->tax_total}}</b> <br>
<b>Grand Total: {{ $i->grand_total}}</b>
</td>
</tr>
</table>
 @endforeach 

 <br><hr>

<table width="100%">
<tr>
<td width="30%" align="center">

</td>
<td align="center">

</td>
<td align="right">

</td>
</tr>
</table>
</body>
</html>