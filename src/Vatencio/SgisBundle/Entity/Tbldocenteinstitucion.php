<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tbldocenteinstitucion
 */
class Tbldocenteinstitucion
{
    /**
     * @var integer
     */
    private $intiddocenteinstitucion;

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
     * @var \Vatencio\SgisBundle\Entity\Tblinstitucion
     */
    private $intidinstitucion;


    /**
     * Get intiddocenteinstitucion
     *
     * @return integer
     */
    public function getIntiddocenteinstitucion()
    {
        return $this->intiddocenteinstitucion;
    }

    /**
     * Set dtmcreacion
     *
     * @param \DateTime $dtmcreacion
     *
     * @return Tbldocenteinstitucion
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
     * @return Tbldocenteinstitucion
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
     * @return Tbldocenteinstitucion
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
     * @return Tbldocenteinstitucion
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
     * @return Tbldocenteinstitucion
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
     * Set intidinstitucion
     *
     * @param \Vatencio\SgisBundle\Entity\Tblinstitucion $intidinstitucion
     *
     * @return Tbldocenteinstitucion
     */
    public function setIntidinstitucion(\Vatencio\SgisBundle\Entity\Tblinstitucion $intidinstitucion = null)
    {
        $this->intidinstitucion = $intidinstitucion;

        return $this;
    }

    /**
     * Get intidinstitucion
     *
     * @return \Vatencio\SgisBundle\Entity\Tblinstitucion
     */
    public function getIntidinstitucion()
    {
        return $this->intidinstitucion;
    }
}
