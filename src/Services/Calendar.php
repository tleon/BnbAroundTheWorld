<?php

namespace App\Services;

use App\Model\BookingManager;

class Calendar
{

    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    private $months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];

    private $month;

    public $year;



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
     * Renvoi le premier jour du mois.
     *
     * @return \DateTime
     */
    private function getFirstDay() : \DateTime
    {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    /**
     * Retourne le dernier jour du mois
     *
     * @return \DateTime
     */
    private function getLastDay() : \DateTime
    {
        return $this->getFirstDay()->modify("+1 month -1 day");
    }


    /**
     * Renvoi le premier jour de la premiere semaine du mois + x semaines + x jours
     *
     * @param integer $week
     * @param integer $day
     * @return \DateTime
     */
    public function newDate(int $week, int $day) : \DateTime
    {  
        if($this->getFirstDay()->format('D') === 'Mon'){
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

    /**
     * Revoi le mois suivant
     *
     * @return string
     */
    public function nextMonth() : string
    {
        $month = $this->month + 1;
        $year = $this->year;
        if($month > 12 ){
            $month = 1;
            $year += 1;
        }
        return "/admin/planning/?month=$month&year=$year";
    }

    /**
     * Renvoi le mois precedent
     *
     * @return string
     */
    public function previousMonth() : string
    {
        $month = $this->month - 1;
        $year = $this->year;
        if($month == 0 ){
            $month = 12;
            $year -= 1;
        }
        return "/admin/planning/?month=$month&year=$year";
    }


    /**
     * Renvoi un tableau des reservations pour le mois indexées par dates pour lesquelles il existe une 
     * ou plusieurs réservations.
     *
     * @return array
     */
    public function getBookingInMonth() : array
    {   // Nouvelle instance de BookingManager
        $bm = new BookingManager;
        // On récupere un tableau multidimensionnel en sortie de mysql
        $bookings = $bm->selectByMonth($this->getFirstDay(), $this->getLastDay());
        // On creer un tableau qui sera notre sortie, comprenant toutes les dates pour lesquelles il existe une 
        // ou plusieurs réservations.
        $bookingPerDay = [];
        // On boucle sur toutes les reservations.
        foreach($bookings as $booking){
            // On recupere uniquement les dates avec comme format "2019-01-21" (auparavent au format "2019-01-21 00:00:00").
            $entree=explode(' ', $booking['begin_date'])[0];
            $sortie=explode(' ', $booking['end_date'])[0];
            // on istancie la classe DatePeriode pour recuperer toutes les dates comprises entre begin_date & end_date
            // avec un intervalle de 1 jour.
            $periods = new \DatePeriod(
                new \DateTime($entree),
                new \DateInterval('P1D'),
                new \DateTime($sortie)
            );
            // on boucle sur toutes ces dates
            foreach ($periods as $period) {
                // on creer une clef de la date si innexistante et on push en valeur les infos de sortie mysql sur la resa
                if(!isset($bookingPerDay[$period->format('d-m-Y')])){
                    $bookingPerDay[$period->format('d-m-Y')] = [$booking];
                // ici la clef existe deja, on push en valeur les infos de sortie mysql sur la resa
                } else {
                    $bookingPerDay[$period->format('d-m-Y')][] = $booking;
                }
            }
        }
        return $bookingPerDay;
    }
}
