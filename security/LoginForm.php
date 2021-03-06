<?php
/**
 * Abstract base class for a login form
 *
 * This class is used as a base class for the different log-in forms like
 * {@link MemberLoginForm} or {@link OpenIDLoginForm}.
 *
 * @author Markus Lanthaler <markus@silverstripe.com>
 * @package sapphire
 * @subpackage security
 */
abstract class LoginForm extends Form {
	function __construct($controller, $name, $fields, $actions) {
		parent::__construct($controller, $name, $fields, $actions);
		
		$this->disableSecurityToken();	
	}

	/**
	 * Authenticator class to use with this login form
	 * 
	 * Set this variable to the authenticator class to use with this login
	 * form.
	 * @var string
	 */
	
	protected $authenticator_class;

	/**
	 * Get the authenticator class
	 * @return Authenticator Returns the authenticator class for this login form.
	 */
	
	public function getAuthenticator() {
		if(!class_exists($this->authenticator_class) || !is_subclass_of($this->authenticator_class, 'Authenticator')) {
			user_error("The form uses an invalid authenticator class! '{$this->authenticator_class}' is not a subclass of 'Authenticator'", E_USER_ERROR);
			return;
		}
		
		return new $this->authenticator_class;
	}
}

?>