<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace BjyAuthorize\Provider\Identity;

use Zend\Debug\Debug;

use BjyAuthorize\Exception\InvalidRoleException;
use BjyAuthorize\Provider\Role\ProviderInterface as RoleProviderInterface;
use Zend\Permissions\Acl\Role\RoleInterface;
use Zend\Authentication\AuthenticationService;

/**
 * Simple identity provider to handle simply guest|user
 *
 * @author Ingo Walz <ingo.walz@googlemail.com>
 */
class AuthenticationIdentityProvider implements ProviderInterface
{
    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @var string|\Zend\Permissions\Acl\Role\RoleInterface
     */
    protected $defaultRole = 'Invitado';

    /**
     * @var string|\Zend\Permissions\Acl\Role\RoleInterface
     */
    protected $authenticatedRole = 'Autenticado';

    /**
     * @param AuthenticationService $authService
     */
    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentityRoles()
    {
        if ( ! $identity = $this->authService->getIdentity()) {
            return array($this->defaultRole);
        }

        if ($identity instanceof RoleInterface) {
        	
            return array($identity);
        }

        if ($identity instanceof RoleProviderInterface) {

        	if (count($identity->getRoles()) > 0) {
        		
        		return $identity->getRoles();
        		
        	} else {
        	//	Debug::dump($identity->getRoles());
        		
        		return array($this->authenticatedRole);
            }
        }
	
        
        return array($this->authenticatedRole);
    }

    /**
     * Get the rule that's used if you're not authenticated
     *
     * @return string|\Zend\Permissions\Acl\Role\RoleInterface
     */
    public function getDefaultRole()
    {
        return $this->defaultRole;
    }

    /**
     * Set the rule that's used if you're not authenticated
     *
     * @param $defaultRole
     *
     * @throws \BjyAuthorize\Exception\InvalidRoleException
     */
    public function setDefaultRole($defaultRole)
    {
        if ( ! ($defaultRole instanceof RoleInterface || is_string($defaultRole))) {
            throw InvalidRoleException::invalidRoleInstance($defaultRole);
        }

        $this->defaultRole = $defaultRole;
    }

    /**
     * Get the role that is used if you're authenticated and the identity provides no role
     *
     * @return string|\Zend\Permissions\Acl\Role\RoleInterface
     */
    public function getAuthenticatedRole()
    {
        return $this->authenticatedRole;
    }

    /**
     * Set the role that is used if you're authenticated and the identity provides no role
     *
     * @param string|\Zend\Permissions\Acl\Role\RoleInterface $authenticatedRole
     *
     * @throws \BjyAuthorize\Exception\InvalidRoleException
     *
     */
    public function setAuthenticatedRole($authenticatedRole)
    {
        if ( ! ($authenticatedRole instanceof RoleInterface || is_string($authenticatedRole))) {
            throw InvalidRoleException::invalidRoleInstance($authenticatedRole);
        }

        $this->authenticatedRole = $authenticatedRole;
    }
}
