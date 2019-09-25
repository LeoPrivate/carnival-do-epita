<?php

namespace Hackathon\PlayerIA;

use Hackathon\PlayerIA\Player;
use Hackathon\Game\Result;

/**
 * Class PaperPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class LeoprivatePlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    protected $sign = array(0 => 'paper', 1 => 'rock', 2 => 'scissors');

    private function getLastChoice() {
        return $this->result->getLastChoiceFor($this->mySide);
    }

    private function getLastOpponentChoice() {
        return $this->result->getLastChoiceFor($this->opponentSide);
    }

    private function getMyLastScore() {
        return $this->result->getLastScoreFor($this->mySide);
}

    private function shouldIReverse() {
        return $this->getMyLastScore() == 3;
    }

    private function shouldIChangeMySign() {
        return $this->getMyLastScore() < 3;
    }

    private function chooseOne() {
        $sign = $this->getLastChoice();
        if ($sign == 'rock') {
            return parent::rockChoice();
        } else if ($sign == 'paper') {
            return parent::paperChoice();
        } else {
            return parent::scissorsChoice();
        }
    }
    private function chooseOneReverse() {
        $sign = $this->getLastChoice();
        if ($sign == 'rock') {
            return parent::scissorsChoice();
        } else if ($sign == 'paper') {
            return parent::rockChoice();
        } else {
            return parent::paperChoice();
        }
    }
    private function changeMySign() {
        $IndexNewSign = array_search($this->getMyLastScore(), $this->sign);
        $sign = $this->sign[($IndexNewSign + 1) % 3 ];
        if ($sign == 'rock') {
            return parent::rockChoice();
        } else if ($sign == 'paper') {
            return parent::paperChoice();
        } else {
            return parent::scissorsChoice();
        }
}




    public function getChoice()
    {
        // COMMENT MARCHE MON RESEAU DE NEURONE ?
        /*
         * 1. Papier
         * 2. si je gagne, je prend le counter du mon counter
         * 3. sinon je prend le prochain dans ma liste
         * J'avoue, j'ai testé plusieurs stratégie et celle ci fait environ TOP 8 donc
         * rapport qualité/effort c'est plutôt correct :-)
         * Désolé pour toute les fonctions qui ne servent pas, c'était pour mes autres tests
         */
        if (!$this->getLastChoice()) {
            return parent::paperChoice();
        }
        if ($this->shouldIReverse()) {
            return $this->chooseOneReverse();
        }
        return $this->changeMySign();

  }
};
