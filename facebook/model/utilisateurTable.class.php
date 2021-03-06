<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";
class utilisateurTable {

	/**
	* Renvoie l'utilisateur grâce à son id et son mdp
	*
	* @author Duret Nicolas
	* @author LE VEVE Mathieu
	*/
	public static function getUserByLoginAndPass($login,$pass){
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));

		return $user;
	}

	/**
	* Renvoie l'utilisateur grâce à son id
	*
	* @author Duret Nicolas
	*/
	public static function getUserById($id){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneById($id);

		return $user; 
	}

	/**
	* Renvoie tous les utilisateurs de la base (ordre alphabétique)
	*
	* @author Duret Nicolas
	* @author LE VEVE Mathieu: edit le 18/11, affiche tous les users par ordre alphabétique (repris dans la vue displayFriendList)
	*/
	public static function getUsers() {
		$em = dbconnection::getInstance()->getEntityManager() ;
		$userRepository = $em->getRepository('utilisateur');
		$users = $userRepository->findBy(
			array(),
			array('identifiant' => 'ASC')
		);
		
		return $users;
	}

	/**
	* Met à jour l'objet $user dans la base de donnée
	*
	* @author Duret Nicolas
	*/
	public static function updateUser($user) {
		$em = dbconnection::getInstance()->getEntityManager() ;
		$em->flush($user);
	}
}
?>
