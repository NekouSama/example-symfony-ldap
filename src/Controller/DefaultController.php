<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Ldap\Ldap;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        // free ldap server for training
        // https://www.forumsys.com/tutorials/integration-how-to/ldap/online-ldap-test-server/
        //
        // ldap example on how to build query
        // https://ldapwiki.com/wiki/LDAP%20Query%20Basic%20Examples

        // my example for using ldap
        $ldap = Ldap::create('ext_ldap', ['connection_string' => 'ldap://ldap.forumsys.com:389']);
        $dn = 'cn=read-only-admin,dc=example,dc=com';
        $password = 'password';
        $ldap->bind($dn, $password);
        $query = $ldap->query('dc=example,dc=com', '(&(objectclass=person))');
        $results = $query->execute();
        foreach ($results as $entry) {
            dump($entry);
        }
        die;

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DefaultController.php',
        ]);
    }
}
