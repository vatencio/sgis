<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tblmateriadocente
 */
class Tblmateriadocente
{
    /**
     * @var integer
     */
    private $intidmateriadocente;

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
     * @var \Vatencio\SgisBundle\Entity\Tblmateria
     */
    private $intidmateria;


    /**
     * Get intidmateriadocente
     *
     * @return integer
     */
    public function getIntidmateriadocente()
    {
        return $this->intidmateriadocente;
    }

    /**
     * Set dtmcreacion
     *
     * @param \DateTime $dtmcreacion
     *
     * @return Tblmateriadocente
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
     * @return Tblmateriadocente
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
     * @return Tblmateriadocente
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
     * @return Tblmateriadocente
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
     * @return Tblmateriadocente
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
     * Set intidmateria
     *
     * @param \Vatencio\SgisBundle\Entity\Tblmateria $intidmateria
     *
     * @return Tblmateriadocente
     */
    public function setIntidmateria(\Vatencio\SgisBundle\Entity\Tblmateria $intidmateria = null)
    {
        $this->intidmateria = $intidmateria;

        return $this;
    }

    /**
     * Get intidmateria
     *
     * @return \Vatencio\SgisBundle\Entity\Tblmateria
     */
    public function getIntidmateria()
    {
        return $this->intidmateria;
    }
}
