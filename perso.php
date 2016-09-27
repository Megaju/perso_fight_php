<?php
    include ('header.php');

    // PERSONNAGE
    class Personnage {
        public $_life;
        
        private $_name;
        private $_localisation;
        private $_caractere;
        private $_force;
        private $_defense;
        private $_agility;
        
        public function __construct($nom, $localisation, $caractere, $PV, $FO, $DE, $AG) {
            $this->_name = $nom;
            $this->_localisation = $localisation;
            $this->_caractere = $caractere;
            $this->_life = $PV;
            $this->_force = $FO;
            $this->_defense = $DE;
            $this->_agility = $AG;
        }
        
        // Le personnage se présente
        public function sePresente() {
            echo '<h2>Présentation de ' . $this->_name . ' : </h2>';
            echo '<p>Bonjour je suis <i>' . $this->_name . '</i> j’habites à <i>' . $this->_localisation . '</i>. On dis de moi que je suis une personne plutôt <i>' . $this->_caractere . '</i> !</p>';
            echo '<p>J’ai ' . $this->_life . ' points de vie ' . $this->_force . ' de force et ' . $this ->_defense . ' en défense.</p>';
        }
        
        // Un personnage va attaquer un autre personnage
        public function attaque($persoQuiSubit) {
            echo '<h2>Attaque :</h2>';
            echo '<div><p><b class="red">' . $this->_name . '</b> attaque <b class="blue">' . $persoQuiSubit->_name . '</b> !</p>';
            $persoQuiSubit->_life -= $this->_force - $persoQuiSubit->_defense;
            echo '<p>Il reste ' . $persoQuiSubit->_life . ' PV à ' . $persoQuiSubit->_name . ' !</p></div>';
            // gestion de la contre-attaque
            $ca = rand(1, 3);
            if ($ca === 3) {
                $persoQuiSubit->contreAttaque($this->_name);
            }
        }
        
        // Système de contre-attaque qui a X chance de se lancer après une attaque
            // X = agilité du perso (mais pour le moment on dira 1 chance sur 3)
        public function contreAttaque($persoQuiSubit) {
            echo '<h2>Contre-attaque :</h2>';
            echo '<div><p><b class="red">' . $this->_name . '</b> contre-attaque <b class="blue">' . $persoQuiSubit->_name . '</b> !</p>';
            $persoQuiSubit->_life -= $this->_force - $persoQuiSubit->_defense;
            echo '<p>Il reste ' . $persoQuiSubit->_life . ' PV à ' . $persoQuiSubit->_name . ' !</p></div>';
        }
        
        
    }
    
    // Création de l'objet "julien" <<COMMENT CA JE SUIS UN OBJET ??!!>>
    $julien = new Personnage("Julien", "Rennes", "sympa", 100, 10, 5, 3);
    $julien->sePresente();
    
    // Création d'Émeraude la copine de Julien. (hou la la...)
    $emeraude = new Personnage("Émeraude", "Rennes", "rigolote", 100, 10, 5, 3);
    $emeraude->sePresente();

    // Et là Julien va attaquer Emeraude ! ! ! FIGHT ! ! !
    echo '<h3>COMBAT À MOOOOOOOOOOOOOOOORT ! ! ! !</h3>';
    while ($julien->_life > 0 and $emeraude->_life > 0) {
        $julien->attaque($emeraude);
        if ($emeraude->_life > 0) {
            $emeraude->attaque($julien);
        }
        else {
            echo "<p class='big-text'>Ju wins, FATALITYYYY!</p>";
        }
    }

    include ('footer.php');
    
?>