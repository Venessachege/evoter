 <?php 
        require_once('php/connection.php');
       if(isset($_GET['candidate']))
        $result =$mysqli->query("SELECT * FROM users"
            . "	INNER JOIN candidate_details"
            . "    ON users.User_id = candidate_details.User_id WHERE users.User_id =".$_GET['candidate'])
            OR die($mysqli->error);
        $candidates = mysqli_fetch_all($result,MYSQLI_ASSOC);    
    ?>
    <div class="row">
        <?php foreach($candidates as $candidate): ?>
            <div class="col-md-12">
              <div class="card-body">
                <h5 class="card-title"><?= $candidate['First_name']; ?></h5>
                <p class="card-text"><?= $candidate['Manifesto']; ?></p>
              </div>
            </div>
        <?php endforeach; ?>
    </div>