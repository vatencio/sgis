<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tbldocentesede
 */
class Tbldocentesede
{
    /**
     * @var integer
     */
    private $intiddocentesede;

    /**
     * @var \DateTime
     */
    private $dtmcreacion;

    /**
     * @var string
     */
    private $strcreacion;

    /**
     * @var \DateTime
     */
    private $dtmactualizacion;

    /**
     * @var string
     */
    private $stractualizacion;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tbldocente
     */
    private $intiddocente;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tblsede
     */
    private $intidsede;


    /**
     * Get intiddocentesede
     *
     * @return integer
     */
    public function getIntiddocentesede()
    {
        return $this->intiddocentesede;
    }

    /**
     * Set dtmcreacion
     *
     * @param \DateTime $dtmcreacion
     *
     * @return Tbldocentesede
     */
    public function setDtmcreacion($dtmcreacion)
    {
        $this->dtmcreacion = $dtmcreacion;

        return $this;
    }

    /**
     * Get dtmcreacion
     *
     * @return \DateTime
     */
    public function getDtmcreacion()
    {
        return $this->dtmcreacion;
    }

    /**
     * Set strcreacion
     *
     * @param string $strcreacion
     *
     * @return Tbldocentesede
     */
    public function setStrcreacion($strcreacion)
    {
        $this->strcreacion = $strcreacion;

        return $this;
    }

    /**
     * Get strcreacion
     *
     * @return string
     */
    public function getStrcreacion()
    {
        return $this->strcreacion;
    }

    /**
     * Set dtmactualizacion
     *
     * @param \DateTime $dtmactualizacion
     *
     * @return Tbldocentesede
     */
    public function setDtmactualizacion($dtmactualizacion)
    {
        $this->dtmactualizacion = $dtmactualizacion;

        return $this;
    }

    /**
     * Get dtmactualizacion
     *
     * @return \DateTime
     */
    public function getDtmactualizacion()
    {
        return $this->dtmactualizacion;
    }

    /**
     * Set stractualizacion
     *
     * @param string $stractualizacion
     *
     * @return Tbldocentesede
     */
    public function setStractualizacion($stractualizacion)
    {
        $this->stractualizacion = $stractualizacion;

        return $this;
    }

    /**
     * Get stractualizacion
     *
     * @return string
     */
    public function getStractualizacion()
    {
        return $this->stractualizacion;
    }

    /**
     * Set intiddocente
     *
     * @param \Vatencio\SgisBundle\Entity\Tbldocente $intiddocente
     *
     * @return Tbldocentesede
     */
    public function setIntiddocente(\Vatencio\SgisBundle\Entity\Tbldocente $intiddocente = null)
    {
        $this->intiddocente = $intiddocente;

        return $this;
    }

    /**
     * Get intiddocente
     *
     * @return \Vatencio\SgisBundle\Entity\Tbldocente
     */
    public function getIntiddocente()
    {
        return $this->intiddocente;
    }

    /**
     * Set intidsede
     *
     * @param \Vatencio\SgisBundle\Entity\Tblsede $intidsede
     *
     * @return Tbldocentesede
     */
    public function setIntidsede(\Vatencio\SgisBundle\Entity\Tblsede $intidsede = null)
    {
        $this->intidsede = $intidsede;

        return $this;
    }

    /**
     * Get intidsede
     *
     * @return \Vatencio\SgisBundle\Entity\Tblsede
     */
    public function getIntidsede()
    {
        return $this->intidsede;
    }
}
