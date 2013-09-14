<?php

namespace Jazzyweb\Bioritmos\Model;

/**
 *
 * class BioRitmo
 * Basada en la clase BioR de Iztok Strzinar / master@pomarancha.com
 * Requiere php-gd
 *
 *  DESCRIPCIÓN
 *  -----------
 * Esta clase permite calcular y dibujar los valores de los bioritmos personales.
 * Ofrece datos para 3 curvas periódicas (física, emocional e intelectual) en el rango -100,100
 *
 * "Los biorritmos constituyen un intento de predecir aspectos diversos de la vida de un individuo recurriendo
 * a ciclos matemáticos sencillos. La mayoría de los investigadores estima que esta idea no tendría más poder
 * predictivo que el que podría atribuirse al propio azar,1 considerándola un caso claro de pseudociencia" (Wikipedia)
 *
 *  USO
 *  ---
 * Constructor: Toma dos argumentos; la fecha de nacimiento y la fecha para la cual se quiere calcular el bioritmo.
 * Si esta segunda fecha no se define, se toma la fecha de hoy:
 *
 * $test = new BioRitmo('1971-05-15', '2004-08-06');
 *
 * DrawBior: Construye el diagrama, lo escribe en el disco en el lugar especificado por su argumento. Usa path relativos
 *
 * $test->DrawBior('image_png');
 *
 * GetDiagramImageTag: Obtiene la representación HTML del bioritmo
 *
 * $test->GetDiagramImageTag();
 *
 * $test->GetDiagramFileHandler();
 *
 * GetAllPercentages: Obtiene un array con todos los porcentages para un día dado
 *
 * $array = $test->GetAllPercentages();
 *
 * EJEMPLO
 * -------
 *
 * include ("BioRitmo.php");
 * $my_bior = new BioRitmo ('1971-05-15');
 * $my_bior->DrawBior('my_bior.png');
 * echo $my_bior->GetDiagramImageTag();
 *
 */

// Parametrización

define('PHY_PERIOD', 23);
define('EMO_PERIOD', 28);
define('INT_PERIOD', 33);

define('DAYS_TO_SHOW', 30); // number of days on diagram
define('DIAGRAM_WIDTH', 600);
define('DIAGRAM_HEIGHT',400);

define('FILE_FOR_DIAG', 'slika2.png'); // file for diagram graphyc; must be .png file


// define text for diagram
define('CURVE_TEXT_PHY', 'FIZ');
define('CURVE_TEXT_EMO', 'EMO');
define('CURVE_TEXT_INT', 'INT');

// define colors for diargam / RGB format
define('BACK_C_R', 219);
define('BACK_C_G', 219);
define('BACK_C_B', 219);

define('GRID_C_R', 0);
define('GRID_C_G', 0);
define('GRID_C_B', 0);

define('PHY_C_R', 207);
define('PHY_C_G', 0);
define('PHY_C_B', 0);

define('EMO_C_R', 0);
define('EMO_C_G', 107);
define('EMO_C_B', 0);

define('INT_C_R', 0);
define('INT_C_G', 0);
define('INT_C_B', 112);

// end customization; do not edit bellow this line

class Bioritmos {

    private $daysToShow;
    private $diagramWidth;
    private $diagramHeight;

    private $showFIZ;
    private $showEMO;
    private $showINT;

    // constructor
    public function __construct ($birth_date, $date_for_bior = -1) {

        $this->daysToShow = DAYS_TO_SHOW;
        $this->diagramWidth = DIAGRAM_WIDTH;
        $this->diagramHeight = DIAGRAM_HEIGHT;

        $this->showFIZ = true;
        $this->showEMO = true;
        $this->showINT = true;

        if ($date_for_bior == -1)
            $date_for_bior = date('Y-m-d', time());

        // date for bior - timestamp
        $this->date_for_bior_epoch = strtotime($date_for_bior);

        // dateparts for birth_date
        $birth_date_parts = explode('-', $birth_date);
        list ($this->birth_date_y, $this->birth_date_m, $this->birth_date_d) = $birth_date_parts;

        // dateparts for date_for_bior
        $date_for_bior_parts = explode('-', $date_for_bior);
        list ($this->date_for_bior_y, $this->date_for_bior_m, $this->date_for_bior_d) = $date_for_bior_parts;

    }

    /**
     * @param int $diagramHeight
     */
    public function setDiagramHeight($diagramHeight)
    {
        $this->diagramHeight = $diagramHeight;
    }

    /**
     * @param int $diagramWidth
     */
    public function setDiagramWidth($diagramWidth)
    {
        $this->diagramWidth = $diagramWidth;
    }

    /**
     * @param boolean $showEMO
     */
    public function setShowEMO($showEMO)
    {
        $this->showEMO = $showEMO;
    }

    /**
     * @param boolean $showFIZ
     */
    public function setShowFIZ($showFIZ)
    {
        $this->showFIZ = $showFIZ;
    }

    /**
     * @param boolean $showINT
     */
    public function setShowINT($showINT)
    {
        $this->showINT = $showINT;
    }

    public function setDaysToShow($days){
        $this->daysToShow = $days;
    }

    // get all percentages and trends for today in array
    public function GetAllPercentages () {

        return array("phy"=>$this->GetPercentageForToday(PHY_PERIOD),
            "emo"=>$this->GetPercentageForToday(EMO_PERIOD),
            "int"=>$this->GetPercentageForToday(INT_PERIOD),
            "avg"=>$this->GetAverage()
        );

    }

    //get relative file handler for diagram file
    public function GetDiagramFileHandler () {
        return $this->file_for_diag;
    }

    //get html image tag for diagram file
    public function GetDiagramImageTag () {

        return "<img src=\"$this->file_for_diag\">";
    }

    // build diagram and put it to disk as png file
    public function DrawBior ($file_for_diag = FILE_FOR_DIAG) {

        // set handler
        $this->file_for_diag = $file_for_diag;

        // create image
        $this->image = imagecreate ($this->diagramWidth ,$this->diagramHeight);

        // allocate colors for gdlib
        $color_grid = imagecolorallocate ($this->image, GRID_C_R, GRID_C_G, GRID_C_B);
        $color_phy = imagecolorallocate ($this->image, PHY_C_R, PHY_C_G, PHY_C_B);
        $color_emo = imagecolorallocate ($this->image, EMO_C_R, EMO_C_G, EMO_C_B);
        $color_int = imagecolorallocate ($this->image, INT_C_R, INT_C_G, INT_C_B);
        $color_back = imagecolorallocate ($this->image, BACK_C_R, BACK_C_G, BACK_C_B);

        // draw background
        imagefilledrectangle ($this->image, 0, 0, $this->diagramWidth - 1, $this->diagramHeight - 1, $color_back);


        $nrSecondsPerDay = 60 * 60 * 24;
        $diagramDate = $this->date_for_bior_epoch - ($this->daysToShow / 2 * $nrSecondsPerDay) + $nrSecondsPerDay;


        // draw days and separators
        for ($i = 1; $i < $this->daysToShow; $i++) {
            $thisDate = getdate($diagramDate);
            $xCoord = ($this->diagramWidth / $this->daysToShow) * $i;

            imageline($this->image, $xCoord, $this->diagramHeight - 25, $xCoord, $this->diagramHeight - 20, $color_grid);
            imagestring($this->image, 1, $xCoord - 5, $this->diagramHeight - 16, $thisDate[ "mday"], $color_grid);

            $diagramDate += $nrSecondsPerDay;
        }

        // draw some diagram elements
        imageline($this->image, 0, ($this->diagramHeight - 20) / 2, $this->diagramWidth, ($this->diagramHeight - 20) / 2, $color_grid);
        imageline($this->image, $this->diagramWidth / 2, 0, $this->diagramWidth / 2, $this->diagramHeight - 20, $color_grid);
        imagestring($this->image, 2, $this->diagramWidth - 30, 5, '100%' , $color_grid);
        imagestring($this->image, 2, $this->diagramWidth - 35, $this->diagramHeight - 45, '-100%' , $color_grid);
        imagestring($this->image, 2, 5, $this->diagramHeight - 45, date('m-Y', $this->date_for_bior_epoch) , $color_grid);
        imagestring($this->image, 2, 10, 10, '<-- '.$this->birth_date_d.'/'.$this->birth_date_m.'/'.$this->birth_date_y, $color_grid);
        imagestring($this->image, 4, 10, 30, CURVE_TEXT_PHY , $color_phy);
        imagestring($this->image, 4, 10, 45, CURVE_TEXT_EMO , $color_emo);
        imagestring($this->image, 4, 10, 60, CURVE_TEXT_INT , $color_int);

        // call functions for curve drawing

        if($this->showFIZ)
            $this->DrawCurve ($this->GetDaysFromBirth(), PHY_PERIOD, $color_phy);
        if($this->showEMO)
            $this->DrawCurve ($this->GetDaysFromBirth(), EMO_PERIOD, $color_emo);
        if($this->showINT)
            $this->DrawCurve ($this->GetDaysFromBirth(), INT_PERIOD, $color_int);

        // write diagram image to disk
        imagepng ($this->image, $this->file_for_diag);


    }

    // gregorian to julian days conversion
    private function grgtojd ($month,$day,$year) {
        if ($month > 2) {
            $month = $month - 3;
        } else {
            $month = $month + 9;
            $year = $year - 1;
        }
        $c = floor($year / 100);
        $ya = $year - (100 * $c);
        $j = floor((146097 * $c) / 4);
        $j += floor((1461 * $ya)/4);
        $j += floor(((153 * $month) + 2) / 5);
        $j += $day + 1721119;
        return $j;
    }

    // get days from birth
    private function GetDaysFromBirth (){

        // transform date to number of Julian days and substract two dates to get "num of days alive"
        $this->days_from_birth = abs($this->grgtojd($this->birth_date_m, $this->birth_date_d, $this->birth_date_y)
        - $this->grgtojd($this->date_for_bior_m, $this->date_for_bior_d, $this->date_for_bior_y));

        return $this->days_from_birth;
    }



    // draw sin curve
    private  function DrawCurve ($days_from_birth, $period, $color) {

        $centerDay = $this->GetDaysFromBirth() - ($this->daysToShow / 2);
        $plotScale = ($this->diagramHeight - 25) / 2;
        $plotCenter = ($this->diagramHeight - 25) / 2;
        imagesetthickness($this->image, 2);
        for($x = 0; $x <= $this->daysToShow; $x++) {
            $phase = (($centerDay + $x) % $period) / $period * 2 * pi();
            $y = 1 - sin($phase) * (float)$plotScale + (float)$plotCenter;

            if($x > 0) {
                imageline($this->image, $oldX, $oldY, $x * $this->diagramWidth / $this->daysToShow, $y, $color);
            }
            $oldX = $x * $this->diagramWidth / $this->daysToShow;
            $oldY = $y;
        }
    }

    // Get pecentage for given day for given curve
    private  function GetPercentageForToday ($period) {

        // get y value in degrees for given day for given period
        $y = ceil(sin(deg2rad($this->GetDaysFromBirth() * (360 / $period))) * 100);
        $y2 = ceil(sin(deg2rad(($this->GetDaysFromBirth() + 1) * (360 / $period))) * 100);

        // find out trend
        if ($y > $y2)
            $this->trend = 0;
        else
            $this->trend = 1;

        return array('percent' => $y, 'trend' => $this->trend);
    }

    // Get average percentage and global trend
    private  function GetAverage () {

        $phy = $this->GetPercentageForToday(PHY_PERIOD);
        $emo = $this->GetPercentageForToday(EMO_PERIOD);
        $int = $this->GetPercentageForToday(INT_PERIOD);

        if ($phy['trend'] + $emo['trend'] + $int['trend'] >= 2)
            $avg_trend = 1;
        else
            $avg_trend = 0;

        return array ('percent' => ceil(($phy['percent'] + $emo['percent'] + $int['percent']) / 3),
            'trend' => $avg_trend);

    }
}


