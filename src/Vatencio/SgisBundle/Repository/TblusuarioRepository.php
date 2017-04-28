<?php

namespace Vatencio\SgisBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SguRolUsuarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TblusuarioRepository extends EntityRepository
{
    public function findPersonaByIdUsuario($id_usu)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM VatencioSgisBundle:Tblpersona p JOIN p.usuario u WHERE u.id = :usuario_id')
            ->setParameter('usuario_id', $id_usu)
            ->getResult();
    }
    
    public function findUsuarioByIdUsuario($id_usu)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM RhtRhtOnlineBundle:SguUsuario u WHERE u.id = :usuario_id')
            ->setParameter('usuario_id', $id_usu)
            ->getResult();
    }
    
    public function findUsuarioClienteByIdSucursal($id_sucursal)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT u FROM RhtRhtOnlineBundle:SguUsuario u WHERE u.roles LIKE :like_string AND u.sucursal = :sucursal_id ')
            ->setParameter('sucursal_id', $id_sucursal)
            ->setParameter('like_string', "%CLIENTE%")
            ->getArrayResult();
}
       
}
