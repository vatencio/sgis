<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tblrole
 */
class Tblrole
{
    /**
     * @var integer
     */
    private $intidrol;

    /**
     * @var string
     */
    private $strnombre;

    /**
     * @var string
     */
    private $strdescripcion;

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
     * Get intidrol
     *
     * @return integer
     */
    public function getIntidrol()
    {
        return $this->intidrol;
    }

    /**
     * Set strnombre
     *
     * @param string $strnombre
     *
     * @return Tblrole
     */
    public function setStrnombre($strnombre)
    {
        $this->strnombre = $strnombre;

        return $this;
    }

    /**
     * Get strnombre
     *
     * @return string
     */
    public function getStrnombre()
    {
        return $this->strnombre;
    }

    /**
     * Set strdescripcion
     *
     * @param string $strdescripcion
     *
     * @return Tblrole
     */
    public function setStrdescripcion($strdescripcion)
    {
        $this->strdescripcion = $strdescripcion;

        return $this;
    }

    /**
     * Get strdescripcion
     *
     * @return string
     */
    public function getStrdescripcion()
    {
        return $this->strdescripcion;
    }

    /**
     * Set dtmcreacion
     *
     * @param \DateTime $dtmcreacion
     *
     * @return Tblrole
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
     * @return Tblrole
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
     * @return Tblrole
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
     * @return Tblrole
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
}
