<?php 
$title = "Sistem Informasi Ansaf";
include_once "header.php";
include_once "koneksi.php"; ?>

      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">
              <h2 class="panel-title"><strong> - <?php echo $title ?> - </strong></h2>
            </div>
            <div class="panel-body">
              <table class="table table-bordered  table-striped table-admin">
              <thead>
                <tr>
                  <th>#</th>
              <th>Nama Penerima Bantuan</th>
              <th>Kategori</th>
              <th>Jumlah Keluarga</th>
              <th>Pendapatan Sebulan </th>
              <th>Alamat</th>
              <th>Bandar</th>
              <th>Negeri</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th>Detail</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $data = file_get_contents('http://localhost/web/ambildata.php');
                $no=1;
                if(json_decode($data,true)){
                  $obj = json_decode($data);
                  foreach($obj->results as $item){
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $item->name; ?></td>
                <td><?php echo $item->category; ?></td>
                <td><?php echo $item->AsnafFamily; ?></td>
                <td><?php echo $item->AsnafIncome; ?></td>
                <td><?php echo $item->address; ?></td>
                <td><?php echo $item->AsnafCity; ?></td>
                <td><?php echo $item->AsnafState; ?></td>
                <td><?php echo $item->lat; ?></td>
                <td><?php echo $item->lng; ?></td>

                
                <td class="ctr">
                  <div class="btn-group">
                    <a target="_blank" href="detail.php?id=<?php echo $item->id; ?>" rel="tooltip" data-original-title="Lihat File" data-placement="top" class="btn btn-primary">
                    <i class="fa fa-map-marker"> </i> Detail dan Lokasi</a>&nbsp;
                  </div>
                </td>
              </tr>
              <?php $no++; }}

              else{
                echo "data tidak ada.";
                } ?>
              
              </tbody>
            </table>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include_once "footer.php" ?>