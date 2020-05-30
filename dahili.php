<?php
//nesne yönelimli kullanım
$db = new mysqli("localhost", "root", "", "uyeler") or die("BAĞLANAMADI");

// yordamsal $link = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');

// hata varsa görmek için
if ($db->connect_errno) {
    echo "Bağlantıda Sorun var: " . $db->connect_error;
}
$db->set_charset("utf8");
// bunu sonrada yaz $db->set_charset("utf8");


// ÜYE TİPİNE GÖRE BİLGİ VEREN CLASS
class ufaktefek {
	
	 public static function listele($v) {
		
	$s="select * from kisisel";
	$tumveri=$v->prepare($s);
	$tumveri->execute();
	$sonuc=$tumveri->get_result();		
	if ($sonuc->num_rows==0):	
	?>  
    
      <tr class="table-danger">
      <td colspan="8"><p class="text-danger" style="padding:0; margin:0;">Kayıtlı üye bulunmamaktadır.</p></td>
      </tr>     
      
      <?php
	  else :
	  
	  	
	while ($satir = $sonuc->fetch_assoc()):
	echo ' <tr>
      	<td>'.$satir["id"].'</td>
        <td>'.$satir["ad"].'</td>
        <td>'.$satir["soyad"].'</td>
        <td>'.$satir["tc"].'</td>
        <td>'.$satir["meslek"].'</td>
        <td>'.$satir["aidat"].' TL</td>
        <td>'.ufaktefek::yetki($satir["yetki"]).'</td>
        <td style="text-align:center;"><a href="index.php?islem=guncelle&id='.$satir["id"].'" class="btn btn-info" >Güncelle</a>
        <a href="index.php?islem=sil&id='.$satir["id"].'" class="btn btn-danger" >Sil</a>
        
        </td>
      </tr>
	';
	endwhile;	
	$sonuc->close();
	$v->close();
	  
     
     
	
	  endif;
	  
		
	} // ÜYE LİSTELEME
	
	
	
	public static function yetki($veri) {		
		 $sondurum;		
		if ($veri==1) :		
		return $sondurum='<p class="text-danger">Normal Üye</p>';		
		elseif ($veri==2) :
		return $sondurum='<p class="text-warning">Özel Üye</p>';
		elseif ($veri==3) :
		return $sondurum='<p class="text-success">Vip Üye</p>';
		endif;		
	} // ÜYE YETKİ
	
	public static function sil($verim1,$verim2) {
		
		if ($verim1!="") :			
			$sil="Delete from kisisel where id=$verim1";
			$ok=$verim2->prepare($sil);
			$ok->execute();
			$sonuc=$ok->get_result();	
			
				if (!$sonuc):					
					echo '<div class="alert alert-success">Kayıt başarıyla silindi.<br>YÖNLENDİRİLİYOR</div>';					
					header("refresh:2;url=index.php");					
				else:
				echo '<div class="alert alert-danger">Hata oluştu<br>YÖNLENDİRİLİYOR</div>';					
					header("refresh:2;url=index.php");				
				endif;	
		
		else :
		
		echo '<div class="alert alert-danger">Hata oluştu<br>YÖNLENDİRİLİYOR</div>';					
					header("refresh:2;url=index.php");		
			
		endif;
	
		
	} // ÜYE SİL
	
	
 public static function ekle($veri) {
	 $butonum=$_POST["fbuton"];
	
	if ($butonum):

	 $ad=htmlspecialchars($_POST["ad"]);	 
	$soyad=htmlspecialchars($_POST["soyad"]);
	$tc=htmlspecialchars($_POST["tc"]);
	 $meslek=htmlspecialchars($_POST["meslek"]);
	$aidat=htmlspecialchars($_POST["aidat"]);
	$yetki=htmlspecialchars($_POST["yetki"]);	

$sgl="INSERT INTO kisisel (ad, soyad, tc, meslek ,aidat,yetki)
					VALUES ('$ad', '$soyad', $tc, '$meslek', $aidat, $yetki)";					
			$ekle=$veri->prepare($sgl);		
			$ekle->execute();
			$son=$ekle->get_result();	
				if (!$son):					
					echo '<div class="alert alert-success" style="text-align:center;">Kayıt başarıyla EKLENDİ.<br>YÖNLENDİRİLİYOR</div>';					
					header("refresh:2;url=index.php");					
				else:
				echo '<div class="alert alert-danger">Hata oluştu<br>YÖNLENDİRİLİYOR</div>';					
					header("refresh:2;url=index.php");				
				endif;		
	else:	
	echo "Hata var";	
	endif;	
	$veri->close();
	 
 }  // ÜYE EKLEME
 
 
 public static function ekleform() {
	?>
    <form action="index.php?islem=ekleson" method="post">
     <table class="table  table-bordered " style="text-align:center">
   
    <thead>
      <tr>
        <th colspan="12">YENİ ÜYE KAYDET</th>      
      </tr>
    </thead>
    
    <tbody>
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Ad</th>
    <th colspan="4" style="text-align:left;"><input name="ad" type="text" /></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Soyad</th>
    <th colspan="4" style="text-align:left;"><input name="soyad" type="text" /></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Tc</th>
    <th colspan="4" style="text-align:left;"><input name="tc" type="text" /></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Meslek</th>
    <th colspan="4" style="text-align:left;"><input name="meslek" type="text" /></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Aidat</th>
    <th colspan="4" style="text-align:left;"><input name="aidat" type="text" /></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Yetki</th>
    <th colspan="4" style="text-align:left;">
    <select name="yetki">
    <option value="1">Normal</option>
    <option value="2">Özel</option>
    <option value="3">Vip</option>
    </select></th>
    </tr>
    
     <tr>
    <th colspan="12"><input type="submit" name="fbuton" class="btn btn-success" value="EKLE"></th>

    </tr>
    
    </tbody>
    
    
</table>
    </form>    
    
    <?php 
 } //ÜYE EKLE FORM
	
	
	public static function guncelleform($d) {
		@$id=$_GET["id"];
		
		$liste="select * from kisisel where id=$id";
		$gun=$d->prepare($liste);
		$gun->execute();
		$sonuc = $gun->get_result();
		$result = $sonuc->fetch_assoc();		
		
		
		
	?>
    
     <form action="index.php?islem=guncelleson" method="post">
     <table class="table  table-bordered " style="text-align:center">
   
    <thead>
      <tr>
        <th colspan="12">YENİ ÜYE KAYDET</th>      
      </tr>
    </thead>
    
    <tbody>
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Ad</th>
    <th colspan="4" style="text-align:left;"><input name="ad" type="text" value="<?php echo $result["ad"]; ?>" /></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Soyad</th>
    <th colspan="4" style="text-align:left;"><input name="soyad" type="text" value="<?php echo $result["soyad"]; ?>"/></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Tc</th>
    <th colspan="4" style="text-align:left;"><input name="tc" type="text" value="<?php echo $result["tc"]; ?>" /></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Meslek</th>
    <th colspan="4" style="text-align:left;"><input name="meslek" type="text" value="<?php echo $result["meslek"]; ?>" /></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Aidat</th>
    <th colspan="4" style="text-align:left;"><input name="aidat" type="text" value="<?php echo  $result["aidat"]; ?>" /></th>
    </tr>
    
    <tr>
    <th colspan="4"></th>
    <th colspan="4">Yetki</th>
    <th colspan="4" style="text-align:left;">
    <select name="yetki">
    <?php 
	
	if ($result["yetki"]==1) :
	
	echo  '<option value="1" selected="selected">Normal</option>
		      <option value="2">Özel</option>
   			 <option value="3">Vip</option>';
			 
			 elseif ($result["yetki"]==2) :
	echo  '<option value="1" >Normal</option>
		      <option value="2" selected="selected">Özel</option>
   			 <option value="3">Vip</option>';
		 	 elseif ($result["yetki"]==3) :
	echo  '<option value="1" >Normal</option>
		      <option value="2" >Özel</option>
   			 <option value="3" selected="selected">Vip</option>';
	endif;
	
	?>

 
    </select></th>
    </tr>
    
     <tr>
    <th colspan="12">
    <input name="uyeid" type="hidden" value="<?php echo  $result["id"]; ?>" />
    <input type="submit" name="fbuton" class="btn btn-success" value="EKLE"></th>

    </tr>
    
    </tbody>
    
    
</table>
    </form>    
<?php 		
	} // ÜYE GÜNCELLE FORM
	
	public static function guncelleson($dbver) {
	
	$butonum=$_POST["fbuton"];
	
	if ($butonum):

	$id=htmlspecialchars($_POST["uyeid"]);	 
	 $ad=htmlspecialchars($_POST["ad"]);	 
	$soyad=htmlspecialchars($_POST["soyad"]);
	$tc=htmlspecialchars($_POST["tc"]);
	 $meslek=htmlspecialchars($_POST["meslek"]);
	$aidat=htmlspecialchars($_POST["aidat"]);
	$yetki=htmlspecialchars($_POST["yetki"]);	

$sgl="UPDATE  kisisel set ad='$ad', soyad='$soyad', tc=$tc, meslek='$meslek', aidat=$aidat, yetki=$yetki where id=$id";					
			$ekle=$dbver->prepare($sgl);		
			$ekle->execute();
			$son=$ekle->get_result();	
				if (!$son):					
					echo '<div class="alert alert-success" style="text-align:center;">Kayıt başarıyla GÜNCELLENDİ.<br>YÖNLENDİRİLİYOR</div>';					
					header("refresh:2;url=index.php");					
				else:
				echo '<div class="alert alert-danger">Hata oluştu<br>YÖNLENDİRİLİYOR</div>';					
					header("refresh:2;url=index.php");				
				endif;		
	else:	
	echo "Hata var";	
	endif;	
	$dbver->close();
	
} // ÜYE GÜNLELLE SON // güncelle son


public static function aramaform() {
	
	?>
    
    <form action="index.php?islem=aramasonuc" method="post">
        Aranacak Kriter <select name="kriter">
        <option value="ad">AD</option>
        <option value="soyad">Soyad</option>
        <option value="tc">Tc</option>
        <option value="meslek">Meslek</option>
        <option value="aidat">Aidat</option>
        <option value="yetki">Üye tipi</option>
        </select>
        <input type="text" name="ara" placeholder="Aranacak veri" /><input name="buton" type="submit" value="ARA"/></form>
        <?php
	
} // ARAMA FORM //aramaform

public static function aramasonuc($dbverisi) {
	
	?>
    <div class="container">
    
    <h2><a href="index.php">Anaya Dön</a> BULUNAN SONUÇLAR</h2>
   <table class="table  table-bordered table-hover" style="text-align:center">
   <thead>
      <tr>
        <th colspan="8"><?php ufaktefek::aramaform(); ?></th>

      </tr>
    </thead>
   
   
    <thead>
      <tr class="table-light">
        <th>Üye id</th>
        <th>Ad</th>
        <th>Soyad</th>
        <th>Tc</th>
        <th>Meslek</th>
        <th>Aidat</th>
        <th>Üye Tipi</th>
        <th>İşlemler <a href="index.php?islem=ekle" class="btn btn-success">EKLE</a></th>
      </tr>
    </thead>
    
    <tbody>
          
    
    <?php

				$kriter=$_POST["kriter"];
				$veri=$_POST["ara"];
				$buton=$_POST["buton"];
				
				if ($buton):
				
				
						if ($kriter=="ad" || $kriter=="soyad" || $kriter=="meslek") :
						
						$ara="select * from kisisel WHERE CONCAT(ad,soyad,tc,meslek,aidat,yetki) LIKE '%$veri%'";
						$sonuc=$dbverisi->prepare($ara) or die("sorgu");
						$sonuc->execute();
						$b=$sonuc->get_result();
						
							if ($b->num_rows!=0) :
							
							while ($satir = $b->fetch_assoc()):
							echo ' <tr>
								<td>'.$satir["id"].'</td>
								<td>'.$satir["ad"].'</td>
								<td>'.$satir["soyad"].'</td>
								<td>'.$satir["tc"].'</td>
								<td>'.$satir["meslek"].'</td>
								<td>'.$satir["aidat"].' TL</td>
								<td>'.ufaktefek::yetki($satir["yetki"]).'</td>
								<td style="text-align:center;"><a href="index.php?islem=guncelle&id='.$satir["id"].'" class="btn btn-info" >Güncelle</a>
								<a href="index.php?islem=sil&id='.$satir["id"].'" class="btn btn-danger" >Sil</a>
								
								</td>
							  </tr>
							';
							endwhile;
							
							else:
							echo' <tr class="table-danger">
      <td colspan="8"><p class="text-danger" style="padding:0; margin:0;">ARAMA KAYITLARINA GÖRE VERİ YOK</p></td>
      </tr>	';
							
							endif;
						
					
						
						else :
					
						$ara="select * from kisisel where $kriter LIKE '$veri'";
						$sonuc=$dbverisi->prepare($ara);
						$sonuc->execute();
						$b=$sonuc->get_result();
							if ($b->num_rows!=0) :
							
							while ($satir = $b->fetch_assoc()):
							echo ' <tr>
								<td>'.$satir["id"].'</td>
								<td>'.$satir["ad"].'</td>
								<td>'.$satir["soyad"].'</td>
								<td>'.$satir["tc"].'</td>
								<td>'.$satir["meslek"].'</td>
								<td>'.$satir["aidat"].' TL</td>
								<td>'.ufaktefek::yetki($satir["yetki"]).'</td>
								<td style="text-align:center;"><a href="index.php?islem=guncelle&id='.$satir["id"].'" class="btn btn-info" >Güncelle</a>
								<a href="index.php?islem=sil&id='.$satir["id"].'" class="btn btn-danger" >Sil</a>
								
								</td>
							  </tr>
							';
							endwhile;
							
							else:
							echo' <tr class="table-danger">
      <td colspan="8"><p class="text-danger" style="padding:0; margin:0;">ARAMA KAYITLARINA GÖRE VERİ YOK</p></td>
      </tr>	';
							
							endif;	
						
						
						endif;
						
						
				else:
				
				echo "hata var";		
				
				endif;
				?>
                   </tbody>  
   
 			 </table></div>
 			 <?php
} // ARAMA SONUÇ

public static function satirsayisi($zum)
{

	$s="select * from kisisel";
	$tumveri=$zum->prepare($s);
	$tumveri->execute();
	$sonuc=$tumveri->get_result();		
	echo '<p class="text-success">Toplam kayıtlı üye sayısı : <strong>'.$sonuc->num_rows .'</strong></p>';

} // SATIR SAYISI


}

?>