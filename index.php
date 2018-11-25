<?php 
  include 'fuseki.php'; 
  $request = new Fuseki('http://localhost:3030', 'band');
  $PREFIX = "PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX owl: <http://www.w3.org/2002/07/owl#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
        PREFIX band: <http://localhost/Band/band.owl#>";
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>CSS Responsive Table Layout</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">  
  <link rel="stylesheet" href="css/style.css">  
</head>

<body>
  <div class="wrapper">

    <!-- Tabel Band -->
    <?php
      $sparql1 = $PREFIX."
      select *
      {
        ?band band:band_name ?nama.
        ?band band:born_band ?lahir.
        ?band band:websites ?web.
        ?band band:origin_band ?asal.
        ?band band:year_active ?tahun_aktif.
        ?band band:band_labels ?label.
      }";

      $request->setSparQl($sparql1);
      $result1 = $request->sendRequest();
    ?>
    <h2 style="color: white">Band</h2>
    <div class="table">
      <div class="row header">
        <div class="cell">
          Band Name
        </div>
        <div class="cell">
          Born Band
        </div>
        <div class="cell">
          Origin Band
        </div>
        <div class="cell">
          Year Active
        </div>
        <div class="cell">
          Band Labels
        </div>
        <div class="cell">
          Websites
        </div>
      </div>
      <?php foreach ($result1 as $loop) { ?>
      <div class="row">
        <div class="cell">
          <?php echo $loop['nama']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['lahir']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['asal']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['tahun_aktif']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['label']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['web']['value']; ?>
        </div>
      </div> 
      <?php } ?>
    </div>

    <!-- Tabel Member -->
    <?php
      $sparql4 = $PREFIX."
      select *
      {
        ?band band:band_name ?name. 
        OPTIONAL
        { 
          ?band band:band_name ?name.
          ?band band:has_member ?member1.
          ?member1 rdf:type band:member.
          ?member1 band:member_age ?umur.
          ?member1 band:member_name ?nama.
          ?member1 band:band_position ?posisi.
          ?member1 band:member_born ?ttl.
        }
      }";
      $request->setSparQl($sparql4);
      $result4 = $request->sendRequest();
    ?>
    <h2 style="color: white">Member</h2>
    <div class="table">
      <div class="row header green">
        <div class="cell">
          Member Name
        </div>
        <div class="cell">
          Member Age
        </div>
        <div class="cell">
          Band Position
        </div>
        <div class="cell">
          Member Born
        </div>
        <div class="cell">
          Band Name
        </div>
      </div>
      <?php foreach ($result4 as $loop) { ?>
      <div class="row">
        <div class="cell">
          <?php echo $loop['nama']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['umur']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['posisi']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['ttl']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['name']['value']; ?>
        </div>
      </div> 
      <?php } ?>
    </div> 

    <!-- Tabel Award -->
    <?php
      $sparql3 = $PREFIX."
      select *
      {
        ?band band:band_name ?name. 
        OPTIONAL
        { 
          ?band band:band_name ?name.
          ?band band:has_award ?award1.
          ?award1 rdf:type band:award.
          ?award1 band:organizer ?penyelenggara.
          ?award1 band:year_award ?tahun.
          ?award1 band:nomination ?nominasi.
        }
      }";
      $request->setSparQl($sparql3);
      $result3 = $request->sendRequest();
    ?>
    <h2 style="color: white">Award</h2>
    <div class="table">
      <div class="row header blue">
        <div class="cell">
          Band Name
        </div>
        <div class="cell">
          Organizer
        </div>
        <div class="cell">
          Year Award
        </div>
        <div class="cell">
          Nominees
        </div>
      </div>
      <?php foreach ($result3 as $loop) { ?>
      <div class="row">
        <div class="cell">
          <?php echo $loop['name']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['penyelenggara']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['tahun']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['nominasi']['value']; ?>
        </div>
      </div> 
      <?php } ?>
    </div>  
    
    <!-- Tabel Album -->
    <?php
      $sparql2 = $PREFIX."
      select *
      {
        ?band band:band_name ?name. 
        OPTIONAL
        { 
          ?band band:band_name ?name.
          ?band band:has_album ?album1.

          ?album1 rdf:type band:album.
          ?album1 band:year_release ?tahun_rilis.
          ?album1 band:album_title ?nama_album. 
        }
      }";
      $request->setSparQl($sparql2);
      $result2 = $request->sendRequest();
    ?>
    <h2 style="color: white">Album</h2>
    <div class="table">
      <div class="row header">
        <div class="cell">
          Band Name
        </div>
        <div class="cell">
          Album Title
        </div>
        <div class="cell">
          Year Release
        </div>
      </div>
      <?php foreach ($result2 as $loop) { ?>
      <div class="row">
        <div class="cell">
          <?php echo $loop['name']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['nama_album']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['tahun_rilis']['value']; ?>
        </div>
      </div> 
      <?php } ?>
    </div>

    <!-- Tabel Single -->
    <?php
      $sparql5 = $PREFIX."
      select *
      {
        ?band band:band_name ?name. 
        OPTIONAL
        { 
          ?band band:band_name ?name.

          ?band band:has_album ?album1.          
          ?album1 band:album_title ?title_album.

          ?album1 band:has_single ?single1.

          ?single1 rdf:type band:single.
          ?single1 band:duration ?durasi.
          ?single1 band:title ?judul.
          ?single1 band:creator ?pencipta.
        }
      }";
      $request->setSparQl($sparql5);
      $result5 = $request->sendRequest();
    ?>
    <h2 style="color: white">Single</h2>
    <div class="table">
      <div class="row header green">
        <div class="cell">
          Band Name
        </div>
        <div class="cell">
          Album Title
        </div>
        <div class="cell">
          Single Title
        </div>
        <div class="cell">
          Duration
        </div>
        <div class="cell">
          Creator
        </div>
      </div>
      <?php foreach ($result5 as $loop) { ?>
      <div class="row">
        <div class="cell">
          <?php echo $loop['name']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['title_album']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['judul']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['durasi']['value']; ?>
        </div>
        <div class="cell">
          <?php echo $loop['pencipta']['value']; ?>
        </div>
      </div> 
      <?php } ?>
    </div> 
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> 
</body>
</html>