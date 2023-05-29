<?php

class Database
{
    private static $dbName = 'platform' ;
    private static $dbHost = '10.9.18.4' ;
    private static $dbUsername = 'business_school';
    private static $dbUserPassword = '2KCkYMmm%;f!';

    private static $cont  = null;

    public function __construct() {
        exit('Init function is not allowed');
    }

    public static function connect() {
        // One connection through whole application
        if ( null == self::$cont ) {
            try {
                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
                self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$cont->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}
$pdo = Database::connect();
$id = intval($_POST["id"]);
$stmt = $pdo->prepare("SELECT * FROM timetabless WHERE id = :id");
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch();
Database::disconnect();
$baslik = $result["name"];
$resim = $result["image"];
$x = "https://www.okul.pwc.com.tr/platform/manage/admin/timetable/images/";
if($id == 54){
    $x = "";
    $resim = "https://www.okul.pwc.com.tr/platform/images/panel-konusmacilar2.jpg";
} elseif ($id == 59) {
    $x = "";
    $resim = "https://www.okul.pwc.com.tr/platform/images/vergi-oturum-konusmacilar.jpg";
}
$who = $result["who"];
$konusmacilar = "";
$kimler_katilmali = $result["description"];
$neler_bekliyor = $result["expection"];
$saat = $result["start_time"] . " - " . $result["end_time"];
$salon = "";
if($who != NULL || !empty($who)){
    $who = explode("#", trim($who));
    $konusmacilar = "<p>";
    foreach($who as $i => $w){
        $w = explode("-", $w);
        $present = trim($w[0]);
        $topic = trim($w[1]);
        $konusmacilar .= "<b>$present</b> - $topic <br />";
    }
} else {
    $konusmacilar = "";
}
?>
<div class="row">
    <div class="col-lg-6">
        <div class="ts-speaker-popup-img">
            <img class="company-logo" src="<?php echo $x . $resim; ?>" alt="<?php echo $baslik; ?>">
        </div>
    </div><!-- col end-->
    <div class="col-lg-6">
        <div class="ts-speaker-popup-content">
            <h3 class="ts-title"><?php echo $baslik; ?></h3>
            <span class="speakder-designation">
         <?php echo $konusmacilar; ?>
        </span>
            <h4>Kimler Katılmalı?</h4>
            <p>
                <?php echo $kimler_katilmali; ?>
            </p>
            <h4>Katılımcıları Neler Bekliyor?</h4>
            <p>
                <?php echo $neler_bekliyor; ?>
            </p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="speaker-session-info">
                        <span><?php echo $saat; ?></span>
                        <p><?php echo $salon; ?></p>
                    </div>
                </div>
            </div>
        </div><!-- ts-speaker-popup-content end-->
    </div><!-- col end-->
    <button title="Close (Esc)" type="button" onclick='deletePopup()' class="mfp-close">×</button>
</div><!-- row end-->