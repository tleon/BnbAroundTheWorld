<?php

namespace App\Classes;

class Month
{

    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    private $months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];

    private $month;

    private $year;



    /**
     * Month constructor.
     * @param int $month Le mois compris entre 1 et 12.
     * @param int $year L'année
     */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if ($month === null) {
            $month = intval(date("m"));
        }
        if ($year === null) {
            $year = intval(date("Y"));
        }
        if ($month < 1 || $month > 12) {
            throw new \Exception("La mois n'est pas valide");
        }
        if ($year < 1970) {
            throw new \Exception("L'année est inferieur a 1970");
        }
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Retourne le mois en toute lettre + année en "chiffres".
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }

    /**
     * Retourne le nombre de semaine dans le mois.
     * 
     * Pour ce faire, on recupere les numéros de semaines en debut et fin de mois, 
     * puis on effectue une soustraction pour connaitre le nombre de semaines dans le mois.
     *
     * Si le premier janvier se trouve sur la semaine 52 de l'année passée,
     * on recupere le numéro de semaine du 31 janvier.
     * 
     * @return integer
     */
    public function getNbWeeks() : int
    {
        // $start = new \DateTime("{$this->year}-{$this->month}-01");
        $start = $this->getFirstDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $nbWeeks = intval($end->format('W')) - intval($start->format('W')) + 1;
        if(intval($end->format('W')) < 5){
            $nbWeeks = (52 + intval($end->format('W'))) - intval($start->format('W')) + 1;
        }elseif ($nbWeeks < 0){
            $nbWeeks = intval($end->format('W')) + 1;
        }
        
        return $nbWeeks;
        
    }


    /**
     * Renvoi le premier lundi du mois.
     *
     * @return \DateTime
     */
    public function getFirstDay() : \DateTime
    {
        // $firstDay = new \DateTime("{$this->year}-{$this->month}-01");
        // $firstDay = $firstDay->modify('last monday');
        // return intval($firstDay->format('d'));
        return new \DateTime("{$this->year}-{$this->month}-01");
    }


    /**
     * Undocumented function
     *
     * 
     * @param integer $week
     * @param integer $day
     * @return \DateTime
     */
    public function newDate(int $week, int $day) : \DateTime
    {  
        if(date('D',strtotime(strval($this->getFirstDay()->format('Y-m-d')))) === 'Mon'){
            $newDay = $this->getFirstDay()->modify("+{$week} week +{$day} day");
        } else {
            $newDay = $this->getFirstDay()->modify('last monday');
            $newDay = $newDay->modify("+{$week} week +{$day} day");
        }
        return $newDay;
    }

    

    /**
     * Renvoi true si le jour est dans le mois en cour.
     *
     * @param \DateTime $date
     * @return boolean
     */
    public function isInMonth(\DateTime $date) : bool
    {
        return $this->getFirstDay()->format('Y-m') === $date->format('Y-m');
    }
}
