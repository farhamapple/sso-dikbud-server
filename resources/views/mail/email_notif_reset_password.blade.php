<table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
  <tr style="border-collapse:collapse">
      <td align="left" style="padding:0;Margin:0">
          <h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;font-size:30px;font-style:normal;font-weight:normal;color:#4A7EB0">Notifikasi Reset Password SSO</h1>
      </td>
  </tr>
  <tr style="border-collapse:collapse">
      <td align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:20px;font-size:0">
          <table width="5%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
              <tr style="border-collapse:collapse">
              <td style="padding:0;Margin:0;border-bottom:2px solid #999999;background:#FFFFFF none repeat scroll 0% 0%;height:1px;width:100%;margin:0px"></td>
              </tr>
          </table>
      </td>
  </tr>
  <tr style="border-collapse:collapse">
      <td align="left" style="padding:0;Margin:0">
          <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:21px;color:#666666">
              Berikut adalah Link untuk melakukan Reset Password Anda
      </p>
      </td>
  </tr>
  <tr style="border-collapse:collapse">
      <td align="left" style="padding:0;Margin:0">
          <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:21px;color:#666666">
              <b>Nama : {{ $data->name }}</b>
              <br>
              <br>
              {{-- Waktu Update : {{ Carbon\Carbon::parse($pendaftaranEvent->updated_at)->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB --}}
              <br>
              Link : <a href={{ route('auth-forgot-password-form', $data->activation_code) }} target="_blank">Reset Password</a>
          </p>
      </td>
  </tr>
  <tr style="border-collapse:collapse">
      <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px"><span class="es-button-border" style="border-style:solid;border-color:#4A7EB0;background:#2CB543;border-width:0px;display:inline-block;border-radius:0px;width:auto"></span></td>
  </tr>
  <tr style="border-collapse:collapse">
      <td align="left" style="padding:0;Margin:0">
          <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:21px;color:#666666">
              Salam,
              <br>
              SSO Kemendikbudristek
          </p>
      </td>
  </tr>
</table>
