<?php
    class enseignant
    {
        public static function inscription($enseignant){
            //se connecter à la base des données
            $bdd = config::connexion();
            $req = $bdd->prepare('INSERT INTO users(nomuser,mdp) VALUES(?,?)');
            if($res = $req->execute(array($enseignant[0],$enseignant[3]))){

                $sql2 = $bdd->query('SELECT id FROM users order by id desc LIMIT 1');
                $a = $sql2->fetch();
                //enregistrement
                $req = $bdd->prepare(  
                                            'INSERT INTO enseignant(matiere,user_id,email) 
                                            VALUES(?,?,?)'
                                        );
                $res = $req->execute(array($enseignant[1],$a[0],$enseignant[2]));
                return $res;
            }
        }
        public static function cnxEnseignant($login){

            //se connecter à la base des données
            $bdd = config::connexion();

            $req = $bdd->prepare('SELECT * FROM users
                                    inner join enseignant
                                    on users.id =enseignant.user_id 
                                    WHERE nomuser = ?
                                    AND mdp = ?');
            $req->execute($login);
            if ($res = $req->fetch()) {
                return $res;
            }
        }
    }
    