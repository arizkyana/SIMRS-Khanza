<?php
 include '../conf/conf.php';
?>
<html>
    <isi>
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </isi>
    <body>

    <?php
    reportsqlinjection();      
        $nonota    =str_replace("_"," ",$_GET['nonota']); 
        $tanggal   =$_GET['tanggal']; 
        $catatan = str_replace("_"," ",$_GET['catatan']); 
        $petugas = str_replace("_"," ",$_GET['petugas']); 
        $norm = str_replace("_"," ",$_GET['norm']);
        $pasien = str_replace("_"," ",$_GET['pasien']); 
        $besarppn = str_replace("_"," ",$_GET['besarppn']); 

        $_sql = "SELECT no,temp1, temp2, temp3, temp4, temp5, temp6, temp7, temp8, temp9 from temporary order by no asc";            
        $hasil=bukaquery($_sql);
        
        if(mysql_num_rows($hasil)!=0) { 
          $setting=  mysql_fetch_array(bukaquery("select nama_instansi,alamat_instansi,kabupaten,propinsi,kontak,email,logo from setting"));
          echo "<table width='".getOne("select notaapotek from set_nota")."'  border='0' align='left' cellpadding='0' cellspacing='0' class='tbl_form'>
                 <tr class='isi14'>
                       <td width=50% colspan=4 align=left>
                           <table width='100%' bgcolor='#ffffff' padding='0' align='left' border='0' class='tbl_form'>
								<tr>
									<td padding='0'>
										<img width='60' height='60' src='data:image/jpeg;base64,". base64_encode($setting['logo']). "'/>
									</td>
									<td>
									<center>
											<font color='000000' size='3'  face='Tahoma'>".$setting["nama_instansi"]."</font><br>
                                                                                        <font color='000000' size='2'  face='Tahoma'>
                                                                                            ".$setting["alamat_instansi"].", ".$setting["kabupaten"].", ".$setting["propinsi"]."<br/>
                                                                                            ".$setting["kontak"].", E-mail : ".$setting["email"]."
                                                                                        </font> 
									</center>
									</td>
								</tr>
						   </table>
                       </td>
                 </tr>
                 <tr>
					 <td colspan='6'><hr/>
						 <table width=100%>
							 <tr class='isi14'>
								<td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>No.RM</font>
								</td>
                                                                <td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>: $norm</font>
								</td>
                                                                <td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>No.Nota</font>
								</td>
                                                                <td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>: $nonota</font>
								</td>                                                                
							 </tr> 
                                                         <tr class='isi14'>
								<td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>Nama Pasien</font>
								</td>
                                                                <td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>: $pasien</font>
								</td>
                                                                <td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>Tanggal</font>
								</td>
                                                                <td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>: $tanggal</font>
								</td>                                                                
							 </tr> 
                                                         <tr class='isi14'>
								<td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>Alamat Pasien</font>
								</td>
                                                                <td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>: ".getOne(
                                                                           "select alamat from pasien where no_rkm_medis='$norm'")."</font>
								</td>
                                                                <td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>Petugas</font>
								</td>
                                                                <td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>: $petugas</font>
								</td>                                                                
							 </tr> 
                                                         
                                                         <tr class='isi14'>
								<td width='25%'>
								   <font color='000000' size='2' face='Tahoma'>Catatan</font>
								</td>
                                                                <td width='25%' colspan='3'>
								   <font color='000000' size='2' face='Tahoma'>: $catatan</font>
								</td>                                                              
							 </tr> 
						 </table>
					 </td>
                 </tr>
                 <tr class='isi14'>
                       <td colspan=4 height='100%' valign=top>
                            <table width=100% cellpadding='0' cellspacing='0'>
                               <tr class=isi15>
                                   <td width='5%' align=center><font color='000000' size='2'  face='Tahoma'>No</font></td>
                                   <td width='20%' align=center><font color='000000' size='2'  face='Tahoma'>Jml</font></td>
                                   <td width='55%' align=center><font color='000000' size='2'  face='Tahoma'>Nama Barang</font></td>
                                   <td width='20%' align=center><font color='000000' size='2'  face='Tahoma'>Total</font></td>
                               </tr>";
                                      $ttlpesan=0;
                                      $i=1;
                                      while($barispesan = mysql_fetch_array($hasil)) { 
                                          $ttlpesan=$ttlpesan+$barispesan[9];
                                          echo "
                                            <tr class='isi15'>
                                                <td><font color='000000' size='2'  face='Tahoma'>$i</font></td>
                                                <td><font color='000000' size='2'  face='Tahoma'>$barispesan[1] $barispesan[5]</font></td>
                                                <td><font color='000000' size='2'  face='Tahoma'>$barispesan[3] </font></td>
                                                <td align=right><font color='000000' size='2'  face='Tahoma'>".formatDuit2($barispesan[9])."</font></td>
                                           </tr>";$i++;
                                      }    
                             echo " <tr class='isi14'>
                                      <td colspan=2></td>
                                      <td align='right'><font color='000000' size='2'  face='Tahoma'>Tagihan</font></td>
                                      <td align='right'><font color='000000' size='2'  face='Tahoma'>".formatDuit2($ttlpesan)."</font></td>
                                    </tr>  
                                    <tr class='isi14'>
                                      <td colspan=2></td>
                                      <td align='right'><font color='000000' size='2'  face='Tahoma'>PPN</font></td>
                                      <td align='right'><font color='000000' size='2'  face='Tahoma'>".formatDuit2($besarppn)."</font></td>
                                    </tr>   
                                    <tr class='isi14'>
                                      <td colspan=2></td>
                                      <td align='right'><font color='000000' size='2'  face='Tahoma'>Tagihan+PPN</font></td>
                                      <td align='right'><font color='000000' size='2'  face='Tahoma'>".formatDuit2($ttlpesan+$besarppn)."</font></td>
                                    </tr>  
                          </table>
                      </td>
                    </tr>
                 </table>";
            
        } else {echo "<b>Data pesan masih kosong !</b>";}
    ?>

    </body>
</html>
