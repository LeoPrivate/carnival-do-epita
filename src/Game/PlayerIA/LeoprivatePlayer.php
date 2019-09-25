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

        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
       // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        if (!$this->getLastChoice()) {
            return parent::paperChoice();
        }
        if ($this->shouldIChangeMySign()) {
            return $this->changeMySign();
        } else {
            return $this->chooseOne();
        }

  }
};
