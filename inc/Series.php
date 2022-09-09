<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php require_once 'auth.php'; ?>
<?php require_once '../forms/searchm.php'; ?>
<?php require_once 'header.php'; ?>
<style>
body {
    overflow-X: hidden;
}

.mimge {
    width: 225px;
    left: 0;
    top: 0;
    right: 100px;
    margin: 5px;
    float: CENTER;
    position: relative;
}

.contanier {
    left: 20%;
    right: 10%;
    position: relative;
}

.movie-item-title {
    font-size: 15PX;
}

.section {
    top: 300px;
    position: relative;
}

/* .pagenum{
  position: relative;
  top: 940px;
  left: 900PX;
  float: left;
  margin: 0px;
}
.pagenum1{
  position: relative;
  top: 940px;
  left: 900PX;
  float: left;
  margin: 0px;
} */
@media screen and (max-width: 1480px) {

    .mimge {
        width: 175px;
        left: 0;
        right: 100px;
        margin: 5px;
        float: CENTER;
        position: relative;
    }

    .movie-item-title {
        font-size: 10PX;
    }

    /* .pagenum{
  position: relative;
  top: 1200px;
  left: 200PX;
  float: left;
}
.pagenum1{
  position: relative;
  top: 1900px;
  left: 200PX;
  float: left;
  
} */
}
</style>

<body>


    <?php
    // 1) connect to database - اتصال بقاعدة البيانات

    require_once '../db_conn.php';

    // 2) define how many results you want per page - تعريف عدد نتائج لكل صفحة
    $resultsPerPage = 20;

    // 3) ايجاد عدد نتائج البيانات الذي تحدده من قاعدة البيانات
    // find out the number of results stored in database -
    $numberOfResults = "SELECT * FROM tvshow ";
    $numberOfResults = $conn->query($numberOfResults);
    $numberOfResults = $numberOfResults->num_rows;

    // 4) -تحديد رقم الصفحة الذي يعمل عليه الزائر حاليًا
    // determine which page number visitor is currently on 
    if (!isset($_GET['page'])) {
        $page = 1;
    } else if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    // 5) determine number of total pages available - تحديد عدد الصفحات الإجمالية المتاحة

    $totalPages = ceil($numberOfResults / $resultsPerPage);

    for ($count = 1; $count <= $totalPages; ++$count) {
        if ($page == $count) {
            // echo '
            // <div class="pagenum1">
            // <a style="color:red;"  href="Series.php?page='.$count.'">'.$count.'</a></div> ';
        } else {
            // echo '
            // <a  href="Series.php?page='.$count.'">'.$count.'</a> 
            // ';
        }
    }
    // 6) تحديد رقم البداية المحدد للنتائج في صفحة العرض
    // determine the sql LIMIT starting number for the results on the displaying page

    // $sql = "SELECT s.NAME, e.SID FROM `episodetv_info` e INNER JOIN tvshow s ON e.SID = s.ID WHERE s.ID = ".$result['SID'] ."";

    // $result =	mysqli_query($conn, $sql);
    // if (mysqli_num_rows($result) > 0) {
    //   $filterName = mysqli_fetch_assoc($result);

    //          echo "<div class='rate1'>
    //          <a href='filters.php?search=".$filterName['SID']."&searchBtn=' class='neon-button'>".$filterName['NAME']." </a> </div>";


    // }  

    $resultsql = "SELECT * FROM tvshow LIMIT " . $resultsPerPage . " OFFSET " . ($page - 1) * $resultsPerPage;
    $results = mysqli_query($conn, $resultsql);


    // 7) display the results  - // عرض  النتائج الصفحات

    foreach ($results  as $result) {

        echo '
  <div class="r">     
<div class="mimge">
  <div class="movie-item">
  <div class="flm">    
  <a href="seriesw?search=' . $result['TV_NAME'] . '&searchBtn="</a>  <img src=' . $result['IMAGEURL'] . '>    
     <div class="movie-item-content">
<div class="movie-item-title">
' . $result['TV_NAME'] . '
<div class="movie-info">
      <i class="bx bxs-star"></i>
          <span>Global Rate ' . $result['RATE'] . '</span>
  
        </div>
     </div>   
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>
</a>';
    }

    ?>
    <!-- SCRIPT -->
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- OWL CAROUSEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous"></script>
    <!-- APP SCRIPT -->
    <script src="../js/app.js"></script>

</body>

</html>