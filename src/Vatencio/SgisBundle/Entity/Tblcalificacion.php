<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tblcalificacion
 */
class Tblcalificacion
{
    /**
     * @var integer
     */
    private $intidcalificacion;

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
     * @var \Vatencio\SgisBundle\Entity\Tbldocente
     */
    private $intiddocente;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tbllogro
     */
    private $intidlogro;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tblmateriaestudiante
     */
    private $intidmateriaestudiante;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tblnota
     */
    private $intidnota;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tblperiodoyear
     */
    private $intidperiodoyear;


    /**
     * Get intidcalificacion
     *
     * @return integer
     */
    public function getIntidcalificacion()
    {
        return $this->intidcalificacion;
    }

    /**
     * Set strnombre
     *
     * @param string $strnombre
     *
     * @return Tblcalificacion
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
     * @return Tblcalificacion
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
     * @return Tblcalificacion
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
     * @return Tblcalificacion
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
     * @return Tblcalificacion
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
     * @return Tblcalificacion
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
     * @return Tblcalificacion
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
     * Set intidlogro
     *
     * @param \Vatencio\SgisBundle\Entity\Tbllogro $intidlogro
     *
     * @return Tblcalificacion
     */
    public function setIntidlogro(\Vatencio\SgisBundle\Entity\Tbllogro $intidlogro = null)
    {
        $this->intidlogro = $intidlogro;

        return $this;
    }

    /**
     * Get intidlogro
     *
     * @return \Vatencio\SgisBundle\Entity\Tbllogro
     */
    public function getIntidlogro()
    {
        return $this->intidlogro;
    }

    /**
     * Set intidmateriaestudiante
     *
     * @param \Vatencio\SgisBundle\Entity\Tblmateriaestudiante $intidmateriaestudiante
     *
     * @return Tblcalificacion
     */
    public function setIntidmateriaestudiante(\Vatencio\SgisBundle\Entity\Tblmateriaestudiante $intidmateriaestudiante = null)
    {
        $this->intidmateriaestudiante = $intidmateriaestudiante;

        return $this;
    }

    /**
     * Get intidmateriaestudiante
     *
     * @return \Vatencio\SgisBundle\Entity\Tblmateriaestudiante
     */
    public function getIntidmateriaestudiante()
    {
        return $this->intidmateriaestudiante;
    }

    /**
     * Set intidnota
     *
     * @param \Vatencio\SgisBundle\Entity\Tblnota $intidnota
     *
     * @return Tblcalificacion
     */
    public function setIntidnota(\Vatencio\SgisBundle\Entity\Tblnota $intidnota = null)
    {
        $this->intidnota = $intidnota;

        return $this;
    }

    /**
     * Get intidnota
     *
     * @return \Vatencio\SgisBundle\Entity\Tblnota
     */
    public function getIntidnota()
    {
        return $this->intidnota;
    }

    /**
     * Set intidperiodoyear
     *
     * @param \Vatencio\SgisBundle\Entity\Tblperiodoyear $intidperiodoyear
     *
     * @return Tblcalificacion
     */
    public function setIntidperiodoyear(\Vatencio\SgisBundle\Entity\Tblperiodoyear $intidperiodoyear = null)
    {
        $this->intidperiodoyear = $intidperiodoyear;

        return $this;
    }

    /**
     * Get intidperiodoyear
     *
     * @return \Vatencio\SgisBundle\Entity\Tblperiodoyear
     */
    public function getIntidperiodoyear()
    {
        return $this->intidperiodoyear;
    }
    
    public function __toString() {
        return $this->strnombre;
    }
}
