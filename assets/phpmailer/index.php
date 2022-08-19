<?php
require_once("class.smtp.php");
require_once("class.phpmailer.php");
require 'PHPMailerAutoload.php';
?>
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2 class="gugel-font8 text-black">Hubungi Kami</h2>
      <span class="lead gugel-font8">Butuh informasi lebih lanjut ? Ingin menyampaikan pesan anda kepada kami ? Silahkan isi form dibawah ini, pesan anda akan segera kami respon kembali.</span>
    </div>

    <div class="row">
      
      <div class="col-md-12 col-lg-12">
        <h4 class="mb-3 gugel-font8 text-black">Form Pesan  & Pertanyaan</h4>
        <form action="" method="POST">
          <div class="row g-3">
            <div class="col-sm-12">
              <label for="firstName" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama_lengkap" placeholder="Isikan nama lengkap..." required>
            </div>

            <div class="col-sm-12">
              <label for="lastName" class="form-label">E-Mail</label>
              <input type="email" class="form-control" name="email" placeholder="Isikan alamat email..."  required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-sm-12">
              <label for="lastName" class="form-label">Telepon / HP</label>
              <input type="text" class="form-control" name="telepon" onkeypress="return hanyaAngka(event)" maxlength="12" placeholder="Isikan nomer telepon / hp..."  required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-sm-12">
              <label for="lastName" class="form-label">Pesan</label>
              <textarea name="pesan" class="form-control"></textarea>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

          </div>

          <button class="w-100 btn btn-primary btn-lg" type="submit" name="simpan"><i class="fa fa-check-square-o" aria-hidden="true"></i> Kirim</button>
        </form>
		<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
		</script>
		<?php
		if(isset($_POST['simpan']))
		{
			//save to history reminder table
			$tgl_kirim = date('Y-m-d');

					//send email
    $from = "info@alazharsummarecon.sch.id";    
    $to = "inside.man108@gmail.com";    
    $subject = "Checking PHP mail";    

						$pesan	= "Dear Bapak/Ibu $nama_penerima,<br /><br />Berikut data <b>Buku Tamu</b> yang <b>harus</b> segera di follow up :<br><br>";
						$pesan	.= "<table width='100%'>
						<tr>
							<td width='35%'>Nama Lengkap</td>
							<td width='2%'>:</td>
							<td width='63%'> ".$_POST['nama_lengkap']."</td>
						</tr>
						<tr>
							<td width='35%'>Email </td>
							<td width='2%'>:</td>
							<td width='63%'> ".$_POST['email']."</td>
						</tr>
						<tr>
							<td width='35%'>No. Telepon / WA</td>
							<td width='2%'>:</td>
							<td width='63%'> ".$_POST['telepon']."</td>
						</tr>
						<tr>
							<td width='35%'>Pesan </td>
							<td width='2%'>:</td>
							<td width='63%'> ".$_POST['pesan']."</td>
						</tr>
						</table>";

						// this will add the closing tags and now html_string has your built email
						$pesan	.= "<br><br>";
						$pesan	.= "<br><br>Mohon segera lakukan follow up atas form buku tamu ini dalam waktu 1x24 Jam";
						$pesan	.= "<br><br><b>#Email berikut dikirimkan oleh sistem dan tidak untuk dibalas (No Reply).</b>";
						$headers = "From:" . $from;

						mail($to,$subject,$pesan, $headers);    
                        echo "Pesan email sudah terkirim.";
						///////////////////////////////////// END OF SEND MAIL PEMOHON /////////////////////////////////////////////////////
		}
		?>
		<p></p>
      </div>
	 </div>

  </main>

</div>